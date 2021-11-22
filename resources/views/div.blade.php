@extends('layouts.master')
@section('content')
    <body>
        <div class="container">
            <div class="card mt-5 shadow" style="background: white;">
               <div class="container">
                <div class="card-body" style="padding:5%; margin-left:-2%;">
                    <h1 style="text-align: center;">DIVISION LIST <a href="/div/tambah" class="btn btn-success" style="margin-left:2%;" ><i class="fas fa-plus"></i></a></h1>
                    
                    <br/>
                    <br/>
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Division</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($div as $p)
                            <tr>
                                <td>{{ $p->division }}</td>
                                <td>{{ $p->description }}</td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
               </div>
             
            </div>
        </div>
  @endsection