<?php

namespace App\Http\Controllers;

use App\Role;
use App\Tournament;
use App\TournamentUserRole;
use Carbon\Carbon;
use DateTimeZone;
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
}
