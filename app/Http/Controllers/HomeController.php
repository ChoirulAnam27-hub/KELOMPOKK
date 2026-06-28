<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Court;

class HomeController extends Controller
{
    public function index()
    {
        $courts = Court::all();
        return view('welcome', compact('courts'));
    }
}
