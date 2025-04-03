<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __construct(public readonly PostService $postService) {}

    public function index()
    {
        return response()->json($this->postService->getAllPosts());
    }

    public function store(PostRequest $request)
    {
        $validateData = $request->validated();

        return response()->json($this->postService->createPost($validateData), 201);
    }

    public function show($id)
    {
        return response()->json($this->postService->getPostById($id));
    }

    public function update(PostRequest $request, $id)
    {
        $validateData = $request->validated();

        return response()->json($this->postService->updatePost($id, $validateData));
    }

    public function destroy($id)
    {
        $this->postService->deletePost($id);
        return response()->json(['message' => 'Post deleted']);
    }
}
