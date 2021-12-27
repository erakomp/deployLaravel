<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CariController extends Controller
{
    public function index(Request $request){
        $datas=DB::table('tasks')->get();
        $query = $request->get('q');

        $hasil = DB::table('tasks')->where('title', 'LIKE', '%' . $query . '%')->paginate(10);

        return view('pages.searchingg', compact( 'datas','hasil', 'query'));
    }
}
