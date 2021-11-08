@extends('layouts.master')


@section('content')

                <div class="container">
                    <h1>Hey {{Auth::user()->name}}, here is the report for comments</h1>
                    <table class="table ">
                        
                        <tbody>
                            @foreach ($getComm as $item)
    
                          <tr>
                            @if($item->source_type == 'App\Models\Task')
                            <div>
                                <td>{{$item->name}} just commented "{!!$item->desc!!}" on
                                
                                    task "<a href="/tasks/{{$item->ei}}"> {{$item->title}}</a>" 
                                    
                                    on {{$item->created_at}} </td>
                                
                                
                                
                                @else    
                                <td style="display:none;"><a href="">{{$item->title}}</a></td>
                                @endif
                            </div>
                            
                            
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                </div>
                
                   
            
        
         
 



@endsection


    
