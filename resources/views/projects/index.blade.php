@extends('layouts.master')
@section('heading')
    
@stop

@section('content')
<style>
 
</style>
<!--<div class="row">
    @foreach ($getProject as $item)
    <div class="col-lg-3 col-xs-6">
         small box 
        <div class="small-box bg-white">
            <div class="inner" style="min-height: 100px">
                <h3>
                    {{$item->title}}
                </h3>

                <p>{{$item->created_at}}</p>
                
                
            </div>
            <div class="icon">
                <i class="ion ion-ios-book-outline"></i>
            </div>
            <a href="/projects/{{$item->external_id}}" class="small-box-footer">VIEW <i
                        class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    @endforeach
    
</div>-->
<div class="row">
    @foreach ($getProject as $item)
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box " style="border-radius: 20px; background-color:rgba(255, 255, 255, 0.5);">
            <div class="inner" style="min-height: 100px">
                
                <h3 style="color:rgb(63, 63, 63)!important; font-size:25px!important;">
                    {{$item->title}}
                </h3>

                <p style="color:rgb(63, 63, 63)!important; font-size:15px!important;"> {{date('l, d-m-Y H:m:s', strtotime($item->created_at))}}</p>
                <a data-toggle="modal" data-id="{{route('projects.destroy', $item->external_id) }}" data-title="{{$item->title}}'" data-target="#deletion" class="btn btn-link"><i class="fa fa-trash" aria-hidden="true" style="color:rgb(63, 63, 63)!important; font-size:30px!important;"></i>
                </a>
                <a href="{{route("projects.show", $item->external_id)}}" class="btn btn-link"><i
                    class="fa fa-arrow-circle-right" style="color:rgb(63, 63, 63)!important; font-size:30px!important;"></i></a>
            </div>
            <div class="icon">
                <i class="ion ion-ios-book-outline"></i>
            </div>
           
                        
        </div>
    </div>
    @endforeach
    <!--<div class="col-lg-3 col-xs-6">
      small box
        <div class="small-box " style="border-radius: 20px; background-color:rgba(0, 0, 0, 0.349);">
            <div class="inner" style="min-height: 100px">
                
                <a href="/projects/create"><h3 style="color:white!important; font-size:25px!important;">
                    Add New Project
                </h3></a>

                
            </div>
            <div class="icon">
                <i class="ion ion-ios-book-outline"></i>
            </div>
           
                        
        </div>
    </div>
   
</div>-->
    <!--<table class="table table-hover" id="projects-table">
        <thead>
        <tr>

            <th>{{ __('Title') }}</th>
            <th>{{ __('Deadline') }}</th>
            <th>{{ __('Created at') }}</th>
            <th>{{ __('Assigned') }}</th>
            <th>
                <select name="status_id" id="status-task" class="table-status-input">
                    <option value="" disabled>{{ __('Status') }}</option>
                    @foreach($statuses as $status)
                        <option class="table-status-input-option" {{ $status->title == 'Open' ? 'selected' : ''}} value="{{$status->title}}">{{$status->title}}</option>
                    @endforeach
                    <option value="all">@lang('All')</option>
                </select>
            </th>
        </tr>
        </thead>
    </table>-->

      <!-- DELETE MODAL SECTION -->
      <div id="deletion" class="modal fade" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
        <form method="POST" id="deletion-form" >
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@lang('Delete Project ') <span id="deletion-title"></span></h4>
            </div>
            <div class="modal-body">
   
            @method('delete')
            @csrf
            
            <p>
            @lang('When you click the delete button it will delete the project directly').
            </p>
            <label style="font-weight: 300; color:#333; font-size:14px;">
                <input type="checkbox" name="delete_tasks"> Agree 
            </label>
            
            
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">@lang('Cancel')</button>
            <input type="submit" class="btn btn-brand" value="{{__('Delete')}}">
            </div>
            </form>
        </div>
    </div>
</div>
<!-- END OF THE EDIT MODAL SECTION -->
@stop

@push('scripts')
<style type="text/css">
    .table > tbody > tr > td {
        border-top:none !important;
    }
    .table-actions {
       opacity: 0;
    }
    #projects-table tbody tr:hover .table-actions{
      opacity: 1;
    }
    .title-table-tab {
        width:260px;
    }
    .client-table-tab {
        width:220px;
    }
</style>
    <script>
        $(function () {
            var table = $('#projects-table').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: '{!! route('projects.index.data') !!}',
                language: {
                    url: '{{ asset('lang/' . (in_array(\Lang::locale(), ['dk', 'en']) ? \Lang::locale() : 'en') . '/datatable.json') }}'
                },
                drawCallback: function(){
                    var length_select = $(".dataTables_length");
                    var select = $(".dataTables_length").find("select");
                    select.addClass("tablet__select");
                },
                columns: [
                    {data: 'titlelink', name: 'title', class: 'title-table-tab'},
                    {data: 'deadline', name: 'deadline'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'user_assigned_id', name: 'user_assigned_id'},
                    {data: 'status_id', name: 'status.title', orderable: false},
                    {data: 'view', name: 'view', orderable: false, searchable: false, class: 'table-actions'},
                ]
            });
            table.columns(5).search('^' + 'Open' + '$', true, false).draw();
            $('#status-task').change(function () {
                selected = $("#status-task option:selected").val();
                if (selected == "all") {
                    table.columns(5).search('').draw();
                } else {
                    table.columns(5).search(selected ? '^' + selected + '$' : '', true, false).draw();
                }
            });
        });
        $( '#deletion' ).on( 'show.bs.modal', function (e) {
            var target = e.relatedTarget;
            var id = $(target).data('id');
            var title = $(target).data('title');
         
            $("#deletion-title").text(title);
            $('#deletion-form').attr('action', id)

        });
    </script>
@endpush