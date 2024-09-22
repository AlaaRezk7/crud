<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // 1. Index - Retrieve All Posts
    public function index()
    {
        return response()->json(Post::all(), 200);
    }

    // 2. Store - Create a New Post
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $post = Post::create($validatedData);
        return response()->json($post, 201);  // Return 201 for Created
    }

    // 3. Show - Retrieve a Single Post by ID
    public function show($id)
    {
        $post = Post::find($id);

        if ($post) {
            return response()->json($post, 200);
        } else {
            return response()->json(['message' => 'Post not found'], 404);
        }
    }

    // 4. Update - Update an Existing Post
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $post->update($validatedData);
        return response()->json($post, 200);
    }

    // 5. Destroy - Delete a Post
    public function destroy($id)
    {
        $post = Post::find($id);

        if ($post) {
            $post->delete();
            return response()->json(['message' => 'Post deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Post not found'], 404);
        }
    }
}
