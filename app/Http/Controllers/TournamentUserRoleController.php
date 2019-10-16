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
}
