@extends('admin.master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <a href="{{ route('positions.index') }}" class="btn" style="margin-right:5px"><i class="fa fa-caret-left" title="Back"></i></a>
                        <h4 class="font-size-16" style="margin-left: 10px; margin-top:5px;">CREATE NEW POSITION</h4>
                    </div>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">HRTool</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('positions.index') }}">Positions</a>
                            <li class="breadcrumb-item active">Create New Position</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('positions.store') }}" method="POST">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Name:</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Description:</label>

                            <div class="col-md-6">
                                <textarea class="form-control" id="description" name="description" rows="3" style="margin-bottom: 4px;"></textarea>
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="organization_id" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Organization:</label>
                            <div class="col-md-6">
                                <select class="form-control" id="organization_id" name="organization_id">
                                    <option value="">-- Select organization --</option>
                                    @foreach ($organizations as $org)
                                    <option value="{{ $org->id }}">{{ $org->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="professional_qualifications_level" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Professional Qualifications Level') }}</label>

                            <div class="col-md-6">
                                <select id="professional_qualifications_level" class="form-control @error('professional_qualifications_level') is-invalid @enderror" name="professional_qualifications_level" required>
                                    <option value=""> -- Select professional qualifications level -- </option>
                                    <option value="I" {{ old('professional_qualifications_level') == 'I' ? 'selected' : '' }}>I</option>
                                    <option value="II" {{ old('professional_qualifications_level') == 'II' ? 'selected' : '' }}>II</option>
                                    <option value="III" {{ old('professional_qualifications_level') == 'III' ? 'selected' : '' }}>III</option>
                                    <option value="IV" {{ old('professional_qualifications_level') == 'IV' ? 'selected' : '' }}>IV</option>
                                    <option value="V" {{ old('professional_qualifications_level') == 'V' ? 'selected' : '' }}>V</option>
                                    <option value="VI" {{ old('professional_qualifications_level') == 'VI' ? 'selected' : '' }}>VI</option>
                                    <option value="VII" {{ old('professional_qualifications_level') == 'VII' ? 'selected' : '' }}>VII</option>
                                </select>
                                @error('type_of_contract')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="professional_requirements_per_job_systematisation" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Professional Requirements per Job Systematisation:</label>

                            <div class="col-md-6">
                                <textarea class="form-control" id="professional_requirements_per_job_systematisation" name="professional_requirements_per_job_systematisation" rows="2" style="margin-bottom: 4px;"></textarea>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
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
    <!-- End Page-content -->
    @endsection