<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Str;

class CommentController extends Controller
{
    /**
     * Store a new comment for a specific content.
     *
     * This method validates the incoming request to ensure that a valid comment and content ID are provided.
     * It then creates a new comment record in the database, retrieves the total number of comments for the content,
     * and returns a JSON response with the newly created comment data, including user information, like status, 
     * and the total number of comments for the content.
     *
     * Expected request data:
     * - comment: required, string, max 500 characters — the comment text.
     * - id_content: required, integer — the UUID of the content to which the comment belongs.
     *
     * @param  \Illuminate\Http\Request  $req  The HTTP request instance containing comment data.
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $req)
    {
        $req->validate([
            'comment' => 'required|string|max:500',
            'id_content' => 'required|exists:contents,id'
        ]);

        $user = User::find(Auth::id());

        $comment = Comment::create([
            'id' => Str::uuid(),
            'id_user' => $user->id,
            'id_content' => $req->id_content,
            'comment' => $req->comment
        ]);

        $totalComments = Comment::where('id_content', $req->id_content)->count();

        return response()->json([
            'success' => true,
            'comment' => [
                'user_name' => $user->name,
                'user_image' => $user->photo
                    ? asset('storage/profile_photos/' . $user->photo)
                    : asset('img/icons/user-elipse.svg'),
                'comment' => $comment->comment,
                'id' => $comment->id,
                'likes' => $comment->likes->count() ?? 0,
                'is_liked' => $comment->likes()->where('user_id', Auth::id())->exists(),
                'total_comment' => $totalComments
            ]
        ]);
    }

    /**
     * Delete a specific comment.
     *
     * This method checks if the authenticated user is the owner of the comment. If so, it deletes the comment from
     * the database. If the user is not the owner of the comment, a 403 Unauthorized response is returned. 
     * Upon successful deletion, a success message is returned in a JSON response.
     *
     * @param  int  $id  The ID of the comment to be deleted.
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        if (Auth::id() !== $comment->id_user)
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);

        $comment->delete();

        return response()->json(['success' => true, 'message' => 'Comment deleted']);
    }

    /**
     * Get a paginated list of comments for a specific content.
     *
     * This method retrieves comments for a given content ID, paginates the results, 
     * and includes additional information like user details, like count, and like status.
     * If no comments are found, it returns a failure message. Otherwise, it returns the 
     * comments along with pagination data such as the total number of comments and whether
     * more comments are available for the next page.
     *
     * Expected request data:
     * - page: integer, optional — the page number for pagination (default is 1).
     * - contentId: integer, required — the UUID of the content for which comments are being fetched.
     *
     * @param  \Illuminate\Http\Request  $req  The HTTP request instance containing pagination data.
     * @param  int  $contentId  The ID of the content for which comments are being retrieved.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $req, $contentId)
    {
        $perPage = 5;
        $page = $req->query('page', 1);

        $comments = Comment::where('id_content', $contentId)
            ->with('user')
            ->latest()
            ->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();

        $totalComments = Comment::where('id_content', $contentId)->count();

        $hasMore = ($page * $perPage) < $totalComments;

        if ($comments->isEmpty()) {
            return response()->json([
                'status' => 'fail',
                'message' => 'No comments found',
            ]);
        }

        return response()->json([
            'status' => 'success',
            'totalComment' => $totalComments,
            'hasMore' => $hasMore,
            'data' => $comments->map(function ($comment) {
                return [
                    'id' => $comment->id,
                    'user_name' => $comment->user->name ?? 'Unknown User',
                    'user_image' => $comment->user && $comment->user->photo
                        ? url('storage/profile_photos/' . $comment->user->photo)
                        : asset('img/icons/user-elipse.svg'),
                    'comment' => $comment->comment,
                    'created_at' => $comment->created_at->diffForHumans(),
                    'likes' => $comment->likes->count() ?? 0,
                    'is_liked' => $comment->likes()->where('user_id', Auth::id())->exists(),
                ];
            }),
        ]);
    }
}
