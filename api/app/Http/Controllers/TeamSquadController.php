<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamSquadRequest;
use App\Http\Requests\UpdateTeamSquadRequest;
use App\Models\TeamSquad;
use Illuminate\Http\Request;

class TeamSquadController extends Controller
{
    public function create(TeamSquadRequest $request){
        TeamSquad::create([
            'squad_name' => $request->squadName,
            'description' =>  $request->description,
            'achievement' => $request->achievement
        ]);
        return response()->json([
            'message' => 'squad created successfully'
        ]);
    }
    public function get(){
        $teamSquad  = TeamSquad::all();
        return response()->json([
            'teamSquad' => $teamSquad   
        ]);
    }
    public function update(UpdateTeamSquadRequest $request, $squadID){
        $squad = TeamSquad::find($squadID);

        if(!$squad){
            return response()->json([
                'message' => 'squad not found '
            ]);
        } 
        $squad->update($request->all());

        return response()->json([
            'message' => 'team squad update successfully'
        ]);
    }
    public function delete($squadID){
        $squad = TeamSquad::find($squadID);
        if(!$squad){
            return response()->json([
                'message' => 'squad not found  '
            ]);
        }  
        $squad->delete();
        return response()->json([
            'message' => 'team squad deleted successfully'
        ]);
    }
    
}

