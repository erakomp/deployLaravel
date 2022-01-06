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
$all_pro =  Activity::where('source_type','=','App\Models\Task')->
    where('deleted_at','=',NULL)
    ->where('text', 'like', "%".'DONE KPI'."%")
    ->where( function($query) use($request){
                     return $request->price_id ?
                            $query->from('activities')->where('source_id',$request->price_id) : '';})
                // })->where(function($query) use($request){
                //      return $request->color_id ?
                //             $query->from('activities')->where('source_id',$request->color_id) : '';
                // })
                // ->with('price','color')
                ->get();
    $product = Activity::where('source_type','=','App\Models\Task')->
    where('deleted_at','=',NULL)
    ->where('text', 'like', "%".'DONE KPI'."%")
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
    $product_progressing = Activity::where('source_type','=','App\Models\Task')->
    where('deleted_at','=',NULL)
    ->where('text', 'like', "%".'Progressing'."%")
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
                $duration =   $interval->format('%a') * 24 + $interval->format('%h') . ' hours' . $interval->format(' %i minutes %s seconds (+/- %d Days)');

                // return [
                //     'product' => $done_kpi,
                //     'progressing' => $progressing,
                //     'durasi' => $duration
                // ];
    $selected_id = [];
    $selected_id['price_id'] = $request->price_id;
    // $selected_id['color_id'] = $request->color_id;
                $get_task_id = DB::table('tasks')->where('deleted_at', '=', NULL)->get();
    return view('testingg',compact('all_pro','product','selected_id', 'get_task_id', 'duration'));
    }
    
}
