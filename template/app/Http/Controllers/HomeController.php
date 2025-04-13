<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
    // public function blog()
    // {
    //     return view('user.blog');
    // }
    // public function leaderboard()
    // {
    //     return view('user.leaderboard');
    // }
    // public function favorites()
    // {
    //     return view('user.favorites');
    // }
    // public function history_download()
    // {
    //     return view('user.history_download');
    // }
    // public function payment()
    // {
    //     return view('user.payment');
    // }

}
