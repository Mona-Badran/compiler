<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Auth; 

class JWTAuthController extends Controller{
    
    public function register(Request $request){
        $user = new User;
        
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;

        $user->save();

        $token = JWTAuth::fromUser($user);

        return response()->json([
            "username" => $user, 
            "token" => $token
        ], 201);
    }

    public function login(Request $request){
        $credentials = $request->only('username', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }

            $user = Auth::user();

            return response()->json([
                "username" => $user, 
                "token" => $token
            ], 201);

        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }
    }

}
