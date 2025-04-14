<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
     * Display the home page with trending and explore content.
     *
     * This method retrieves two sets of content for the home page:
     * - Explore Content: Randomly selected content that is not created by the authenticated user. 
     * - Trending Content: Content that is most popular based on views, downloads, and likes within the current month.
     * 
     * It also checks if the content has been liked by the authenticated user and adds an `is_liked` attribute 
     * to indicate whether the user has liked the content.
     * Both sets of content are processed into three-column layout format using the `getTripleColumn` method.
     * 
     * The method returns a view with both the trending and explore content to be displayed on the home page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $contents = Content::select('contents.*', 'contents.id_user', DB::raw('CASE WHEN likes.id IS NOT NULL THEN 1 ELSE 0 END as is_liked'))
            ->leftJoin(
                'likes',
                fn($join) =>
                $join->on('contents.id', '=', 'likes.id_content')
                    ->where('likes.id_user', '=', Auth::id())
            )
            ->where('contents.id_user', '<>', Auth::id())
            ->inRandomOrder()
            ->with('user')
            ->limit(10)
            ->get();

        $startOfMonth = Carbon::now()->startOfMonth()->toDateTimeString();
        $endOfMonth = Carbon::now()->endOfMonth()->toDateTimeString();
        
        $trending = Content::select('contents.*', DB::raw('CASE WHEN likes.id IS NOT NULL THEN 1 ELSE 0 END as is_liked'))
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
            ->limit(10)
            ->with('user')
            ->get();

        $trending = $this->getTripleColumn($trending);
        $explore = $this->getTripleColumn($contents);       

        return view('user.home', [
            'trending' => $trending,
            'explore' => $explore,
        ]);
    }
}
