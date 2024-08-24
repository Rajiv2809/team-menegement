<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    
    public function   get(){
        $user = User::find(auth()->id());

        return response()->json([
            'message' => $user
        ]);
    }

}
