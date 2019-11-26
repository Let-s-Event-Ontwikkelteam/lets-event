<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        /* Search for the ID from the User */
        $user = Auth::user();
        /* Return page back with the variable */
        return view('users.settings', ['user' => $user]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // Search for the ID from the User
        $user = Auth::user();

        // Validate data
        $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users,email'],
            'phone_number' => ['required', 'regex:/^([+]31)\s06(-)([0-9]\s{0,3}){8}$/u'],
        ]);

        // Set the data from the form in a request
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;

        // Save the data into the database
        $user->save();

        // Redirect back to the page and give a status with it
        return redirect()->back()->with('message', 'Je hebt met succes je account instellingen gewijzigd!');
    }
}
