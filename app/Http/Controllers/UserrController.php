<?php
  
namespace App\Http\Controllers;
use Ramsey\Uuid\Uuid;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class UserrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
$products = User::all();  
        return view('userr.index',compact('products'));
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('userr.create');
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
           
            'email' => 'required',
            'password' => 'required',
        ]);
  
        User::insert([
            'external_id' => Uuid::uuid4()->toString(),
            
            'email' => $request->email,
            'password' => $request->password,

        ]);
   
        return redirect()->route('userr.index')
                        ->with('success','List created successfully.');
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

        return view('userr.show',compact('product'));
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

        return view('userr.edit',compact('product'));
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
           
            'email' => 'required',
            'password' => 'required',
        ]);
        User::findOrFail($product)->update(['email'=>$request->email, 'password'=>bcrypt($request->password)]);
  
        return redirect()->route('userr.index')
                        ->with('success','Your profile has been updated successfully');
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
        $image = $query->first();
        $query->delete();
        return redirect()->route('userr.index')
                        ->with('success','Your profile has been updated deleted successfully');
    }
}