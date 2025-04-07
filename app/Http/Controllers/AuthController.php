<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{

    public function __construct(public readonly AuthService $authService) {}

    public function register(RegisterRequest $request)
    {
        $validatedData = $request->validated();

        $this->authService->register($validatedData);

        return response()->json(['message' => 'User registered, pending admin approval'], 201);
    }

    // public function login(LoginRequest $request): JsonResponse
    // {
    //     $validatedData = $request->validated();

    //     $token = $this->authService->login($validatedData);
    //     $user = auth()->user();
    //     if (!$user) {
    //         return response()->json(['error' => 'Authentication failed.'], 401);
    //     }
    //     return response()->json([
    //         'access_token' => $token,
    //         'data' => new UserResource($user),
    //         'token_type' => 'Bearer'
    //     ]);
    // }

    public function login(LoginRequest $request)
    {
        $validatedData = $request->validated();
        $token = $this->authService->login($validatedData);
    
        $user = Auth::user();
    
        if (!$user) {
            return redirect()->route('login')->with('error', 'Authentication failed.');
        }
    
        if (!$user->is_approved) {
            return redirect()->route('login')->with('error', 'Your account is pending approval.');
        }
    
        return redirect()->route('admin.dashboard')->with([
            'success' => 'Login successful!',
            'access_token' => $token
        ]);
    }


    public function showLoginForm()
    {
        return view('auth.login');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logged out successfully.');
    }
}
