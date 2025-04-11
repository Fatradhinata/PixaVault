<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Content;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isEmpty;

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

    public function edit()
    {
        return view('user.profile_edit', [
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $req)
    {
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
}
