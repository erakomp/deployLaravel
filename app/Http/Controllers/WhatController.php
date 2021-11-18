<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\What;
use DB;

class WhatController extends Controller
{
    public function index()
    {
        $what = What::all();
        return view('what', ['what' => $what]);
    }
 
    public function tambah()
    {
        return view('what_tambah');
    }
 
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'role_id' => 'required'
        ]);
 
        DB::table('role_user')->create([
            'user_id' => $request->user_id,
            'role_id' => $request->role_id
        ]);
 
        return redirect('/what');
    }
    public function edit($id)
    {
        $what = What::find($id);
        return view('what_edit', ['what' => $what]);
    }
    public function update($id, Request $request)
    {
        $this->validate($request, [
       'user_id' => 'required',
       'role_id' => 'required'
    ]);
 
        $what = What::find($id);
        $what->user_id = $request->user_id;
        $what->role_id = $request->role_id;
        $what->save();
        return redirect('/what');
    }
    public function delete($id)
    {
        $what = What::find($id);
        $what->delete();
        return redirect('/what');
    }
}
