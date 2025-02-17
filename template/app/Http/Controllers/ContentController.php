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

    private function getTripleColumn($collection)
    {
        $content = $collection->toArray();
        $divided_len = ceil(count($content) / 3);

        $tmp = [[], [], []];

        for ($i = 0; $i < $divided_len; $i++) {
            if (isset($content[$i*3])) array_push($tmp[0], (object) $content[$i*3]);
            if (isset($content[$i*3+1])) array_push($tmp[1], (object) $content[$i*3+1]);
            if (isset($content[$i*3+2])) array_push($tmp[2], (object) $content[$i*3+2]);
        }

        return $tmp;
    }

    public function explore(Request $req)
    {
        $search = $req->input('search');
        $tag = $req->input('tag');

        $data = Content::with('user');
        
        if ($search)
            $data = $data->where('name', 'like', "%$search%")->orWhere('desc', 'like', "%$search%");
        if ($tag)
            $data = $data->where('tags', 'like', "%$tag%", 'and');

        $data = $data->get();
        $data = $this->getTripleColumn($data);

        return view('user.explore', [
            'contents' => $data
        ]);
    }

    public function getDataById($id)
    {
        $contents = Content::with('user')->find($id);
        $data = $contents->toArray();
        $data['created_at'] = date('d-m-Y', strtotime($data['created_at']));
        $data['updated_at'] = date('d-m-Y', strtotime($data['updated_at']));

        return response()->json(($contents->count()) ? [
            'status' => 'success',
            'data' => $data,
        ] : [
            'status' => 'fail',
            'message' => 'Data is not found/empty',
        ]);
    }

    public function getRandom($limit)
    {
        $contents = Content::inRandomOrder()->with('user')->limit($limit)->get();
        $data = $contents->toArray();

        return response()->json(($contents->count()) ? [
            'status' => 'success',
            'data' => $data,
        ] : [
            'status' => 'fail',
            'message' => 'Data is not found/empty',
        ]);
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
