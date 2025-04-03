<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function __construct(public readonly AuthService $authService) {}

    public function register(RegisterRequest $request)
    {
        $validatedData = $request->validated();

        $this->authService->register($validatedData);

        return response()->json(['message' => 'User registered, pending admin approval'], 201);
    }

    public function login(LoginRequest $request)
    {
        $validatedData = $request->validated();

        $token = $this->authService->login($validatedData);

        return response()->json(['access_token' => $token, 'token_type' => 'Bearer']);
    }
}
