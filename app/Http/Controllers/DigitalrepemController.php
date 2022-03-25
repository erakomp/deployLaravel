<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DigitalrepemController extends Controller
{
    public function __construct(){
        $this->middleware(function($request, $next){
            $this->roleGlob = Auth::user();
            $this->countries = DB::table('projects')->get();
            $this->states = DB::table('tasks')->where('project_id', $request->country_id)->get();
            $this->product = DB::table('tasks')
                ->join('statuses', 'tasks.status_id', '=', 'statuses.id')
                ->where('tasks.deleted_at', '=', null)
                ->where('tasks.flag', '=', Auth::user()->flag)
                ->where('projects.flag', '=', Auth::user()->flag)
                ->join('projects', 'tasks.project_id', '=', 'projects.id')
                ->join('users', 'tasks.user_assigned_id', '=', 'users.id')
                ->select('statuses.title as jo', 
                        'projects.title as pt', 
                        'tasks.project_id', 
                        'tasks.id', 
                        'tasks.title as tt', 
                        'users.name as ui', 
                        'tasks.created_at', 
                        'tasks.status_id', 
                        'tasks.updated_at', 
                        'tasks.created_at', 
                        DB::raw('TIMESTAMPDIFF(HOUR, tasks.created_at, tasks.updated_at) AS timediff'))
                ->where('projects.deleted_at', '=', null)
                ->where(function ($query) use ($request) {
                    return $request->price_id ? $query->from('tasks')->where('tasks.status_id', $request->price_id) : '';
                })
                ->where(function ($query) use ($request) {
                    return $request->name_id ? $query->from('users')->where('users.id', $request->name_id) : '';
                })
                ->where(function ($query) use ($request) {
                    return $request->from ? $query->from('tasks')
                    ->whereBetween('tasks.updated_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59']) : '';
                })
                ->get();
            $this->price_id = $request->price_id;
            $this->name_id = $request->name_id;
            $this->startDate = Carbon::today()->toDateString();
            return $next($request);
        });
    }

    public function test(Request $request)
    {
        if (count($this->states) > 0) {
            return response()->json($this->states);
        }

        if($this->roleGlob['flag'] == '4'){
            $product = $this->product;
            $startDate = $this->startDate;
            $countries = $this->countries;
            $price_id = $this->price_id;
            $name_id = $this->name_id;
            return view('digitalrepem', compact('product', 'startDate', 'countries', 'price_id', 'name_id'));
        }elseif($this->roleGlob['flag'] == '1'){
            $this->manager();
        }else{
            $this->superAdmin();
        }

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

    public function superAdmin()
    {
        dd($this->roleGlob['flag']);
    }

    public function manager()
    {
        dd($this->roleGlob['flag']);
    }

    public function employee()
    {
        $product = $this->product;
        $startDate = $this->startDate;
        $countries = $this->countries;
        $price_id = $this->price_id;
        $name_id = $this->name_id;
        return view('digitalrepem', compact('product', 'startDate', 'countries', 'price_id', 'name_id'));
    }

}
