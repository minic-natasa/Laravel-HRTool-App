@extends('admin.master')
@section('admin')

@section('title')
Organization Card | HRTool
@endsection

<head>

    <style>
        .card {
            width: 12vw;
            height: 28vh;
            border: 1px solid #ccc;
            padding: 1vw;
            margin: 1vw;
            border-radius: 15px;
            box-shadow: 2px 2px 27px #ccc;
            position: relative;
        }

        .card h2 {
            font-size: 16px;
            margin-top: 0;
        }

        .card p {
            font-size: 12px;
            margin-bottom: 1vh;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .level-1-container {
            flex-direction: row;
        }

        .level-2-container {
            flex-direction: row;
        }
    </style>

</head>

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <h4 class="font-size-14" style="margin-left: 10px; margin-top:5px; margin-right:10px">{{$organization->name}} ORGANIZATION</h4>

                        @if(Auth::user()->can('organization.edit'))
                        <div class="d-flex align-items-center">
                            <a href="{{route('organizations.edit', $organization->id)}}" class="btn btn-link" style="margin-right:5px"><i class="fas fa-pencil-alt" title="Edit"></i></a>
                        </div>
                        @endif
                    </div>

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

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                @if(Auth::user()->hasRole(['admin_hr', 'admin_it']))
                                <a href="{{ route('admin.index') }}">HRTool</a>
                                @else
                                <a href="/homepage">HRTool</a>
                                @endif
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('organizations.index') }}">Organizations</a>
                            <li class="breadcrumb-item active">Organization Card</li>
                        </ol>
                    </div>


                </div>
            </div>
        </div>
        <!-- end page title -->



        <div class="card-container level-1-container">
            @foreach ($contracts as $con)
            @if ($con->status == 'active')

            @php
            $annex = $con->annexes()->where('reason', 'Promene pozicije')->where('deleted', false)->latest('created_at')->first();
            $annexPositionName = $annex ? $annex->new_value : '';
            $annexPosition = '';
            $annexOrganization = '';
            $contractOrganization = $con->organization;
            $contractPosition = '';


            foreach ($con->organization->position as $pos) {
            if ($pos->id == $con->position) {
            $contractPosition = $pos;
            $contractOrganization = $contractPosition->organization;
            break;
            }
            }

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

            @if($organization->manager_id == $con->employee->id && ($annex ? $annexOrganization->id == $organization->id : $contractOrganization->id == $organization->id))
            @can('employee.profile')
            <a href="{{ url('users/'.$con->employee->id.'/profile-card') }}" class="card level-1" style="height: 29vh;">
                <img src="{{ (!empty($con->employee->profile_picture) ? url('upload/admin_images/'.$con->employee->profile_picture) : url('upload/default_image.png')) }}" style="margin-bottom:7px;" alt="Employee Picture" class="d-flex me-3 rounded-circle img-thumbnail avatar-md">
                <h2 class="mt-0 font-size-16 mb-1">{{ $con->employee->first_name}} {{ $con->employee->last_name}}</h2>
                <p class="text-muted font-size-11" style="color: #002EFF !important">
                    <strong>Manager</strong><br>
                </p>
                <p class="text-muted font-size-12" style="padding-right: 3px;">
                    @if ($annex && $annexPosition)
                    {{$annexPositionName}}
                    @else
                    {{ $contractPosition->name }}
                    @endif
                </p>
                <p class="text-muted font-size-12" style="padding-right: 3px;">
                    {{ $con->employee->email }}
                </p>
            </a>
            @else
            <div class="card level-1" style="height: 29vh;">
                <img src="{{ (!empty($con->employee->profile_picture) ? url('upload/admin_images/'.$con->employee->profile_picture) : url('upload/default_image.png')) }}" style="margin-bottom:7px;" alt="Employee Picture" class="d-flex me-3 rounded-circle img-thumbnail avatar-md">
                <h2 class="mt-0 font-size-16 mb-1">{{ $con->employee->first_name}} {{ $con->employee->last_name}}</h2>
                <p class="text-muted font-size-11" style="color: #002EFF !important">
                    <strong>Unit Manager</strong><br>
                </p>
                <p class="text-muted font-size-12" style="padding-right: 3px;">
                    @if ($annex && $annexPosition)
                    {{$annexPositionName}}
                    @else
                    {{ $contractPosition->name }}
                    @endif
                </p>
                <p class="text-muted font-size-12" style="padding-right: 3px;">
                    {{ $con->employee->email }}
                </p>
            </div>
            @endcan
            @endif
            @endif
            @endforeach
        </div>

        <div class="card-container level-2-container">
            @foreach ($contracts as $con)
            @if ($con->status == 'active')

            @php
            $reasonToSearch = 'Promena pozicije';
            $annex = $con->annexes()
            ->where('deleted', 0)
            ->whereRaw("FIND_IN_SET('$reasonToSearch', reason) > 0")
            ->orderByDesc('annex_date')
            ->first();
            $annexPositionName = $annex ? $annex->position : '';
            $annexPosition = '';
            $annexOrganization = '';
            $contractOrganization = $con->organization;
            $contractPosition = '';


            foreach ($con->organization->position as $pos) {
            if ($pos->id == $con->position) {
            $contractPosition = $pos;
            $contractOrganization = $contractPosition->organization;
            break;
            }
            }

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

            @if(!($organization->manager_id == $con->employee->id) && ($annex ? $annexOrganization->id == $organization->id : $contractOrganization->id == $organization->id))
            @can('employee.profile')
            <a href="{{ url('users/'.$con->employee->id.'/profile-card') }}" class="card level-2">
                <img src="{{ (!empty($con->employee->profile_picture) ? url('upload/admin_images/'.$con->employee->profile_picture) : url('upload/default_image.png')) }}" style="margin-bottom:10px;" alt="Employee Picture" class="d-flex me-3 rounded-circle img-thumbnail avatar-md">
                <h2 class="mt-0 font-size-16 mb-1">{{ $con->employee->first_name}} {{ $con->employee->last_name}}</h2>
                <p class="text-muted font-size-12" style="padding-right: 3px;">
                    @if ($annex && $annexPosition)
                    {{$annexPositionName}}
                    @else
                    {{ $contractPosition->name }}
                    @endif
                </p>
                <p class="text-muted font-size-12" style="padding-right: 3px;">
                    {{ $con->employee->email }}
                </p>
            </a>
            @else
            <div class="card level-2">
                <img src="{{ (!empty($con->employee->profile_picture) ? url('upload/admin_images/'.$con->employee->profile_picture) : url('upload/default_image.png')) }}" style="margin-bottom:10px;" alt="Employee Picture" class="d-flex me-3 rounded-circle img-thumbnail avatar-md">
                <h2 class="mt-0 font-size-16 mb-1">{{ $con->employee->first_name}} {{ $con->employee->last_name}}</h2>
                <p class="text-muted font-size-12" style="padding-right: 3px;">
                    @if ($annex && $annexPosition)
                    {{$annexPositionName}}
                    @else
                    {{ $contractPosition->name }}
                    @endif
                </p>
                <p class="text-muted font-size-12" style="padding-right: 3px;">
                    {{ $con->employee->email }}
                </p>
            </div>
            @endcan
            @endif
            @endif
            @endforeach
        </div>


    </div>
</div>


@endsection