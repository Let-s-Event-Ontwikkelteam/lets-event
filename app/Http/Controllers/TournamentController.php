<?php

namespace App\Http\Controllers;

use App\Role;
use App\Tournament;
use App\TournamentUserRole;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TournamentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     *
     */
    public function index()
    {

        $currentLoggedInUser = User::find(Auth::id());
        $organizerRole = Role::getByName('organizer');

        $tournaments = Tournament::all()->map(function($tournament) use ($currentLoggedInUser, $organizerRole) {
            $currentUserIsOrganizerForTournament = boolval($currentLoggedInUser->isOrganizerForTournament($tournament->id, $organizerRole->id));
            $tournament->currentUserIsOrganizerForTournament = $currentUserIsOrganizerForTournament;
            return $tournament;
        });


        // $organizerRole = Role::getByName('organizer');

        // if (!$organizerRole) {
        //     // TODO: Redirect naar index met foutmelding of iets dergelijks.
        // }

        // $tournamentOrganizer = TournamentUserRole::where([
        //     'user_id' => Auth::id(),
        //     'role_id' => $organizerRoleId 
        //     ])->get();


        $currentUser = User::find(Auth::id());

        return view('tournament.index', compact('currentUser', 'tournaments', 'organizerRole'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tournament.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:255',
            'start-date-time' => 'required|date'
        ]);

        $createdTournament = Tournament::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'start_date_time' => $request->input('start-date-time')
        ]);

        $organizerRoleId = Role::getByName('organizer')->id;

        TournamentUserRole::create([
            'tournament_id' => $createdTournament->id,
            'user_id' => Auth::id(),
            'role_id' => $organizerRoleId
        ]);

        return redirect()->route('tournament.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Tournament $tournament
     * @return \Illuminate\Http\Response
     */
    public function show(Tournament $tournament)
    {
//        $participantRoleId = Role::getByName('participant');
        return view('tournament.show', compact('tournament'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tournament $tournament
     * @return \Illuminate\Http\Response
     */
    public function edit(Tournament $tournament, $id)
    {
        $tournament = Tournament::find($id);
        $organizerRole = Role::getByName('organizer');

        if (!$organizerRole) {
            return redirect()->route('tournament.index')
                ->withErrors(['RoleNotFound', 'Er bestaat geen toernooi administrator rol.']);
        }

        // Check if logged in user is an organiser for the tournament
        $organizerRoleId = Role::all()->firstWhere('name', '=', 'organizer')->id;

        $tournamentOrganizer = TournamentUserRole::where([
            'tournament_id' => $id,
            'user_id' => Auth::id(),
            'role_id' => $organizerRoleId
            ])->get();

            if (!$tournamentOrganizer->count()) {
                return redirect()->route('tournament.index')
                    ->withErrors(array('TournamentAdminAuthorizationFail' => 'Je bent geen beheerder van dit toernooi, je mag dit toernooi niet editten.'));
            }

        return view('tournament.edit', compact('tournament'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Tournament $tournament
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Tournament $tournament)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:255',
            'start-date-time' => 'required|date'
        ]);

        $tournament->update([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'start_date_time' => $request->get('start-date-time')
        ]);

        return redirect()->route('tournament.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tournament $tournament, $id)
    {
        $tournament = Tournament::find($id);

        if (!$tournament) {
            return redirect()->back()->withErrors([
                'TournamentNotFound' => 'Het opgevraagde toernooi is al verlopen of niet meer beschikbaar.'
            ]);
        }

        $organizerRole = Role::getByName('organizer');

        if (!$organizerRole) {
            return redirect()->route('tournament.index')
                ->withErrors(['RoleNotFound', 'Er bestaat geen toernooi administrator rol.']);
        }

        // Check if logged in user is an organiser for the tournament
        $organizerRoleId = Role::all()->firstWhere('name', '=', 'organizer')->id;

        $tournamentOrganizer = TournamentUserRole::where([
            'tournament_id' => $id,
            'user_id' => Auth::id(),
            'role_id' => $organizerRoleId
            ])->get();

        if (!$tournamentOrganizer->count()) {
            return redirect()->route('tournament.index')
                ->withErrors(array('TournamentDeleteAuthorizationFail' => 'Je bent geen beheerder van dit toernooi, je mag dit toernooi dus niet verwijderen.'));
        }

        if (Tournament::destroy($tournament->id)) {
            // Delete alleen de relaties als het destroyen van het toernooi goed is gegaan.
            $tournamentUserRolesToBeDeleted = TournamentUserRole::all()->where('tournament_id', $tournament->id);
            TournamentUserRole::destroy($tournamentUserRolesToBeDeleted);
        };
        return redirect()->route('tournament.index');
    }
}
