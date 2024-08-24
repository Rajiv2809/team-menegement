<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;
    protected $fillable = [
        'squad_id',
        'user_id'
    ];
    public function squad(){
        return $this->belongsTo(TeamSquad::class,'squad_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
