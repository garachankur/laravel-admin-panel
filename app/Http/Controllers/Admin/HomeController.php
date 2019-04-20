<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {

        $totalUser = User::count();

        return view('admin.main.dashboard', compact('totalUser'));
    }
}
