<?php

namespace App\Http\Controllers;

use App\Admin;
use App\User;
use Illuminate\Http\Request;

class AdminPanelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return View('admin.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::find($id);
        return View('admin.edit', ['user' => $user]);
    }
    public function edit($id)
    {
        $rules = array(
            'name'       => 'required',
            'email'      => 'required|email',
            'phone_number' => 'required|numeric'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('admin/' . $id . '/show')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $user->name = input::get('name');
            $user->email = input::get('email');
            $user->phone_number = input::get('phone_number');
            $user->save();
        }
    }

    public function destroy($id)
    {
        // delete from tourney
        $user = User::find($id);
        $user->delete();
        $user->save();
        // redirect
        return Redirect::to('admin');
    }
}