@extends('layouts.master')
    
  @section('content')
        <div class="container">
            <div class="card mt-5" style="background-color:white; padding:5%; margin-left:-10%;">
                <div class="container">
                    <div class="card-header text-center">
                        <h1>Labels
    
                        </h1>
                    </div>
                    <div class="card-body" >
                        <a href="/pegawai/tambah" class="btn btn-primary">Add</a>
                        <br/>
                        <br/>
                        <table class="table table-responsive  table-striped" style="max-width: 100%;">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Color</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pegawai as $p)
                                <tr>
                                    <td>{{ $p->nama }}</td>
                                    <td>{{ $p->alamat }}</td>
                                    <td>
                                       
                                        <a href="/pegawai/hapus/{{ $p->id }}" class="btn btn-danger">Hapus</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
               
            </div>
        </div>
   @endsection