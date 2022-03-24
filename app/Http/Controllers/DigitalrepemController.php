<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DigitalrepemController extends Controller
{
    public function test(Request $request)
    {
        $countries = DB::table('projects')
            ->get();
        $states = DB::table('tasks')
            ->where('project_id', $request->country_id)
            ->get();

        if (count($states) > 0) {
            return response()->json($states);
        }

        $product = DB::table('tasks')
            ->join('statuses', 'tasks.status_id', '=', 'statuses.id')
            // ->whereIn('tasks.status_id', [5,7])
            ->where('tasks.deleted_at', '=', null)
            ->where('tasks.flag', '=', Auth::user()->flag)
            ->where('projects.flag', '=', Auth::user()->flag)

            ->join('projects', 'tasks.project_id', '=', 'projects.id')
            ->join('users', 'tasks.user_assigned_id', '=', 'users.id')
            ->select('statuses.title as jo', 'projects.title as pt', 'tasks.project_id', 'tasks.id', 'tasks.title as tt', 'users.name as ui', 'tasks.created_at', 'tasks.status_id', 'tasks.updated_at', 'tasks.created_at', DB::raw('TIMESTAMPDIFF(HOUR, tasks.created_at, tasks.updated_at) AS timediff'))
            ->where('projects.deleted_at', '=', null)

            // ->select(DATEDIFF)

            ->where(function ($query) use ($request) {
                return $request->price_id ?
                    $query->from('tasks')->where('tasks.status_id', $request->price_id) : '';
            })
            ->where(function ($query) use ($request) {
                return $request->name_id ?
                    $query->from('users')->where('users.id', $request->name_id) : '';
            })
            ->where(function ($query) use ($request) {
                return $request->from ?
                    $query->from('tasks')->whereBetween('tasks.updated_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59']) : '';
            })
            //->with('prices','colors')
            ->get();

        $price_id = $request->price_id;
        $name_id = $request->name_id;

        // $from = !empty($from) ? date('d-M-Y', strtotime($request->from)) : 0;
        // $to = !empty($to) ? date('d-M-Y', strtotime($to)) : null;

        // $from = date("mm/dd/yyyyH:i:s", strtotime($request->from));
        // $to = $request->to;
        // return $from;
        
        $selected_id = [];
        $selected_id['project_id'] = $request->price_id;
        $selected_id['status_id'] = $request->name_id;
        $selected_id['updated_at'] = $request->from;
        $selected_id['updated_at'] = $request->to;

        $startDate = Carbon::today()->toDateString();
        return view('digitalrepem', compact('product', 'startDate', 'selected_id', 'countries', 'price_id', 'name_id'));
    }

    public function overdue(Request $request)
    {
        $product = DB::table('tasks')
            ->join('projects', 'tasks.project_id', '=', 'projects.id')
            ->where('projects.flag', '=', auth()->user()->flag)
            ->where('projects.deleted_at', '=', null)
            ->where('tasks.deleted_at', '=', null)

            ->where('tasks.flag', '=', auth()->user()->flag)
            ->where(function ($query) use ($request) {
                return $request->from ?
                    $query->from('tasks')->whereBetween('deadline', [$request->from . ' 00:00:00', $request->to . ' 23:59:59']) : '';
            })
            ->select('tasks.*')
            ->get();

        $selected_id = [];
        $selected_id['deadline'] = $request->from;
        $selected_id['deadline'] = $request->to;

        return view('overdue', compact('product', 'selected_id'));
    }
}
