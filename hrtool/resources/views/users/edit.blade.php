@extends('admin.master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <a href="{{ route('users.profile-card', $user->id) }}" class="btn" style="margin-right:5px;"><i class="fa fa-caret-left" title="Back"></i></a>
                        <h4 class="font-size-16" style="margin-left: 10px; margin-top:5px;">EDIT USER</h4>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">HRTool</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Employees</a>
                                <li class="breadcrumb-item active">Edit Employee</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">First Name:</label>
                            <div class="col-md-6">
                                <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $user->first_name) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Last Name:</label>
                            <div class="col-md-6">
                                <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $user->last_name) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Email:</label>
                            <div class="col-md-6">
                                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="birth_date" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Birth date:</label>
                            <div class="col-md-6">
                                <input type="date" name="birth_date" class="form-control" value="{{ old('birth_date', $user->birth_date) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name_of_one_parent" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Name of one parent:</label>
                            <div class="col-md-6">
                                <input type="text" name="name_of_one_parent" class="form-control" value="{{ old('name_of_one_parent', $user->name_of_one_parent) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jmbg" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">JMBG:</label>
                            <div class="col-md-6">
                                <input type="text" name="jmbg" class="form-control" value="{{ old('jmbg', $user->jmbg) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="private_email" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Private email:</label>
                            <div class="col-md-6">
                                <input type="text" name="private_email" class="form-control" value="{{ old('private_email', $user->private_email) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mobile" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Mobile:</label>
                            <div class="col-md-6">
                                <input type="text" name="mobile" class="form-control" value="{{ old('mobile', $user->mobile) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bank_account_number" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Bank account number:</label>
                            <div class="col-md-6">
                                <input type="text" name="bank_account_number" class="form-control" value="{{ old('bank_account_number', $user->bank_account_number) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="employee_number" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Employee number:</label>
                            <div class="col-md-6">
                                <input type="text" name="employee_number" class="form-control" value="{{ old('employee_number', $user->employee_number) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ID_number" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">ID number:</label>
                            <div class="col-md-6">
                                <input type="text" name="ID_number" class="form-control" value="{{ old('ID_number', $user->ID_number) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address_in_ID" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Address in ID:</label>
                            <div class="col-md-6">
                                <input type="text" name="address_in_ID" class="form-control" value="{{ old('address_in_ID', $user->address_in_ID) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="current_address" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Current Address:</label>
                            <div class="col-md-6">
                                <input type="text" name="current_address" class="form-control" value="{{ old('current_address', $user->current_address) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="slava" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Slava:</label>
                            <div class="col-md-6">
                                <input type="text" name="slava" class="form-control" value="{{ old('slava', $user->slava) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="emergency_contact_name" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Emergency Contact Name:</label>
                            <div class="col-md-6">
                                <input type="text" name="emergency_contact_name" class="form-control" value="{{ old('emergency_contact_name', $user->emergency_contact_name) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="emergency_contact_number" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Emergency Contact Number:</label>
                            <div class="col-md-6">
                                <input type="text" name="emergency_contact_number" class="form-control" value="{{ old('emergency_contact_number', $user->emergency_contact_number) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="passport_number" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Passport Number:</label>
                            <div class="col-md-6">
                                <input type="text" name="passport_number" class="form-control" value="{{ old('passport_number', $user->passport_number) }}">
                            </div>
                        </div>
                        <!--
                        <div class="form-group row">
                            <label for="profile_image" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Change Profile Image:</label>
                            <div class="col-md-6">
                                <input type="file" name="profile_image" class="form-control" value="{{ old('profile_image', $user->profile_image) }}">
                            </div>
                        </div>
-->
                        <div class="form-group row">
                            <label for="manager" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Manager:</label>
                            <div class="col-md-6">
                                <select name="manager" class="form-control">
                                    <option value="0" @if(!$user->manager) selected @endif>No</option>
                                    <option value="1" @if($user->manager) selected @endif>Yes</option>
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