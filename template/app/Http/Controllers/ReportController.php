<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Report;
use App\Models\Comment;
use App\Models\Content;
use App\Models\CommentLike;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function store(Request $req) {

        $validated = $req->validate([
            'id_user' => 'required|uuid|exists:users,id',
            'id_content' => 'nullable|uuid|exists:contents,id',
            'id_comment' => 'nullable|uuid|exists:comments,id',
            'reason' => 'required|string',
            'detail' => 'nullable|string|max:500',
        ]);

        $validated['id_reported_user'] = $validated['id_user'];
        $validated['id_user'] = Auth::user()->id;

        Report::create($validated);
        
        return response()->json([
            'success' => true,
            'message' => "Thank you for your report. We will review it as soon as possible"
        ]);
    }

    public function getDataById($id) 
    {
        $data = Report::find($id)->toArray();
        if (!$data) return response()->json(['error' => 'Data not found!'], 404);

        if (is_null($data['id_content']) && is_null($data['id_comment'])) {
            $data['user'] = User::where('id', $data['id_reported_user'])->first()->toArray();
        } elseif ($data['id_content'] && is_null($data['id_comment'])) {
            $data['content'] = Content::with('user')->where('id', $data['id_content'])->first()->toArray();
        } else {
            $data['comment'] = Comment::with('user')->where('id', $data['id_comment'])->first()->toArray();
            $data['comment']['likes'] = CommentLike::where('comment_id', $data['id_comment'])->count();
        }

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    public function resolve($id) {
        try {
            if (Auth::user()->role == 'admin') {
                $data = Report::find($id);
                
                if (!$data) return redirect()->back()->with('error', 'Data not found!');

                if ($data->status !== "pending") return redirect()->back()->with('warning', 'Report is already resolved!');

                $data->update(['status' => 'resolved']);
                return redirect()->back()->with('success', 'Report resolved!');
            }
    
            return redirect()->back()->with('warning', 'You are not authorized to resolve this content!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');    
        }
    }
    
    public function destroy(Request $req) {
        $id = Report::find($req->input('id'));
        if (!$id) return redirect()->back()->with('error', 'Data not found!');

        try {
            if (Auth::user()->role == 'admin') {
                $id->delete();
                return redirect()->back()->with('success', 'Payment deleted successfully!');
            }
    
            return redirect()->back()->with('warning', 'You are not authorized to delete this content!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }
}
