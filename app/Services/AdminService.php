<?php

namespace App\Services;

use App\Models\User;
use App\Models\Tenant;
use App\Models\Post;

class AdminService
{
    public function approveUser($userId)
    {
        $user = User::findOrFail($userId);

        if ($user->is_approved) {
            throw new \Exception("User is already approved.");
        }
        $user->update(['is_approved' => true]);

        Tenant::create([
            'user_id' => $user->id,
            'name'=>$user->name,
            'domain' => $user->email, 
        ]);

        return $user;
    }

    // public function getAllPosts()
    // {
    //     return Post::all();
    // }
    public function getAllPosts()
    {
        return Post::with('user')->latest()->paginate(10);
    }
}
