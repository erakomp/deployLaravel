@extends('layouts.master')

@section('content')
<div class="card shadows" style="background-color:white!important;">
    <div class="card-body" style="padding:5%;">
        <div class="container">
            <div class="row justify-content-center">
                    <div class="card" >
        
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                          
                        </div>
                        <div class="card-body text-center" >
                            
                            <h1 style="margin-bottom:5%;">
                                @if(Auth::user()->image != NULL)
                                <img src="/storage/images/{{Auth::user()->image}} " alt="" class="img-thumbnail" style="max-width: 200px!important;" >
                                
                                    
                                @else
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/Picture_icon_BLACK.svg/1156px-Picture_icon_BLACK.svg.png" alt="" srcset="" style="max-width: 200px!important;"s>
                                @endif Hello <strong>{{Auth::user()->name}}</strong>, <br>Welcome to your dashboard</h1>
                           

                            <form action="{{route('avatar.upload')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row" style="display:flex!important; justify-content:center!important;">
                                    <div class="col-sm-6" style="display:flex!important; justify-content:center!important;">
                                        <input  type="file" name="imageAvatar" accept="img/*">
                                        
                                           
                                    </div>
                                    
                                    <div class="col-sm-6" style="display:flex!important; justify-content:center!important;">
                                        <input type="submit" value="Upload" >

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection