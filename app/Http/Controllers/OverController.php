<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        ->where('tasks.deleted_at', '=', NULL)
        ->join('projects', 'tasks.project_id', '=', 'projects.id')
        ->join('users', 'tasks.user_assigned_id', '=', 'users.id')
        ->join('statuses', 'tasks.status_id', '=', 'statuses.id')
        ->where('projects.deleted_at', '=', NULL)
        ->where('tasks.flag', '=', Auth::user()->flag)
        ->where('projects.flag', '=', Auth::user()->flag)
        ->select('projects.title as pt', 'tasks.project_id' ,'tasks.external_id','tasks.title as tt', 'users.name as ui', 'tasks.created_at', 'tasks.status_id', 'tasks.updated_at', 'statuses.title as st','tasks.created_at', DB::raw('TIMESTAMPDIFF(HOUR, tasks.created_at, tasks.updated_at) AS timediff'))
        
        // ->select(DATEDIFF)
        
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
                
        $price_id = $request->price_id;        
        $color_id = $request->color_id;
        $from = date("Y-m-d H:i:s",strtotime($request->from));        
        $to = date("Y-m-d H:i:s",strtotime($request->to));
       
        // $from = !empty($from) ? date('d-M-Y', strtotime($request->from)) : 0 ;
        // $to = !empty($to) ? date('d-M-Y', strtotime($to)) : null;

        // $from = date("mm/dd/yyyyH:i:s",strtotime($request->from));
        // $to = $request->to;
        //           return $from;
        $selected_id = [];
        $selected_id['project_id'] = $request->price_id;
        $selected_id['status_id'] = $request->color_id;
        $selected_id['updated_at'] = $request->from;
        $selected_id['updated_at'] = $request->to;

        $startDate = Carbon::today()->toDateString();
    return view('test',compact('product', 'startDate','selected_id', 'countries', 'color_id', 'price_id', 'from', 'to'));
    }

    public function overdue(Request $request){
        $product = DB::table('tasks')
        ->join('projects', 'tasks.project_id', '=', 'projects.id')
        ->join('statuses','tasks.status_id', '=', 'statuses.id')
        ->join('users', 'tasks.user_assigned_id', '=', 'users.id')
        ->where('tasks.deleted_at', '=', NULL)
        ->where('projects.deleted_at', '=', NULL)
        ->where('tasks.flag', '=', Auth::user()->flag)
        ->where('projects.flag', '=', Auth::user()->flag)
        
        ->where( function($query) use($request){
            return $request->from ?
                   $query->from('tasks')->whereBetween('deadline', [$request->from . ' 00:00:00', $request->to . ' 23:59:59']) : '';
       
       })
       ->select('tasks.title as tt', 'projects.title as pt', 'users.name','tasks.deadline', 'tasks.created_at', 'tasks.external_id','statuses.title as st')
       ->get();
    
    $selected_id = [];
    $selected_id['deadline'] = $request->from;
    $selected_id['deadline'] = $request->to;
    
    return view('overdue',compact('product','selected_id' ));
    }
}
