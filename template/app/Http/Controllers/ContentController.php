<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Like;
use App\Models\User;
use GuzzleHttp\Client;
use App\Models\Content;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Number;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;
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
            ->with('user')
            ->first();
    
        if (!$content) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Data is not found/empty',
            ]);
        }
    
        $content->increment('views');
    
        $data = $content->toArray();
    
        $data['created_at'] = date('d-m-Y', strtotime($data['created_at']));
        $data['updated_at'] = date('d-m-Y', strtotime($data['updated_at']));
    
        return response()->json([
            'status' => 'success',
            'data' => $data, 
        ]);
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'desc' => 'required|string|max:500',
            'shoot_by' => 'nullable|string|max:50',
        ]);


        $content = Content::findOrFail($id);

        $content->name = $request->name;
        $content->desc = $request->desc;
        $content->shoot_by = $request->shoot_by;
        $content->save();

        return response()->json(['status' => 'success']);
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

    public function like(Content $id)
    {
        try {
            if (!Auth::check())
                return response()->json(['redirect' => route('login')], 403);
            
            $id_user = Auth::id();
            $id_content = $id->id;

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

    public function show(string $publicId)
    {
        if (empty($publicId))
            return response()->json(['error' => 'Public ID is required'], 400);

        $cacheKey = "cloudinary_image_{$publicId}";

        try {
            // Cek apakah gambar sudah ada di cache
            $cachedImage = Cache::get($cacheKey);
            if ($cachedImage) {
                $cachedImage = base64_decode($cachedImage);
                return response()->stream(function () use ($cachedImage) {
                    echo $cachedImage;
                    flush();
                }, 200, ['Content-Type' => 'image/webp']);
            }

            // Ambil gambar dari Cloudinary dengan kualitas dikontrol langsung dari URL
            $imageUrl = Cloudinary::getImage($publicId)
                ->quality('auto:low') // Bisa diubah jadi 'auto:eco', 'auto:best', atau angka spesifik
                ->format('webp') // Pastikan format WebP untuk efisiensi
                ->toUrl();

            $client = new Client();
            $response = $client->get($imageUrl, ['stream' => true]);

            if ($response->getStatusCode() !== 200)
                return response()->json(['error' => 'Failed to fetch image from Cloudinary'], 500);

            $imageData = $response->getBody()->getContents();

            Cache::put($cacheKey, base64_encode($imageData), 3600);

            return response()->stream(function () use ($imageData) {
                echo $imageData;
                flush();
            }, 200, ['Content-Type' => 'image/webp']);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching image: ' . $e->getMessage()], 500);
        }
    }

    public function download(Content $id)
    {
        try {
            if (!Auth::check())
                return response()->json(['redirect' => route('login')], 403);
    
            if (!$id)
                return response()->json(['error' => 'Data not found!'], 404);
    
            $user = User::find(Auth::id());
            $subscription = ServiceProvider::subscriptionCheck($user->id);
    
            if (!$subscription) {
                if ($user->free_limit <= 0) {
                    return response()->json(['error' => "You've reached your free limit!"], 403);
                }

                $user->decrement('free_limit');
            }

            $publicId = $id->photo;
            $id->increment('downloads');

            if (empty($publicId))
                return response()->json(['error' => 'Public ID is required'], 400);

            $client = new Client();
            $imageUrl = Cloudinary::getImage($publicId)->toUrl();
            $response = $client->get($imageUrl, ['stream' => true]);
            $statusCode = $response->getStatusCode();

            if ($statusCode != 200)
                return response()->json(['error' => 'Failed to fetch image from Cloudinary'], $statusCode);

            $contentType = $response->getHeaderLine('Content-Type') ?: 'application/octet-stream';

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

    public function trending()
    {
        $startOfMonth = Carbon::now()->startOfMonth()->toDateTimeString();
        $endOfMonth = Carbon::now()->endOfMonth()->toDateTimeString();
        
        $contents = Content::select('contents.*', DB::raw('CASE WHEN likes.id IS NOT NULL THEN 1 ELSE 0 END as is_liked'))
            ->leftJoin(
                'likes',
                fn($join) =>
                $join->on('contents.id', '=', 'likes.id_content')
                    ->where('likes.id_user', '=', Auth::id())
            )
            ->where('contents.id_user', '<>', Auth::id())
            ->orderBy('contents.created_at', 'desc')
            ->orderByRaw(
                "CASE 
                    WHEN contents.created_at BETWEEN ? AND ? THEN 0 
                    ELSE 1 
                END", [$startOfMonth, $endOfMonth]
            )
            ->orderByDesc('downloads')
            ->orderByDesc('views')
            ->orderByDesc('likes')
            ->limit(50)
            ->with('user')
            ->get();

        $data = $this->getTripleColumn($contents);

        return view('user.trending', [
            'contents' => $data
        ]);
    }


    public function result(Request $req)
    {
        $search = $req->input('q');
        $tag = $req->input('t');

        // === CONTENT SEARCH ===
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
            $data = $data->where(function ($q) use ($search) {
                $q->where('contents.name', 'like', "%$search%")
                    ->orWhere('contents.desc', 'like', "%$search%");
            });

        if ($tag)
            $data = $data->where('contents.tags', 'like', "%$tag%");

        $data = $data->get();
        $data = $this->getTripleColumn($data);

        // === USER SEARCH ===
        $users = collect();
        if ($search) {
            $users = User::withCount('followers')
                ->where('id', '<>', Auth::id())
                ->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%")
                        ->orWhere('full_name', 'like', "%$search%");
                })
                ->take(20)
                ->get();
        }


        return view('user.result', [
            'contents' => $data,
            'search' => $search,
            'users' => $users,
        ]);
    }


    public function upload()
    {
        $user = User::find(Auth::id());
        $subscription = ServiceProvider::subscriptionCheck($user->id);
    
        if (!$subscription) {
            if ($user->free_limit <= 0) {
                return redirect()
                    ->to(route('pricing') . '#subscribe')
                    ->with('warning', 'You have reached your free limit! <br>Please purchase the subscription to upload more photos.');
            }

            $user->decrement('free_limit');
        }

        return view('user.upload');
    }

    public function tags(Request $req)
    {
        $q = $req->get('q');

        $results = Tag::where('name', 'like', "$q%")
            ->orderBy('name')
            ->limit(15)
            ->pluck('name');

        return response()->json($results);
    }

    public function store(Request $req)
    {
        $validated = $req->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,heic,arw,tiff|min:1024|max:12288',
            'name' => 'required|string|max:255',
            'desc' => 'required|string',
            'tags' => 'required|string',
            'shoot_by' => 'nullable|string',
        ]);

        try {
            $user = User::find(Auth::id());
            $subscription = ServiceProvider::subscriptionCheck($user->id);
        
            if (!$subscription) {
                if ($user->free_limit <= 0) {
                    return redirect()
                        ->to(route('pricing') . '#subscribe')
                        ->with('warning', 'You have reached your free limit! <br>Please purchase the subscription to upload more photos.');
                }
    
                $user->decrement('free_limit');
            }
            
            $tagObjects = json_decode($validated['tags']);
            $inputTags = array_map(fn($tag) => htmlspecialchars(trim($tag->value)), $tagObjects);

            $tagsJson = json_encode($inputTags);

            foreach ($inputTags as $tagName) {
                $exists = Tag::where('name', $tagName)->exists();

                if (!$exists) {
                    Tag::create(['name' => $tagName]);
                }
            }

            $photo = Cloudinary::upload($req->file('image')->getRealPath());

            $data = array_merge($validated, [
                'id_user' => $user->id,
                'tags' => $tagsJson,
                'photo' => $photo->getPublicId(),
            ]);

            Content::create($data);

            return redirect()->route('profile')->with('success', 'Photo uploaded successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function destroy(Request $req)
    {
        $id = Content::find($req->input('id'));
        if (!$id) return redirect()->back()->with('error', 'Data not found!');

        try {
            if (Auth::user()->role == 'admin') {
                Cloudinary::destroy($id->photo);

                $id->delete();
                return redirect()->back()->with('success', 'Content deleted successfully!');
            }

            return redirect()->back()->with('warning', 'You are not authorized to delete this content!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }
}
