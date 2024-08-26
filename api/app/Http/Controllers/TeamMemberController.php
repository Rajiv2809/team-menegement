<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TeamSquad;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TeamSquadRequest;
use App\Http\Requests\TeamMemberRequest;
use App\Http\Requests\UpdateTeamMemberRequest;

class TeamMemberController extends Controller
{
    public function create(TeamMemberRequest $request){
        
        $user = User::where('id', $request->user_id)->first();
        $user->squad_id = $request->squad_id;
        $user->save();
        return response()->json([
            'message' => 'member has been added',

        ],200);
    }
    public function get($squadID){
        $users = User::where('squad_id', $squadID)->get();

        if($users->isEmpty()){
            return response()->json([
                'message' => 'There are no members in this squad'
            ],404); 
        }
        return response()->json([
            'users' => $users
        ]);
    }
    // public function update(UpdateTeamMemberRequest $request, $memberID)
    // {
        
    //     $member = TeamMember::find($memberID);
    
    //     if (!$member) {
    //         return response()->json([
    //             'message' => 'Member not found',
    //         ], 404);
    //     }
    
    //     $squad = TeamSquad::find($request->squad_id);
    
    //     if (!$squad) {
    //         return response()->json([
    //             'message' => 'Squad not found',
    //         ], 404);
    //     }
    
        
    //     $member->update($request->only(['squad_id', 'user_id', ])); 
    //     return response()->json([
    //         'message' => 'Member updated successfully',
    //     ], 200);
    // }
    
    public function delete($username){
        $member = User::where('username', $username)->first();
        if(!$member){
            return response()->json([
                'message' => 'member not found  '
            ]);
        }  
        $member->squad_id = null;
        $member->save();
        return response()->json([
            'message' => 'member team deleted successfully',
        ]);
    }
}
