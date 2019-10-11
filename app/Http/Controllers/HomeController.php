<?php

namespace App\Http\Controllers;

use App\User;
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
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {

    

        return view('welcome');
    }

    public function dashboard()
    {

        // why does this not work
        $user = Auth::user();
        
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

        // users doesnt get passed to view
        return view('home')->with([
            'tournaments' => $userTournaments,
            'user' => $user
        ]);
    }

    public function leave($id)
    {
        $participantRoleId = Role::all()->firstWhere('name', '=', 'participant')->id;

        TournamentUserRole::where([
            'tournament_id' => $id,
            'user_id' => Auth::id(),
            'role_id' => $participantRoleId
        ])->delete();

        return redirect()->route('tournament.index')->with('message', 'Je hebt met succes het toernooi verlaten!');
    }
}
