@extends('layouts.master')

@section('content')
<div class="card shadow" style="background-color:white; padding:5%;">
    <div class="container">
        <div class="card-body">
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h3>Edit label</h3>
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
        
            <form action="{{ route('labels.update',$label->id) }}" method="POST">
                @csrf
                @method('PUT')
        
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Title:</strong>
                            <input type="text" name="nama" value="{{ $label->nama }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Color:</strong>
                            <input type="color" name="price" value="{{ $label->price }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group" style="display:none!important;">
                            <strong>Detail:</strong>
                            <textarea class="form-control" style="height:150px" name="detail">{{ $label->detail }}</textarea>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-md btn-brand">Update</button>
                    </div>
                </div>
        
            </form>
        </div>
    </div>
</div>
    
@endsection
