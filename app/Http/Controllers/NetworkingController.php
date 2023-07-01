<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NetworkingController extends Controller
{
    public function index()
    {
        return view('dashboard.signals');
    }
}
