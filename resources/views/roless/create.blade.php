@extends('layouts.master')
  
@section('content')
<div class="container">
<div class="row">
    
</div>
   
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="card" style="background-color:white!important; padding:5%;">
    <div class="container">
        
        <div class="card-body" style="margin-right:15%;">
            <div class="text-center" style="margin-bottom:3%;">
                <h2><strong>Register Roles</strong></h2>
            </div>
                <form action="{{ route('roless.store') }}" method="POST">
                    @csrf
                  
                     <div class="row text-center">
                         <div class="col-sm-6">
                            <div class="form-group">
                                <strong>Name:</strong>
                                <select name="user_id" id="user_id">
                                    @foreach ($users as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
            
                                    @endforeach
                                    
                                  </select>
                            </div>
                         </div>
                         <div class="col-sm-6">
                            <div class="form-group">
                                <strong>Role:</strong>
                                <select name="role_id" id="role_id">
                                    @foreach ($roles as $item)
                                    <option value="{{$item->id}}">{{$item->display_name}}</option>
            
                                    @endforeach
                                    
                                  </select>
                            </div>
                         </div>
                        <div class="col-xs-12 col-sm-6 col-md-12" style="margin-bottom:1%;">
                            
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-12" style="margin-bottom:1%;">
                           
                        </div>
                        <div class="col-lg-12 margin-tb">
       
                            <div class="pull-left" style="margin-bottom:1%;">
                               
                            </div>
                        </div>
                        
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <a class="btn btn-warning" href="{{ route('roless.index') }}" style="margin-right:1%!important;"> Back</a>
                                <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                   
                </form>
        </div>
    </div>
</div>

   </div>

@endsection