<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function home()
    {
        return view('backend.home.home');
    }
}
