<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use App\Models\Content;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Number;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


class ContentController extends Controller
{
    private function getTripleColumn($collection)
    {
        $content = $collection->toArray();
        $divided_len = ceil(count($content) / 3);

        $tmp = [[], [], []];

        for ($i = 0; $i < $divided_len; $i++) {
            if (isset($content[$i * 3]))
                array_push($tmp[0], (object) $content[$i * 3]);
            if (isset($content[$i * 3 + 1]))
                array_push($tmp[1], (object) $content[$i * 3 + 1]);
            if (isset($content[$i * 3 + 2]))
                array_push($tmp[2], (object) $content[$i * 3 + 2]);
        }

        return $tmp;
    }

    public function getDataById($id)
    {
        $content = Content::with('user')->find($id);
        $content->increment('views');
        
        $data = $content->toArray();
        $data['created_at'] = date('d-m-Y', strtotime($data['created_at']));
        $data['updated_at'] = date('d-m-Y', strtotime($data['updated_at']));

        return response()->json(($content) ? [
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
        $data = $this->getTripleColumn($contents);

        return response()->json(($contents->count()) ? [
            'status' => 'success',
            'data' => $data,
        ] : [
            'status' => 'fail',
            'message' => 'Data is not found/empty',
        ]);
    }

    public function showImage($publicId)
    {
        try {
            if (empty($publicId))
                return response()->json(['error' => 'Public ID is required'], 400);

            $imageUrl = Cloudinary::getImage($publicId)->toUrl();
            $client = new Client();
            $response = $client->get($imageUrl, ['stream' => true]);
            $statusCode = $response->getStatusCode();

            if ($statusCode != 200)
                return response()->json(['error' => 'Failed to fetch image from Cloudinary'], $statusCode);

            $contentType = $response->getHeaderLine('Content-Type');
            if (!$contentType) $contentType = 'application/octet-stream';

            return response()->stream(function() use ($response) {
                $stream = $response->getBody();
                while (!$stream->eof()) {
                    echo $stream->read(4096);
                    flush();
                }
            }, 200, [ 'Content-Type' => $contentType ]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching image: ' . $e->getMessage()], 500);
        }
    }
    
    public function index()
    {
        $data = Content::inRandomOrder()->with('user')->get();
        $data = $this->getTripleColumn($data);

        return view('user.explore', [
            'contents' => $data,
        ]);
    }

    public function result(Request $req)
    {
        $search = $req->input('q');
        $tag = $req->input('t');

        $data = Content::with('user');

        if ($search)
            $data = $data->where('name', 'like', "%$search%")->orWhere('desc', 'like', "%$search%");
        if ($tag)
            $data = $data->where('tags', 'like', "%$tag%", 'and');

        $data = $data->get();
        $data = $this->getTripleColumn($data);

        return view('user.result', [
            'contents' => $data,
            'search' => $search,
        ]);
    }
    public function explore(Request $req)
    {
        $data = Content::with('user');

        $data = $data->get();
        $data = $this->getTripleColumn($data);

        return view('user.explore', [
            'contents' => $data,
        ]);
    }

    public function upload()
    {
        $user = User::find(Auth::id());

        if ($user->free_limit <= 0) {
            return redirect()->to(route('pricing') . '#subscribe')
                ->with('warning', 'You have reached your free limit! <br>Please purchase the subscription to upload more photos.');
        }
        
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

        $user = User::find(Auth::id());

        if ($user->free_limit > 0) {
            
            $user->decrement('free_limit');
            
            try {
                $tags = json_encode(
                    array_map(
                        fn($a) => htmlspecialchars(trim($a)),
                        explode(',', $validated['tags'])
                    )
                );
                
                $photo = Cloudinary::upload($req->file('image')->getRealPath());

                $data = array_merge($validated, [
                    'id_user' => $user->id,
                    'tags' => $tags,
                    'photo' => $photo->getPublicId(),
                ]);
    
                Content::create($data);
    
            } catch (\Exception $e) {
                return redirect()->back()
                    ->with('error', 'Something went wrong when uploading. Please try again.');
            }
    
            return redirect()->route('profile')
                ->with('success', 'Photo uploaded successfully!');
        } 
        
        return redirect()->to(route('pricing') . '#subscribe')
            ->with('warning', 'You have reached your free limit! <br>Please purchase the subscription to upload more photos.');
    }


}
