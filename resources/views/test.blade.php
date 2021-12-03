@extends('layouts.master')

@section('content')
<div class="card shadow" style="background-color: white;">
    <div class="card-body">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"></div>
        
                        <form action="{{ route('filter') }}" method="GET" style="margin-top: 5%; margin-bottom:5%; display:flex; justify-content:center;">
                        <select name="price_id" id="input" style="margin-right:2%;"  >
                            <option value="0">Select Task</option>
                            @foreach (DB::table('tasks')
                            ->join('projects', 'tasks.project_id', '=', 'projects.id')
                            ->where('projects.flag', '=', Auth::user()->flag)
                            ->select('tasks.id', 'tasks.title')->where('tasks.deleted_at','=',NULL)->orderBy('id')->get() as $price)
                                <option value="{{ $price->id }}" {{ $price->id == $selected_id['source_id'] ? 'selected' : '' }}>
                                {{ $price->title }}
                                </option>
                            @endforeach
                        </select>
                        <select name="color_id" id="input" style="margin-right:2%;" >
                            <option value="0">Select Status</option>
                            <option value="QC">QC</option>
                            <option value="Done">Done KPI</option>
        
                            {{-- @foreach (DB::table('users')->select('id', 'name')->orderBy('id')->get() as $color)
                            <option value="{{ $color->id }}" {{ $color->id == $selected_id['causer_id'] ? 'selected' : '' }}>
                            {{ $color->name }}
                            </option>
                            @endforeach --}}
                        </select>
                        <input type="submit" class="btn btn-md btn-brand movedown" value="Filter" style="font-size: 16px; ">
                        </form>
                    
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>desc</th>
                                        <th>created date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($product->sortByDesc('id') as $product )
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $product->text }}</td>
                                        
                                        <td>{{date('l, d/m/y H:i:s', strtotime( $product->created_at))}}</td>
            
                                    </tr>
                                    @empty
                                    <p> There is no data to be shown </p>
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
</div>

@endsection