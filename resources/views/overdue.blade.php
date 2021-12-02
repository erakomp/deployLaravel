@extends('layouts.master')

@section('content')
<div class="card shadow" style="background-color: white;">
    <div class="card-body">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" style="margin-top:5%; margin-bottom:3%; font-size:40px; text-align:center;"><strong>OVERDUE TASKS</strong></div>
        
                        <form action="{{ route('filter') }}" method="GET" style="margin-top: 20px; text-align:center;">
                        <input type="datetime-local" name="price_id" id="input" style="margin-right:2%;">
                        <input type="datetime-local" name="color_id" id="input" style="margin-right:2%;">
        
                        <input type="submit" class="btn btn-sm btn-brand movedown" value="Filter" style="margin-top:-0.2%; font-size:16px;">
                        </form>
                    
                    
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Task Title</th>
                                    <th>Deadline</th>
        
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($product->sortByDesc('id') as $product )
                                <tr>
                                    @if($product->deadline < Carbon::today()->toDateString())

                                    <td style="color:red;"><strong>{{ $loop->index+1 }}</strong></td>
                                    <td style="color:red;"><strong>{{ $product->title }}</strong></td>
                                    <td style="color:red;"><strong>{{ $product->deadline }}</strong></td>
                                    
                                    <td style="color:red;"><strong>{{ $product->deadline }}</strong></td>
                                    @else
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $product->title }}</td>
                                    <td >{{ $product->deadline }}</td>
                                    
                                    <td>{{ $product->deadline }}</td>
                                    @endif
                                </tr>
                                @empty
                                <p> No data Found </p>
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

@endsection