@extends('layouts.masterr')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="{{ asset('js/help.js') }}"></script>
@section('content')
<div class="card shadow" style="background-color: white;">
    <div class="card-body">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <h1 style="text-align: center;">Digital Report</h1>
                        </div>

                        <form action="{{ route('filterrepem') }}" method="GET" onchange="postdata(this.value)"
                            style="margin-top: 5%; display:flex; justify-content:center;">

                            <select name="price_id" id="input" style="margin-right:2%;">
                                <option value="0">Select Status</option>
                                @foreach (DB::table('statuses')
                                ->select('id', 'title')->orderBy('id')->get() as $country)
                                <option value="{{ $country->id }}" @if($country->id == $price_id) selected @endif>
                                    {{ $country->title }} </option>
                                @endforeach
                            </select>

                            <input type="date" name="from" id="input" class="waktu"
                                value="{{Carbon\Carbon::now()->toDatetimelocalString()}}" style="margin-right:2%;">

                            <input type="date" name="to" id="input" class="waktu"
                                value="{{Carbon\Carbon::now()->toDatetimelocalString()}}" style="margin-right:2%;">

                            <input onclick="tgl(event)" type="submit" class="btn btn-md btn-brand movedown"
                                value="Filter" style="font-size: 16px;">

                            <a class="btn btn-md btn-brand movedown"
                                style="font-size: 16px; margin-left:2%; margin-right:2%;">By Created</a>

                            <a href="/digitalrepem" class="btn btn-md btn-brand movedown" value="Reset"
                                style="font-size: 16px;">Reset</a>
                        </form>

                        <div class="table-responsive">
                            <table class="table" style="margin-left:5%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Status</th>
                                        <th>Title</th>
                                        <th>Project Title</th>
                                        <th>Assigned To</th>
                                        <th>Created Date</th>
                                        <th>Updated Date</th>
                                        <th>Duration(D:H:M:S)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($product->sortByDesc('id') as $product )
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{$product->jo}}</td>
                                        <td><a href="/tasks/{{$product->id}}">{{ $product->tt }}</a></td>
                                        <td>{{$product->pt}}</td>
                                        <td>{{$product->ui}}</td>
                                        <td>{{date('l, d/m/y H:i:s', strtotime( $product->created_at))}}</td>
                                        <td>{{date('l, d/m/y H:i:s', strtotime( $product->updated_at))}}</td>
                                        <td>{{(Carbon::parse($product->created_at)) ->
                                            diff((Carbon::parse($product->updated_at))) -> format('%D : %H : %I : %S')}}
                                        </td>
                                    </tr>
                                    @empty
                                    <p> There is no data to be shown</p>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection