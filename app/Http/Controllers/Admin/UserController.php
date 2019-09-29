<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users', compact('users') );
    }
    public function activate(User $user){
        $user->active = 1;
        $user->save();
        return redirect()->back();
    }
    public function deactivate(User $user){
        $user->active = 0;
        $user->save();
        return redirect()->back();
    }
    public function roles(User $user, Request $request){
        $user->roles()->attach([$request->get('role')]);
        return redirect()->back();
    }
}
