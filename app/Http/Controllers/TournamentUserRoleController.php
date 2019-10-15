<?php
 
namespace App\Http\Controllers;

use App\Role;
use App\Tournament;
use App\TournamentUserRole;
use Illuminate\Support\Facades\Auth;


class TournamentUserRoleController extends Controller
{
    // Check of de user is ingelogt
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
        /**
         * Het ID opvragen van de role participant (Deelnemer).
         * Zodat er later gecheckt kan worden of er
         */
        $participantRoleId = Role::all()->firstWhere('name', '=', 'participant')->id;

        $existingRecord = TournamentUserRole::where([
            'tournament_id' => $tournamentId,
            'user_id' => Auth ::id(),
            'role_id' => $participantRoleId
        ]);

        /**
         * Als de deelnemer al meedoet moet er een error worden weergegeven op de toernooien pagina dat hij al mee * doet.
         */
        
        /** Als count 0 is dan slaat hij de IF over en maakt hij een nieuwe row in de tabel tournament_user_role  
         * aan.
         */ 
        if ($existingRecord->count()) {
            return redirect()
                ->route('tournament.index')
                ->withErrors(array('joinParticipantError' => 'Je neemt al deel aan dit toernooi!'));
        }

        /**
         * Als de deelnemer nog niet mee doet moet er een nieuwe row toegevoegd worden in de database.
         * Row: welk toernooi, welke user en de deelnemer role 
         */

        TournamentUserRole::create([
            'tournament_id' => $tournamentId,
            'user_id' => Auth::id(),
            'role_id' => $participantRoleId
        ]);

        // Als je deelneemt verwijst hij je terug naar het dashboard waar je toernooien staan waaraan je deelneemt.
        return redirect()->route('dashboard');
    }
}
