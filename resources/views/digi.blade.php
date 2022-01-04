@extends('layouts.master')
@section('content')
<div class="container">
    <div class="card shadow" style="background:white;">
        <div class="container" style="padding:5%; margin-right:10%;">
            <a href="{{URL::previous()}}"><div class="btn btn-primary">Back</div></a>
           <!-- <a href="{{URL::previous()}}"><div class="btn btn-primary">Print</div></a>-->

            <div class="card-header">
                <p class="text-center" style="font-size:25px; font-weight:800;">DIGITAL REPORT RESULT</p>
            </div>
            <p class="text-center">from <strong>{{date('l, d-m-Y  00:00:00', strtotime($startDate))}}</strong> until <strong>{{date('l, d-m-Y 23:59:59', strtotime($endDate))}}</strong> with status <strong>
              @if($status == 0) All Categories
            @elseif($status == '1') Resources
            @elseif($status == '2') To Do List / Backlog
            @elseif($status == '3') On Hold
            @elseif($status == '4') Progressing
            @elseif($status == '5') QC
            @elseif($status == '6') Error / Must Be Fixed
            @elseif($status == '7') Done KPI
          @endif</strong></p>
            <div class="card-body">
                <table class="table table-responsive">
                    <thead>
                      <tr>
                        <th scope="col">No.</th>

                        <th scope="col">Task Title</th>
                        <th scope="col">Project Title</th>
                        <th scope="col">Assigned To</th>
                        <th scope="col">Created Date</th>
                        <th scope="col">Updated Date</th>
                        <th scope="col">Duration (in Day(s):Hour(s):Minute(s):Second(s))</th>
                        <th scope="col">Current Status</th>
                
                
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($getTaskReport->where('deleted_at', '=',NULL) as $k=>$i)
                      <tr>
                        <td>{{$k+1}}</td>
                        <td>{{$i->task_title}}</td>
                        <td>{{$i->project_title}}</td>
                        <td>{{$i->username}}</td>
                        <td>{{date('l, d-m-Y H:i:s', strtotime($i->task_created_at))}}</td>
                        <td>{{date('l, d-m-Y H:i:s', strtotime($i->task_update_at))}}</td>
                        <td>{{(Carbon::parse($i->task_created_at)) -> diff((Carbon::parse($i->task_update_at))) -> format('%D : %H : %I : %S')}}</td>
                        <td>{{$i->status_title}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
      
    </div>
   
</div>

  @endsection