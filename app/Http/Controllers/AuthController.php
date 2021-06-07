<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request){
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
    }

    public function login(Request $request) {

        if ( !Auth::attempt($request->only('email','password')) ){
            return response([
                'message' => 'E-mail ou senha inválidos'
            ], Response::HTTP_UNAUTHORIZED);
        }else if( User::where([['email', $request->email], ['active', 0]])->exists() ) {
            return response([
                'message' => 'Este usuário está inativo'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();

        $token = $user->createToken('token')->plainTextToken;
        $cookie = cookie('jwt', $token, 60 * 14);

        return response([
            'message' => 'successfully logged in'
        ])->withCookie($cookie);
    }

    public function user() {
        return Auth::user();
    }

    public function logout() {
        $cookie = Cookie::forget('jwt');

        return response([
            'message' => 'successfully logged out'
        ])->withCookie($cookie);
    }
}
