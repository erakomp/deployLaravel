<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashController extends Controller
{
    public function index()
    {
        $getUser = DB::table('users')->get();
        $getProjects = DB::table('projects')->get();
        $getTasks = DB::table('tasks')->get();

        return view('dashboard', compact('getUser', 'getProjects', 'getTasks'));
    }
}
