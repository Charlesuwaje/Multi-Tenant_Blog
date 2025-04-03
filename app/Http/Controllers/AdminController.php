<?php

namespace App\Http\Controllers;

use App\Services\AdminService;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct(public readonly AdminService $adminService) {}

    public function approveUser($id)
    {
        $this->adminService->approveUser($id);

        return response()->json(['message' => 'User approved as a tenant']);
    }




    public function getAllPosts()
    {
        return response()->json($this->adminService->getAllPosts());
    }
}
