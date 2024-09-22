<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // 1. Index - Retrieve All Comments
    public function index()
    {
        return response()->json(Comment::all(), 200);
    }

    // 2. Store - Create a New Comment
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required|string',
            'post_id' => 'required|exists:posts,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $comment = Comment::create($validatedData);
        return response()->json($comment, 201);
    }

    // 3. Show - Retrieve a Single Comment by ID
    public function show($id)
    {
        $comment = Comment::find($id);

        if ($comment) {
            return response()->json($comment, 200);
        } else {
            return response()->json(['message' => 'Comment not found'], 404);
        }
    }

    // 4. Update - Update an Existing Comment
    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        $validatedData = $request->validate([
            'content' => 'required|string',
            'post_id' => 'required|exists:posts,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $comment->update($validatedData);
        return response()->json($comment, 200);
    }

    // 5. Destroy - Delete a Comment
    public function destroy($id)
    {
        $comment = Comment::find($id);

        if ($comment) {
            $comment->delete();
            return response()->json(['message' => 'Comment deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Comment not found'], 404);
        }
    }
}
