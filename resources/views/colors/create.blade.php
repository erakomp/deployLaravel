@extends('layouts.master')

@section('content')
<div class="card shadow" style="background: white;">
    <div class="card-body" style="padding:5%;">
        <div class="container">
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h3>Add List(s)</h3>
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
        
            <form action="{{ route('colors.store') }}" method="POST">
                @csrf
        
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>List Title:</strong>
                            <input type="text" name="title" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12" style="display: none;">
                        <div class="form-group">
                            <strong>Type:</strong>
                            <select name="source_type" id="">
                            <option value="App\Models\Task">For Task(s)</option>    
                            </select>                
                    </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Color:</strong>
                            <input type="color" name="color" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-brand movedown">Add List</button>
                    </div>
                </div>
        
            </form>
        </div>
    </div>
</div>
   
@endsection
