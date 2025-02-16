<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Models\Content;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    public function upload(Request $request)
    {
        // Validasi input
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|string|max:255',
            'desc' => 'required|string',
            'tags' => 'required|string',
            'shoot_by' => 'nullable|string',
        ]);

        // Pastikan user login
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'You must be logged in to upload.');
        }

        // Upload gambar ke Cloudinary
        $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();

        // Simpan ke database
        $content = new Content();
        $content->id_user = Auth::id();
        $content->name = $request->name;
        $content->desc = $request->desc;
        $content->photo = $uploadedFileUrl;
        $content->downloads = 0;
        $content->likes = 0;
        $content->views = 0;
        $content->tags = json_encode(explode(',', $request->tags)); // Ubah tags jadi JSON
        $content->save();

        return redirect()->back()->with('success', 'Photo uploaded successfully!');
    }

}
