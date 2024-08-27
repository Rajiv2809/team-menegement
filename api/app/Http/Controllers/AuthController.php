<?php

namespace App\Http\Controllers;

use Closure;
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
            'date_of_birth' => $request->dateOfBirth,
            'phone_number' => $request->phoneNumber,
            'password' => Hash::make($request->password),
            'profile_picture' => $path,
            'squad_id' => null, 
        ]);
        return response()->json([
            'message' => 'created success',
            'user' => $user
        ],201);
    }
    public function login(Request $request)
        {

    $validator = Validator::make($request->all(), [
        'username' => 'required|string|max:255',
        'password' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => 'Validation failed',
            'errors' => $validator->errors(),
        ], 422);
    }
    $data = [
        "username" => $request->username,
        "password" => $request->password
    ];
    if (!Auth::attempt($data)) {
        return response()->json([
            'message' => 'Wrong username or password'
        ], 401);
    }

    $user = User::where('username', $request->username)->first();

    return response()->json([
        'message' => 'Login Success',
        'token' =>  $user->createToken($user->username)->plainTextToken,
        'user' => $user
    ], 200);
}
}
        