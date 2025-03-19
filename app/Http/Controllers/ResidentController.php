<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResidentController extends Controller
{
    public function index()
    {
        return view('residents.index'); // Change this based on your view
    }
}
