<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{

    public function __construct(public readonly AuthService $authService) {}

    public function register(RegisterRequest $request)
    {
        $validatedData = $request->validated();

        $this->authService->register($validatedData);

        return response()->json(['message' => 'User registered, pending admin approval'], 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $token = $this->authService->login($validatedData);
        $user = auth()->user();
        if (!$user) {
            return response()->json(['error' => 'Authentication failed.'], 401);
        }
        return response()->json([
            'access_token' => $token,
            'data' => new UserResource($user),
            'token_type' => 'Bearer'
        ]);
    }
}
