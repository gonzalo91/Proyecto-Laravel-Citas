<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use JwtAuth;

class AuthController extends Controller
{
    public function login(Request $request){
        $credentials =  $request->only('email', 'password');

        if(Auth::guard('api')->attempt($credentials)){

            $user  = Auth::guard('api')->user();

            $jwt   = JwtAuth::generateToken($user);
            $success = true;

            return compact('success', 'jwt', 'user');
        }else{
            $success = false;
            $message = 'Invalid Credentia';
            return compact('success', 'message');

        }
    }
}
