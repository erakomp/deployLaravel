<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Div;

use App\Models\Activity;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use DateTime;
class NewmenuController extends Controller
{
    public function index(Request $request){
        
$all_pro =  Activity::join('tasks', 'activities.source_id', '=', 'tasks.id')
->join('divs', 'tasks.flag', '=', 'divs.id')
    ->join('users', 'tasks.user_assigned_id', '=', 'users.id')
    ->join('projects', 'tasks.project_id', '=', 'projects.id')
        ->select('activities.id', 'activities.text', 'activities.log_name', 'activities.created_at','users.name', 'tasks.title', 'projects.title as pt', 'tasks.status_id', 'tasks.updated_at', 'tasks.created_at as tc', 'tasks.flag', 'divs.division')
        // ->where('tasks.status_id', '=', 7)

        ->where('activities.source_type','=','App\Models\Task')
    ->where('activities.deleted_at','=',NULL)
    // ->where('activities.text', 'like', "%".'DONE KPI'."%")
    ->where( function($query) use($request){
                     return $request->price_id ?
                            $query->from('tasks')->where('tasks.flag',$request->price_id) : '';})
                            ->where( function($query) use($request){
                                return $request->color_id ?
                                       $query->from('tasks')->where('activities.text', 'like', "%".$request->color_id."%") : '';})
                                       ->where( function($query) use($request){
                                        return $request->color_from ?
                                               $query->from('tasks')->where('activities.text', 'like', "%".$request->color_from."%") : '';})
                            ->where(function($query) use($request){
                                return $request->from ?
                                $query->from('tasks')->whereBetween('tasks.updated_at', [$request->from, $request->to]) : '';
                           })
                // })->where(function($query) use($request){
                //      return $request->color_id ?
                //             $query->from('activities')->where('source_id',$request->color_id) : '';
                // })
                // ->with('price','color')
               
                ->get();
    // $product = Activity::join('tasks', 'activities.source_id', '=', 'tasks.id')
    // ->join('users', 'tasks.user_assigned_id', '=', 'users.id')
    // ->join('projects', 'tasks.project_id', '=', 'projects.id')
    //     ->select('activities.id', 'activities.text', 'activities.log_name', 'activities.created_at','users.name', 'tasks.title', 'projects.title as pt', 'tasks.status_id', 'tasks.flag')
    //     ->where('tasks.status_id', '=', 7)

    // ->where('source_type','=','App\Models\Task')
    // ->where('activities.deleted_at','=',NULL)
    // ->where('activities.text', 'like', "%".'DONE KPI'."%")
    // ->where( function($query) use($request){
    //                  return $request->price_id ?
    //                         $query->from('tasks')->where('tasks.flag',$request->price_id) : '';})
    //                         ->where(function($query) use($request){
    //                             return $request->from ?
    //                             $query->from('tasks')->whereBetween('tasks.updated_at', [$request->from, $request->to]) : '';
    //                        })
    //             // })->where(function($query) use($request){
    //             //      return $request->color_id ?
    //             //             $query->from('activities')->where('source_id',$request->color_id) : '';
    //             // })
    //             // ->with('price','color')
    //             ->orderBy('created_at','desc')->first();
    //             //  return $product;
    // $product_progressing = Activity::join('tasks', 'activities.source_id', '=', 'tasks.id')
    // ->join('users', 'tasks.user_assigned_id', '=', 'users.id')
    // ->join('projects', 'tasks.project_id', '=', 'projects.id')
    //     ->select('activities.id', 'activities.text', 'activities.log_name', 'activities.created_at','users.name', 'tasks.title', 'projects.title as pt', 'tasks.status_id', 'tasks.flag')
    //     ->where('tasks.status_id', '=', 7)
    // ->where('activities.source_type','=','App\Models\Task')
    // ->where('activities.deleted_at','=',NULL)
    // ->where('activities.text', 'like', "%".'Progressing'."%")
    // ->where( function($query) use($request){
    //                  return $request->price_id ?
    //                         $query->from('tasks')->where('tasks.flag',$request->price_id) : '';})
    //                         ->Orwhere(function($query) use($request){
    //                             return $request->from ?
    //                             $query->from('tasks')->whereBetween('tasks.updated_at', [$request->from, $request->to]) : '';
    //                        })
    //             // })->where(function($query) use($request){
    //             //      return $request->color_id ?
    //             //             $query->from('activities')->where('source_id',$request->color_id) : '';
    //             // })
    //             // ->with('price','color')
    //             ->first();
    //             $from = date("Y-m-d H:i:s",strtotime($request->from));        
    //             $to = date("Y-m-d H:i:s",strtotime($request->to));
    //             $progressing = new DateTime($product_progressing->created_at->format('Y-m-d H:i:s'));
    //             $done_kpi = new DateTime($product->created_at);
    //             $interval = $done_kpi->diff($progressing);
    //             // return Carbon\Carbon::parse($interval)->format('%d %h %m %s');
    //             $duration =   $interval->format('%a') * 24 + $interval->format('%h') . ' :' . $interval->format(' %i : %s : (+/- %d Day(s))');

                // return [
                //     'product' => $done_kpi,
                //     'progressing' => $progressing,
                //     'durasi' => $duration
                // ];
                $from = date("Y-m-d H:i:s",strtotime($request->from));        
                $to = date("Y-m-d H:i:s",strtotime($request->to));


                $color_id = $request->color_id;
                $color_from = $request->color_from;
                // $interval = ($all_pro->tc)->diff($all_pro->created_at);

                //  return Carbon\Carbon::parse($interval)->format('%d %h %m %s');
                // $duration =   $interval->format('%a') * 24 + $interval->format('%h') . ' :' . $interval->format(' %i : %s : (+/- %d Day(s))');
                // return $duration;

                // foreach($all_pro as $i){
                //     $duration = '';
                //     if($request->color_id){
                //         $start_time = new DateTime($all_pro->tc->format('Y-m-d H:i:s'));
                //         $end_time = new DateTime($all_pro->created_at->format('Y-m-d H:i:s'));
                //          $interval = $start_time->diff($end_time);

                //  return Carbon\Carbon::parse($interval)->format('%d %h %m %s');
                // $duration =   $interval->format('%a') * 24 + $interval->format('%h') . ' :' . $interval->format(' %i : %s : (+/- %d Day(s))');

                //     }
                //     return $duration;
                // }
    $selected_id = [];
    $selected_id['price_id'] = $request->price_id;
    $selected_id['updated_at'] = $request->from;
    $selected_id['updated_at'] = $request->to;
    $selected_id['color_from'] = $request->color_from;

    // $selected_id['status_id'] = $request->status_from;
    // $selected_id['status_id'] = $request->status_to;
    $selected_id['color_id'] = $request->color_id;
                $get_task_id = Task::join('projects','tasks.project_id', '=', 'projects.id')
                ->join('divs', 'tasks.flag', '=', 'divs.id')
                ->where('tasks.deleted_at', '=', NULL)
                ->where('tasks.status_id', '=', 7)

                ->where('projects.deleted_at', '=', NULL)
                ->select('tasks.title', 'tasks.id' , 'divs.division')
                ->get();
                $getDiv = Div::all();
    return view('testingg',compact('all_pro','selected_id', 'getDiv','get_task_id', 'from', 'to', 'color_id', 'color_from'));
    }
    public function index2(Request $request){
        $getDiv = Div::all();
        $selected_id = [];
        $selected_id['price_id'] = $request->price_id;
        $selected_id['updated_at'] = $request->from;
        $selected_id['updated_at'] = $request->to;
        return view('testingmenu', compact('getDiv', 'selected_id'));
    }
    
}
