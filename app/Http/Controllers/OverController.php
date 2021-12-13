<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OverController extends Controller
{
    public function test(Request $request){
        $countries = DB::table('projects')
        ->get();
        $states = DB::table('tasks')
        ->where('project_id', $request->country_id)
        ->get();
    
    if (count($states) > 0) {
        return response()->json($states);
    }
    
        $product = DB::table('tasks')
        ->whereIn('tasks.status_id', [5,7])
        ->join('projects', 'tasks.project_id', '=', 'projects.id')
        ->select('projects.title as pt', 'tasks.project_id' ,'tasks.title as tt', 'tasks.created_at', 'tasks.status_id', 'tasks.updated_at')
        
        ->where( function($query) use($request){
                         return $request->price_id ?
                                $query->from('tasks')->where('tasks.project_id', $request->price_id) : '';
                    })->where(function($query) use($request){
                         return $request->color_id ?
                                $query->from('tasks')->where('tasks.status_id',  $request->color_id ) : '';
                    })
                    ->where(function($query) use($request){
                        return $request->from ?
                        $query->from('tasks')->whereBetween('tasks.updated_at', [$request->from, $request->to]) : '';
                   })
                    //->with('prices','colors')
                    ->get();
         
        $selected_id = [];
        $selected_id['project_id'] = $request->price_id;
        $selected_id['status_id'] = $request->color_id;
        $selected_id['updated_at'] = $request->from;
        $selected_id['updated_at'] = $request->to;
        return view('test',compact('product','selected_id', 'countries'));
    }

    public function overdue(Request $request){
        $product = DB::table('tasks')
        ->where('deleted_at', '=', NULL)
        ->where( function($query) use($request){
            return $request->from ?
                   $query->from('tasks')->whereBetween('deadline', [$request->from . ' 00:00:00', $request->to . ' 23:59:59']) : '';
       
       })
       ->select('tasks.*')
       ->get();
    
    $selected_id = [];
    $selected_id['deadline'] = $request->from;
    $selected_id['deadline'] = $request->to;
    
    return view('overdue',compact('product','selected_id' ));
    }
}
