<?php

namespace App\Http\Controllers;

class TournamentUserRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
}
