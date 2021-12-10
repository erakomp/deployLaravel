@extends('layouts.master')

@section('content')
<div class="card shadow" style="background-color: white;">
    <div class="card-body">
        <div class="container" style="padding:3%;">
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-12 margin-tb">
                    <div class="">
                        <h1 style="text-align: center; text-transform:uppercase;">Lists</h1 style="text-align: center;">
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-success" href="{{ route('colors.create') }}">Add New List</a>
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
                    <th style="text-align: center;">List Title</th>
                    {{-- <th style="text-align: center;">Source Type</th> --}}
                    <th style="text-align: center;">Color</th>
                    <th style="text-align: center;" width="280px">Actions</th>
                </tr>
                @foreach ($products as $product)
                    <tr style="text-align: center;">
                        {{-- <td>{{ $product->id }}</td> --}}
                        <td>{{ $product->title }}</td>
                        {{-- <td>{{ $product->source_type }}</td> --}}
                        <td><div class="btn" style="background-color: {{$product->color}};"></div></td>
                        <td>
                            <form action="{{ route('colors.destroy',$product->id) }}" method="POST">
        
                                {{-- <a class="btn btn-info" href="{{ route('colors.show',$product->id) }}">Show</a> --}}
        
                                <a class="btn btn-warning" href="{{ route('colors.edit',$product->id) }}"><i class="fas fa-edit"></i></a>
        
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
