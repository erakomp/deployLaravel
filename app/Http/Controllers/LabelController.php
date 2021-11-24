<?php

namespace App\Http\Controllers;

use App\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labels = Label::latest()->paginate(5);
  
        return view('labels.index', compact('labels'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('labels.create');
    }
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'detail' => 'sometimes',
        ]);
  
        Label::create($request->all());
   
        return redirect()->route('labels.index')
                        ->with('success', 'label created successfully.');
    }
   
    /**
     * Display the specified resource.
     *
     * @param  \App\label  $label
     * @return \Illuminate\Http\Response
     */
    public function show(label $label)
    {
        return view('labels.show', compact('label'));
    }
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\label  $label
     * @return \Illuminate\Http\Response
     */
    public function edit(label $label)
    {
        return view('labels.edit', compact('label'));
    }
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\label  $label
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, label $label)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'detail' => 'sometimes',
        ]);
  
        $label->update($request->all());
  
        return redirect()->route('labels.index')
                        ->with('success', 'label updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\label  $label
     * @return \Illuminate\Http\Response
     */
    public function destroy(label $label)
    {
        $label->delete();
  
        return redirect()->route('labels.index')
                        ->with('success', 'label deleted successfully');
    }
}
