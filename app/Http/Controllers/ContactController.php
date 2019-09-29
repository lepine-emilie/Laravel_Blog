<?php

namespace App\Http\Controllers;

use App\Notifications\ContactAdmin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contact');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(Request $request)
    {
        $users = User::whereHas("roles", function ($query) {
            $query->where("name", "Admin");
        })->get();

        Notification::send($users, new ContactAdmin($request));
        return redirect()->route('home')->with('mailStatus', 'Your message  was sent successfully');
    }
}
