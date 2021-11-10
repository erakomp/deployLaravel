@extends('layouts.master')
 
@section('content')
<div class="container">
    <div class="row">
        <div class="text-center">
            <h1 style="font-size:28px;"><strong>Roles Lists</strong></h1>
        </div>
        <div class="col-lg-12 margin-tb">
            
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('roless.create') }}" style="margin-bottom:15%;">Register Roles</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>Username</th>
            <th>Roles</th>
           
        </tr>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->un }}</td>
            <td>{{ $product->rn }}</td>
            
        </tr>
        @endforeach
    </table>
  
</div>
    
      
@endsection