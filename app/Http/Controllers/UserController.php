<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Flash;

class UserController extends Controller
{
    public function index() {
        $users = User::all();

        return view('users.index')->with(['users' => $users]);
    }

    public function update($id, Request $request)
    {
        $user = User::find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $user->update($request->all());

        Flash::success('User updated successfully.');

        return redirect(route('users.index'));
    }

    public function show($id) 
    {
        $user = User::find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
    }

    public function store() 
    {
        
    }

    public function edit($id) 
    {
        $user = User::find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.edit')
        ->with('user', $user);
    }

    public function destroy() 
    {
        
    }
    public function create() 
    {
        
    }

    public function showProfile() 
    {
        $user = Auth::user();

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('profile.index')->with('user', $user);
    }

    public function updateProfile(Request $request, $id) 
    {
        $user = User::find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $user->update($request->all());

        Flash::success('Profile updated successfully.');

        return view('profile.index')->with(['user' => $user]);
    }

}
