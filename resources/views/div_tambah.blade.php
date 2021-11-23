@extends('layouts.master')
@section('content')
        <div class="container">
            <div class="card mt-5" style="background: white; ">
               <div class="container">
                <div class="card-body" style="padding:5%;">
                    
                    <br/>
                    <br/>
                    
                    <form method="post" action="/div/store">
 
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Division Title</label>
                                    <input type="text" name="division" class="form-control" placeholder="Division Title">
                                    
         
                                    @if($errors->has('user_id'))
                                        <div class="text-danger">
                                            {{ $errors->first('user_id')}}
                                        </div>
                                    @endif
         
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Description</label>
                                   
                                    <input type="text" name="description" class="form-control" placeholder="Description">
                                    
         
                                     @if($errors->has('role_id'))
                                        <div class="text-danger">
                                            {{ $errors->first('role_id')}}
                                        </div>
                                    @endif
         
                                </div>
                            </div>
                        </div>
                        
 
                       
 
                        <div class="form-group" style="display:flex; justify-content:center;">
                            <a href="/div" class="btn btn-md btn-brand movedown" style="font-size:16px; margin-right:5px;">Back</a>
                            <input type="submit" class="btn btn-md btn-brand movedown" style="font-size:16px; margin-right:5px;" value="Submit">
                        </div>
 
                    </form>
 
                </div>
               </div>
                
            </div>
        </div>
    @endsection