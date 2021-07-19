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
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Manage Users</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{url('/admin/manage-users')}}">Users</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('/admin/manage-proof')}}">Manage Proof</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#manage-category" aria-expanded="false" aria-controls="manage-category">
                <span class="menu-title">Manage Category</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="manage-category">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{url('/admin/manage-category')}}">Category</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('/admin/add-category')}}">Add Category</a></li>
                </ul>
            </div>

        </li>

    </ul>
</nav>