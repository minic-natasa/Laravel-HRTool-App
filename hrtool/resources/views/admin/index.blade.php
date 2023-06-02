@extends('admin.master')
@section('admin')

@section('title')
Admin Dashboard | HRTool
@endsection

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                       <h4 class="font-size-16" style="margin-left: 10px; margin-top:5px;">DASHBOARD</h4>
                    </div>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">HRTool</a></li>
                            <li class="breadcrumb-item active">Admin Dashboard</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-3 col-md-6">
                <a href="{{ route('users.index') }}" class="text-decoration-none">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-secondary font-size-14 mb-2">See All</p>
                                    <h4 class="mb-2">Employees</h4>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-primary rounded-3">
                                        <i class="fas fa-users" style="font-size: 24px;"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </a>
            </div><!-- end col -->
            <div class="col-xl-3 col-md-6">
                <a href="{{ route('organizations.index') }}" class="text-decoration-none">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-secondary font-size-14 mb-2">See All</p>
                                    <h4 class="mb-2">Organizations</h4>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-primary rounded-3">
                                        <i class="fas fa-sitemap" style="font-size: 24px;"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </a>
            </div><!-- end col -->
            <div class="col-xl-3 col-md-6">
                <a href="{{ route('positions.index') }}" class="text-decoration-none">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-secondary font-size-14 mb-2">See All</p>
                                    <h4 class="mb-2">Positions</h4>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-primary rounded-3">
                                        <i class="fas fa-user" title="Positions" style="font-size: 24px;"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </a>
            </div><!-- end col -->
            <div class="col-xl-3 col-md-6">
                <a href="{{ route('contracts.index') }}" class="text-decoration-none">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-secondary font-size-14 mb-2">See All</p>
                                    <h4 class="mb-2">Contracts</h4>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-primary rounded-3">
                                        <i class="fas fa-file-contract" title="Contracts" style="font-size: 24px;"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </a>
            </div><!-- end col -->
        </div>


    </div>

</div>
<!-- End Page-content -->
@endsection