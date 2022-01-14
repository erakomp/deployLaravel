<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ApiController extends Controller
{
    public function getCustomers()
    {
        $query = DB::table('users')->where('deleted_at', '=', NULL)->select('id','name','email');
        return datatables($query)->make(true);
    }
}
