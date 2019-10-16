<?php

namespace App\Http\Controllers;

class TournamentUserRoleController extends Controller
{
    // Check of de user is ingelogt
    public function __construct()
    {
        $this->middleware('auth');
    }
}
