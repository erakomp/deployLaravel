@extends('layouts.master')

@section('content')
<div class="card shadow" style="background-color:white;">
    <div class="card-body" style="padding:5%;">
        <div class="container">
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-12 margin-tb">
                    <div class="text-center">
                        <h3 style="text-align:center; font-weight:bold;">CARD LIST(S)</h3>
                        <a class="btn btn-brand movedown" href="{{ route('colors.create') }}">Add New List</a>

                    </div>
                   
                </div>
            </div>
        
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
        
            <table class="table table-bordered">
                <tr style="text-align: center;">
                    {{-- <th>No</th> --}}
                    <th style="text-align: center;">List Title</th>
                    {{-- <th style="text-align: center;">Source Type</th> --}}
                    <th style="text-align: center;">Color</th>
                    <th style="text-align: center;" width="280px">Actions</th>
                </tr>
                @foreach ($products as $product)
                    <tr style="text-align: center;">
                      <td>{{ $product->title }}</td>
                        {{-- <td>{{ $product->source_type }}</td> --}}
                        <td style=""><div class ="btn" style=" pointer-events:none;background-color:{{$product->color}}; border-radius:50px; width:100px; height:20px;"></div> </td>
                        <td>
                            <form action="{{ route('colors.destroy',$product->id) }}" method="POST">
        
                                {{-- <a class="btn btn-info" href="{{ route('colors.show',$product->id) }}">Show</a>
        
                                <a class="btn btn-primary" href="{{ route('colors.edit',$product->id) }}">Edit</a> --}}
        
                                @csrf
                                @method('DELETE')
        
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        
            {{-- {!! $products->links() !!} --}}
        </div>
    </div>
</div>
   

@endsection
