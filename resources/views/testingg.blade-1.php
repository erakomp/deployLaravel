@extends('layouts.master')

@section('content')
<div class="card-shadow" style="background: white;">
    <div class="card-body" style="margin-left:15%; ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <h1 style="margin-top: 3%; text-align:center;">Get Task Duration</h1>
                        <form action="{{ route('filteringg') }}" method="GET" style="margin-top: 10%; ">
                        {{-- <select name="price_id" id="input">
                            <option value="0">Select Division Assigned</option>
                            @foreach ($getDiv as $price)
                                <option value="{{ $price->id }}" {{ $price->id == $selected_id['price_id'] ? 'selected' : '' }}>
                                {{ $price->division }}
                                </option>
                            @endforeach
                        </select> --}}
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label style="font-size: 15px!important;">Choose From:</label>
                                <select name="price_id" id="input">
                                    <option value="0">Select Division Assigned</option>
                                    @foreach ($getDiv as $price)
                                        <option value="{{ $price->id }}" {{ $price->id == $selected_id['price_id'] ? 'selected' : '' }}>
                                        {{ $price->division }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label style="font-size: 15px!important;">Card Status To:</label>
                            <select name="taskie" id="input">
                                <option value="0">Select Status</option>
                               @foreach($getTask as $i)
                                    <option value="{{$i->id}}" {{ $selected_id['taskie'] ? 'selected' : '' }}>
                                   {{$i->title}}
                                    </option>
                                   @endforeach
                                
                            </select>
                        </div>
                    </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label style="font-size: 15px!important;">Card Status To:</label>
                            <select name="color_id" id="input">
                                <option value="0">Select Status</option>
                               
                                    <option value="Done KPI" {{ $selected_id['color_id'] ? 'selected' : '' }}>
                                    Done KPI
                                    </option>
                                    <option value="Progressing" {{  $selected_id['color_id'] ? 'selected' : '' }}>
                                        Progressing
                                        </option>
                                
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label style="font-size: 15px!important;">Card Status From:</label>
                        <select name="color_from" id="input">
                            <option value="0">Select Status</option>
                           
                                <option value="QC" {{ $selected_id['color_from'] ? 'selected' : '' }}>
                                QC
                                </option>
                                <option value="Progressing" {{  $selected_id['color_from'] ? 'selected' : '' }}>
                                    Progressing
                                    </option>
                            
                        </select>
                    </div>
                </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label style="font-size: 15px!important;">Choose From:</label>
                                    <div class="input-group mb-3">
                                        <input id="startDate" type="date" name="from" width="300" value="" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label style="font-size: 15px!important;">Choose To:</label>
                                    <div class="input-group mb-3">
                                        <input id="endDate"  type="date" name="to" width="300"  value=""/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <select name="color_id" id="input">
                            <option value="0">Select Color</option>
                            @foreach ($get_task_id as $color)
                            <option value="{{ $color->id }}" {{ $color->id == $selected_id['color_id'] ? 'selected' : '' }}>
                            {{ $color->title }}
                            </option>
                            @endforeach
                        </select> --}}
                        <div style="display: flex; justify-content:center;">
                            <input type="submit" class="btn btn-danger btn-sm " value="Filter" style="margin-right:20px;">
                            <a href="/filtermenu"><div class="btn btn-warning btn-sm">Reset</div></a>
                        </div>
                       
                        </form>
                    
                    
                        <table class="table table-stripped" style="margin-top:5%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Desc</th>
                                    <th>Task Title</th>
                                    <th>Project Title</th>
                                    <th>Assigned To</th>
                                    <th>Created Date</th>
                                  
                                  @if($color_id!=0)
                                  <th>Duration(D:H:M:S)</th>
                                    @else
                                    <th>Duration(D:H:M:S)</th>
                                    @endif
                                </tr>
                            </thead>
                            
                            <tbody>
                                @forelse($getAct as $product )
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $product->text }}</td>
                                    <td>{{$product->title}}</td>
                                    <td>{{$product->pt}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->created_at}}</td>
                                    <td>@if($selected_id['color_from']==1)
                                        {{(Carbon::parse($product->created_at)) -> diff((Carbon::parse($product->tc))) -> format('%D : %H : %I : %S')}}
                                        @endif
                                    </td>
                                    {{-- <td>{{ $product->text }}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{date('l, Y-m-d H:i:s', strtotime($product->tc)) }}</td>
                                    <td>{{date('l, Y-m-d H:i:s', strtotime($product->updated_at)) }}</td>
                                    @if($color_id!=0)
                                    <td>{{(Carbon::parse($product->created_at)) -> diff((Carbon::parse($product->tc))) -> format('%D : %H : %I : %S')}}</td>
                                    @else
                                    <td>{{(Carbon::parse($product->created_at)) -> diff((Carbon::parse($product->updated_at))) -> format('%D : %H : %I : %S')}}</td>
                                    @endif --}}
                                    {{-- @if( $selected_id['color_id']!=0 && ( $selected_id['color_from']==0))
                                    <td>{{date('l, Y-m-d H:i:s', strtotime($product->updated_at)) }} </td>
                                    <td>{{(Carbon::parse($product->created_at)) -> diff((Carbon::parse($product->tc))) -> format('%D : %H : %I : %S')}} </td>
                                    @elseif( ($selected_id['color_id']==0) && ( $selected_id['color_from']!=0))
                                    <td>{{date('l, Y-m-d H:i:s', strtotime($product->updated_at)) }} </td>
                                    <td>{{(Carbon::parse($product->created_at)) -> diff((Carbon::parse($product->updated_at))) -> format('%D : %H : %I : %S')}} </td>
                                    
                                        
                                    @elseif(($selected_id['color_id']==0) && ( $selected_id['color_from']==0))
                                    <td>{{date('l, Y-m-d H:i:s', strtotime($product->updated_at)) }} </td>    
                                    
                                    @endif --}}
                                       
                                        {{-- @if( $selected_id['price_id']==0) <td>{{date('l, Y-m-d H:i:s', strtotime($product->updated_at)) }} </td> @elseif( $selected_id['color_id']==0 )
                                        <td>{{date('l, Y-m-d H:i:s', strtotime($product->updated_at)) }} </td>
                                        <td>{{(Carbon::parse($product->created_at)) -> diff((Carbon::parse($product->updated_at))) -> format('%D : %H : %I : %S')}} </td>
                                        @else
                                        <td>{{date('l, Y-m-d H:i:s', strtotime($product->updated_at)) }} </td>
                                        <td>{{(Carbon::parse($product->created_at)) -> diff((Carbon::parse($product->tc))) -> format('%D : %H : %I : %S')}} </td>
                                       <td></td> @endif --}}
                                    {{-- <td>
                                        
                                        {{(Carbon\Carbon::parse(min($product->created_at))) -> diff((Carbon\Carbon::parse(max($product->created_at)))) -> format('%D : %H : %I : %S')}}
                                    </td> --}}
                                </tr>
                                @empty
                                <p> No data Found </p>
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