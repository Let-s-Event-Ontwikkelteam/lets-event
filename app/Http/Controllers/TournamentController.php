<?php

namespace App\Http\Controllers;

use App\Role;
use App\Tournament;
use App\TournamentUserRole;
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
        $tournaments = Tournament::all();
        return view('tournament.index', compact('tournaments'));
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

        // Maak de gebruiker een beheerder.
        $organizerRoleId = Role::all()->firstWhere('name' , '=', 'organizer')->id;

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
        $participantRoleId = Role::all()->firstWhere('name', '=', 'participant')->id;
        return view('tournament.show', compact('tournament'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tournament $tournament
     * @return \Illuminate\Http\Response
     */
    public function edit(Tournament $tournament)
    {
        $organizerRoleId = Role::all()->firstWhere('name', '=', 'organizer')->id;

        // TODO: Bouw een check in om te zien of $organizerRoleId bestaat.
        // Check if logged in user is an organiser for the tournament
        $tournamentOrganizer = TournamentUserRole::find([
            'tournament_id' => $tournament->id,
            'user_id' => Auth::id(),
            'role_id', $organizerRoleId
        ]);

        if (!$tournamentOrganizer->count()) {
            return redirect()->route('tournament.index')
                ->withErrors(array('TournamentDeleteAuthorizationFail' => 'Je bent geen beheerder van dit toernooi, je mag dit toernooi niet wijzigen'));
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

        $tournament->name = $request->get('name');
        $tournament->description = $request->get('description');
        $tournament->start_date_time = $request->get('start-date-time');
        $tournament->save();

        return redirect()->route('tournament.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tournament = Tournament::find($id);

        if (!$tournament) {
            return redirect()->back()->withErrors([
                'TournamentNotFound' => 'Het opgevraagde toernooi is al verlopen of niet meer beschikbaar.'
            ]);
        }

        $organizerRoleId = Role::all()->firstWhere('name', '=', 'organizer')->id;
        // TODO: Bouw een check in om te zien of $organizerRoleId niet null is.

        // Check if logged in user is an organiser for the tournament
        $tournamentOrganizer = TournamentUserRole::where([
            'tournament_id' => $tournament->id,
            'user_id' => Auth::id(),
            'role_id' => $organizerRoleId
            ])->get();

        if (!$tournamentOrganizer->count()) {
            return redirect()->route('tournament.index')
                ->withErrors(array('TournamentDeleteAuthorizationFail' => 'Je bent geen beheerder van dit toernooi, je mag dit toernooi dus ook niet verwijderen.'));
        }

        $tournament->delete();
        TournamentUserRole::destroy(
            TournamentUserRole::where('tournament_id', $tournament->id)->get()->toArray()
        );
        return redirect()->route('tournament.index');
    }
}
