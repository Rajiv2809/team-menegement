<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\RegisterRequest;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Validator;
use Anhskohbo\NoCaptcha\Facades\NoCaptcha;

class AuthController extends Controller
{
    public function Register(RegisterRequest $request){
        $path = $request->file('profilePicture')->store('images', 'public');
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'dateOfBirth' => $request->dateOfBirth,
            'phoneNumber' => $request->phoneNumber,
            'password' => Hash::make($request->password),
            'profilePicture' => $path
        ]);
        return response()->json([
            'message' => 'created success',
            'user' => $user
        ],201);
    }
    public function login(LoginRequest $request)
    {
        
        $recaptchaResponse = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('NOCAPTCHA_SECRET'), 
            'response' => $request->recaptcha,
            'remoteip' => $request->ip(),
        ]);
    
        $recaptchaData = $recaptchaResponse->json();
    
        if (!$recaptchaData['success']) {
            return response()->json([
                'message' => 'CAPTCHA validation failed'
            ], 422);
        }
    

        $credentials = $request->only('username', 'password');
    
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Wrong username or password'
            ], 401);
        }
    
        $user = User::where('username', $request->username)->first();
    
        return response()->json([
            'message' => 'Login Success',
            'token' => 'Bearer ' . $user->createToken($user->username)->plainTextToken,
            'user' => $user
        ], 200);
    }
}
