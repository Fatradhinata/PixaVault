<?php

namespace App\Http\Controllers;

use App\Models\Like;
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
        $content = Content::select('contents.*', DB::raw('CASE WHEN likes.id IS NOT NULL THEN 1 ELSE 0 END as is_liked'))
            ->leftJoin(
                'likes',
                fn($join) =>
                $join->on('contents.id', '=', 'likes.id_content')
                    ->where('likes.id_user', '=', Auth::id())
            )
            ->where('contents.id', $id)
            ->first();

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
        $contents = Content::select('contents.*', DB::raw('CASE WHEN likes.id IS NOT NULL THEN 1 ELSE 0 END as is_liked'))
            ->leftJoin(
                'likes',
                fn($join) =>
                $join->on('contents.id', '=', 'likes.id_content')
                    ->where('likes.id_user', '=', Auth::id())
            )
            ->where('contents.id_user', '<>', Auth::id())
            ->inRandomOrder()
            ->with('user')
            ->limit($limit)
            ->get();

        $data = $this->getTripleColumn($contents);

        return response()->json(($contents->count()) ? [
            'status' => 'success',
            'data' => $data,
        ] : [
            'status' => 'fail',
            'message' => 'Data is not found/empty',
        ]);
    }

    public function updateLike(Content $id)
    {
        $id_user = Auth::id();
        $id_content = $id->id;

        try {
            $like = Like::where('id_user', $id_user, 'and')->where('id_content', $id_content)->first();

            if ($like) {
                $like->delete();
                $id->decrement('likes');
                return response()->json(['status' => 'success', 'like' => false], 200);
            }

            $id->increment('likes');
            Like::create([
                'id_user' => $id_user,
                'id_content' => $id_content,
            ]);
            return response()->json(['status' => 'success', 'like' => true], 201);

        } catch (\Exception $e) {
            return response()->json(['status' => 'fail', 'message' => 'Something went wrong!'], 500);
        }
    }

    public function showImage($publicId)
    {
        try {
            if (empty($publicId))
                return response()->json(['error' => 'Public ID is required'], 400);

            $imageUrl = Cloudinary::getImage($publicId)->toUrl();
            $client = new Client();
            $response = $client->get($imageUrl, [
                'stream' => true,
                'width' => 200,  // Resize gambar menjadi lebar 800px
                'height' => 200, // Resize gambar menjadi tinggi 600px
                'quality' => 'auto:good',
                'format' => 'auto',
            ]);

            $statusCode = $response->getStatusCode();

            if ($statusCode != 200)
                return response()->json(['error' => 'Failed to fetch image from Cloudinary'], $statusCode);

            $contentType = $response->getHeaderLine('Content-Type');
            if (!$contentType)
                $contentType = 'application/octet-stream';

            return response()->stream(function () use ($response) {
                $stream = $response->getBody();
                while (!$stream->eof()) {
                    echo $stream->read(4096);
                    flush();
                }
            }, 200, ['Content-Type' => $contentType]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching image: ' . $e->getMessage()], 500);
        }
    }

    public function downloadImage(Content $id)
    {
        if (!$id)
            return redirect()->back()->with('error', 'Data not found!');

        $publicId = $id->photo;
        $user = User::find(Auth::id());

        if ($user->free_limit > 0) {

            $user->decrement('free_limit');
            $id->increment('downloads');

            try {
                if (empty($publicId))
                    return response()->json(['error' => 'Public ID is required'], 400);

                $client = new Client();
                $imageUrl = Cloudinary::getImage($publicId)->toUrl();
                $response = $client->get($imageUrl, ['stream' => true]);
                $statusCode = $response->getStatusCode();

                if ($statusCode != 200)
                    return response()->json(['error' => 'Failed to fetch image from Cloudinary'], $statusCode);

                $contentType = $response->getHeaderLine('Content-Type');
                if (!$contentType)
                    $contentType = 'application/octet-stream';

                $mimes = [
                    'image/jpeg' => 'jpg',
                    'image/png' => 'png',
                    'image/heic' => 'heic',
                    'image/webp' => 'webp',
                    'image/tiff' => 'tiff',
                ];

                $extention = isset($mimes[$contentType]) ? "." . $mimes[$contentType] : '';
                $fileName = str_replace(' ', '_', $id->name) . $extention;

                $tempFile = tempnam(sys_get_temp_dir(), 'download_');
                $tempHandle = fopen($tempFile, 'w+');

                $stream = $response->getBody();
                while (!$stream->eof())
                    fwrite($tempHandle, $stream->read(4096));
                fclose($tempHandle);

                return response()->download($tempFile, $fileName, [
                    'Content-Type' => $contentType,
                    'Content-Disposition' => 'attachment; filename="' . $fileName . '"'
                ])->deleteFileAfterSend(true);

            } catch (\Exception $e) {
                return response()->json(['error' => 'Error downloading image: ' . $e->getMessage()], 500);
            }
        } else {
            return redirect()->to(route('pricing') . '#subscribe')
                ->with('warning', 'You have reached your free limit! <br>Please purchase the subscription to download more photos.');
        }
    }

    public function index()
    {
        $contents = Content::select('contents.*', DB::raw('CASE WHEN likes.id IS NOT NULL THEN 1 ELSE 0 END as is_liked'))
            ->leftJoin(
                'likes',
                fn($join) =>
                $join->on('contents.id', '=', 'likes.id_content')
                    ->where('likes.id_user', '=', Auth::id())
            )
            ->where('contents.id_user', '<>', Auth::id())
            ->inRandomOrder()
            ->with('user')
            ->get();

        $data = $this->getTripleColumn($contents);

        return view('user.explore', [
            'contents' => $data,
        ]);
    }


    public function result(Request $req)
    {
        $search = $req->input('q');
        $tag = $req->input('t');

        $data = Content::select('contents.*', DB::raw('CASE WHEN likes.id IS NOT NULL THEN 1 ELSE 0 END as is_liked'))
            ->leftJoin(
                'likes',
                fn($join) =>
                $join->on('contents.id', '=', 'likes.id_content')
                    ->where('likes.id_user', '=', Auth::id())
            )
            ->where('contents.id_user', '<>', Auth::id())
            ->with('user');

        if ($search)
            $data = $data->where('contents.name', 'like', "%$search%")->orWhere('contents.desc', 'like', "%$search%");
        if ($tag)
            $data = $data->where('contents.tags', 'like', "%$tag%", 'and');

        $data = $data->get();
        $data = $this->getTripleColumn($data);

        return view('user.result', [
            'contents' => $data,
            'search' => $search,
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
