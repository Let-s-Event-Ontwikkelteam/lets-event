<?php

namespace App\Http\Controllers;

use App\Role;
use App\Tournament;
use App\TournamentUserRole;
use Illuminate\Support\Facades\Auth;
use Psy\Util\Json;

class TournamentUserRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
}
