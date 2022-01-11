@extends('layouts.master')
@section('content')
<form action="{{ route('filteringg') }}" method="GET" style="margin-top: 10%; ">
    {{-- <select name="price_id" id="input">
        <option value="0">Select Division Assigned</option>
        @foreach ($getDiv as $price)
            <option value="{{ $price->id }}" {{ $price->id == $selected_id['price_id'] ? 'selected' : '' }}>
            {{ $price->division }}
            </option>
        @endforeach
    </select> --}}
    <div class="card shadow" style="background-color: white; padding:5%;">
        <div class="card-header">
            <h1 style="margin-bottom: 3%; text-transform:uppercase; text-align:center; font-weight:bold;">DURATION REPORT PROGRESSING - DONE KPI</h1>
        </div>
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label style="font-size: 15px!important;">Choose Division:</label>
                            <div class="input-group mb-3">
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
                </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label style="font-size: 15px!important;">Choose From:</label>
                            <div class="input-group mb-3">
                                <input id="startDate" type="date" name="from" width="300" value="{{Carbon\Carbon::today()->toDateString()}}" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label style="font-size: 15px!important;">Choose To:</label>
                            <div class="input-group mb-3">
                                <input id="endDate"  type="date" name="to" width="300"  value="{{Carbon\Carbon::today()->toDateString()}}"/>
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
            </div>
        </div>
    </div>
    
    @endsection