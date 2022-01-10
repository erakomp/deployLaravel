<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getDataProject = DB::table('projects')->where('deleted_at', '=', NULL)->count();
        $getDataTask = DB::table('tasks')->where('deleted_at', '=', NULL)->count();
        $getIncTask = DB::table('tasks')->where('deleted_at', '=', NULL)->where('status_id', '!=',7)->count();
        $getCompTask = DB::table('tasks')->where('deleted_at', '=', NULL)->where('status_id', '=', 7)->count();
        $getOv = DB::table('tasks')->where('deleted_at', '=', NULL)->where('deadline', '<', Carbon::today())->where('status_id', '!=', 7)->count();
        $getUserList = DB::table('users')->count();
        $getUser = DB::table('users')->get();
        $most = DB::table('activities')
        ->join('users', 'activities.causer_id', '=', 'users.id')
        ->select('users.name', 'users.image', 'users.email', 'activities.created_at')->distinct()
        ->paginate(5);
        $year = ['2021-01','2021-02','2021-03','2021-04','2021-05','2021-06', '2021-07','2021-08','2021-09','2021-10','2021-11', '2021-12',] ;

        $user = [];
        foreach ($year as $key => $value) {
            $user[] = DB::table('tasks')->where(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"),$value)->count();
        }

        $record = DB::table('users')->select(DB::raw("COUNT(*) as count"), DB::raw("flag as day_name"))
    ->groupBy('day_name')
    ->get();
  
     $data = [];
 
     foreach($record as $row) {
        $data['label'][] = $row->day_name;
        $data['data'][] = (int) $row->count;
      }
 
    $data['chart_data'] = json_encode($data);
    
        return view('welcome', $data,compact('getDataProject','getDataTask','getIncTask', 'getCompTask', 'getOv', 'getUserList', 'getUser', 'most'))->with('year',json_encode($year,JSON_NUMERIC_CHECK))->with('user',json_encode($user,JSON_NUMERIC_CHECK));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
