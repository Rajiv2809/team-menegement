<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamMemberRequest;
use App\Http\Requests\TeamSquadRequest;
use App\Http\Requests\UpdateTeamMemberRequest;
use App\Models\TeamMember;
use App\Models\TeamSquad;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function create(TeamMemberRequest $request){
  
        TeamMember::create([
            'squad_id' => $request->squad_id,
            'user_id' => $request->user_id
        ]);
        return response()->json([
            'message' => 'add memmber successfully',
            
        ]);
    }
    public function get(){
        $member = TeamMember::find(1);
        return response()->json([
            'message' => $member->user,
            'messagse'=> $member->squad
        ]);
    }
    public function update(UpdateTeamMemberRequest $request, $memberID)
    {
        
        $member = TeamMember::find($memberID);
    
        if (!$member) {
            return response()->json([
                'message' => 'Member not found',
            ], 404);
        }
    
        $squad = TeamSquad::find($request->squad_id);
    
        if (!$squad) {
            return response()->json([
                'message' => 'Squad not found',
            ], 404);
        }
    
        
        $member->update($request->only(['squad_id', 'user_id', ])); 
        return response()->json([
            'message' => 'Member updated successfully',
        ], 200);
    }
    
    public function delete($memberID){
        $squad = TeamMember::find($memberID);
        if(!$squad){
            return response()->json([
                'message' => 'member not found  '
            ]);
        }  
        $squad->delete();
        return response()->json([
            'message' => 'member team deleted successfully'
        ]);
    }
}
