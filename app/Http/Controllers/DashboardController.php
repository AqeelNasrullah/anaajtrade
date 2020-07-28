<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function roznamcha()
    {
        return view('dashboard.roznamcha');
    }

    public function stock()
    {
        return view('dashboard.stock');
    }
}
