<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Activity;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use DateTime;
class NewmenuController extends Controller
{
    public function index(Request $request){
$all_pro =  Activity::join('users', 'activities.causer_id', '=', 'users.id')
        ->select('activities.id', 'activities.text', 'activities.log_name', 'activities.created_at','users.name')
        ->where('activities.source_type','=','App\Models\Task')
    ->where('activities.deleted_at','=',NULL)
    ->where('activities.text', 'like', "%".'DONE KPI'."%")
    ->where( function($query) use($request){
                     return $request->price_id ?
                            $query->from('activities')->where('source_id',$request->price_id) : '';})
                // })->where(function($query) use($request){
                //      return $request->color_id ?
                //             $query->from('activities')->where('source_id',$request->color_id) : '';
                // })
                // ->with('price','color')
               
                ->get();
    $product = Activity::join('users', 'activities.causer_id', '=', 'users.id')
    ->select('activities.id', 'activities.text', 'activities.log_name', 'activities.created_at','users.name')->where('source_type','=','App\Models\Task')->
    where('activities.deleted_at','=',NULL)
    ->where('activities.text', 'like', "%".'DONE KPI'."%")
    ->where( function($query) use($request){
                     return $request->price_id ?
                            $query->from('activities')->where('source_id',$request->price_id) : '';})
                // })->where(function($query) use($request){
                //      return $request->color_id ?
                //             $query->from('activities')->where('source_id',$request->color_id) : '';
                // })
                // ->with('price','color')
                ->orderBy('created_at','desc')->first();
                //  return $product;
    $product_progressing = Activity::join('users', 'activities.causer_id', '=', 'users.id')
    ->select('activities.id', 'activities.text', 'activities.log_name', 'activities.created_at','users.name')
    ->where('activities.source_type','=','App\Models\Task')->
    where('activities.deleted_at','=',NULL)
    ->where('activities.text', 'like', "%".'Progressing'."%")
    ->where( function($query) use($request){
                     return $request->price_id ?
                            $query->from('activities')->where('source_id',$request->price_id) : '';})
                // })->where(function($query) use($request){
                //      return $request->color_id ?
                //             $query->from('activities')->where('source_id',$request->color_id) : '';
                // })
                // ->with('price','color')
                ->first();

                $progressing = new DateTime($product_progressing->created_at->format('Y-m-d H:i:s'));
                $done_kpi = new DateTime($product->created_at);
                $interval = $done_kpi->diff($progressing);
                // return Carbon\Carbon::parse($interval)->format('%d %h %m %s');
                $duration =   $interval->format('%a') * 24 + $interval->format('%h') . ' :' . $interval->format(' %i : %s : (+/- %d Day(s))');

                // return [
                //     'product' => $done_kpi,
                //     'progressing' => $progressing,
                //     'durasi' => $duration
                // ];
    $selected_id = [];
    $selected_id['price_id'] = $request->price_id;
    // $selected_id['color_id'] = $request->color_id;
                $get_task_id = Task::join('projects','tasks.project_id', '=', 'projects.id')
                ->where('tasks.deleted_at', '=', NULL)
                ->where('projects.deleted_at', '=', NULL)
                ->select('tasks.title', 'tasks.id' )
                ->get();
    return view('testingg',compact('all_pro','product','selected_id', 'get_task_id', 'duration'));
    }
    
}
