@extends('layouts.master')

@section('content')
<div class="card shadow" style="background-color: white;">
    <div class="card-body">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" style="margin-top:5%; margin-bottom:3%; font-size:40px; text-align:center;"><strong>OVERDUE TASKS</strong></div>
        
                        <form action="{{ route('filtering') }}" method="GET" style="margin-top: 20px; text-align:center;">
                        <input type="datetime-local" name="from" id="input" value="{{Carbon\Carbon::now()->toDatetimelocalString()}}" style="margin-right:2%;">
                        <input type="datetime-local" name="to" id="input" value="{{Carbon\Carbon::now()->toDatetimelocalString()}}" style="margin-right:2%;">
        
                        <input type="submit" class="btn btn-sm btn-brand movedown" value="Filter" style="margin-top:-0.2%; font-size:16px;">
                        </form>
                    
                    
                        <table class="table table-stripped" style="padding:5%!important;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Task Title</th>
                                    <th>Deadline</th>
        
                                </tr>
                            </thead>
                            <tbody>
                                
                                @forelse($product->where('deleted_at', '=', NULL)->sortByDesc('id') as $product )
                                <tr>
                                    @if($product->deadline < Carbon::today()->toDateString())

                                    <td style="color:red;"><strong>{{ $loop->index+1 }}</strong></td>
                                    <td style="color:red;"><a href="/tasks/{{$product->external_id}}" style="color:red;"><strong>{{ $product->title }}</strong></a></td>
                                    
                                    
                                    <td style="color:red;"><strong>{{date('l, d/m/y H:i:s', strtotime($product->deadline))}}</strong></td>
                                    @else
                                    <td>{{ $loop->index+1 }}</td>
                                    <td><a href="/tasks/{{$product->external_id}}" style="color:black;">{{ $product->title }}</a></td>
                                    
                                    <td >{{date('l, d/m/y H:i:s', strtotime($product->deadline))}}</td>
                                    
                                    @endif
                                </tr>
                                @empty
                                <p>There is no data for this actual date </p>
                                @endforelse
        
                            </tbody>
                        </table>
                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection