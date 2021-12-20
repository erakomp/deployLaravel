<?php
  
namespace App\Http\Controllers;
use Ramsey\Uuid\Uuid;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class TaskssController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
$products = Task::all();  
        return view('taskss.index',compact('products'));
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('taskss.create');
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
           
            'getlabel' => 'required',
            'getcolor' => 'required',
        ]);
  
        Task::insert([
            'external_id' => Uuid::uuid4()->toString(),
            
            'getlabel' => $request->getlabel,
            'getcolor' => $request->getcolor,

        ]);
   
        return redirect()->route('taskss.index')
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
        $product = Task::get();

        return view('taskss.show',compact('product'));
    }
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Task::findOrFail($id);

        return view('taskss.edit',compact('product'));
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
           
            'getlabel' => 'required',
            'getcolor' => 'required',
        ]);
        Task::findOrFail($product)->update(['getlabel'=>$request->getlabel, 'getcolor'=>$request->getcolor]);
  
        return redirect()->route('taskss.index')
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
        $query = Task::where('id', '=', $id);
        $image = $query->first();
        $query->delete();
        return redirect()->route('taskss.index')
                        ->with('success','Your profile has been updated deleted successfully');
    }
}