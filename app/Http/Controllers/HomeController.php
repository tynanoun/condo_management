<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usage;
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasRole('admin')) {
            $usages = Usage::all();
        } else {
            $usages = Usage::all()->where('room_id', '=', Auth::user()->room_id)->sortByDesc('start_date');
        }

        return view('home', compact('usages'));
    }
}
