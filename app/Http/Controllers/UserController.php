<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Auth;

class UserController extends Controller
{
    /* showAllUserInfo */
    public function show()
    {
        /* Search for the ID from the User */
        $user = Auth::user();
        /* Return page back with the variable */
        return view('users.settings', ['user' => $user]);
    }

    /* updateUserInfo */
    public function update(Request $request)
    {
        /* Validate data */
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
        ],
        [
            'name.required' => 'Je bent vergeten om je naam in te voeren!',
            'email.required' => 'Je bent vergeten om je email in te voeren!',
            'phone_number.required' => 'Je bent vergeten om je telefoonnummer in te voeren!',
        ]);
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
