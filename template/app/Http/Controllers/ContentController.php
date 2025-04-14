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
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ContentController extends Controller
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
            if (isset($content[$i * 3]))
                array_push($tmp[0], (object) $content[$i * 3]);
            if (isset($content[$i * 3 + 1]))
                array_push($tmp[1], (object) $content[$i * 3 + 1]);
            if (isset($content[$i * 3 + 2]))
                array_push($tmp[2], (object) $content[$i * 3 + 2]);
        }

        return $tmp;
    }

    /**
     * Retrieve content data by its ID.
     *
     * This method fetches the content based on the provided ID and includes information about whether the content
     * is liked by the authenticated user. It also increments the view count of the content. The retrieved content 
     * data is formatted (dates are converted) and returned in a JSON response.
     *
     * @param  string  $id  The UUID of the content to retrieve.
     * @return \Illuminate\Http\JsonResponse  The JSON response with the content data or an error message.
     */
    public function getDataById(string $id)
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

    /**
     * Retrieve a random selection of contents.
     *
     * This method fetches a random selection of content from the database, excluding the authenticated user's content
     * and optionally excluding a specific content ID passed via the query string. It also determines whether the 
     * authenticated user has liked each piece of content. The results are formatted into groups of three columns 
     * and returned in a JSON response.
     *
     * @param  int  $limit  The number of random contents to retrieve.
     * @return \Illuminate\Http\JsonResponse  The JSON response containing the selected contents or an error message.
     */
    public function getRandom(int $limit)
    {
        $excludeId = request()->query('exclude_id');

        $contents = Content::select('contents.*', DB::raw('CASE WHEN likes.id IS NOT NULL THEN 1 ELSE 0 END as is_liked'))
            ->leftJoin(
                'likes',
                fn($join) =>
                $join->on('contents.id', '=', 'likes.id_content')
                    ->where('likes.id_user', '=', Auth::id())
            )
            ->where('contents.id_user', '<>', Auth::id())
            ->when($excludeId, function ($query, $excludeId) {
                $query->where('contents.id', '<>', $excludeId);
            })
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

    /**
     * Like or unlike a content item.
     *
     * This method checks if the user is authenticated, and if so, either adds or removes a like
     * for the specified content. It also updates the content's like count accordingly. If the user
     * is not authenticated, it returns a redirect URL to the login page.
     *
     * @param  \App\Models\Content  $id  The content item being liked/unliked.
     * @return \Illuminate\Http\JsonResponse  The JSON response indicating the status of the like action.
     */
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

    /**
     * Display an image by its public ID from Cloudinary.
     * 
     * This method first checks if the image is available in the cache. If the image is cached, 
     * it returns the cached image. If not, it fetches the image from Cloudinary, caches it, 
     * and then returns the image in the WebP format. This method also compress fetched image
     * in a low quality to optimize the page.
     * 
     * @param  string  $publicId  The public ID of the image in Cloudinary.
     * @return \Illuminate\Http\Response  The image response, either from cache or fetched from Cloudinary.
     */
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

    /**
     * Download a file (image) from Cloudinary after checking subscription and free limit.
     *
     * This method performs several steps:
     * 1. Verifies user authentication.
     * 2. Checks if the user has subscription to download the image.
     * 3. If not, check if the user has enough free limit to download the image.
     * 4. Fetches the high quality image from Cloudinary.
     * 5. Streams the image to the user, along with proper headers for downloading the file.
     * 6. Handles errors gracefully with appropriate status codes and messages.
     *
     * @param  Content  $id  The content (image) to be downloaded.
     * @return \Illuminate\Http\Response  The image file as a downloadable response.
     */
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

    /**
     * Display a list of contents that are not created by the authenticated user.
     *
     * This method fetches the contents from the database, checks if the authenticated user has liked
     * each content, and returns the results in random order. The contents are grouped into 3 columns
     * for presentation on the explore page.
     *
     * Expected response:
     * - contents: array, contains a list of contents with associated data like user and like status.
     *
     * @return \Illuminate\View\View
     */
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

    /**
     * Redirect to detail content's ID.
     *
     * This method redirects to the explore page with a query parameter `show` containing the content's ID.
     * The content ID will be used to display more details in the explore view.
     *
     * @param  string  $id  The ID of the content to display in the explore view.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function showInExplore(string $id)
    {
        return redirect()->route('explore', ['show' => $id]);
    }

    /**
     * Display the trending contents for the current month.
     *
     * This method fetches contents that are trending based on several factors such as the number of
     * views, likes, and downloads. The contents are sorted based on the popularity within the current
     * month and across the entire platform. The results are ordered by the number of downloads, views,
     * and likes, with the most popular content appearing first.
     *
     * Expected response:
     * - contents: array, contains a list of trending contents with associated data like user and like status.
     *
     * @return \Illuminate\View\View
     */
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
                END",
                [$startOfMonth, $endOfMonth]
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

    /**
     * Perform a search for contents and users.
     *
     * This method handles search functionality for both contents and users. It accepts a query string
     * (`q`) and an optional tag filter (`t`). It then searches for contents whose name, description, or tags
     * match the query string. It also searches for users whose name or full name matches the query string.
     * The results are returned in a view with the contents and users that match the search criteria.
     *
     * Expected request data:
     * - q: string, optional — the search query to match contents and users by name, description, or tags.
     * - t: string, optional — the tag to filter contents by. If provided, only contents with matching tags will be included in the search.
     *
     * @param  \Illuminate\Http\Request  $req  The incoming request containing the search query and optional tag filter.
     * @return \Illuminate\View\View
     */
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

        if ($search) {
            $data = $data->where(function ($q) use ($search) {
                $q->where('contents.name', 'like', "%$search%")
                    ->orWhere('contents.desc', 'like', "%$search%")
                    ->orWhere('contents.tags', 'like', "%$search%");
            });
        }

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

    /**
     * Show the upload page or redirect if the user has reached their free upload limit.
     *
     * This method checks if the user has an active subscription or if they have reached their free upload limit.
     * If the user has reached their free limit, they are redirected to the pricing page with a warning message.
     * If the user has a valid subscription or hasn't reached their free limit, the method returns the upload page view.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
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
        }

        return view('user.upload');
    }

    /**
     * Search and retrieve tags that start with a given query string.
     *
     * This method searches for tags whose names start with the provided query string (`q`).
     * It returns a list of tag names (up to a limit of 15) that match the query.
     *
     * Expected request data:
     * - q: string, required — the search query to tags search.
     * 
     * @param  \Illuminate\Http\Request  $req  The incoming request containing the query parameter `q` for tag search.
     * @return \Illuminate\Http\JsonResponse  A JSON response containing a list of tag names that match the query.
     */
    public function tags(Request $req)
    {
        $q = $req->get('q');

        $results = Tag::where('name', 'like', "$q%")
            ->orderBy('name')
            ->limit(15)
            ->pluck('name');

        return response()->json($results);
    }

    /**
     * Store a newly uploaded photo along with its details.
     *
     * This method handles the upload of a new photo, validates the input data, and processes the tags and other photo-related information.
     * It also checks the user's subscription and free upload limit. If the user has exceeded the free limit, they are redirected to the pricing page.
     * If the upload is successful, the photo's details (including tags) are stored in the database. A successful response is returned for AJAX requests,
     * or the user is redirected to their profile page with a success message for non-AJAX requests.
     *
     * Expected request data:
     * - image: file, required — the image file to upload (must be of type jpg, jpeg, png, heic, arw, tiff with size between 200KB and 12MB).
     * - name: string, required — the name of the photo.
     * - desc: string, required — a description of the photo.
     * - tags: string, required — a JSON-encoded array of tag objects to associate with the photo.
     * - shoot_by: string, optional — the name of the photographer, if provided.
     * 
     * @param  \Illuminate\Http\Request  $req  The incoming request containing the photo and metadata for the upload.
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse  A redirect response or JSON response based on the request type.
     */
    public function store(Request $req)
    {
        $validated = $req->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,heic,arw,tiff|min:200|max:12288',
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
                if (!Tag::where('name', $tagName)->exists()) {
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

            if ($req->ajax()) {
                return response()->json([
                    'status' => 'success', 
                    'message' => 'Photo uploaded successfully!'
                ], 200);
            }

            return redirect()->route('profile')->with('success', 'Photo uploaded successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Update content details.
     *
     * This method updates the details of a specific content item. It validates the incoming 
     * request data, ensuring the content name, description, and optional "shoot_by" field 
     * adhere to the specified constraints. If the validation is successful, the content record 
     * is updated with the new data. If the content with the provided ID is found and updated 
     * successfully, a success response is returned.
     *
     * Expected request data:
     * - name: string, required — the name/title of the content (max length: 100 characters).
     * - desc: string, required — the description of the content (max length: 500 characters).
     * - shoot_by: string, optional — the camera or tool used to capture the content (max length: 50 characters).
     *
     * @param  \Illuminate\Http\Request  $req  The incoming HTTP request containing the updated content data.
     * @param  string  $id  The ID of the content to update.
     * @return \Illuminate\Http\JsonResponse The JSON response containing the status, wheter it success or not.
     */
    public function update(Request $req, string $id)
    {
        $validated = $req->validate([
            'name' => 'required|string|max:100',
            'desc' => 'required|string|max:500',
            'shoot_by' => 'nullable|string|max:50',
        ]);

        Content::findOrFail($id)->update($validated);

        return response()->json(['status' => 'success']);
    }

    /**
     * Delete a content and its associated photo.
     *
     * This method handles the deletion of a content record. It checks whether the content 
     * exists and if the currently authenticated user has the necessary permissions to 
     * delete it (either as an admin or as the user who created the content). If the 
     * content exists and the user is authorized, the associated photo is deleted from 
     * Cloudinary, and the content record is removed from the database. If the request 
     * is not authorized, a 403 error is returned. In case of any errors, a 500 error 
     * is returned with an appropriate error message.
     *
     *
     * @param  string  $id  The ID of the content to delete.
     * @return \Illuminate\Http\JsonResponse The JSON response containing the status and the message for the client.
     */
    public function destroy($id)
    {
        $content = Content::find($id);
        if (!$content) {
            return response()->json(['success' => false, 'message' => 'Content not found!'], 404);
        }

        try {
            if (Auth::user()->role === 'admin' || Auth::id() === $content->id_user) {
                Cloudinary::destroy($content->photo);

                $content->delete();
                return response()->json(['success' => true, 'message' => 'Content deleted successfully!']);
            }

            return response()->json(['success' => false, 'message' => 'You are not authorized to delete this content!'], 403);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!'], 500);
        }
    }
}
