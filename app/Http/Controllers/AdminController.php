<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\AdminService;

class AdminController extends Controller
{

    public function __construct(public readonly AdminService $adminService) {}

    public function approveUser($id)
    {
        $this->adminService->approveUser($id);

        // return response()->json(['message' => 'User approved as a tenant']);
        return redirect()->back()->with('success', 'User approved successfully.');
    }


    public function viewAllPosts()
    {
        $posts = $this->adminService->getAllPosts();
        return view('admin.posts', compact('posts'));
    }

    public function getAllPosts()
    {
        return response()->json($this->adminService->getAllPosts());
    }
    public function index()
    {
        $users = User::where('is_approved', false)->get();
        return view('admin.dashboard', compact('users'));
    }

    public function showPost($id)
{
    $post = Post::with('user')->findOrFail($id);
    return view('admin.post_show', compact('post'));
}


    
}
