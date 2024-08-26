<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function getUser($username){
        $user = User::where('username', $username)->first();
        if(!$user){
            return response()->json([
                'message' => 'user not found'
            ], 404);
        }
        return response()->json([
            'user' => $user
        ], 200);
    }
     public function update(UpdateUserRequest $request)
    {
        $user = Auth::user();
        $user->name = $request->input('name', $user->name);
        $user->username = $request->input('username', $user->username);
        $user->email = $request->input('email', $user->email);
        $user->date_of_birth = $request->input('dateOfBirth', $user->date_of_birth);
        $user->phone_number = $request->input('phoneNumber', $user->phone_number);


        if ($request->hasFile('profilePicture')) {
         
            $path = $request->file('profilePicture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }

        $user->save();

        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user,
        ], 200);
    }

}
