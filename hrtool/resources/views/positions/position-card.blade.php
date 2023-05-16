@extends('admin.master')
@section('admin')

<head>

    <style>
        p {
            margin-bottom: 15px;
            font-size: 16px;
        }

        .card {
            margin-bottom: 3.9vh;
        }

        h5 {
            margin-bottom: 5px !important;
            font-size: 14px !important;
        }

        h4 {
            margin-bottom: 5px !important;
            font-size: 14px !important;
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
                        <a href="{{ route('positions.index') }}" class="btn" style="margin-right:5px"><i class="fa fa-caret-left" title="Back"></i></a>
                        <h4 class="font-size-14" style="margin-left: 10px; margin-top:5px;">{{$position->name}}</h4>
                    </div>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">HRTool</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('positions.index') }}">Positions</a>
                            <li class="breadcrumb-item active">Position Card</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-8">
                <div class="card" style="height: 64vh;">
                    <div class="card-body" style="overflow-y: auto;">

                        <h4 class="card-title mb-4" style="padding-left: 15px; padding-top:15px;">DESCRIPTION</h4>

                        <div class="text-center mt-4">
                            <ul style="text-align: justify; padding-bottom:5px">
                                @foreach(explode("\n", $position->description) as $description)
                                <li style="padding-bottom:3px">{{$description}}</li>
                                @endforeach
                            </ul>
                        </div>

                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div><!-- end col-xl-8 -->

            <!-- end col -->
            <div class="col-xl-4">
                <div class="card" style="height: 22vh;">
                    <div class="card-body align-items-center justify-content-between w-100" style="padding-top: 5vh;">
                        <div class="row">
                            <div class="col-4" style="border-right: 1px solid #ccc;">
                                <div class="text-center mt-4">
                                    <h5>UNIT</h5>
                                    <a href="{{ route('organizations.organization-card', $position->organization->id) }}">
                                        <p class="mb-2">{{$position->organization->name}}</p>
                                    </a>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-4">
                                <div class="text-center mt-4">
                                    <h5>See All</h5>
                                    <a href="{{ route('organizations.index') }}">
                                        <p class="mb-2 text-truncate">Organizations</p>
                                    </a>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-4">
                                <div class="text-center mt-4">
                                    <h5>See All</h5>
                                    <a href="{{ route('positions.index') }}">
                                        <p class="mb-2 text-truncate">Positions</p>
                                    </a>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div>
                </div><!-- end card -->



                <div class="card" style="height: 38vh;">
                    <div class="card-body" style="padding-right: 3vw; overflow-y: auto;">

                        <h4 class="card-title mb-4" style="padding-left: 15px; padding-top:15px;">Professional Requirements Per Job Systematisation</h4>
                        <div class="text-center mt-4">
                            <ul style="text-align: justify; padding-bottom:5px">
                                @foreach(explode("\n", $position->professional_requirements_per_job_systematisation) as $requirement)
                                <li style="padding-bottom:5px">{{$requirement}}</li>
                                @endforeach
                            </ul>
                        </div>


                    </div>
                </div><!-- end card -->
            </div><!-- end col -->
        </div>




    </div>
</div>
@endsection