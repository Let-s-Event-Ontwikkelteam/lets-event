<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UserController extends Controller
{
    /* showAllUserInfo */
    public function showAllUserInfo()
    {
        /* Search for the ID from the User */
        $user = Auth::user();
        /* Return page back with the variable */
        return view('users.settings', ['user' => $user]);
    }

    /* updateUserInfo */
    public function updateUserInfo(Request $request)
    {
        /* Search for the ID from the User */
        $user = Auth::user();
        /* Set the data from the form in a request */
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        /* Save the data into the database */
        $user->save();
        /* Redirect back to the page and give a status with it */
        return redirect()->back()->with('status', 'Je hebt met succes je account instellingen gewijzigd!');
    }
}

// validatie
