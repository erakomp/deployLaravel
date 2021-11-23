<?php $notifications = auth()->user()->unreadNotifications; ?>

<!-- DESKTOP NAV --->
<button type="button" class="navbar-toggle menu-txt-toggle" style="">
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
</button>

<!-- MOBILE NAV -->
<button type="button" id="mobile-toggle" class="mobile-toggle mobile-nav" data-toggle="offcanvas"
        data-target="#myNavmenu">
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
</button>

<div class="navbar navbar-default navbar-top">

        <div class="navbar-icons__wrapper">

            <!--<div id="nav-toggle col-sm-6">
                <search></search>
            </div>
            @if(Entrust::hasRole('administrator') || Entrust::hasRole('owner'))
                <div id="nav-toggle col-sm-4">
                    <a href="{{route('settings.index')}}" style="text-decoration: none;">
                        <span class="top-bar-toggler">
                        </span>
                    </a>
                </div>
            @endif-->
            
            <div id="nav-toggle col-sm-" style="margin-right:5%!important;">
                <a id="grid-action" role="button" data-toggle="dropdown">
                    <span class="top-bar-toggler">
                    <img src="https://cdn.erakomp.co.id/bell.png" alt="" style="width:30px;">   
                    @if($notifications->isEmpty())
                    <ul>
                        <div class="action-content">
                            <span class="btn btn-danger" style="width:50px; height: 30px;margin-right:30%; margin-top:20px;">0</span>
                        </div>
                    </ul>
                @else
                <span class="btn btn-danger" style="width:50px; height: 30px;margin-right:30%; margin-top:20px;">{{Auth::user()->unreadNotifications->count()}}</span>
                @endif
                
                    </span>
                </a>
            </div>
            <div id="nav-toggle col-sm-2" >
                <li class="topbar-user__list">
                    <a href="{{url('/logout')}}" class="btn btn-outline-metal btn-hover-brand btn-upper btn-font-dark btn-sm btn-bold" style="margin:2%;">Logout</a>
                </li>
            </div>
            @include('navigation.topbar.user-profile')

        </div>

    @include('partials.action-panel._panel')
<!--NOTIFICATIONS END-->

</div>

