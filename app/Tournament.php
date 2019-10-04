<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    protected $fillable = ['name', 'description','start_date_time'];

    public function getUsersByRole($roleId) 
    {
        return TournamentUserRole::where([
            'tournament_id' => $this->id,
            'role_id' => $roleId
        ])->get();
        //->map(function($tournamentUserRole) {
        //     $user = User::find($tournamentUserRole->user_id);
        //     $
        // });
    }
}
