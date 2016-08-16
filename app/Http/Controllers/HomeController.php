<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notification;
use App\Calculation;


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

        $notifications = Notification::where("id", ">", 0)->orderBy('id', 'desc')->get();

        $calculations = Calculation::all();

        return view('home', ['notifications' => $notifications, 'calculations' => $calculations, 'user' => Auth::user()]);

    }
}
