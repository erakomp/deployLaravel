@extends('layouts.master')

@section('content')
<div class="card shadow" style="background-color: white;">
    <div class="card-body">
        <div class="container" style="padding:3%;">
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-12 margin-tb">
                    <div class="">
                        <h1 style="text-align: center; text-transform:uppercase; font-weight:bold;">EDIT PROFILE</h1 style="text-align: center;">
                    </div>
                    
                </div>
            </div>
        
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <h2>Hi, User {{Auth::user()->name}}</h2>You may update your password and email here  <a class="btn btn-warning" href="{{ route('userr.edit',Auth::user()->id) }}"><i class="fas fa-edit"></i></a>
        
        
            {{-- <table class="table table-bordered">
                <tr>
                     <th style="text-align: center;">Np.</th> 
                    <th style="text-align: center;">List Title</th>
                   <th style="text-align: center;">Source Type</th> 
                    <th style="text-align: center;">Color</th>
                    <th style="text-align: center;" width="280px">Actions</th>
                </tr>
                
                    <tr style="text-align: center;">
                        {{-- <td>{{ $product->id }}</td> 
                        <td>{{ Auth::user()->name }}</td>
                        {{-- <td>{{ $product->source_type }}</td> 
                        <td><div class="btn" style="background-color: {{Auth::user()->email}};"></div></td>
                        <td>
                            <form action="{{ route('userr.destroy',Auth::user()->id) }}" method="POST">
        
                                {{-- <a class="btn btn-info" href="{{ route('userr.show',Auth::user()->id) }}">Show</a> 
        
                                <a class="btn btn-warning" href="{{ route('userr.edit',Auth::user()->id) }}"><i class="fas fa-edit"></i></a>
        
                                @csrf
                                @method('DELETE')
        
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
              
            </table> --}}
        </div>
    </div>
</div>


    {{-- {!! $products->links() !!} --}}

@endsection
