<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index() {
        return view('Dashboard.index');
    }

    public function users() {
        $users = User::all();
        return view('Dashboard.Usuaris.index', compact('users'));
    }
}
