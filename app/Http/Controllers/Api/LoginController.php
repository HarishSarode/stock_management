<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function login(Request $request) {
        try {
            if (empty($request->email)) {
                return response()->json([
                    'status' => 400,
                    'error' => true,
                    'message' => 'Please enter email address'
                ]);
            } else if (empty($request->password)) {
                return response()->json([
                    'status' => 400,
                    'error' => true,
                    'message' => 'Please enter password'
                ]);
            }

            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                $token = $user->createToken('bearer')->plainTextToken;

                return response()->json([
                    'status' => 200,
                    'success' => true,
                    'message' => 'Logged in successfully!',
                    'token' => $token
                ]);

            } else {
                return response()->json([
                    'status' => 400,
                    'error' => true,
                    'message' => 'These credentials does not match with our records!'
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Login API error : ' . $e->getMessage());
            return response()->json([
                'status' => 400,
                'error' => true,
                'message' => 'Something went wrong!'
            ]);
        }
    }

    public function logout(Request $request) {
        try {
            if(empty($request->id)){
                return response()->json([
                    'status' => 400,
                    'error' => true,
                    'message' => 'Please provide user id'
                ]);
            }
            $user = User::where('id', $request->id)->first();
            $user->tokens()->delete();
            return response()->json([
                'status' => 200,
                'success' => true,
                'message' => 'Logged out successfully!'
            ]);
        } catch (\Exception $e) {
            Log::error('Logout API error : ' . $e->getMessage());
            return response()->json([
                'status' => 400,
                'error' => true,
                'message' => 'Something went wrong!'
            ]);
        }
    }
}
