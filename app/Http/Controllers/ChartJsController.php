<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ChartJsController extends Controller
{
    public function index()
    {
        $year = ['2021-01','2021-02','2021-03','2021-04','2021-05','2021-06', '2021-07','2021-08','2021-09','2021-10','2021-11', '2021-12',] ;

        $user = [];
        foreach ($year as $key => $value) {
            $user[] = DB::table('tasks')->where(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"),$value)->count();
        }
        $years = ['2021-01','2021-02','2021-03','2021-04','2021-05','2021-06', '2021-07','2021-08','2021-09','2021-10','2021-11', '2021-12',] ;

        $users = [];
        foreach ($years as $key => $value) {
            $users[] = DB::table('projects')->where(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"),$value)->count();
        }
        

    	return view('chartjs')->with('year',json_encode($year,JSON_NUMERIC_CHECK))->with('user',json_encode($user,JSON_NUMERIC_CHECK))->with('years',json_encode($years,JSON_NUMERIC_CHECK))->with('users',json_encode($users,JSON_NUMERIC_CHECK));
    }
    public function index2()
    {
 
 $record = DB::table('users')->select(DB::raw("COUNT(*) as count"), DB::raw("flag as day_name"))
    ->groupBy('day_name')
    ->get();
  
     $data = [];
 
     foreach($record as $row) {
        $data['label'][] = $row->day_name;
        $data['data'][] = (int) $row->count;
      }
 
    $data['chart_data'] = json_encode($data);
    return view('chart-js', $data);
    }
}
