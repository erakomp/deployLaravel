<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Exports\ReportExport;
use App\Exports\CalculationsExport;
use DB;
use Carbon\Carbon;
use App\Imports\TransactionsImport;

class ExcelController extends Controller
{
    /**
        * @return \Illuminate\Support\Collection
        */
    public function importExportView()
    {
        return view('index');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function exportExcel($type)
    {
        /**$getTaskReport =DB::table('activities')
        ->join('tasks', 'activities.source_id', '=', 'tasks.id')
        ->where('activities.source_type', '=', 'App\Models\Task')
        ->join('projects', 'tasks.project_id', '=', 'projects.id')
        ->join('users', 'tasks.user_created_id', '=', 'users.id')
        ->join('statuses', 'tasks.status_id', '=', 'statuses.id')
        ->select('activities.text', 'activities.created_at', 'tasks.title AS t', 'users.name', 'projects.title AS p')
        ->orderBy('tasks.title', 'DESC')
        ->orderBy('activities.created_at', 'DESC')
        ->where('source_id', 1)
        ->get();
        $getArray = [];
        foreach ($getTaskReport->groupBy('t') as $key=>$i) {
            $min = Carbon::parse($i->pluck('created_at')->last());
            $max = Carbon::parse($i->pluck('created_at')->first());
            $diff = $min->diffInSeconds($max);
            $hours = floor($diff/3600);
            $mins = floor(($diff%3600)/60);

            return [
                'min' => $min,
                'max' => $max,
                'Diff' => gmdate('H:i:s', $diff),
                'Hours' => $hours,
                'Minutes' => $mins,
            ];

            array_push($getArray, [

                'task' => $key,
                'duration' => gmdate('H:i:s', $diff),

            ]);
        }
        return $getArray;**/
        return \Excel::download(new ReportExport, 'exportdetails.'.$type);
    }
    public function exportExcel2($type)
    {
        return \Excel::download(new ReportExport, 'exportduration.'.$type);
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
