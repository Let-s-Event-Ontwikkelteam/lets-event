<?php

namespace App\Http\Controllers;

use App\Role;
use App\TournamentUserRole;
use Illuminate\Support\Facades\Auth;

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
    public function joinParticipant($tournamentId)
    {
        // Vraag het id van de rol op van een participant (deelnemer).
        $participantRoleId = Role::all()->firstWhere('name', '=', 'participant')->id;

        // Maak een nieuwe record aan in de TournamentUserRole table.
        TournamentUserRole::create([
            'tournament_id' => $tournamentId,
            'user_id' => Auth::id(),
            'role_id' => $participantRoleId
        ]);

        // Redirect terug naar de vorige pagina.
        return redirect()->back();
    }
}
