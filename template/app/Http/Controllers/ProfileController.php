<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProfileController extends Controller
{
    private function getTripleColumn($collection)
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

    public function index()
    {
        $user = Auth::user();

        return view('user.profile', [
            'user' => $user,
            'contents' => $this->getTripleColumn($user->contents),
            'liked' => $this->getTripleColumn($this->getLikedContent())
        ]);
    }

    public function details(User $id)
    {
        return view('user.profile', [
            'user' => $id,
            'contents' => $this->getTripleColumn($id->contents),
            'liked' => $this->getTripleColumn($this->getLikedContent())
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'bio' => 'nullable|string|max:500',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $upload = Cloudinary::upload($request->file('photo')->getRealPath(), [
                'folder' => 'profile_images'
            ]);

            $validated['photo'] = $upload->getPublicId();
        }

        $user->update($validated);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            throw ValidationException::withMessages([
                'old_password' => 'Old password is incorrect.',
            ]);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'Password updated successfully.');
    }

    public function edit()
    {
        return view('user.profile_edit', [
            'user' => Auth::user(),
        ]);
    }
}
