<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamSquad extends Model
{
    use HasFactory;

    protected $fillable  = [ 
        'squadName',
        'achievement',
        'description'

    ];
    public function teamMembers()
    {
        return $this->hasMany(TeamMember::class, 'squad_id');
    }
}
