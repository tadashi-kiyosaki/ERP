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
        $this->middleware(['auth' => 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->roleId == 1 || Auth::user()->roleId == 2)
            return view('home');
        else if (Auth::user()->roleId == 3)
            return view('landlords.actions');
        else if (Auth::user()->roleId == 4)
            return view('properties.actions');
    }
}
