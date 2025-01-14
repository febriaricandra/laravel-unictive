<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;

class AuthController extends Controller
{
    //
    public function Register(Request $request)
    {
        $credentials = $request->only('name', 'email', 'password');
        try {
            $user = new User();
            $user->name = $credentials['name'];
            $user->email = $credentials['email'];
            $user->password = bcrypt($credentials['password']);
            $user->save();
            $token = JWTAuth::fromUser($user);
            return response()->json(['status' => 'success', 'token' => $token], 201);
        } catch (JWTException $e) {
            return response()->json(['status' => 'error', 'message' => 'Failed to create token'], 500);
        }
    }

    public function Login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['status' => 'error', 'message' => 'Invalid credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['status' => 'error', 'message' => 'Failed to create token'], 500);
        }
        return response()->json(['status' => 'success', 'token' => $token], 200);
    }

    public function Logout(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['status' => 'success', 'message' => 'User logged out successfully'], 200);
        } catch (JWTException $e) {
            return response()->json(['status' => 'error', 'message' => 'Failed to logout user'], 500);
        }
    }
}
