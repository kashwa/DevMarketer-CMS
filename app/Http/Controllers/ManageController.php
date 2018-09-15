<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManageController extends Controller
{
    /**
     * Dashboard to control Managing users.
     */
    public function dashboard(){
        return view('manage.dashboard');
    }

    public function index(){
        return redirect()->route('manage.dashboard');
    }
}
