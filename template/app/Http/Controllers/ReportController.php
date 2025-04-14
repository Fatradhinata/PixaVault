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
    /**
     * Store a new report in the database.
     *
     * This method handles the creation of a new report. It validates the request data to ensure
     * at least one subject (user, content, or comment) is reported along with a required reason.
     * The authenticated user's ID is automatically assigned as the reporter. Reports can be
     * submitted by both authenticated and guest users (with null user ID).
     *
     * Expected request data:
     * - id_user: uuid, nullable — the ID of the reported user (must exist in users table)
     * - id_content: uuid, nullable — the ID of the reported content (must exist in contents table)
     * - id_comment: uuid, nullable — the ID of the reported comment (must exist in comments table)
     * - reason: string, required — the reason for the report
     * - detail: string, nullable, max:500 — additional details about the report
     *
     * @param  \Illuminate\Http\Request  $req  The incoming request containing report details
     * @return \Illuminate\Http\JsonResponse  JSON response indicating success or failure
     */
    public function store(Request $req) 
    {
        $validated = $req->validate([
            'id_user' => 'nullable|uuid|exists:users,id',
            'id_content' => 'nullable|uuid|exists:contents,id',
            'id_comment' => 'nullable|uuid|exists:comments,id',
            'reason' => 'required|string',
            'detail' => 'nullable|string|max:500',
        ]);

        $validated['id_reported_user'] = $validated['id_user'];
        $validated['id_user'] = (Auth::check()) ? Auth::user()->id : null;

        if (
            is_null($validated['id_reported_user']) &&
            is_null($validated['id_content']) &&
            is_null($validated['id_comment'])
        ) {
            return response()->json([
                'success' => false,
                'message' => "No subject was reported!"
            ]);
        }

        Report::create($validated);
        
        return response()->json([
            'success' => true,
            'message' => "Thank you for your report. We will review it as soon as possible"
        ]);
    }

    /**
     * Retrieve detailed report data by ID.
     *
     * This method fetches a report by its ID and enriches it with related data based on the report type.
     * If the report is about a user, it includes the user's details. If about content, it includes
     * content details with the author. If about a comment, it includes comment details with the author
     * and like count.
     *
     * @param  string  $id  The UUID of the report to retrieve
     * @return \Illuminate\Http\JsonResponse  JSON response containing either the enriched report data or an error message
     */
    public function getDataById($id) 
    {
        $data = Report::find($id)->toArray();
        if (!$data) return response()->json(['error' => 'Data not found!'], 404);

        if (!is_null($data['id_reported_user'])) {
            $data['user'] = User::where('id', $data['id_reported_user'])->first()->toArray();
        } elseif (!is_null($data['id_content'])) {
            $data['content'] = Content::with('user')->where('id', $data['id_content'])->first()->toArray();
        } elseif (!is_null($data['id_comment'])) {
            $data['comment'] = Comment::with('user')->where('id', $data['id_comment'])->first()->toArray();
            $data['comment']['likes'] = CommentLike::where('comment_id', $data['id_comment'])->count();
        }

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    /**
     * Resolve a pending report.
     *
     * This method allows administrators to mark a report as resolved. Only users with 'admin' role
     * can perform this action. The report must exist and be in 'pending' status to be resolved.
     *
     * @param  string  $id  The UUID of the report to resolve
     * @return \Illuminate\Http\RedirectResponse  Redirects back with status message
     */
    public function resolve($id) 
    {
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
    
    /**
     * Delete a report from the database.
     *
     * This method handles the deletion of a report. Only users with 'admin' role can perform
     * this action. The report must exist to be deleted.
     *
     * Expected request data:
     * - id: string, required — the ID of the report to delete
     *
     * @param  \Illuminate\Http\Request  $req  The incoming request containing the report ID to delete
     * @return \Illuminate\Http\RedirectResponse  Redirects back with status message
     */
    public function destroy(Request $req) 
    {
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
