@extends('admin.master')
@section('admin')

<head>

    <style>
        .card {
            width: 190px;
            height: 200px;
            border: 1px solid #ccc;
            padding: 15px;
            margin: 15px;
            border-radius: 10px;
            box-shadow: 2px 2px 10px #ccc;
            position: relative;
        }

        .card h2 {
            font-size: 16px;
            margin-top: 0;
        }

        .card p {
            font-size: 12px;
            margin-bottom: 7px;
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
                        <a href="{{ route('organizations.index') }}" class="btn" style="margin-right:5px"><i class="fa fa-caret-left" title="Back"></i></a>
                        <h4 class="font-size-14" style="margin-left: 10px; margin-top:5px;">{{$organization->name}} UNIT</h4>
                    </div>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">HRTool</a></li>
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
            @if($con->organization_id == $organization->id)
            @if($con->employee->manager && $organization->manager_id == $con->employee->id )
            <a href="{{ url('users/'.$con->employee->id.'/profile-card') }}" class="card level-1">
                <img src="{{ (!empty($con->employee->profile_picture) ? url('upload/admin_images/'.$con->employee->profile_picture) : url('upload/default_image.png')) }}" style="margin-bottom:10px;" alt="Employee Picture" class="d-flex me-3 rounded-circle img-thumbnail avatar-md">
                <h2 class="mt-0 font-size-16 mb-1">{{ $con->employee->first_name}} {{ $con->employee->last_name}}</h2>
                <p class="text-muted font-size-14" style="color: #002EFF !important">
                    <strong>Unit Manager</strong><br>
                </p>

                <p class="text-muted font-size-12" style="padding-right: 3px;">
                    @foreach($con->organization->position as $pos)
                    @if($con->position == $pos->id )
                    {{ $pos->name }}
                    @endif
                    @endforeach
                </p>
            </a>

            @endif
            @endif
            @endforeach
        </div>

        <div class="card-container level-2-container">
            @foreach ($contracts as $con)
            @if($con->organization_id == $organization->id)
            @if(!($con->employee->manager && $organization->manager_id == $con->employee->id ))
            <a href="{{ url('users/'.$con->employee->id.'/profile-card') }}" class="card level-2">
                <img src="{{ (!empty($con->employee->profile_picture) ? url('upload/admin_images/'.$con->employee->profile_picture) : url('upload/default_image.png')) }}" style="margin-bottom:15px" alt="Employee Picture" class="d-flex me-3 rounded-circle img-thumbnail avatar-md">
                <h2 class="mt-0 font-size-16 mb-1">{{ $con->employee->first_name}} {{ $con->employee->last_name}}</h2>

                <p class="text-muted font-size-12" style="padding-right: 3px;">
                    @foreach($con->organization->position as $pos)
                    @if($con->position == $pos->id )
                    {{ $pos->name }}
                    @endif
                    @endforeach
                </p>
            </a>


            @endif
            @endif
            @endforeach
        </div>
    </div>
</div>


@endsection