<?php

namespace App\Http\Controllers\HMS2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UnionController extends Controller
{
    public function index(){
        return view('backend.HMS2.locations.unions.all-union-list');
    }
}
