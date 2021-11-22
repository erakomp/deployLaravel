<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Div;
use DB;

class DivController extends Controller
{
    public function index()
    {
        $pegawa = DB::table('divs')
       ->get();
        return view('div', ['div' => $pegawa]);
    }
    public function tambah()
    {
        $div = DB::table('divs')->get();
        

        return view('div_tambah', compact('div'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
           'division' => 'required',
           'description' => 'required'
       ]);

        Div::create([
           'division' => $request->division,
           'description' => $request->description
       ]);

        return redirect('/div');
    }
    public function edit($id)
    {
        $div = Div::find($id);
        return view('div_edit', ['div' => $div]);
    }
    public function update($id, Request $request)
    {
        $this->validate($request, [
       'division' => 'sometimes',
       'description' => 'sometimes'
    ]);
 
        $div = Div::find($id);
        $div->division = $request->division;
        $div->description = $request->description;
        $div->save();
        return redirect('/div');
    }
    public function delete($id)
    {
        $div = Div::find($id);
        $div->delete();
        return redirect('/div');
    }
}
