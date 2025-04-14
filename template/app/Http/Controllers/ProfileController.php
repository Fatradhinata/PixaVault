<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Follow;
use App\Models\Content;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Divide a collection into three columns.
     *
     * This method takes a collection and splits it into three columns. The collection is first converted to an array,
     * then divided into three parts as evenly as possible. Any extra elements will be distributed to the columns in order.
     *
     * @param  \Illuminate\Support\Collection  $collection  The collection to be divided.
     * @return array  An array containing three sub-arrays, each representing a column.
     */
    private function getTripleColumn(Collection $collection)
    {
        $content = $collection->toArray();
        $divided_len = ceil(count($content) / 3);

        $tmp = [[], [], []];

        for ($i = 0; $i < $divided_len; $i++) {
            if (isset($content[$i * 3])) array_push($tmp[0], (object) $content[$i * 3]);
            if (isset($content[$i * 3 + 1])) array_push($tmp[1], (object) $content[$i * 3 + 1]);
            if (isset($content[$i * 3 + 2])) array_push($tmp[2], (object) $content[$i * 3 + 2]);
        }

        return $tmp;
    }

    /**
     * Retrieve content liked by the authenticated user.
     *
     * This private method fetches all content items that the currently authenticated user has liked.
     * Each content item is marked with an 'is_liked' flag (1 for liked, 0 otherwise) and includes
     * the associated user data. The query excludes content created by the authenticated user.
     *
     * @return \Illuminate\Database\Eloquent\Collection  Collection of liked content with user relationships
     */
    private function getLikedContent()
    {
        return Content::select('contents.*', DB::raw('CASE WHEN likes.id IS NOT NULL THEN 1 ELSE 0 END as is_liked'))
            ->leftJoin(
                'likes',
                fn($join) =>
                $join->on('contents.id', '=', 'likes.id_content')
                    ->where('likes.id_user', '=', Auth::id())
            )
            ->where('contents.id_user', '<>', Auth::id(), 'and')
            ->where('likes.id', 'IS NOT', null)
            ->with('user')
            ->get();
    }

    /**
     * Toggle follow status for a user.
     *
     * This method handles the follow/unfollow functionality between the authenticated user
     * and another user. It checks for valid authentication, prevents self-following, and
     * either creates or deletes a follow relationship based on current state.
     *
     * @param  string  $id  The UUID of the user to follow/unfollow
     * @return \Illuminate\Http\JsonResponse  JSON response indicating the new follow status or error
     */
    public function follow($id)
    {
        if (!Auth::check()) return response()->json(['redirect' => route('login')]);

        $userToFollow = User::find($id);
        if (!$userToFollow) return response()->json(['error' => 'User not found!'], 400);

        $currentUser = Auth::user();
        if ($userToFollow->id == $currentUser->id) return response()->json(['error' => 'You cannot follow yourself'], 400);

        $follow = Follow::where('follower_id', $currentUser->id)
            ->where('followed_id', $userToFollow->id)
            ->first();

        if ($follow) {
            // Unfollow
            $follow->delete();
            return response()->json(['status' => 'unfollowed']);
        } else {
            // Follow
            Follow::create([
                'follower_id' => $currentUser->id,
                'followed_id' => $userToFollow->id,
            ]);
            return response()->json(['status' => 'followed']);
        }
    }

    /**
     * Display user profile page with statistics.
     *
     * This method shows a user profile including their uploads, likes, views, downloads,
     * and follower count. If no user ID is provided in the query string, it defaults to
     * the authenticated user's profile. The view includes the user's content organized
     * in three columns and their liked content.
     *
     * Expected query parameters:
     * - id: uuid, optional — The user UUID to view (defaults to current user)
     *
     * @param  \Illuminate\Http\Request  $req  The incoming request containing optional user ID
     * @return \Illuminate\View\View  The profile view with user data and content
     */
    public function index(Request $req)
    {
        $userId = $req->query('id') ?: Auth::id();

        $user = User::with(['achievements', 'contents'])
            ->leftJoin('contents as c', 'users.id', '=', 'c.id_user')
            ->leftJoin('follows as f', 'users.id', '=', 'f.followed_id')
            ->select(
                'users.id',
                'users.name',
                'users.full_name',
                'users.email',
                'users.photo',
                'users.bio',
                DB::raw('COUNT(DISTINCT c.id) as total_uploads'),
                DB::raw('COALESCE(SUM(c.likes), 0) as total_likes'),
                DB::raw('COALESCE(SUM(c.views), 0) as total_views'),
                DB::raw('COALESCE(SUM(c.downloads), 0) as total_downloads'),
                DB::raw('COUNT(DISTINCT f.follower_id) as total_followers')
            )
            ->where('users.id', $userId)
            ->groupBy(
                'users.id',
                'users.name',
                'users.full_name',
                'users.email',
                'users.photo',
                'users.bio'
            )
            ->first();

        return view('user.profile', [
            'user' => $user,
            'contents' => $this->getTripleColumn($user->contents),
            'liked' => $this->getTripleColumn($this->getLikedContent())
        ]);
    }

    /**
     * Display profile edit page.
     *
     * This method shows the profile editing form for the currently authenticated user.
     * The form is pre-populated with the user's existing data.
     *
     * @return \Illuminate\View\View  The profile edit view with current user data
     */
    public function edit()
    {
        return view('user.profile_edit', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Update user profile information.
     *
     * This method handles updating the authenticated user's profile data including photo, name,
     * contact information, and bio. It validates the input, handles photo uploads (including
     * deletion of old photos), and updates the user record. Empty string values are stored for
     * null values in specific fields.
     *
     * Expected request data:
     * - photo: image, optional — Profile photo (jpg/jpeg/png, max 2MB)
     * - name: string, required — Username (max 20 characters)
     * - full_name: string, nullable — Full name (max 100 characters)
     * - phone_number: string, nullable — Phone number (max 72 characters)
     * - bio: string, nullable — Biography text (max 500 characters)
     *
     * @param  \Illuminate\Http\Request  $req  The incoming request containing profile data
     * @return \Illuminate\Http\RedirectResponse  Redirects back with status message
     */
    public function update(Request $req)
    {
        foreach (['full_name', 'phone_number', 'bio'] as $field)
            if ($req->has($field) && $req->input($field) === null) $req->merge([$field => '']);

        $validated = $req->validate([
            'photo' => 'image|mimes:jpg,jpeg,png|max:2048',
            'name' => 'required|string|max:20',
            'full_name' => 'nullable|string|max:100',
            'phone_number' => 'nullable|string|max:72',
            'bio' => 'nullable|string|max:500',
        ]);

        try {
            $user = Auth::user();

            if ($req->hasFile('photo')) {
                if (!$user->photo !== "" && Storage::exists("profile_photos/" . $user->photo))
                    Storage::delete("profile_photos/" . $user->photo);

                $file = $req->file('photo');
                $filename = uniqid('profile_', true) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('profile_photos', $filename, 'public');

                $validated['photo'] = $filename;
            }

            $user->update($validated);

            return redirect()->back()->with('success', 'Data updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Change user password.
     *
     * This method handles password changes for authenticated users. It verifies the old password
     * matches, confirms the new passwords match, and updates the password if validation passes.
     *
     * Expected request data:
     * - old-password: string, required — Current password for verification
     * - new-password: string, required — Desired new password
     * - confirm-password: string, required — New password confirmation
     *
     * @param  \Illuminate\Http\Request  $req  The incoming request containing password data
     * @return \Illuminate\Http\RedirectResponse  Redirects back with status message
     */
    public function changePassword(Request $req)
    {
        $validated = $req->validate([
            'old-password' => 'required|string',
            'new-password' => 'required|string',
            'confirm-password' => 'required|string',
        ]);

        try {
            $user = Auth::user();

            if (!password_verify($validated['old-password'], $user->password))
                return redirect()->back()->with('warning', 'Invalid old password');

            if ($validated['new-password'] !== $validated['confirm-password'])
                return redirect()->back()->with('warning', 'Confirm password must be same as new password!');

            $user->update([
                'password' => bcrypt($validated['new-password'])
            ]);

            return redirect()->back()->with('success', 'Password changed successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Retrieve a user's followers list.
     *
     * This method fetches all followers for a specified user, returning their basic profile
     * information including ID, name, and photo URL. The photo URL is converted to a full
     * asset path, with a default avatar used if no photo exists.
     *
     * @param  string  $id  The UUID of the user whose followers to retrieve
     * @return \Illuminate\Http\JsonResponse  JSON response containing follower data
     */
    public function getFollowers($id)
    {
        $user = User::with('followers')->findOrFail($id);

        $followers = $user->followers->map(fn($follower) => [
            'id' => $follower->id,
            'name' => $follower->name,
            'full_name' => $follower->full_name ?? '',
            'photo' => $follower->photo
                ? asset('storage/profile_photos/' . $follower->photo)
                : asset('img/icons/user-elipse.svg'),
        ]);

        return response()->json([
            'status' => 'success',
            'followers' => $followers
        ]);
    }
}
