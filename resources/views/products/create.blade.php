@extends('layouts.master')
  
@section('content')
<div class="card shadow" style="background-color:white; padding:2%;">
    <div class="card-body">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="text-align-center">
                        <h2><strong>ADD NEW USER</strong></h2>
                    </div>
                    <div class="pull-right">
                        
                    </div>
                </div>
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
            
                <form action="{{ route('productss.store') }}" method="POST">
                    @csrf
                  
                     <div class="row" >
                        <div class="col-sm-4" style="margin-bottom:2%; margin-top:2%;">
                            <div class="form-group">
                                <strong>Name:</strong>
                                <input type="text" name="name" class="form-control" placeholder="Example: John Doe">
                            </div>
                        </div>
                        <div class="col-sm-4" style="margin-bottom:2%; margin-top:2%;">
                            <div class="form-group">
                                <strong>Email:</strong>
                                <input type="text" name="email" class="form-control" placeholder="Example: john@doe.com">
                            </div>
                        </div>
                
                        <div class="col-sm-4" style="margin-bottom:2%; margin-top:2%;">
                            <div class="form-group">
                                <strong>Password:</strong>
                                <input type="password" name="password" class="form-control" >
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <a class="btn btn-md btn-brand movedown" style="font-size: 14px; margin-right:5px;" href="{{ route('productss.index') }}"> Back</a>
                                <button type="submit" class="btn btn-md btn-brand movedown" style="font-size: 14px; margin-right:5px;">Submit</button>
                        </div>
                    </div>
                   
                </form>
               </div>
    </div>
</div>


@endsection