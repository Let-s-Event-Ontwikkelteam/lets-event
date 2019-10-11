<?php

namespace App\Http\Controllers;
use DateTime;
use DateTimeZone;
use Carbon\Carbon;
use App\Role;
use App\Tournament;
use App\TournamentUserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//     public function __construct()
//     {
//         $this->middleware('auth');
//     }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome');
    }

    public function dashboard()
    {
        $userTournaments = null;

        if (Auth::check()) {
            $participantRoleId = Role::all()->firstWhere('name', '=', 'participant')->id;

            // TODO: Check inbouwen om te kijken of id wel bestaat.
            // Ga na aan welke toernooien de gebruiker deelneemt.
            $tournamentIds = TournamentUserRole::where([
                'user_id' => Auth::id(),
                'role_id' => $participantRoleId
            ])->pluck('tournament_id')->toArray();

            $userTournaments = Tournament::all()->whereIn('id', $tournamentIds);
        }

        return view('home')->with('tournaments', $userTournaments);
    }

    public function leave($id, $tourneyTime)
    {
        $participantRoleId = Role::all()->firstWhere('name', '=', 'participant')->id;
        $time = Carbon::now(new DateTimeZone('Europe/Amsterdam'));
        $mytime = $time->toDateTimeString();

            //kijk of de current time kleiner is dan de tijd waarop het toernooi start
            //als dit zo is dan wordt de persoon verwijderd 
            //als dit niet zo is wordt hij redirect terug naar de pagina met een message
            if ($mytime < $tourneyTime) {
        TournamentUserRole::where([
            'tournament_id' => $id,
            'user_id' => Auth::id(),
            'role_id' => $participantRoleId
        ])->delete();
        return redirect()->route('tournament.index')->with('message', 'Je hebt met succes het toernooi verlaten!');

        }
        else{
        return redirect()->route('dashboard')->with('message', 'Je kan het toernooi niet verlaten omdat het al begonnen is.');     
        }
    }
}
