<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function update(UpdateUserRequest $request)
    {

        $user = User::find(auth()->id());

        
        $user->update($request->all());


        return response()->json([
            'message' => 'User updated successfully'
        ]);
    }

}
