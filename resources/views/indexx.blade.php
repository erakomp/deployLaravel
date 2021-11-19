@extends('layouts.master')

@section('content')
<div class="card" style="background:white; padding:2%;">

    <div class="card-body">
        <div class="container">
            <h1 style="text-align: center; font-weight:800;">USERS PROFILE</h1>
            <br>
            <table class="table table-bordered table-striped">
                <tr>
                 <th width="10%">Image</th>
                 <th width="35%">Users</th>
                </tr>
                @foreach($data as $row)
                 <tr>
                  <td><img src="{{ URL::to('/') }}/images/{{ $row->image }}" class="img-thumbnail" width="75" /></td>
                  <td>{{ $row->name }}</td>
                 </tr>
                @endforeach
               </table>
        </div>
    </div>
</div>

@endsection
