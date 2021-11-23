@extends('layouts.master')
@section('content')
<div class="card shadow" style="background-color: white; padding:5%;">
    <div class="container">
        <div class="card-body">
           <h1>Hi, {{Auth::user()->name}} </h1> 
           <small>{{Auth::user()->email}}</small>
           
        </div>
    </div>
</div>
@endsection
