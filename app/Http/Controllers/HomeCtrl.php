<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeCtrl extends Controller
{

    public function index()
    {
        if (Auth::check()) {
            return view('home.index');
        }
        return view('login.login');
    }

}
