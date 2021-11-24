@extends('layouts.master')

@section('content')
<div class="card shadow" style="background-color: white; padding:5%;">
    <div class="card-body">
        <div class="container">
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-12 margin-tb">
                    <div class="">
                        <h1 style="text-align:center"><strong>Labels List</strong> <a class="btn btn-md btn-brand"  style="margin-left:10px;" href="{{ route('labels.create') }}">Add label</a></h1>
                        
                    </div>
                    <div class="pull-right">
                        
                    </div>
                </div>
            </div>
        
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
        
            <table class="table table-responsive">
                <tr style="text-align:center">
                    <th style="text-align:center">Title</th>
                    <th style="text-align:center">Color</th>
                    <th width="280px" style="text-align:center">Actions</th>
                </tr>
                @foreach ($labels as $label)
                    <tr style="text-align:center">
                        
                        <td>{{ $label->name }}</td>
                        <td><span class="btn" style="pointer-events:none!important;background-color:{{ $label->price }}; width:80px; border-radius:50px;"></span></td>
                        <td>
                            <form action="{{ route('labels.destroy',$label->id) }}" method="POST">
        
                             <!--  <a class="btn btn-info" href="{{ route('labels.show',$label->id) }}">Show</a>-->
        
                                <a class="btn btn-md btn-brand" href="{{ route('labels.edit',$label->id) }}">Edit</a>
        
                                @csrf
                                @method('DELETE')
        
                                <button type="submit" class="btn btn-md btn-brand">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        
            {!! $labels->links() !!}
        </div>
    </div>
</div>
    

@endsection
