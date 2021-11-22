
@extends('layouts.app')
@section('content')
    <!-- Main Section -->
    <div class="container" >
        <div class="row">
            <div class="col-md-5 col-md-offset-4">
                <div class="tablet" style="margin-top:-25%!important; background-color:rgba(255, 255, 255, 0.685);">
                    <h1 class="text-center" style="font-size:50px; font-family: 'Fredericka the Great', cursive!important;">Era Project Management</h1>

                    <form action="{{ url('/registerPost') }}" method="post" style="margin-top:10%;">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="alamat">Full Name:</label>
                            <input type="text"  class="form-control" id="name" name="name" >
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Password:</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        
                        <div class="form-group">
                            <label for="flag">Division:</label>
                            <select name="flag" id="flag">
                                @foreach($getDiv as $i)
                                <option value="{{$i->id}}">{{$i->division}}</option>
                                @endforeach
                            </select>
 
                        </div>
                        
                      <div class="row">
                        
                        <div class="form-group" style="margin-bottom:10%;">
                            <div class="col-md-12">
                            
                                <button type="submit" class="btn btn-success btn-lg btn-block" style="border-radius: 2px; box-shadow: 0px 2px 4px rgba(0,0,0,0.18);   background: #536be2; border: none;">
                                    <i class="fa fa-btn fa-sign-in"></i>Sign Up
                                </button>
                            </div>
                            <div class="col-md-6 col-md-offset-2" style="padding-left: 60px;">
                                <a class="btn btn-link" href="{{ url('/login') }}" style="color:#333; margin-top:8px;">Already have account?</a>
                            </div>
                        </div>
                      </div>
                        
                    </form>
                    </div>
            </div>
        </div>
    </div>
@endsection