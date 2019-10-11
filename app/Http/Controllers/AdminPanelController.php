<?php

namespace App\Http\Controllers;

use App\Admin;
use App\User;
use App\Role;
use Carbon\Carbon;
use DateTimeZone;
use App\Tournament;
use App\TournamentUserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AdminPanelController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index($tournament_id)
    {
        //get the organizer Id and participant Id
        $organizerRoleId = Role::all()->firstWhere('name', '=', 'organizer')->id;
        $participantRoleId = Role::all()->firstWhere('name', '=', 'participant')->id;
        
        //get the userRole and check if this user is a owner from this tournament.
        $tournamentOrganizer = TournamentUserRole::where([
            'tournament_id' => $tournament_id,
            'user_id' => Auth::id(),
            'role_id' => $organizerRoleId
            ])->get();
            if (!$tournamentOrganizer->count()) {
                return redirect()->route('tournament.index')
                    ->withErrors(array('TournamentAdminAuthorizationFail' => 'Je bent geen beheerder van dit toernooi, je mag niet in de beheerder instellingen.'));
            }

            //get all the participants from this tournament.
            $tournamentParticipant = TournamentUserRole::where([
                'tournament_id' => $tournament_id,
                'role_id' => $participantRoleId
            ])->get();
            $users = User::all();
    
        return View('admin.index', compact('users', 'tournamentParticipant' , 'tournament_id'));
    }

    public function show($tournament_id, $user_id)
    {
        $user = User::find($user_id);
        return View('admin.edit', compact('tournament_id', 'user'));

    }

    public function create($tournament_id, $user_id)
    {
        $organizerRoleId = Role::all()->firstWhere('name' , '=', 'organizer')->id;
            //check if this organizer already exists for this tourney with firstOrCreate.
            //if he does not exist, create this organizer.
            TournamentUserRole::firstOrCreate([
                'tournament_id' => $tournament_id,
                'user_id' => $user_id,
                'role_id' => $organizerRoleId
            ]);

        $participantRoleId = Role::all()->firstWhere('name', '=', 'participant')->id;
            //get all the participants from this tournament.
        $tournamentParticipant = TournamentUserRole::where([
            'tournament_id' => $tournament_id,
            'role_id' => $participantRoleId
        ])->get();
            $users = User::all();

        return redirect('../../../tournament/')->with('message', 'Speler is mede-beheerder gemaakt!!');;        
    }

    public function destroy($tournament_id, $user_id)
    {
        //get the date and time from this moment
        $time = Carbon::now(new DateTimeZone('Europe/Amsterdam'));
        $mytime = $time->toDateTimeString();
        //get the date and time from this tournament
        $tournament = Tournament::find($tournament_id);
        $tourneyTime = $tournament->start_date_time;

        //compare the 2 times, if mytime is greater than the one from the tourney
        // delete user from tourney
        if ($mytime < $tourneyTime) {
        $tourneyPlayer = TournamentUserRole::where([
            'tournament_id' => $tournament_id,
            'user_id' => $user_id
        ])->delete();


        $users = User::all();
        $participantRoleId = Role::all()->firstWhere('name', '=', 'participant')->id;
        $tournamentParticipant = TournamentUserRole::where([
            'tournament_id' => $tournament_id,
            'role_id' => $participantRoleId
        ])->get();
    
        return redirect('../../../tournament/')->with('message', 'Speler is verwijderd van het toernooi!');  
        }
        else{
            return redirect()->route('dashboard')->with('message', 'Je kan geen spelers meer verwijderen omdat het toernooi al is begonnen');     
        }
    }

}
