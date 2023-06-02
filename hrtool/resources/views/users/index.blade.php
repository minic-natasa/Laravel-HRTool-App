@extends('admin.master')
@section('admin')

@section('title')
Employees | HRTool
@endsection

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <h4 class="font-size-16" style="margin-left: 10px; margin-top:5px;">EMPLOYEES</h4>
                    </div>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                @if(Auth::user()->hasRole(['admin_hr', 'admin_it']))
                                <a href="{{ route('admin.index') }}">HRTool</a>
                                @else
                                <a href="/homepage">HRTool</a>
                                @endif
                            </li>
                            <li class="breadcrumb-item active">Employees</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        @if(Auth::user()->can('employee.create'))
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Create new Employee</a>
                </div>

            </div>
        </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body" style="position: relative; overflow: auto; max-height: 59vh; width: 100%;">
                        <div class="table-responsive">
                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th>Employee Number</th>
                                        <th>Profile Picture</th>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Organization</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        @if(Auth::user()->can('employee.edit') || Auth::user()->can('employee.delete'))
                                        <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($users as $user)
                                    <tr style="text-align: center;">
                                        <th scope="row">{{ $user->employee_number }}</th>
                                        <td>
                                            <img src="{{ (!empty($user->profile_picture) ? url('upload/admin_images/'.$user->profile_picture) : url('upload/default_image.png')) }}" alt="" class="avatar-sm rounded-circle">
                                        </td>
                                        <td>
                                            @if(Auth::user()->can('employee.profile'))
                                            <a id="user" href="{{ route('users.profile-card', $user->id) }}">{{ $user->first_name }} {{ $user->last_name }}</a>
                                            @else
                                            {{ $user->first_name }} {{ $user->last_name }}
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                            $activeContracts = $user->contract()->where('status', 'active')->get();
                                            $latestAnnexPos = null;
                                            $currentOrganization = null;

                                            if ($activeContracts->count() > 0) {
                                            foreach ($activeContracts as $contr) {

                                            $reasonToSearch = 'Promena pozicije';
                                            $latestAnnexPos = $contr->annexes()
                                            ->where('deleted', 0)
                                            ->whereRaw("FIND_IN_SET('$reasonToSearch', reason) > 0")
                                            ->orderByDesc('annex_date')
                                            ->first();

                                            $annexPositionName = $latestAnnexPos ? $latestAnnexPos->position : '';
                                            $currentOrganization = $contr->organization;
                                            $annexOrganization = '';
                                            $annexPosition = '';
                                            $currentPosition = '';

                                            foreach ($contr->organization->position as $pos) {
                                            if ($pos->id == $contr->position) {
                                            $currentPosition = $pos;
                                            $currentPositionName = $currentPosition->name;
                                            }
                                            }

                                            if ($latestAnnexPos) {
                                            foreach ($organizations as $org) {
                                            foreach ($org->position as $pos) {
                                            if ($pos->name == $annexPositionName) {
                                            $annexOrganization = $pos->organization;
                                            $annexPosition = $pos;
                                            break;
                                            }
                                            }
                                            }
                                            if (Auth::user()->can('position.profile')) {
                                            echo '<span class="changed" title="Position Changed with Annex"><a id="link" href="' . route('positions.position-card', $annexPosition->id) . '">' . $annexPosition->name . '</a></span>';
                                            } else {
                                            echo $annexPosition->name;
                                            }
                                            } else {
                                            if (Auth::user()->can('position.profile')) {
                                            echo '<a id="link" href="' . route('positions.position-card', $currentPosition->id) . '">' . $currentPositionName . '</a>';
                                            } else {
                                            echo $currentPositionName;
                                            }
                                            echo "<br>";
                                            }
                                            }
                                            } else {
                                            echo "No active contract found";
                                            }
                                            @endphp
                                        </td>
                                        <td>
                                            @php
                                            if ($latestAnnexPos) {
                                            if (Auth::user()->can('organization.profile')) {
                                            echo '<span class="changed" title="Organization Changed with Annex"><a id="link" href="' . route('organizations.organization-card', $annexOrganization->id) . '">' . $annexOrganization->name . '</a></span>';
                                            } else {
                                            echo $annexOrganization->name;
                                            }
                                            } elseif ($currentOrganization) {
                                            if (Auth::user()->can('organization.profile')) {
                                            echo '<a id="link" href="' . route('organizations.organization-card', $currentOrganization->id) . '">' . $currentOrganization->name . '</a>';
                                            } else {
                                            echo $currentOrganization->name;
                                            }
                                            } else {
                                            echo "No active contract found";
                                            }
                                            @endphp
                                        </td>


                                        <td>{{ $user->email }}</td>

                                        <style>
                                            /* Set link color to the same color as normal text */
                                            #link {
                                                color: inherit;
                                                text-decoration: none;
                                            }

                                            /* Set link color to a different color on hover */
                                            #link:hover {
                                                color: #002EFF;
                                            }
                                        </style>


                                        <td>{{ $user->mobile }}</td>

                                        <td>
                                            <div>
                                                @if(Auth::User()->can('employee.edit'))
                                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-link"><i class="fas fa-pencil-alt" title="Edit"></i></a>
                                                @endif
                                                @if(Auth::User()->can('employee.delete'))
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline-block; width: auto;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link" onclick="return confirm('Are you sure you want to delete this employee?')"><i class="fa fa-trash" title="Delete"></i></button>
                                                </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach

                                    <style>
                                        /* Set link color to the same color as normal text */
                                        #user {
                                            color: inherit;
                                            text-decoration: none;
                                        }

                                        /* Set link color to a different color on hover */
                                        #user:hover {
                                            color: #002EFF;
                                        }
                                    </style>

                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<!-- End Page-content -->
@endsection