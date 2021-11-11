<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Role;
use App\Models\RoleUser;

class RoleuserController extends Controller
{
    public function index()
    {
        $products = DB::table('role_user')
        ->join('roles', 'role_user.role_id', '=', 'roles.id')
        ->join('users', 'role_user.user_id', '=', 'users.id')
        ->select('role_user.user_id', 'role_user.role_id', 'roles.name as rn', 'users.name as un')
        ->get();
  
        return view('roless.index', compact('products'));
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = DB::table('role_user')
        ->join('roles', 'role_user.role_id', '=', 'roles.id')
        ->join('users', 'role_user.user_id', '=', 'users.id')
        ->select('role_user.user_id', 'role_user.role_id', 'roles.name as rn', 'users.name as un')
        ->get();
        $roles = DB::table('roles')
        ->select('roles.*')
        ->get();
        $users = DB::table('users')
        ->select('users.*')
        ->get();
        return view('roless.create', compact('products', 'roles', 'users'));
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
            'user_id' => 'required',
            'role_id' => 'required',
        ]);
  
        RoleUser::create($request->all());
        //$data = new User();
        // $data->user_id = $request->user_id;
        // $data->role_id = $request->role_id;
        //$data->save();
        return redirect()->route('roless.index')
                        ->with('success', 'User Role created successfully.');
    }
   
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(User $product)
    {
        return view('products.show', compact('product'));
    }
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(User $product)
    {
        return view('products.edit', compact('product'));
    }
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $product)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'sometimes',
        ]);
  
        $product->update($request->all());
  
        return redirect()->route('products.index')
                        ->with('success', 'User role updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $product)
    {
        $product->delete();
  
        return redirect()->route('productss.index')
                        ->with('success', 'User Roles deleted successfully');
    }
}
