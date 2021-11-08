<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Carbon\Carbon;

use DB;

class ReportExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
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

        ->get();

        $getArray = [];
        $count = 0;
        foreach ($getTaskReport->groupBy('t') as $key=>$i) {
            $min = Carbon::parse($i->pluck('created_at')->first());
            $max = Carbon::parse($i->pluck('created_at')->last());
            $diff = $min->diffInSeconds($max);
            $hours = (floor($diff/3600) .'Hours' .floor(($diff%3600)/60). 'Mins' .floor(($diff%86400)/3600) . 'Secs');
            //$getAve = avg($diff);
            array_push($getArray, [

                'task' => $key,
                'hours' => $hours,



            ]);
        }**/
        $startDate = request()->input('startDate') ;
        $endDate   = request()->input('endDate') ;
        $status = request()->input('status');
        if ($status == 0 && $startDate == Carbon::today()->toDateString() && $endDate == Carbon::today()->toDateString()) {
            $getTaskReport =DB::table('tasks')
            ->join('projects', 'tasks.project_id', '=', 'projects.id')
            ->join('users', 'tasks.user_created_id', '=', 'users.id')
            ->join('statuses', 'tasks.status_id', '=', 'statuses.id')
        ->select('tasks.created_at as tc', 'tasks.updated_at as ua', 'tasks.title AS t', 'users.name', 'projects.title AS p', DB::raw('TIMESTAMPDIFF(MINUTE, tasks.created_at, tasks.updated_at) as duration'), 'statuses.title as st')
        ->WhereBetween('tasks.created_at', [ ($startDate = Carbon::today()->toDateString()), ($endDate = Carbon::today()->addDays(1)) ])
        ->orderBy('tasks.created_at', 'ASC')
            ->get();
        }
        if ($status != 0 && $startDate == Carbon::today()->toDateString() && $endDate == Carbon::today()->toDateString()) {
            $getTaskReport =DB::table('tasks')
            ->join('projects', 'tasks.project_id', '=', 'projects.id')
            ->join('users', 'tasks.user_created_id', '=', 'users.id')
            ->join('statuses', 'tasks.status_id', '=', 'statuses.id')
        ->select('tasks.created_at as tc', 'tasks.updated_at as ua', 'tasks.title AS t', 'users.name', 'projects.title AS p', DB::raw('TIMESTAMPDIFF(MINUTE, tasks.created_at, tasks.updated_at) as duration'), 'statuses.title as st')
        ->WhereBetween('tasks.created_at', [ ($startDate = Carbon::today()->toDateString()), ($endDate = Carbon::today()->addDays(1)) ])
        ->Where('tasks.status_id', '=', $status)
        ->orderBy('tasks.created_at', 'ASC')
            ->get();
        }
        if ($status == 0) {
            $getTaskReport =DB::table('tasks')
            ->join('projects', 'tasks.project_id', '=', 'projects.id')
            ->join('users', 'tasks.user_created_id', '=', 'users.id')
            ->join('statuses', 'tasks.status_id', '=', 'statuses.id')
        ->select('tasks.created_at as tc', 'tasks.updated_at as ua', 'tasks.title AS t', 'users.name', 'projects.title AS p', DB::raw('TIMESTAMPDIFF(MINUTE, tasks.created_at, tasks.updated_at) as duration'), 'statuses.title as st')
        ->WhereBetween('tasks.created_at', [ $startDate, $endDate ])
        ->orderBy('tasks.created_at', 'ASC')
            ->get();
        } else {
            $getTaskReport =DB::table('tasks')
        ->join('projects', 'tasks.project_id', '=', 'projects.id')
        ->join('users', 'tasks.user_created_id', '=', 'users.id')
        ->join('statuses', 'tasks.status_id', '=', 'statuses.id')
    ->select('tasks.created_at as tc', 'tasks.updated_at as ua', 'tasks.title AS t', 'users.name', 'projects.title AS p', DB::raw('TIMESTAMPDIFF(MINUTE, tasks.created_at, tasks.updated_at) as duration'), 'statuses.title as st')
    ->Where('tasks.status_id', '=', $status)

    ->WhereBetween('tasks.created_at', [ $startDate, $endDate ])

    ->orderBy('tasks.created_at', 'ASC')
        ->get();
        }
        
        
        return collect($getTaskReport);
    }

    public function headings(): array
    {
        return [
            'Task Title',
            'Project Title',
            'Created By',
            'Created At',
            'Lastest Move',
            'Durations(In Minutes)',
            'Current Card Status'
               
        ];
    }

    public function map($transaction): array
    {
        return [
            $transaction->t,
            $transaction->p,
            $transaction->name,
            $transaction->tc,
            $transaction->ua,
            $transaction->duration,
            $transaction->st,
            
            
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:G1')
                                ->getFont()
                                ->setBold(true)
                                ->setSize(14);
            },
        ];
    }
}
