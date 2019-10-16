<?php

namespace App\Http\Middleware;

use App\Role;
use App\Tournament;
use App\TournamentUserRole;
use Closure;

class isTournamentOrganizer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Vraag het toernooi id op via de route parameters.
        $tournamentId = $request->route('tournamentId');
        // Check of het de parameters is gevonden.
        if (!$tournamentId) {
            return false;
        }
        // Vraag de huidige gebruiker op.
        $currentUserId = $request->user()->id;
        // Vraag de organisator rol op.
        $organiserRole = Role::getByName('organizer');
        // Check of de gebruiker (auth user) een beheerder is van het toernooi.
        $tournamentUserRolesCount = TournamentUserRole::where([
            'tournament_id' => $tournamentId,
            'user_id' => $currentUserId,
            'role_id' => $organiserRole->id
        ])->count();

        return $tournamentUserRolesCount > 0 ? $next($request) : redirect()->back()
            ->withErrors(['Je bent geen beheerder van dit toernooi.']);
    }
}
