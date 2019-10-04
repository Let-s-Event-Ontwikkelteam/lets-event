<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TournamentUserRole extends Model
{
    protected $fillable = ['tournament_id', 'user_id', 'role_id'];
}
