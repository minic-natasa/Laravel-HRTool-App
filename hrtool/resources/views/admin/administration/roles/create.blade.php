@extends('admin.master')
@section('admin')

@section('title')
Create Role | HRTool
@endsection

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <h4 class="font-size-16" style="margin-left: 10px; margin-top:5px;">CREATE NEW ROLE </h4>
                    </div>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">HRTool</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a>
                            <li class="breadcrumb-item active">Create New Role</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <style>
                        .form-group {
                            margin-left: 1vw;
                        }
                    </style>

                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right" style="margin-bottom: 4px;">Role Name:</label>

                            <div class="col-md-4">
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>

                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-4 offset-md-3">
                                <button type="submit" class="btn btn-primary" style="margin-top:10px; margin-bottom:10px">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>



    </div>
</div>
<!-- End Page-content -->
@endsection