<div class="topbar-user__wrapper">
    <ul class="nav navbar-nav navbar-right">
    <li class="">
           <a href="#" class="dropdown-toggle topbar-user__head" data-toggle="dropdown" style="margin-left:-100px; background:transparent!important;">
                
                <span class="topbar-user__name"></span>
                <img src="https://www.iconpacks.net/icons/2/free-settings-icon-3110-thumb.png" class="topbar-user__image" >
            </a>
            <ul class="dropdown-menu topbar-user__dropdown-menu" >
                <!--<div class="topbar-user__content-header">
                    <div class="topbar-user__card-wrapper">
                        <div class="topbar-user__card-image-wrapper">
                            <img src="" class="topbar-user__card-image">
                        </div>
                        <div class="topbar-user__card-details">
                            <div class="topbar-user__card__name">
                            </div>
                            <div class="topbar-user__card__info">
                            </div>
                        </div>
                    </div>
                </div>-->
              <ul class="topbar-user__list-wrapper" style="margin-left:3%!important;">
                <li class="topbar-user__list">
                    <h3 style="margin-left:5%;">                                Hi <a href="/profile_user">{{Auth::user()->name}}</a>
                    </h3>
                </li>
                    <li class="topbar-user__list">
                        <a href="/home" class="topbar-user__list-link">
                            
                            @if(Auth::user()->image !== NULL)  
                <img src="{{Auth::user()->image}}" alt="">
                @else
                <img src="https://p.kindpng.com/picc/s/451-4517876_default-profile-hd-png-download.png" alt=""> 
                @endif     
                            <span class="user__list-text">
                                @lang('Profile')
                            </span>
                        </a>
                    </li>
                    <!--<li class="topbar-user__list">
                        <a href="{{route('absence.create')}}" class="topbar-user__list-link">
                            <span class="user__list-icon">
                                 <i class="fa fa-clock-o"></i>
                            </span>
                            <span class="user__list-text">
                                @lang('Register absence')
                            </span>
                        </a>
                    </li>-->
                   <!-- <li class="topbar-user__list">
                        <a href="{{url('/users/' .auth()->user()->external_id . '/edit')}}" class="topbar-user__list-link">
                            <span class="user__list-icon">
                                 <i class="fa fa-cog"></i>
                            </span>
                            <span class="user__list-text">
                                @lang('Settings')
                            </span>
                        </a>
                    </li>-->
                   <li class="topbar-user__list">
                        <a href="{{url('/logout')}}" class="btn btn-outline-metal btn-hover-brand btn-upper btn-font-dark btn-sm btn-bold" style="margin:2%;">{{ __('Sign Out') }}</a>
                    </li>
                </ul>
            </ul>
        </li>
    </ul>
</div>
