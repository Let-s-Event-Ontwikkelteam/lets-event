<?php

namespace App\Http\Controllers;

use App\Admin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

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

    public function edit($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required'
        ]);
             
            $user = User::find($id);
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->phone_number = $request->get('phone_number');
            $user->save();

            return redirect('/admin')->with('success', 'Contact updated!');
    }

    public function destroy($id)
    {
        // delete from tourney
        $user = User::find($id);
        $user->delete($id);
        // redirect
        $users = User::all();
        return View('admin.index', compact('users'));
    }
}