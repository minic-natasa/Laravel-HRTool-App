<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-cEIQo9mW6eL2QOxVz+e+zQ5C5CKhrP5w4y4hB4/uH9jV75L+4bN7+B3x6BkwWj/" crossorigin="anonymous">
</head>
<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="">
                <img src="{{asset('assets\images\users\Portrait_Placeholder.png')}}" alt="" class="avatar-md rounded-circle">
            </div>
            <div class="mt-3">
                <h4 class="font-size-16 mb-1">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h4>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="/admin" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('users.index')}}" :isActive="request()->routeIs('users.index')" class=" waves-effect">
                        <i class="fas fa-user" style="font-size: 15px;"></i>
                        <span>Employees</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('organizations.index')}}" :isActive="request()->routeIs('organizations.index')" class=" waves-effect">
                        <i class="fas fa-sitemap" style="font-size: 13px;"></i>
                        <span>Organizations</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->