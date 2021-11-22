@extends('layouts.master')
@section('content')
        <div class="container">
            <div class="card mt-5" style="background: white;">
               <div class="container">
                <div class="card-body" style="padding:2%;">
                    
                    <br/>
                    <br/>
                    
                    <form method="post" action="/div/store">
 
                        {{ csrf_field() }}
 
                        <div class="form-group">
                            <label>Division</label>
                            <input type="text" name="division" class="form-control" placeholder="Division">
                            
 
                            @if($errors->has('user_id'))
                                <div class="text-danger">
                                    {{ $errors->first('user_id')}}
                                </div>
                            @endif
 
                        </div>
 
                        <div class="form-group">
                            <label>Description</label>
                           
                            <input type="text" name="description" class="form-control" placeholder="Description">
                            
 
                             @if($errors->has('role_id'))
                                <div class="text-danger">
                                    {{ $errors->first('role_id')}}
                                </div>
                            @endif
 
                        </div>
 
                        <div class="form-group">
                            <a href="/div" class="btn btn-primary">Back</a>
                            <input type="submit" class="btn btn-success" value="Submit">
                        </div>
 
                    </form>
 
                </div>
               </div>
                
            </div>
        </div>
    @endsection