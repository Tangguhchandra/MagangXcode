<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Logic for the dashboard can be added here
        return view(view: 'home');
    }

    public function DashboardUser()
    {
        // Logic for the dashboard when user is logged in
        return view(view: 'dashboard');
    }
}