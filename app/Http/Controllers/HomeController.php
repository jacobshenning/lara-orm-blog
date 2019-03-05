<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the application settings.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function settings()
    {
        return view('settings');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateSettings()
    {
        request()->validate([
           'name' => 'required|max:255|unique:users,name,' . Auth::id(),
           'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        if (request()->email != Auth::user()->email) {
            Auth::user()->email = request()->email;
            Auth::user()->email_verified_at = NULL;
        }

        Auth::user()->name = request()->name;

        Auth::user()->save();

        return redirect('/home');
    }
}
