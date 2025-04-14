<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentLike;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentLikeController extends Controller
{
    /**
     * Like a specific comment.
     *
     * This method allows a user to like a comment. It first checks if the user has already liked the comment.
     * If the user has liked the comment previously, a message is returned indicating this. If the user hasn't liked
     * the comment yet, the like is created and a success message is returned.
     *
     * @param  string  $commentId  The UUID of the comment to be liked.
     * @return \Illuminate\Http\JsonResponse
     */
    public function likeComment(string $commentId)
    {
        $userId = Auth::id();

        $existingLike = CommentLike::where('comment_id', $commentId)
            ->where('user_id', $userId)
            ->first();

        if ($existingLike)
            return response()->json(['message' => 'You already liked this comment'], 400);

        CommentLike::create([
            'comment_id' => $commentId,
            'user_id' => $userId,
        ]);

        return response()->json(['message' => 'Comment liked successfully']);
    }

    /**
     * Unlike a specific comment.
     *
     * This method allows a user to remove their like from a comment. It first checks if the user has liked the comment.
     * If the user has liked the comment, the like is deleted and a success message is returned. If the user hasn't liked
     * the comment, a message is returned indicating this.
     *
     * @param  string  $commentId  The UUID of the comment to be unliked.
     * @return \Illuminate\Http\JsonResponse
     */
    public function unlikeComment(string $commentId)
    {
        $userId = Auth::id();

        $deleted = CommentLike::where('comment_id', $commentId)
            ->where('user_id', $userId)
            ->delete();

        if ($deleted) {
            return response()->json(['message' => 'Comment unliked successfully']);
        }

        return response()->json(['message' => 'You have not liked this comment'], 400);
    }
}
