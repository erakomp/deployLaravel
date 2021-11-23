@extends('layouts.master')
 
@section('content')
<div class="card shadow" style="background-color: white;">
    <div class="card-body">
        <div class="container">
            <div class="row">
                <div class="text-center">
                    <h1 style="font-size:28px;"><strong>USERS LIST</strong></h1>
                </div>
                <div class="col-lg-12 margin-tb">
                    
                    <div class="pull-right">
                        <a class="btn btn-success" href="{{ route('productss.create') }}" style="margin-bottom:15%;"> <i class="fas fa-user-plus"></i></a>
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
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                   
                </tr>
                @foreach ($products as $product)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->email }}</td>
                    <!--<td>
                        <form action="{{ route('products.destroy',$product->id) }}" method="POST">
           
                            <a class="btn btn-info" href="{{ route('productss.show',$product->id) }}">Show</a>
            
                            <a class="btn btn-primary" href="{{ route('productss.edit',$product->id) }}">Edit</a>
           
                            @csrf
                            @method('DELETE')
              
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>-->
                </tr>
                @endforeach
            </table>
          
        </div>
    </div>
</div>

    
      
@endsection