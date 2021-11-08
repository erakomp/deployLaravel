
@extends('layouts.master')

<style>
    @media (min-weight:1200px){
        div.container{
            width: 800px!important;
        }

    }

</style>
@section('content')
<div class="container" >
    <div class="card shadow" style="background-color:white;" >
        <div class="container"style="">
            <div class="card-header">
                <p style="text-align: center;  margin-top:5%;font-size:30px; font-weight:bold;">GET THE REPORT</p>
            </div>
                <div class="card-body" style="display: flex;
                justify-content: center; margin-top:3%;
                align-items: center; font-size:15px;">
                    <form method="get" action="{{ route('exportExcel2', 'xls') }}">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label style="font-size: 15px!important;">Choose From:</label>
                                    <div class="input-group mb-3">
                                        <input id="startDate" type="date" name="startDate" width="300" value="{{Carbon\Carbon::today()->toDateString()}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label style="font-size: 15px!important;">Choose To:</label>
                                    <div class="input-group mb-3">
                                        <input id="endDate"  type="date" name="endDate" width="300"  value="{{Carbon\Carbon::today()->toDateString()}}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top:3%;margin-bottom:10%;">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label style="font-size: 15px!important;">OR Card Status: </label>
                                    <select id="status" name="status">
                                        <option value="0">Select All</option>

                                        <option value="1">Resources</option>
                                        <option value="2">To Do List / Back Log</option>
                                        <option value="3">On Hold</option>
                                        <option value="4">Progressing</option>
                                        <option value="5">QC</option>
                                        <option value="6">Error / Must Be Fixed</option>
                                        <option value="7">Done KPI</option>
                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="input-group ">
                                        <button type="submit" class="btn btn-primary" style="border-radius:50px; margin-top:10px; font-size:15px!important;">Get The Report</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                            
                        </div>
                        
                     
                        
                     
                        
                     
                    </form>
                
            </div>
        </div>
        
    </div>
        
         
    
</div>




@endsection