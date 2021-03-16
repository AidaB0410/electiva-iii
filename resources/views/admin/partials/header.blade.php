<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <div class="navbar-header d-flex justify-content-center">
            <a class="navbar-brand" href="{{ route('admin') }}">tAmo's</a>
        </div>
        <div class="navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
            </ul>
            <ul class="navbar-nav my-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="notificationsButton"> <i class="fa fa-bell"></i>
                        <div class="notify d-none">
                            <span class="heartbit"></span>
                            <span class="point"></span>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
                        <ul>
                            <li>
                                <div class="drop-title">Notificaciones</div>
                            </li>
                            <li>
                                <div class="message-center" id="notifications"></div>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('/admins/img/users/'.Auth::user()->photo) }}" alt="user" class="profile-pic" /></a>
                    <div class="dropdown-menu dropdown-menu-right animated flipInY">
                        <ul class="dropdown-user">
                            <li>
                                <div class="dw-user-box">
                                    <div class="u-img"><img src="{{ asset('/admins/img/users/'.Auth::user()->photo) }}" alt="user"></div>
                                    <div class="u-text">
                                        <h4>{{ Auth::user()->name." ".Auth::user()->lastname }}</h4>
                                        <p class="text-muted"></p>
                                    </div>
                                </div>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Volver a la Web</a></li>
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> Cerrar Sesión</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>