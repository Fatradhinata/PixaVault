<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Content;
use Illuminate\Support\Facades\DB;

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
        $contents = Content::select('contents.*', DB::raw('CASE WHEN likes.id IS NOT NULL THEN 1 ELSE 0 END as is_liked'))
        ->leftJoin('likes', fn($join) => 
            $join->on('contents.id', '=', 'likes.id_content')
                ->where('likes.id_user', '=', Auth::id())
        )
        ->inRandomOrder()
        ->with('user')
        ->limit(10)
        ->get();

        $trending = $this->getTripleColumn($contents);
        $explore = $this->getTripleColumn($contents);
            
        return view('user.home', [
            'trending' => array_map(fn($col) => array_reverse($col), $trending),
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
    
    // public function trending()
    // {
    //     return view('user.trending');
    // }
}
