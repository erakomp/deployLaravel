@extends('layouts.masterr')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
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

                        <form action="{{ route('according_created') }}" method="GET" onchange="postdata(this.value)"
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

                            <a href="{{ route('filterrepem') }}" class="btn btn-md btn-brand movedown"
                                style="font-size: 16px; margin-left:2%; margin-right:2%;">By Updated</a>

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

<script type="text/javascript">
    $(document).ready(function () {
        $('#country').on('change', function () {
            var countryId = this.value;
            $('#state').html('');
            $.ajax({
                url: '{{ route('getStates') }}?country_id='+countryId,
                type: 'get',
                success: function (res) {
                    $('#state').html('<option value="">Select Task</option>');
                    $.each(res, function (key, value) {
                        $('#state').append('<option value="' + value
                            .id + '">' + value.title + '</option>');
                    });
                    $('#city').html('<option value="">Select City</option>');
                }
            });
        });
        
    });
</script>

<script>
    function tgl(event){
        const waktu =  document.getElementsByClassName("waktu");
        const awal = waktu[0]
        const akhir = waktu[1]
        var date = new Date($(awal).val());
        var date2 = new Date($(akhir).val());
        var day1 = date.getDate();
        var month1 = date.getMonth() + 1;
        var year1 = date.getFullYear();
        var day2 = date2.getDate();
        var month2 = date2.getMonth() + 1;
        var year2 = date2.getFullYear();
        dAwal = [day1, month1, year1].join('/')
        dAkhir = [day2, month2, year2].join('/')
        if(dAwal > dAkhir){
            event.preventDefault();
            alert("Date input getting wrong!");
        }
    }
</script>

<script>
    function formatDate(date) {
        var hours = date.getHours();
        var minutes = date.getMinutes();
        var ampm = hours >= 12 ? 'pm' : 'am';
        hours = hours % 12;
        hours = hours ? hours : 12;
        minutes = minutes < 10 ? '0'+minutes : minutes;
        var year = date.getFullYear();
        var month = date.getMonth();
        month = month < 10 ? '0'+month : month;
        var date = date.getDate();
        date = date < 10 ? '0' + date : date;
        hours = hours < 10  ? '0' + hours : hours;
        minutes = minutes < 10  ? '0' + minutes : minutes;
        var strTime = date + '/' + month + '/' + year + ' ' + hours + ':' + minutes + ' ' + ampm;
        return strTime;
    }
    console.log(formatDate(new Date));
</script>

@endsection