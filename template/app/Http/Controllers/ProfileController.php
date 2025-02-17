<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    private function getTripleColumnContents($collection)
    {
        $content = $collection->contents->toArray();
        $divided_len = ceil(count($content) / 3);

        $tmp = [[], [], []];

        for ($i = 0; $i < $divided_len; $i++) {
            if (isset($content[$i*3])) array_push($tmp[0], (object) $content[$i*3]);
            if (isset($content[$i*3+1])) array_push($tmp[1], (object) $content[$i*3+1]);
            if (isset($content[$i*3+2])) array_push($tmp[2], (object) $content[$i*3+2]);
        }

        return $tmp;
    }

    public function index()
    {
        $user = Auth::user();
        $contents = $this->getTripleColumnContents($user);

        return view('user.profile', [
            'user' => $user,
            'contents' => $contents,
        ]);
    }

    public function details(User $id) {
        $contents = $contents = $this->getTripleColumnContents($id);
        return view('user.profile', [
            'user' => $id,
            'contents' => $contents,
        ]); 
    }
}
