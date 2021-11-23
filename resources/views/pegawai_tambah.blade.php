@extends('layouts.master')
@section('content')
<div class="card shadow" style="background-color:white;">
    <div class="card-body" style="padding:2%;">
        <div class="container">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h1><strong>ADD LABEL</strong></h1>
                </div>
                <div class="card-body">
                    
                    <br/>
                    <br/>
                    
                    <form method="post" action="/pegawai/store">
 
                        {{ csrf_field() }}
 <div class="row">
    <div class="col-sm-6">

        <div class="form-group">
            <label style="font-size:18px;"><strong>Tag Title</strong></label>
            <input type="text" name="nama" class="form-control" placeholder="Title">

            @if($errors->has('nama'))
                <div class="text-danger">
                    {{ $errors->first('nama')}}
                </div>
            @endif

        </div>

    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label style="font-size:18px;"><strong>Color</strong></label>
            <input name="alamat" type="color" class="form-control" >

             @if($errors->has('alamat'))
                <div class="text-danger">
                    {{ $errors->first('alamat')}}
                </div>
            @endif

        </div>

    </div>
 </div>
                        
                        <div class="form-group" style="display:flex; justify-content:center; margin-top:2%;">
                            <a href="/pegawai" class="btn btn-md btn-brand movedown" style="margin-right:5px; font-size:16px;">Kembali</a>
                            <input type="submit" class="btn btn-md btn-brand movedown" style="font-size:16px;" value="Simpan">
                        </div>
 
                    </form>
 
                </div>
            </div>
        </div>
    </div>
</div>
        
@endsection