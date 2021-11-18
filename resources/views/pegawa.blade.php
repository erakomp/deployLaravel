@extends('layouts.master')
@section('content')
    <body>
        <div class="container">
            <div class="card mt-5">
               
                <div class="card-body">
                    <a href="/pegawa/tambah" class="btn btn-primary">Input Pegawa Baru</a>
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
  @endsection