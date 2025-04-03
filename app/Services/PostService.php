<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostService
{
    public function getAllPosts()
    {
        return Post::all();
    }

    public function createPost(array $data)
    {
        return Auth::user()->posts()->create($data);
    }

    public function getPostById($id)
    {
        return Post::findOrFail($id);
    }

    public function updatePost($id, array $data)
    {
        $post = Post::findOrFail($id);
        $post->update($data);
        return $post;
    }

    public function deletePost($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return true;
    }
}
