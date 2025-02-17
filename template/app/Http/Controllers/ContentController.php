<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Models\Content;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    public function index() 
    {
        return view('user.content');
    }

    public function upload() 
    {
        return view('user.upload');
    }

    public function store(Request $req)
    {
        $validated = $req->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|string|max:255',
            'desc' => 'required|string',
            'tags' => 'required|string',
            'shoot_by' => 'nullable|string',
        ]);

        try {
            $tags = json_encode(
                array_map(
                    fn($a) => htmlspecialchars(trim($a)), 
                    explode(',', $validated['tags'])
                )
            );
    
            $photo = Cloudinary::upload($req->file('image')->getRealPath())->getSecurePath();
            $data = array_merge($validated, [
                'id_user' => Auth::id(),
                'tags' => $tags,
                'photo' => $photo,
            ]);
    
            Content::create($data);

        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'Something went wrong when uploading. Please try again.');
        }

        return redirect()->back()->with('success', 'Photo uploaded successfully!');
    }

}
