<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UsercrudController extends Controller
{
   
    public function index()
    {
    $products = User::get();  
        return view('userscrud.index',compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usercrud.create');
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
            'external_id' => 'sometimes',
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'address' => 'sometimes',
            'primary_number' => 'sometimes',
            'image_path' => 'sometimes',
            'language' => 'sometimes',
            'flag' => 'sometimes',
            'image' => 'sometimes',

        ]);
  
        User::insert([
            'external_id' => Uuid::uuid4()->toString(),
            'name' => $request->name ,
            'email' => $request->email ,
            'password' => $request->password,
            'address' => $request->address,
            'primary_number' => $request->primary_number,
            'image_path' => $request->image_path ,
            'language' => $request-> language,
            'flag' => $request->flag ,
            'image' => $request->image,
        

        ]);
   
        return redirect()->route('usercrud.index')
                        ->with('success','Users created successfully.');
    }
   
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $product = User::get();

        return view('usercrud.show',compact('product'));
    }
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = User::findOrFail($id);

        return view('userscrud.edit',compact('product'));
    }
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update($product,Request $request )
    {
        // dd($product);
        //return $product;
        $request->validate([
           
            'name' => 'required',
            'email' => 'required',
            'password' => 'sometimes',
           
        ]);
        User::findOrFail($product)->update($request->all());
  
        return redirect()->route('usercrud.index')
                        ->with('success','User updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $query = User::where('id', '=', $id);
        $query->delete();
        return redirect()->route('usercrud.index')
                        ->with('success','User deleted successfully');
    }

}
