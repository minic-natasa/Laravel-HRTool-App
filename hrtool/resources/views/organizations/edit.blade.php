@extends('admin.master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">EDIT ORGANIZATION</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">HRTool</a></li>
                            <li class="breadcrumb-item active">Organizations</li>
                            <li class="breadcrumb-item active">Edit Organization</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('organizations.index') }}" class="btn btn-primary mb-3">Back</a>
                </div>
            </div>
        </div>



        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 text-gray-900 dark:text-gray-100">


                    <form action="{{ route('organizations.update', $organization->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="name" name="name" value="{{ $organization->name }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="manager" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Manager</label>
                            <div class="col-md-6">
                                <select class="form-control" id="manager_id" name="manager_id">
                                    <option value="">None</option>
                                    @foreach ($managers as $manager)
                                    <option value="{{ $manager->id }}">{{ $manager->first_name }} {{ $manager->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="parent_id" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Parent Organization</label>
                            <div class="col-md-6">
                                <select class="form-control" id="parent_id" name="parent_id">
                                    <option value="">None</option>
                                    @foreach ($organizations as $org)
                                    <option value="{{ $org->id }}" {{ $org->id == $organization->parent_id ? 'selected' : '' }}>{{ $org->name }}</option>
                                    @endforeach
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