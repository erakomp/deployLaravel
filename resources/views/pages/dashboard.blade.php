@extends('layouts.master')

@section('content')

<div class="card" style="background-color:transparent;">
    <div class="card-body">
        <h1 style="font-family: 'Fredericka the Great', cursive; font-size:70px; text-align:center; margin:15%;
        ">ERAKOMP PROJECT MANAGEMENT</h1>
    </div>
    
</div>
<div class="row" style="display:flex; justify-content:center; margin-top:-10%">
    
    <div class="card col-sm-3" style="margin-right:3%;background-color:rgba(255, 255, 255, 0.637); border-radius:15px;">
        <a href="/projects">
            <div class="card-body" style="margin:5%; text-align:center; color:black; ">
                <p>Total Projects</p>
                <h1>{{$totalProjects}}
                </h1>
            </div>
        </a>
        
    </div>

    <div class="card col-sm-3" style="margin-right:3%; background-color:rgba(255, 255, 255, 0.637); border-radius:15px;">
        <div class="card-body" style="margin:5%; text-align:center; color:black!important;">
            <a href="/importExportView" style="color:black!important;">
            <p>Total Tasks</p>
            <h1>                            {{$totalTasks}}
            </h1>
        </a>
        </div>
    </div>

   
</div>

<!--

@push('scripts')
    <script>
        $(document).ready(function () {
            if(!'{{$settings->company}}') {
                $('#modal-create-client').modal({backdrop: 'static', keyboard: false})
                $('#modal-create-client').modal('show');
            }
            $('[data-toggle="tooltip"]').tooltip(); //Tooltip on icons top

            $('.popoverOption').each(function () {
                var $this = $(this);
                $this.popover({
                    trigger: 'hover',
                    placement: 'left',
                    container: $this,
                    html: true,

                });
            });
        });
        $(document).ready(function () {
            if(!getCookie("step_dashboard") && "{{$settings->company}}") {
                $("#clients").addClass("in");
                // Instance the tour
                var tour = new Tour({
                    storage: false,
                    backdrop: true,
                    steps: [
                        {
                            element: ".col-lg-12",
                            title: "{{trans("Dashboard")}}",
                            content: "{{trans("Welcome folks!")}}",
                            placement: 'top'
                        },
                        {
                            element: "#myNavmenu",
                            title: "{{trans("Navigation")}}",
                            content: "{{trans("This is your side navbar")}}"
                        }
                    ]
                });

                var canCreateClient = '{{ auth()->user()->can('client-create') }}';
                if(canCreateClient) {
                    tour.addSteps([
                        {
                            element: "#newClient",
                            title: "{{trans("Create New Client")}}",
                            content: "{{trans("Let's take our first step, by creating a new client")}}"
                        },
                        {
                            path: '/clients/create'
                        }
                    ])
                }

                // Initialize the tour
                tour.init();

                tour.start();
                setCookie("step_dashboard", true, 1000)
            }
            function setCookie(key, value, expiry) {
                var expires = new Date();
                expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 2000));
                document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
            }

            function getCookie(key) {
                var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
                return keyValue ? keyValue[2] : null;
            }
        });
    </script>
@endpush-->
        <!-- Small boxes (Stat box) -->
        @if(isDemo())
            <div class="alert alert-info">
                <strong>Info!</strong> 
            </div>
        @endif

      
@endsection
