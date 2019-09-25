<?php

namespace App\Http\Controllers;

use App\TournamentUserRole;

class TournamentUserRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Deze methode zorgt ervoor dat er een record aangemaakt kan worden in de TournamentUserRole tabel.
     * @param $tournamentId
     * @param $roleId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($tournamentId, $roleId)
    {
        TournamentUserRole::create([
            'tournament_id' => $tournamentId,
            'user_id' => Auth::user(),
            'role_id' => $roleId
        ]);

        return redirect()->back();
    }
}
