<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Login Erakomp Project Management</title>
    <link rel="shortcut icon" href="https://www.cloudapper.com/wp-content/uploads/custom_images/projects/projects-logo.png">
    <!-- Fonts -->
    <script src="https://use.fontawesome.com/8301ab0e4f.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fredericka+the+Great&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Baloo+2&display=swap');

        body {
            font-family: 'Baloo 2', cursive;            
            background-color: azure;
            background-position: center;
            background-size:cover;
            background-repeat: no-repeat;
        }

        .fa-btn {
            margin-right: 6px;
        }
        /* enable absolute positioning */
        .inner-addon { 
            position: relative; 
        }

        /* style icon */
        .inner-addon .fa {
          position: absolute;
          padding-top: 13px;
          padding-right: 30px;
          font-size: 20px;
          pointer-events: none;
        }
        .tablet__body.tablet__tigthen p img {
            max-width: 300px!important;
        }

        /* align icon */
        .left-addon .fa  { left:  0px;}
        .right-addon .fa { right: 0px;}

        /* add padding  */
        .left-addon input  { padding-left:  30px; }
        .right-addon input { padding-right: 30px; }
        .btn-primary:hover {
            border-color: #145a96;
        } 
        .tablet {
            box-shadow: 15px 10px 13px 0px rgba(0, 0, 0, 0.05);
            background-color: #ffffff;
            border-radius: 15px;
            padding: 2em;
        }

    </style>
</head>
<body id="app-layout">
</nav>

<div style="text-align: center; margin-bottom:10%;"><a href="/login">
    <img src="" width="458px"
                                                          alt="" style="margin-top:5em; margin-bottom:2em; margin-left: 6%" class="logo-placment"></a></div>

    @yield('content')

        <!-- JavaScripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
