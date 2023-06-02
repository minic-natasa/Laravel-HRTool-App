@extends('admin.master')
@section('admin')

@section('title')
Edit Permission | HRTool
@endsection

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <h4 class="font-size-16" style="margin-left: 10px; margin-top:5px;">EDIT PERMISSION </h4>
                    </div>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">HRTool</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}">Permissions</a>
                            <li class="breadcrumb-item active">Edit Permission</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name='id' value="{{$permission->id}}">

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px; padding-left:4vw;">Permission Name:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="name" name="name" value="{{ $permission->name }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="group_name" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px; padding-left:4vw;">Permission Group Name:</label>
                            <div class="col-md-6">
                                <select class="form-control" id="group_name" name="group_name">
                                    <option value="">-- Select Permission Group Name -- </option>
                                    <option value="employees" {{ $permission->group_name == 'employees' ? 'selected' : '' }}>
                                        Employees
                                    </option>
                                    <option value="organizations" {{ $permission->group_name == 'organizations' ? 'selected' : '' }}>
                                        Organizations
                                    </option>
                                    <option value="positions" {{ $permission->group_name == 'positions' ? 'selected' : '' }}>
                                        Positions
                                    </option>
                                    <option value="contracts" {{ $permission->group_name == 'contracts' ? 'selected' : '' }}>
                                        Contracts
                                    </option>
                                    <option value="admin" {{ $permission->group_name == 'admin' ? 'selected' : '' }}>
                                        Admin
                                    </option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" style="margin-top:10px; margin-bottom:10px">{{ __('Save') }}</button>
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