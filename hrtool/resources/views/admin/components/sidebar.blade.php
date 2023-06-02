<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-cEIQo9mW6eL2QOxVz+e+zQ5C5CKhrP5w4y4hB4/uH9jV75L+4bN7+B3x6BkwWj/" crossorigin="anonymous">
</head>

@php
$id = Auth::User()->id;
$userID = app\Models\User::find($id);
$status = $userID->status;
@endphp

<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="">
                <img src="{{ (!empty(Auth::User()->profile_picture) ? url('upload/admin_images/'.Auth::User()->profile_picture) : url('upload/default_image.png')) }}" alt="" class="avatar-md rounded-circle" style="margin-top: 1vh;">
            </div>
            <div class="mt-3">
                <h4 class="font-size-16 mb-1">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h4>
            </div>
        </div>

        <!--- Menu -->
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">

                <li style="margin-top: 3vh;">
                    <a href="/homepage" class="waves-effect">
                        <i class="fas fa-house-user" style="font-size: 15px;"></i>
                        <span>Homepage</span>
                    </a>
                </li>

                @role('admin_it|admin_hr')

                <li>
                    <a href="/admin-dashboard" class="waves-effect">
                        <i class="ri-dashboard-line" style="font-size: 15px;"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                @endrole

                <!-- ********************************************************* -->

                @if($status == 'active')

                @role('admin_it|admin_hr')
                <li class="menu-title">HR Administration</li>
                @if(Auth::user()->can('employee.index') && Auth::user()->can('employee.create'))
                <li class="{{ Request::is('users.index') || Request::is('users.create')  ? 'mm-active' : '' }}">
                    <a href="javascript:void(0);" class="has-arrow waves-effect" aria-expanded="true">
                        <i class="fas fa-users" title="Employees" style="font-size: 15px;"></i>
                        <span>Employees</span>
                    </a>
                    <ul class="sub-menu mm-collapse {{ Request::is('users.index') || Request::is('users.create') ? 'mm-show' : '' }}" aria-expanded="true">
                        <li><a href="{{ route('users.index')}}">See all employees</a></li>
                        <li><a href="{{ route('users.create')}}">Create new employee</a></li>
                    </ul>
                </li>
                @else

                <li>
                    @if(Auth::user()->can('employee.index'))
                    <a href="{{ route('users.index')}}" :isActive="request()->routeIs('users.index')" class=" waves-effect">
                        <i class="fas fa-users" style="font-size: 15px;"></i>
                        <span>Employees</span>
                    </a>
                    @endif
                </li>
                @endif


                @if(Auth::user()->can('organization.index') && Auth::user()->can('organization.create'))
                <li class="{{ Request::is('organizations.index') || Request::is('organizations.create') ? 'mm-active' : '' }}">
                    <a href="javascript:void(0);" class="has-arrow waves-effect" aria-expanded="true">
                        <i class="fas fa-sitemap" title="Organizations" style="font-size: 15px;"></i>
                        <span>Organizations</span>
                    </a>
                    <ul class="sub-menu mm-collapse {{ Request::is('organizations.index') || Request::is('organizations.create') ? 'mm-show' : '' }}" aria-expanded="true">
                        <li><a href="{{ route('organizations.index') }}">See all organizations</a></li>
                        <li><a href="{{ route('organizations.create') }}">Create new organization</a></li>
                    </ul>
                </li>
                @else
                <li>
                    @if(Auth::user()->can('organization.index'))
                    <a href="{{ route('organizations.index') }}" :isActive="request()->routeIs('organizations.index')" class="waves-effect">
                        <i class="fas fa-sitemap" style="font-size: 13px;"></i>
                        <span>Organizations</span>
                    </a>
                    @endif
                </li>
                @endif


                @if(Auth::user()->can('position.index') && Auth::user()->can('position.create'))
                <li class="{{ Request::is('positions.index') || Request::is('positions.create')  ? 'mm-active' : '' }}">
                    <a href="javascript:void(0);" class="has-arrow waves-effect" aria-expanded="true">
                        <i class="fas fa-user" title="Positions" style="font-size: 15px;"></i>
                        <span>Positions</span>
                    </a>
                    <ul class="sub-menu mm-collapse {{ Request::is('positions.index') || Request::is('positions.create') ? 'mm-show' : '' }}" aria-expanded="true">
                        <li><a href="{{ route('positions.index')}}">See all positions</a></li>
                        <li><a href="{{ route('positions.create')}}">Enter new position</a></li>
                    </ul>
                </li>
                @else
                @if(Auth::user()->can('position.index'))
                <li>
                    <a href="{{ route('positions.index')}}" :isActive="request()->routeIs('positions.index')" class=" waves-effect">
                        <i class="fas fa-user" title="Positions" style="font-size: 15px;"></i>
                        <span>Positions</span>
                    </a>
                </li>
                @endif
                @endif



                @if(Auth::User()->can('contract.index'))
                <li>
                    <a href="{{ route('contracts.index')}}" :isActive="request()->routeIs('contracts.index')" class=" waves-effect">
                        <i class="fas fa-file-contract" title="Contracts" style="font-size: 15px;"></i>
                        <span>Active Contracts</span>
                    </a>
                </li>
                @endif
                @endrole

                <!-- ********************************************************* -->

                @role('user')
                <li class="menu-title">My Details</li>

                <li>
                    <a href="{{ route('profile.show')}}" :isActive="request()->routeIs('profile.show')" class=" waves-effect">
                        <i class="fas fa-user" title="Profile" style="font-size: 15px;"></i>
                        <span>Profile</span>
                    </a>
                </li>

                @php
                $activeContracts = Auth::user()->contract->where('status', 'active');
                $organizations = App\Models\Organization::all();
                @endphp

                @if($activeContracts && $activeContracts->count() == 1)
                @php
                $reasonToSearch = 'Promena pozicije';

                $contract = $activeContracts->first();
                $annex = $contract->annexes()
                ->where('deleted', 0)
                ->whereRaw("FIND_IN_SET('$reasonToSearch', reason) > 0")
                ->orderByDesc('annex_date')
                ->first();

                $annexPositionName = $annex ? $annex->position : '';
                $currentOrganization = $contract->organization;
                $annexOrganization = '';

                if ($annex) {
                foreach ($organizations as $org) {
                foreach ($org->position as $pos) {
                if ($pos->name == $annexPositionName) {
                $annexOrganization = $pos->organization;
                $annexPosition = $pos;
                break;
                }
                }
                }
                }
                @endphp

                <li>
                    @if ($annex)
                    <a href="{{ route('organizations.organization-card', ['id' => $annexOrganization->id]) }}" :isActive="" class="waves-effect">
                        <i class="fas fa-users" style="font-size: 15px;"></i>
                        <span>Team</span>
                    </a>
                    @else
                    <a href="{{ route('organizations.organization-card', ['id' => $currentOrganization->id]) }}" :isActive="" class="waves-effect">
                        <i class="fas fa-users" style="font-size: 15px;"></i>
                        <span>Team</span>
                    </a>
                    @endif
                </li>

                <li>
                    <a href="{{ route('contracts.profile', Auth::User()->id) }}" :isActive="" class="waves-effect">
                        <i class="fas fa-file-contract" title="Contracts" style="font-size: 15px;"></i>
                        <span>Contract</span>
                    </a>
                </li>

                @elseif($activeContracts && $activeContracts->count() > 1)
                <li>
                    <a class="dropdown-trigger" href="#" data-target="organization-dropdown">
                        <i class="fas fa-users" style="font-size: 15px;"></i>
                        <span>Teams</span>
                    </a>

                    <ul id="organization-dropdown" class="dropdown-content">
                        @foreach(Auth::user()->contract as $contr)
                        @php
                        $reasonToSearch = 'Promena pozicije';
                        $annex = $contr->annexes()
                        ->where('deleted', 0)
                        ->whereRaw("FIND_IN_SET('$reasonToSearch', reason) > 0")
                        ->orderByDesc('annex_date')
                        ->first();

                        $annexPositionName = $annex ? $annex->position : '';
                        $currentOrganization = $contr->organization;
                        $annexOrganization = '';

                        if ($annex) {
                        foreach ($organizations as $org) {
                        foreach ($org->position as $pos) {
                        if ($pos->name == $annexPositionName) {
                        $annexOrganization = $pos->organization;
                        $annexPosition = $pos;
                        break;
                        }
                        }
                        }
                        }
                        @endphp

                        <li>
                            @if ($annex)
                            <a href="{{ route('organizations.organization-card', ['id' => $annexOrganization->id]) }}" :isActive="" class="waves-effect">{{$annexOrganization->name}}</a>
                            @else
                            <a href="{{ route('organizations.organization-card', ['id' => $currentOrganization->id]) }}" :isActive="" class="waves-effect">{{$currentOrganization->name}}</a>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </li>

                <li>
                    <a href="{{ route('contracts.profile', Auth::User()->id) }}" :isActive="" class="waves-effect">
                        <i class="fas fa-file-contract" title="Contracts" style="font-size: 15px;"></i>
                        <span>Contracts</span>
                    </a>
                </li>
                @endif
                @endrole

                <!-- ********************************************************* -->

                @role('admin_it')

                <li class="menu-title">Settings</li>

                <li class="{{ Request::is('admin-panel*') || Request::is('roles*') || Request::is('permissions*') || Request::is('roles.permissions*') ? 'mm-active' : '' }}">
                    <a href="javascript:void(0);" class="has-arrow waves-effect" aria-expanded="true">
                        <i class="fas fa-user-shield" title="Admin" style="font-size: 15px;"></i>
                        <span>Admin</span>
                    </a>
                    <ul class="sub-menu mm-collapse {{ Request::is('admin-panel*') || Request::is('roles*') || Request::is('permissions*') || Request::is('roles.permissions*') ? 'mm-show' : '' }}" aria-expanded="true">
                        <li><a href="{{ route('admin-panel.index') }}" aria-expanded="false">Admin Panel</a></li>
                        <li class="{{ Request::is('roles*') || Request::is('permissions*') || Request::is('roles.permissions*') ? 'mm-active' : '' }}">
                            <a href="javascript:void(0);" class="has-arrow  waves-effect" aria-expanded="true">Roles and Permissions</a>
                            <ul class="sub-menu mm-collapse {{ Request::is('roles*') || Request::is('permissions*') || Request::is('roles.permissions*') ? 'mm-show' : '' }}" aria-expanded="true">
                                <li><a href="{{ route('roles.index') }}">Roles</a></li>
                                <li><a href="{{ route('permissions.index') }}">Permissions</a></li>
                                <li><a href="{{ route('roles.permissions.index') }}">Access</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                @endrole

                @else
                <li>
                    <div style="margin-left: 2vw; margin-right:2vw">Your account isn't activated, please contact IT support. </div>
                </li>
                @endif
            </ul>

        </div>
        <!-- Sidebar -->
    </div>
</div>