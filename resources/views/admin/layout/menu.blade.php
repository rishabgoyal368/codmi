<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="{{Auth::guard('admin')->user()->getProfileImage()}}" alt="profile">
                    <span class="login-status online"></span>
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">{{Auth::guard('admin')->user()->name}}</span>
                    <span class="text-secondary text-small">Admin</span>
                </div>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('/admin/dashboard')}}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>

        @if(is_show('user'))
        <li class="nav-item">
            <a class="nav-link" href="{{url('/admin/users')}}">
                <span class="menu-title">User</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        @endif

        @if(is_show('user'))
        <li class="nav-item">
            <a class="nav-link" href="{{url('/admin/retails')}}">
                <span class="menu-title">Retails</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        @endif
        

    </ul>
</nav>