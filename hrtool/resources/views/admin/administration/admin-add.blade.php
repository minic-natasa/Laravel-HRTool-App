@extends('admin.master')
@section('admin')

@section('title')
Add new Admin | HRTool
@endsection


<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <h4 class="font-size-16" style="margin-left: 10px; margin-top:5px;">Add new Admin</h4>
                    </div>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">HRTool</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin-panel.index') }}">Admin Panel</a></li>
                            <li class="breadcrumb-item active">Add new Admin</a>
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

                    <form action="{{ route('admin.store') }}" method="POST">
                        @csrf

                        <div class="form-group row">
                            <label for="model_id" class="col-md-3 col-form-label text-md-right" style="margin-bottom: 4px;">Employee:</label>
                            <div class="col-md-4">
                                <select class="form-control" id="model_id" name="model_id">
                                    <option value="">-- Select employee --</option>
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="model_id" class="col-md-3 col-form-label text-md-right" style="margin-bottom: 4px;">Role:</label>
                            <div class="col-md-4">
                                <select class="form-control" id="role_id" name="role_id" data-placeholder="-- Select role --">
                                    <option value="">-- Select role -- </option>
                                    @foreach ($roles as $role)
                                    @if ($role->name !== 'user')
                                    @php
                                    $formattedRoleName = ($role->name === 'admin_it') ? 'Admin IT' : (($role->name === 'admin_hr') ? 'Admin HR' : $role->name);
                                    @endphp
                                    <option value="{{ $role->id }}">{{ $formattedRoleName }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-3">
                                <button type="submit" class="btn btn-primary" style="margin-top:10px; margin-bottom:10px">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <!-- End Page-content -->
            @endsection