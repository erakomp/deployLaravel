@extends('layouts.master')
@section('content')
    <body>
        <div class="container">
            <div class="card mt-5 shadow" style="background: white;">
               <div class="container">
                <div class="card-body" style="padding:5%; margin-left:-2%;">
                    <h1 style="text-align: center;">ROLE LIST <a href="/pegawa/tambah" class="btn btn-success" style="margin-left:2%;" ><i class="fas fa-plus"></i></a></h1>
                    
                    <br/>
                    <br/>
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>User Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pegawa as $p)
                            <tr>
                                <td>{{ $p->name }}</td>
                                <td>{{ $p->dn }}</td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
               </div>
             
            </div>
        </div>
  @endsection