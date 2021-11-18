<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
 
use App\Pegawa;
 use DB;

 class PegawaController extends Controller
 {
     public function index()
     {
         $pegawa = DB::table('role_user')
        ->join('users', 'role_user.user_id', '=', 'users.id')
        ->join('roles', 'role_user.role_id', '=', 'roles.id')
        ->select('users.name as name', 'roles.display_name as dn')
        ->get();
         return view('pegawa', ['pegawa' => $pegawa]);
     }
     public function tambah()
     {
         $pegawa = DB::table('role_user')->get();
         $user = DB::table('users')->get();
         $role = DB::table('roles')->get();

         return view('pegawa_tambah', compact('role', 'user'));
     }

     public function store(Request $request)
     {
         $this->validate($request, [
            'user_id' => 'required',
            'role_id' => 'required'
        ]);
 
         Pegawa::create([
            'user_id' => $request->user_id,
            'role_id' => $request->role_id
        ]);
 
         return redirect('/pegawa');
     }
     public function edit($user_id)
     {
         $pegawa = Pegawa::find($user_id);
         return view('pegawa_edit', ['pegawa' => $pegawa]);
     }
     public function delete($user_id)
     {
         $pegawa = Pegawa::find($user_id);
         $pegawa->delete();
         return redirect('/pegawa');
     }
 }
