@extends('layouts.master')

@section('content')
<div class="card shadow" style="background: white;">
    <div class="card-body">
        <div class="container" style="padding: 3%;">
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-12 margin-tb">
                    <div class="">
                        <h1 style="text-transform:uppercase; text-align:center; font-weight:bold;">Add List(s)</h1>
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
                    <div class="col-sm-6">
                        <div class="form-group">
                            <strong >List Title:</strong>
                            <input type="text" name="title" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6" style="display: none;">
                        <div class="form-group">
                            <strong>Type:</strong>
                            <select name="source_type" id="">
                            <option value="App\Models\Task">For Task(s)</option>    
                            </select>                
                    </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <strong>Color:</strong>
                            <input type="color" name="color" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-12 text-center">
                        <button onclick="history.back()" class="btn btn-md btn-brand movedown" style="font-size:14px;">Back</button>

                        <button type="submit" class="btn btn-md btn-brand movedown" style="font-size:14px;">Add List</button>
                    </div>
                </div>
        
            </form>
        </div>
    </div>
</div>
    
@endsection
