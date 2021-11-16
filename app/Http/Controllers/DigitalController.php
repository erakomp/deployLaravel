<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Exports\TransactionsExport;
use App\Imports\TransactionsImport;
use DB;
use Carbon\Carbon;

class DigitalController extends Controller
{
    public function importExportView()
    {
        return view('index2');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function exportExcel($type)
    {
        $startDate = request()->input('startDate') ;
        $endDate   = request()->input('endDate') ;
        $status = request()->input('status');
        if ($status == 0 && $startDate == Carbon::today()->toDateString() && $endDate == Carbon::today()->toDateString()) {
            $getTaskReport =DB::table('tasks')
            ->join('projects', 'tasks.project_id', '=', 'projects.id')
            ->join('users', 'tasks.user_created_id', '=', 'users.id')
            ->join('statuses', 'tasks.status_id', '=', 'statuses.id')
        ->select('tasks.created_at as task_created_at', 'tasks.updated_at as task_update_at', 'tasks.title AS task_title', 'users.name as username', 'projects.title AS project_title', DB::raw('TIMESTAMPDIFF(MINUTE, tasks.created_at, tasks.updated_at) as duration_in_mins'), 'statuses.title as status_title')
        ->WhereBetween('tasks.created_at', [ ($startDate = Carbon::today()->toDateString()) . ' 00:00:00', ($endDate = Carbon::today()->toDateString()).' 23:59:59' ])
        ->orderBy('tasks.created_at', 'ASC')
            ->get();
        }
        if ($status != 0 && $startDate == Carbon::today()->toDateString() && $endDate == Carbon::today()->toDateString()) {
            $getTaskReport =DB::table('tasks')
            ->join('projects', 'tasks.project_id', '=', 'projects.id')
            ->join('users', 'tasks.user_created_id', '=', 'users.id')
            ->join('statuses', 'tasks.status_id', '=', 'statuses.id')
        ->select('tasks.created_at as task_created_at', 'tasks.updated_at as task_update_at', 'tasks.title AS task_title', 'users.name as username', 'projects.title AS project_title', DB::raw('TIMESTAMPDIFF(MINUTE, tasks.created_at, tasks.updated_at) as duration_in_mins'), 'statuses.title as status_title')
        ->WhereBetween('tasks.created_at', [ ($startDate = Carbon::today()->toDateString()). ' 00:00:00', ($endDate = Carbon::today()->toDateString()).' 23:59:59' ])
        ->Where('tasks.status_id', '=', $status)
        ->orderBy('tasks.created_at', 'ASC')
            ->get();
        }
        if ($status != 0) {
            $getTaskReport =DB::table('tasks')
            ->join('projects', 'tasks.project_id', '=', 'projects.id')
            ->join('users', 'tasks.user_created_id', '=', 'users.id')
            ->join('statuses', 'tasks.status_id', '=', 'statuses.id')
        ->select('tasks.created_at as task_created_at', 'tasks.updated_at as task_update_at', 'tasks.title AS task_title', 'users.name as username', 'projects.title AS project_title', DB::raw('TIMESTAMPDIFF(MINUTE, tasks.created_at, tasks.updated_at) as duration_in_mins'), 'statuses.title as status_title')
        ->WhereBetween('tasks.created_at', [ $startDate .'00:00:00', $endDate .' 23:59:59' ])
        ->Where('tasks.status_id', '=', $status)
        ->orderBy('tasks.created_at', 'ASC')
            ->get();
        } else {
            // return 'else';
            //     $getTaskReport =DB::table('tasks')
            //     ->join('projects', 'tasks.project_id', '=', 'projects.id')
            //     ->join('users', 'tasks.user_created_id', '=', 'users.id')
            //     ->join('statuses', 'tasks.status_id', '=', 'statuses.id')
            // ->select('tasks.created_at as task_created_at', 'tasks.updated_at as task_update_at', 'tasks.title AS task_title', 'users.name as username', 'projects.title AS project_title', DB::raw('TIMESTAMPDIFF(MINUTE, tasks.created_at, tasks.updated_at) as duration_in_mins'), 'statuses.title as status_title')
            // ->WhereBetween('tasks.created_at', [ ($startDate = Carbon::today()->toDateString()), ($endDate = Carbon::today()) . '23:59:59' ])
            // ->orderBy('tasks.created_at', 'ASC')
            //     ->get();
            $getTaskReport = DB::table('tasks')
            ->join('projects', 'tasks.project_id', '=', 'projects.id')
            ->join('users', 'tasks.user_created_id', '=', 'users.id')
            ->join('statuses', 'tasks.status_id', '=', 'statuses.id')
        ->select('tasks.created_at as task_created_at', 'tasks.updated_at as task_update_at', 'tasks.title AS task_title', 'users.name as username', 'projects.title AS project_title', DB::raw('TIMESTAMPDIFF(MINUTE, tasks.created_at, tasks.updated_at) as duration_in_mins'), 'statuses.title as status_title')
            ->whereBetween('tasks.created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->orderBy('tasks.created_at', 'ASC')
            ->get();
        }
        return view('digi', compact('getTaskReport', 'startDate', 'endDate', 'status'));
        //   return \Excel::download(new TransactionsExport, 'transactions.'.$type);
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function importExcel(Request $request)
    {
        \Excel::import(new TransactionsImport, $request->import_file);

        \Session::put('success', 'Your file is imported successfully in database.');
        return back();
    }
}
