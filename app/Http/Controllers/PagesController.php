<?php
namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Client;
use App\Models\Lead;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DB;
use Auth;

class PagesController extends Controller
{
    /**
     * Dashobard view
     * @return mixed
     */
    public function dashboard()
    {
        $getUser = DB::table('users')->get();
        $getProjects = DB::table('projects')->count();
        $getTasks = DB::table('tasks')->count();
   
        $today = today();
        $startDate = today()->subdays(14);
        $period = CarbonPeriod::create($startDate, $today);
        $datasheet = [];

        // Iterate over the period
        foreach ($period as $date) {
            $datasheet[$date->format(carbonDate())] = [];
            $datasheet[$date->format(carbonDate())]["monthly"] = [];
            $datasheet[$date->format(carbonDate())]["monthly"]["tasks"] = 0;
            $datasheet[$date->format(carbonDate())]["monthly"]["leads"] = 0;
        }

        $tasks = Task::whereBetween('created_at', [$startDate, now()])->get();
        $leads = Lead::whereBetween('created_at', [$startDate, now()])->get();
        foreach ($tasks as $task) {
            $datasheet[$task->created_at->format(carbonDate())]["monthly"]["tasks"]++;
        }

        foreach ($leads as $lead) {
            $datasheet[$lead->created_at->format(carbonDate())]["monthly"]["leads"]++;
        }
        if (!auth()->user()->can('absence-view')) {
            $absences = [];
        } else {
            $absences = Absence::with('user')->groupBy('user_id')->where('start_at', '>=', today())->orWhere('end_at', '>', today())->get();
        }

        return view('pages.dashboard', compact('getTasks', 'getProjects'))
            ->withUsers(User::with(['department'])->get())
            ->withDatasheet($datasheet)
            ->withTotalTasks(DB::table('tasks')
            ->join('projects', 'tasks.project_id', '=', 'projects.id')
            ->where('projects.flag', '=', Auth::user()->flag)
            ->count())
            ->withTotalLeads(Lead::count())
            ->withTotalProjects(Project::where('projects.flag','=', Auth::user()->flag)->count())
            ->withTotalClients(Client::count())
            ->withSettings(Setting::first())
            ->withAbsencesToday($absences);
    }
}
