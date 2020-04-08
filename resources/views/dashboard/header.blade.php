<header class="app-header">

    <a class="app-header__logo" href="{{url("/")}}"> <i class="material-icons pt-3">home</i> </a>

    <!-- Sidebar toggle button-->
    <a class="app-sidebar__toggle pt-1" href="#" data-toggle="sidebar"></a>

    <!-- Navbar Right Menu-->
    <ul class="app-nav">
        {{-- <li class="app-search">
            <input class="app-search__input" type="search" placeholder="جستجو">
            <button class="app-search__button"><i class="fa fa-search"></i></button>
        </li> --}}
        <!--Notification Menu-->
        <li class="dropdown">
            <a class="app-nav__item p-relative" href="#" data-toggle="dropdown">
                <i class="material-icons">notification_important</i>
                @if ($ncount = 0)
                    <span class="app-notification__number">{{$ncount}}</span>
                @endif
            </a>
            <ul class="app-notification dropdown-menu text-right">
                @if (false)
                    @foreach ([] as $notification)
                        <li class="app-notification__item">
                            <a href="{{url("notifications")}}"> {{$notification->history ? short($notification->history->body) : '-'}} </a>
                        </li>
                    @endforeach
                @else
                    <li class="app-notification__title"> شما اعلامیه جدیدی ندارید. </li>
                @endif
                <li class="app-notification__footer"> <a href="{{url("notifications")}}"> مشاهده همه اعلامیه ها </a> </li>
            </ul>
        </li>
        <!-- User Menu-->
        <li class="dropdown">
            <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu">
                <i class="material-icons">person</i>
            </a>
            <ul class="dropdown-menu settings-menu text-right">
                <li><a class="dropdown-item" href="{{route('acc')}}"><i class="fa fa-lock fa-lg"></i> مدیریت حساب کاربری </a></li>
                <li>
                    <a class="dropdown-item pointer" href="javascript:void" onclick="document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out ml-1"></i> خروج
                    </a>
                    <form id="logout-form" class="hidden" action="{{url("logout")}}" method="POST">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="{{route("dashboard")}}" class="app-nav__item"> <i class="material-icons">dashboard</i> </a>
        </li>

        <li class="nav-item">
            <a href="javascript:void" class="app-nav__item" onclick="window.history.back()"> <i class="material-icons">keyboard_backspace</i> </a>
        </li>
    </ul>
</header>
