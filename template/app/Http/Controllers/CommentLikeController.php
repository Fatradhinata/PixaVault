<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentLike;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentLikeController extends Controller
{
    public function likeComment(Request $request, $commentId)
    {
        $userId = Auth::id(); // Ambil ID user yang sedang login

        // Cek apakah user sudah like komentar ini
        $existingLike = CommentLike::where('comment_id', $commentId)
            ->where('user_id', $userId)
            ->first();

        if ($existingLike) {
            return response()->json(['message' => 'You already liked this comment'], 400);
        }

        // Simpan like baru
        CommentLike::create([
            'comment_id' => $commentId,
            'user_id' => $userId,
        ]);

        return response()->json(['message' => 'Comment liked successfully']);
    }

    public function unlikeComment(Request $request, $commentId)
    {
        $userId = Auth::id();

        // Hapus like jika ada
        $deleted = CommentLike::where('comment_id', $commentId)
            ->where('user_id', $userId)
            ->delete();

        if ($deleted) {
            return response()->json(['message' => 'Comment unliked successfully']);
        }

        return response()->json(['message' => 'You have not liked this comment'], 400);
    }
}
