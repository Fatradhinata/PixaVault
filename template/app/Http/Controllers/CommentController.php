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
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
            'id_content' => 'required|exists:contents,id'
        ]);

        $user = User::find(Auth::id());

        $comment = Comment::create([
            'id' => Str::uuid(),
            'id_user' => $user->id,
            'id_content' => $request->id_content,
            'comment' => $request->comment
        ]);

        return response()->json([
            'success' => true,
            'comment' => [
                'user_name' => $user->name,
                // 'user_image' => asset('storage/profile/' . auth()->user()->profile_image),
                'comment' => $comment->comment,
                'id' => $comment->id,
                'likes' => $comment->likes->count() ?? 0,
                'is_liked' => $comment->likes()->where('user_id', auth()->id())->exists()
            ]
        ]);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        if (Auth::id() !== $comment->id_user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $comment->delete();

        return response()->json(['success' => true, 'message' => 'Comment deleted']);
    }


    public function index(Request $request, $contentId)
    {
        $perPage = 5; 
        $page = $request->query('page', 1); 
    
        // Ambil komentar dengan pagination
        $comments = Comment::where('id_content', $contentId)
            ->with('user')
            ->latest()
            ->skip(($page - 1) * $perPage) 
            ->take($perPage) 
            ->get();
    
        // Hitung total komentar
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
                    'user_image' => null,
                    'comment' => $comment->comment,
                    'created_at' => $comment->created_at->diffForHumans(),
                    'likes' => $comment->likes->count() ?? 0,
                    'is_liked' => $comment->likes()->where('user_id', auth()->id())->exists()
                ];
            }),
        ]);
    }    

    public function getComments()
{
    $comments = Comment::with('likes')->get();

    return response()->json($comments);
}
    
}
