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
            <div id="nav-toggle col-sm-2">
                <a id="grid-action" role="button" data-toggle="dropdown">
                    <span class="top-bar-toggler">
                    <img src="https://cdn.erakomp.co.id/bell.png" alt="" style="width:30px;">                    
                    </span>
                </a>
            </div>
            @include('navigation.topbar.user-profile')

        </div>

    @include('partials.action-panel._panel')
<!--NOTIFICATIONS END-->

</div>

