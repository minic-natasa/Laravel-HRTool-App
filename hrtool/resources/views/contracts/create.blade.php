@extends('admin.master')
@section('admin')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <a href="{{route('contracts.profile', ['id' => $employee->id])}}" class="btn" style="margin-right:5px;"><i class="fa fa-caret-left" title="Back"></i></a>
                        <h4 class="font-size-16" style="margin-left: 10px; margin-top:5px;">CREATE NEW CONTRACT </h4>
                    </div>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">HRTool</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('contracts.index') }}">Contracts</a>
                            <li class="breadcrumb-item active">Create New Contract</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

    </div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 text-gray-900 dark:text-gray-100">

                <form method="POST" action="{{ route('contracts.store') }}">
                    @csrf

                    <input type="hidden" name="status" value="active">
                    <input type="hidden" name="employee_number" value="{{ $employee->id }}">

                    Employee: {{$employee->first_name}} {{$employee->last_name}}

                    <div class="form-group row">
                        <label for="start_date" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Start Date') }}</label>

                        <div class="col-md-6">
                            <input id="start_date" type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{ old('start_date') }}" required autocomplete="start_date">

                            @error('start_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="organization_id" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Organization Unit') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" id="organization_id" name="organization_id" data-placeholder="-- Select organization unit --">
                                <option value="">-- Select organization unit -- </option>
                                @foreach ($organizations as $organization)
                                <option value="{{ $organization->id }}">{{ $organization->name }}</option>
                                @endforeach
                            </select>
                            @error('organization_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="position" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Position') }}</label>
                        <div class="col-md-6">
                            <select name="position" id="position" class="form-control" disabled>
                                <option value="">-- Select organization unit first -- </option>
                            </select>

                            @error('position')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <script>
                        $(document).ready(function() {

                            $('#position').prop('disabled', true);

                            $('#organization_id').change(function() {
                                var organization_id = $(this).val();
                                $('#position').prop('disabled', false);
                                var org_name = $('#organization_id option:selected').text();

                                $.ajax({
                                    url: "{{ route('positions.get-by-organization') }}",
                                    type: 'GET',
                                    data: {
                                        organization_id: organization_id
                                    },
                                    success: function(response) {
                                        $('#position').html('<option value=""> -- Select position from ' + org_name + ' unit -- </option>');
                                        $.each(response.positions, function(index, position) {
                                            $('#position').append('<option value="' + position.id + '">' + position.name + '</option>');
                                        });
                                    },
                                    error: function(xhr) {
                                        console.log(xhr.responseText);
                                    }
                                });
                            });
                        });
                    </script>

                    <div class="form-group row">
                        <label for="type_of_contract" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Type of Contract') }}</label>
                        <div class="col-md-6">
                            <select id="type_of_contract" class="form-control @error('type_of_contract') is-invalid @enderror" name="type_of_contract" required>
                                <option value=""> -- Select contract type -- </option>
                                <option value="Ugovor o radu" {{ old('type_of_contract') == 'Ugovor o radu' ? 'selected' : '' }}>Ugovor o radu</option>
                                <option value="Ugovor o poslovno-tehničkoj saradnji" {{ old('type_of_contract') == 'Ugovor o poslovno-tehničkoj saradnji' ? 'selected' : '' }}>Ugovor o poslovno-tehničkoj saradnji</option>
                            </select>
                            @error('type_of_contract')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="contract_number" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Contract Number') }}</label>

                        <div class="col-md-6">
                            <input id="contract_number" type="text" class="form-control @error('contract_number') is-invalid @enderror" name="contract_number" value="{{ old('contract_number') }}" required autocomplete="contract_number">

                            @error('contract_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="contract_duration" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Contract Duration') }}</label>

                        <div class="col-md-6">
                            <input id="contract_duration" type="text" class="form-control @error('contract_duration') is-invalid @enderror" name="contract_duration" value="{{ old('contract_duration') }}" required autocomplete="contract_duration">

                            @error('contract_duration')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="net_salary" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Net Salary') }}</label>

                        <div class="col-md-6">
                            <input id="net_salary" type="text" class="form-control @error('net_salary') is-invalid @enderror" name="net_salary" value="{{ old('net_salary') }}" required autocomplete="net_salary" autofocus>

                            @error('net_salary')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="gross_salary_1" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Gross Salary 1') }}</label>

                        <div class="col-md-6">
                            <input id="gross_salary_1" type="text" class="form-control @error('gross_salary_1') is-invalid @enderror" name="gross_salary_1" value="{{ old('gross_salary_1') }}" required autocomplete="gross_salary_1">

                            @error('gross_salary_1')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="gross_salary_2" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Gross Salary 2') }}</label>

                        <div class="col-md-6">
                            <input id="gross_salary_2" type="text" class="form-control @error('gross_salary_2') is-invalid @enderror" name="gross_salary_2" value="{{ old('gross_salary_2') }}" required autocomplete="gross_salary_2">

                            @error('gross_salary_2')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="location_of_work" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Location of Work') }}</label>

                        <div class="col-md-6">
                            <select id="location_of_work" class="form-control @error('location_of_work') is-invalid @enderror" name="location_of_work" required>
                                <option value=""> -- Select location of work -- </option>
                                <option value="Hybrid" {{ old('location_of_work') == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                                <option value="Remote" {{ old('location_of_work') == 'Remote' ? 'selected' : '' }}>Remote</option>
                            </select>
                            @error('type_of_contract')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="transportation" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Transportation') }}</label>
                        <div class="col-md-6">
                            <select id="transportation" class="form-control @error('transportation') is-invalid @enderror" name="transportation" required>
                                <option value=""> -- Select transportation type -- </option>
                                <option value="Public Transportation" {{ old('transportation') == 'Public Transportation' ? 'selected' : '' }}>Public Transportation</option>
                                <option value="Private Car" {{ old('transportation') == 'Private Car' ? 'selected' : '' }}>Private Car</option>
                                <option value="Remote allowance" {{ old('transportation') == 'Remote allowance' ? 'selected' : '' }}>Remote allowance</option>
                            </select>
                            @error('type_of_contract')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
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
                        <label for="professional_requirements_per_job_systematisation" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Professional Requirements per Job Systematisation') }}</label>

                        <div class="col-md-6">
                            <input id="professional_requirements_per_job_systematisation" type="text" class="form-control @error('professional_requirements_per_job_systematisation') is-invalid @enderror" name="professional_requirements_per_job_systematisation" value="{{ old('professional_requirements_per_job_systematisation') }}" required autocomplete="professional_requirements_per_job_systematisation">

                            @error('professional_requirements_per_job_systematisation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
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