@extends('layouts.master')

@section('content')
<div class="card shadow" style="background-color: white;">
    <div class="card-body">
        <div class="container" style="padding:3%;">
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-12 margin-tb">
                    <div class="">
                        <h1 style="text-align: center; text-transform:uppercase; font-weight:bold;">Users</h1 style="text-align: center;">
                    </div>
                    <div class="" style="display: flex; justify-content:center;">
                        {{-- <a class="btn btn-md btn-brand movedown" href="{{ route('usercrud.create') }}">Add New User</a> --}}
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
                    {{-- <th style="text-align: center;">Np.</th> --}}
                    <th>No.</th>
                    <th style="text-align: center;">Name</th>
                    {{-- <th style="text-align: center;">Source Type</th> --}}
                    <th style="text-align: center;">Email</th>
                    <th style="text-align: center;" width="280px">Actions</th>
                </tr>
                @foreach ($products as $index=>$product)
                    <tr style="text-align: center;">
                        {{-- <td>{{ $product->id }}</td> --}}
                        <td>{{$index+1}}</td>
                        <td>{{ $product->name }}</td>
                        {{-- <td>{{ $product->source_type }}</td> --}}
                        <td>{{ $product->email }}</td>
                        <td>
                            <form action="{{ route('usercrud.destroy',$product->id) }}" method="POST">
        
                                {{-- <a class="btn btn-info" href="{{ route('userscrud.show',$product->id) }}">Show</a> --}}
        
                                <a class="btn btn-warning" href="{{ route('usercrud.edit',$product->id) }}"><i class="fas fa-edit"></i></a>
        
                                @csrf
                                @method('DELETE')
        
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>


    {{-- {!! $products->links() !!} --}}

@endsection
