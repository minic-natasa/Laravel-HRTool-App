@extends('admin.master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <a href="{{ route('positions.index') }}" class="btn" style="margin-right:5px;"><i class="fa fa-caret-left" title="Back"></i></a>
                        <h4 class="font-size-16" style="margin-left: 10px; margin-top:5px;">EDIT POSITION</h4>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">HRTool</a></li>
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


                    <form action="{{ route('positions.update', $position->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="name" name="name" value="{{ $position->name }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Description</label>
                            <div class="col-md-6">
                                <textarea class="form-control" id="description" name="description" rows="3" style="margin-bottom: 4px;" required>{{ $position->description }}</textarea>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="organization_id" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Parent Organization</label>
                            <div class="col-md-6">
                                <select class="form-control" id="organization_id" name="organization_id">
                                    @foreach ($organizations as $org)
                                    <option value="{{ $org->id }}" @if ($org->id == $position->organization_id) selected @endif>{{ $org->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="professional_qualifications_level" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Professional Qualifications Level:</label>
                            <div class="col-md-6">
                                <select name="professional_qualifications_level" class="form-control">
                                    <option value="I" {{ $position->professional_qualifications_level == 'I' ? 'selected' : '' }}>I</option>
                                    <option value="II" {{ $position->professional_qualifications_level == 'II' ? 'selected' : '' }}>II</option>
                                    <option value="III" {{ $position->professional_qualifications_level == 'III' ? 'selected' : '' }}>III</option>
                                    <option value="IV" {{ $position->professional_qualifications_level == 'IV' ? 'selected' : '' }}>IV</option>
                                    <option value="V" {{ $position->professional_qualifications_level == 'V' ? 'selected' : '' }}>V</option>
                                    <option value="VI" {{ $position->professional_qualifications_level == 'VI' ? 'selected' : '' }}>VI</option>
                                    <option value="VII" {{ $position->professional_qualifications_level == 'VII' ? 'selected' : '' }}>VII</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="professional_requirements_per_job_systematisation" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Professional Requirements per Job Systematisation:</label>
                            <div class="col-md-6">
                                <textarea class="form-control" id="professional_requirements_per_job_systematisation" name="professional_requirements_per_job_systematisation" rows="2" style="margin-bottom: 4px;" required>{{ $position->professional_requirements_per_job_systematisation }}</textarea>
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