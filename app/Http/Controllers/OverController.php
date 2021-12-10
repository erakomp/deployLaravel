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
    
        $product = DB::table('activities')->where( function($query) use($request){
                         return $request->price_id ?
                                $query->from('activities')->where('source_id', $request->price_id) : '';
                    })->where(function($query) use($request){
                         return $request->color_id ?
                                $query->from('activities')->where('text', 'like', '%' . $request->color_id . '%') : '';
                    })
                    ->where(function($query) use($request){
                        return $request->from ?
                        $query->from('activities')->whereBetween('created_at', [$request->from, $request->to]) : '';
                   })
                    //->with('prices','colors')
                    ->get();
         
        $selected_id = [];
        $selected_id['source_id'] = $request->price_id;
        $selected_id['causer_id'] = $request->color_id;
        $selected_id['created_at'] = $request->from;
        $selected_id['created_at'] = $request->to;
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
