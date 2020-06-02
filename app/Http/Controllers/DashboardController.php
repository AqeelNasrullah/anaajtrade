<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    // Displays dashboard view
    public function index()
    {
        return view('dashboard');
    }
}
