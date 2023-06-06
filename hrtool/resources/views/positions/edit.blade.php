@extends('admin.master')
@section('admin')

@section('title')
Edit Position | HRTool
@endsection

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <h4 class="font-size-16" style="margin-left: 10px; margin-top:5px;">EDIT POSITION</h4>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    @if(Auth::user()->hasRole(['admin_hr', 'admin_it']))
                                    <a href="{{ route('admin.index') }}">HRTool</a>
                                    @else
                                    <a href="/homepage">HRTool</a>
                                    @endif
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('positions.index') }}">Positions</a>
                                <li class="breadcrumb-item active">Edit Position</li>
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

                    <style>
                        .form-group {
                            margin-left: 1vw;
                        }
                    </style>

                    <form action="{{ route('positions.update', $position->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right" style="margin-bottom: 4px;">Name:</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="name" name="name" value="{{ $position->name }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="organization_id" class="col-md-3 col-form-label text-md-right" style="margin-bottom: 1vh;">Organization:</label>
                            <div class="col-md-4">
                                <select class="form-control" id="organization_id" name="organization_id">
                                    @foreach ($organizations as $org)
                                    <option value="{{ $org->id }}" @if ($org->id == $position->organization_id) selected @endif>{{ $org->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-3 col-form-label text-md-right" style="margin-bottom: 4px;">Description:</label>
                            <div class="col-md-6">
                                <textarea class="form-control" id="description" name="description" rows="8" style="margin-bottom: 1vh;" required>{{ $position->description }}</textarea>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="professional_requirements_per_job_systematisation" class="col-md-3 col-form-label text-md-right" style="margin-bottom: 4px; padding-right:7vw">Professional Requirements per Job Systematisation:</label>
                            <div class="col-md-6">
                                <textarea class="form-control" id="professional_requirements_per_job_systematisation" name="professional_requirements_per_job_systematisation" rows="7" style="margin-bottom: 4px;" required>{{ $position->professional_requirements_per_job_systematisation }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-3">
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