<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function index()
    {
        $customers = DB::table('users')->get();
        return view('customers.table', compact('customers'));
    }

    public function datatable()
    {
        $customers = DB::table('users')->get();        
        return view('customers.datatable', compact('customers'));
    }

    public function ajax()
    {
        return view('ajax');
    }
}
