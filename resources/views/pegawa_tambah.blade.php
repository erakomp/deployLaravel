@extends('layouts.master')
@section('content')
        <div class="container">
            <div class="card mt-5" style="background: white;">
               <div class="container">
                <div class="card-body" style="padding:2%;">
                    
                    <br/>
                    <br/>
                    
                    <form method="post" action="/pegawa/store">
 
                        {{ csrf_field() }}
 
                        <div class="form-group">
                            <label>Nama</label>
                            <select name="user_id" id="">
                                @foreach($user as $i)
                                <option value="{{$i->id}}">{{$i->name}}</option>
                                @endforeach
                            </select>
                            
 
                            @if($errors->has('user_id'))
                                <div class="text-danger">
                                    {{ $errors->first('user_id')}}
                                </div>
                            @endif
 
                        </div>
 
                        <div class="form-group">
                            <label>Alamat</label>
                           
                            <select name="role_id" id="">
                                @foreach($role as $i)
                                <option value="{{$i->id}}">{{$i->display_name}}</option>
                                @endforeach
                            </select>
 
                             @if($errors->has('role_id'))
                                <div class="text-danger">
                                    {{ $errors->first('role_id')}}
                                </div>
                            @endif
 
                        </div>
 
                        <div class="form-group">
                            <a href="/pegawa" class="btn btn-primary">Back</a>
                            <input type="submit" class="btn btn-success" value="Submit">
                        </div>
 
                    </form>
 
                </div>
               </div>
                
            </div>
        </div>
    @endsection