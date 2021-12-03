@extends('layouts.masterr')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
@section('content')
<div class="card shadow" style="background-color: white;">
    <div class="card-body">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"></div>
        
                        <form action="{{ route('filter') }}" method="GET" style="margin-top: 5%; margin-bottom:5%; display:flex; justify-content:center;">
                            <div class="m-5 w-50">
                                <div class="mb-3">
                                    <select class="form-select form-select-lg mb-3" id="country">
                                        <option selected disabled>Select Project</option>
                                        @foreach (DB::table('projects')
                                        ->where('flag', '=', Auth::user()->flag)
                                        ->select('id', 'title')->orderBy('id')->get() as $country)
                                        <option value="{{ $country->id }}">{{ $country->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <select class="form-select form-select-lg mb-3" id="state" name="price_id" ></select>
                                </div>
                               
                            </div>
                        {{-- <select name="price_id" id="input" style="margin-right:2%;"  >
                            <option value="0">Select Task</option>
                            @foreach (DB::table('tasks')
                            ->join('projects', 'tasks.project_id', '=', 'projects.id')
                            ->where('projects.flag', '=', Auth::user()->flag)
                            ->select('tasks.id', 'tasks.title')->where('tasks.deleted_at','=',NULL)->orderBy('id')->get() as $price)
                                <option value="{{ $price->id }}" {{ $price->id == $selected_id['source_id'] ? 'selected' : '' }}>
                                {{ $price->title }}
                                </option>
                            @endforeach
                        </select> --}}
                        <select name="color_id" id="input" style="margin-right:2%;" >
                            <option value="0">Select Status</option>
                            <option value="QC">QC</option>
                            <option value="Done">Done KPI</option>
        
                            {{-- @foreach (DB::table('users')->select('id', 'name')->orderBy('id')->get() as $color)
                            <option value="{{ $color->id }}" {{ $color->id == $selected_id['causer_id'] ? 'selected' : '' }}>
                            {{ $color->name }}
                            </option>
                            @endforeach --}}
                        </select>
                        <input type="date" name="from" id="input" style="margin-right:2%;" value="{{Carbon\Carbon::today()->toDateString()}}">
                        <input type="date" name="to" id="input" style="margin-right:2%;" value="{{Carbon\Carbon::today()->toDateString()}}">
        
                        <input type="submit" class="btn btn-md btn-brand movedown" value="Filter" style="font-size: 16px; ">
                        </form>
                    
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>desc</th>
                                        <th>created date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($product->sortByDesc('id') as $product )
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $product->text }}</td>
                                        
                                        <td>{{date('l, d/m/y H:i:s', strtotime( $product->created_at))}}</td>
            
                                    </tr>
                                    @empty
                                    <p> There is no data to be shown </p>
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
@endsection