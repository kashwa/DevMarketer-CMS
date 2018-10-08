<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaraFlash;

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
        // LaraFlash::add()->content('hello world')->priority(6)->type('Info');
        // LaraFlash::snackbar('So Far So Good, Continue');
        // flash("Yaay it works", ['priority' => 100, 'type' => 'info']);   ||   helper func.
        // LaraFlash::danger("Something went wrong !");
        return view('home');
    }
}
