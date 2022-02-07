@extends('layouts.app')

@section('content')
<style>

</style>
<div class="container">
    <div class="row">
        <div class="col-md-5 col-md-offset-4">
            <div class="tablet" style="margin-top:-35%!important; background-color:rgba(255, 255, 255, 0.685);">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                    {!! csrf_field() !!}

                    @if(isDemo())
                    <div class="alert alert-info">

                    </div>
                    @endif
                    <p style="text-align: center;">
                        <img src="https://cdn.erakomp.co.id/assets/img/Logo%20Erakomp-01.png" alt="" style="max-width:100px;  ">
                    </p>

                    <h1 class="text-center" style="font-size:50px; font-family: 'Fredericka the Great', cursive!important;">Era Project Management</h1>


                    <br>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="inner-addon right-addon">
                            <div class="col-md-12 input-group-lg">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <input type="email" value="" class="form-control" style="border-radius: 4px; box-shadow:0px 2px 4px rgba(0,0,0,0.18); padding-right:40px; " name="email" value="{{ old('email') }}" placeholder="Enter email here">
                                @if($errors->has('email'))
                                <div class="text-danger">
                                    Please enter the right email
                                </div>
                                @endif

                            </div>
                        </div>

                    </div>
                    <br>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="inner-addon right-addon">
                            <div class="col-md-12 input-group-lg">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                                <input type="password" class="form-control" value="" id="password" style="border-radius: 4px; box-shadow:0px 2px 4px rgba(0,0,0,0.18);" name="password" placeholder="Enter passowrd here">
                                <input type="checkbox" onclick="myFunction()">Show Password

                                @if($errors->has('password'))
                                <div class="text-danger">
                                    Please enter the right password
                                </div>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label style="font-weight: 300; color:#333;">
                                    <input type="checkbox" name="remember"> Remember Me
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">

                            <button type="submit" class="btn btn-success btn-lg btn-block" style="border-radius: 2px; box-shadow: 0px 2px 4px rgba(0,0,0,0.18);   background: #536be2; border: none;">
                                <i class="fa fa-btn fa-sign-in"></i>Login
                            </button>
                        </div>
                        <div class="col-md-6 col-md-offset-2" style="padding-left: 60px;">
                            <a class="btn btn-link" href="{{ url('/register') }}" style="color:#333; margin-top:8px;">Don't have account?</a>
                        </div>
                    </div>
                    <div class="col-md-12">


                        @if (Session::has('message'))
                        <span class="help-block">
                            <strong>{{ Session::get('message') }}</strong>
                        </span>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
@endsection