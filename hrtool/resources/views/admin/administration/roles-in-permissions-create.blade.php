@extends('admin.master')
@section('admin')

@section('title')
Connect Roles with Permissions | HRTool
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <h4 class="font-size-16" style="margin-left: 10px; margin-top:5px;">CONNECT ROLES WITH PERMISSIONS</h4>
                    </div>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">HRTool</a></li>
                            <li class="breadcrumb-item active">Connect Roles with Permissions</a>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('roles.permissions.store') }}" method="POST">
                        @csrf

                        <div class="form-group row" style="margin-bottom: 4px;">
                            <label for="role_id" class="col-md-3 col-form-label text-md-right">{{ __('Role:') }}</label>
                            <div class="col-md-5">
                                <select class="form-control" id="role_id" name="role_id" data-placeholder="-- Select role --">
                                    <option value="">-- Select role -- </option>
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <style>
                            .form-check-label {
                                text-transform: capitalize;
                            }
                        </style>


                        <div class="form-group row" style="padding-top: 6px;">
                            <label for="permission_id" class="col-md-3 col-form-label text-md-right">{{ __('Permissions:') }}</label>
                            <div class="col-md-8" style="padding-top: 1vh;">
                                @if(!($permission_groups->isEmpty()))
                                <div class="form-check" style="padding-bottom: 2vh;">
                                    <input class="form-check-input" type="checkbox" name="" id="all" value="">
                                    <label class="form-check-label" for="all">
                                        All
                                    </label>
                                </div>
                                @endif

                                @if($permission_groups->isEmpty())
                                <div class="form-group row col-md-9 text-md-right">
                                    <p>Enter permissions first.</p>
                                </div>
                                @endif

                                @foreach($permission_groups as $group)
                                <div class="form-group row" style="margin-bottom: 2vh;">
                                    <div class="col-md-4"> <!-- column for permission groups -->
                                        <div class="form-check">
                                            <input class="form-check-input group-checkbox" type="checkbox" name="group_name" id="group_name" value="">
                                            <label class="form-check-label" for="group_name">
                                                {{ $group->group_name }}
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-5"> <!-- column for permissions -->
                                        @php
                                        $permissions_for_group = app\Models\User::getPermissionsForGroup($group->group_name);
                                        @endphp

                                        @foreach($permissions_for_group as $permission)
                                        <div class="form-check">
                                            <input class="form-check-input permission-checkbox" type="checkbox" name="permission[]" id="permission{{$permission->id}}" value="{{$permission->id}}">
                                            <label class="form-check-label" for="permission_id">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
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
        </div>
    </div>
</div>
<!-- End Page-content -->


<script type="text/javascript">
    $('#all').click(function() {
        if ($(this).is(':checked')) {
            $('input[type =  checkbox]').prop('checked', true);
        } else {
            $('input[type =  checkbox]').prop('checked', false);
        }
    });
</script>

<script>
    const groupCheckboxes = document.querySelectorAll('.group-checkbox');
    const permissionCheckboxes = document.querySelectorAll('.permission-checkbox');

    groupCheckboxes.forEach(groupCheckbox => {
        groupCheckbox.addEventListener('change', function() {
            const isChecked = this.checked;
            const permissionContainer = this.closest('.form-group.row').querySelector('.col-md-5');

            const permissionCheckboxes = permissionContainer.querySelectorAll('.permission-checkbox');
            permissionCheckboxes.forEach(permissionCheckbox => {
                permissionCheckbox.checked = isChecked;
            });
        });
    });

    permissionCheckboxes.forEach(permissionCheckbox => {
        permissionCheckbox.addEventListener('change', function() {
            const permissionContainer = this.closest('.col-md-5');
            const groupCheckbox = permissionContainer.previousElementSibling.querySelector('.group-checkbox');

            const permissionCheckboxes = permissionContainer.querySelectorAll('.permission-checkbox');
            const checkedPermissions = permissionContainer.querySelectorAll('.permission-checkbox:checked');

            if (checkedPermissions.length === permissionCheckboxes.length) {
                groupCheckbox.checked = true;
            } else {
                groupCheckbox.checked = false;
            }
        });
    });
</script>





@endsection