@extends('admin.master')
@section('admin')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <a href="{{ route('contracts.index') }}" class="btn" style="margin-right:5px;"><i class="fa fa-caret-left" title="Back"></i></a>
                        <h4 class="font-size-16" style="margin-left: 10px; margin-top:5px;">EDIT CONTRACT</h4>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">HRTool</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('contracts.index') }}">Contracts</a>
                                <li class="breadcrumb-item active">Edit Contract</li>
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

                    <form method="POST" action="{{ route('contracts.update', $contract->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="start_date" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Start Date:</label>
                            <div class="col-md-6">
                                <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $contract->start_date) }}">
                            </div>
                        </div>

                        @php
                        $selectedOrganizationId = $contract->organization_id;
                        @endphp

                        <div class="form-group row">
                            <label for="organization_id" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Organization Unit:</label>
                            <div class="col-md-6">
                                <select name="organization_id" class="form-control" id="organization_id">
                                    @foreach ($organizations as $organization)
                                    <option value="{{ $organization->id }}" {{ $contract->organization_id == $organization->id ? 'selected' : '' }}>{{ $organization->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="position" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Position:</label>
                            <div class="col-md-6">
                                <select name="position" id="position" class="form-control">


                                    @foreach ($positions as $pos)
                                    @if ($pos->organization_id == $selectedOrganizationId)
                                    <option value="{{ $pos->id }}" {{ $contract->position == $pos->id ? 'selected' : '' }}>{{ $pos->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <script>
                            $(document).ready(function() {

                                $('#organization_id').change(function() {
                                    var organization_id = $(this).val();
                                    var selectedOrganizationId = $(this).val();
                                    var org_name = $('#organization_id option:selected').text();

                                    $.ajax({
                                        url: "{{ route('positions.get-by-organization') }}",
                                        type: 'GET',
                                        data: {
                                            organization_id: organization_id
                                        },
                                        success: function(response) {
                                            $('#position').empty().append('<option value="">-- Select position from ' + org_name + ' unit --</option>');

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
                            <label for="type_of_contract" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Type of Contract:</label>
                            <div class="col-md-6">
                                <select name="type_of_contract" class="form-control">
                                    <option value="Ugovor o radu" {{ $contract->type_of_contract == 'Ugovor o radu' ? 'selected' : '' }}>Ugovor o radu</option>
                                    <option value="Ugovor o poslovno-tehničkoj saradnji" {{ $contract->type_of_contract == 'Ugovor o poslovno-tehničkoj saradnji' ? 'selected' : '' }}>Ugovor o poslovno-tehničkoj saradnji</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contract_number" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Contract Number:</label>
                            <div class="col-md-6">
                                <input type="text" name="contract_number" class="form-control" value="{{ old('contract_number', $contract->contract_number) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contract_duration" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Contract Duration:</label>
                            <div class="col-md-6">
                                <input type="text" name="contract_duration" class="form-control" value="{{ old('contract_duration', $contract->contract_duration) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="net_salary" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Net Salary:</label>
                            <div class="col-md-6">
                                <input type="text" name="net_salary" class="form-control" value="{{ old('net_salary', $contract->net_salary) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gross_salary_1" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Gross Salary 1:</label>
                            <div class="col-md-6">
                                <input type="text" name="gross_salary_1" class="form-control" value="{{ old('gross_salary_1', $contract->gross_salary_1) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gross_salary_2" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Gross Salary 2:</label>
                            <div class="col-md-6">
                                <input type="text" name="gross_salary_2" class="form-control" value="{{ old('gross_salary_2', $contract->gross_salary_2) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="location_of_work" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Location of Work:</label>
                            <div class="col-md-6">
                                <select name="location_of_work" class="form-control">
                                    <option value="Hybrid" {{ $contract->location_of_work == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                                    <option value="Remote" {{ $contract->location_of_work == 'Remote' ? 'selected' : '' }}>Remote</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="transportation" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Transportation:</label>
                            <div class="col-md-6">
                                <select name="transportation" class="form-control">
                                    <option value="Public Transportation" {{ $contract->transportation == 'Public Transportation' ? 'selected' : '' }}>Public Transportation</option>
                                    <option value="Private Car" {{ $contract->transportation == 'Private Car' ? 'selected' : '' }}>Private Car</option>
                                    <option value="Remote allowance" {{ $contract->transportation == 'Remote allowance' ? 'selected' : '' }}>Remote allowance</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="professional_qualifications_level" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Professional Qualifications Level:</label>
                            <div class="col-md-6">
                                <select name="professional_qualifications_level" class="form-control">
                                    <option value="I" {{ $contract->professional_qualifications_level == 'I' ? 'selected' : '' }}>I</option>
                                    <option value="II" {{ $contract->professional_qualifications_level == 'II' ? 'selected' : '' }}>II</option>
                                    <option value="III" {{ $contract->professional_qualifications_level == 'III' ? 'selected' : '' }}>III</option>
                                    <option value="IV" {{ $contract->professional_qualifications_level == 'IV' ? 'selected' : '' }}>IV</option>
                                    <option value="V" {{ $contract->professional_qualifications_level == 'V' ? 'selected' : '' }}>V</option>
                                    <option value="VI" {{ $contract->professional_qualifications_level == 'VI' ? 'selected' : '' }}>VI</option>
                                    <option value="VII" {{ $contract->professional_qualifications_level == 'VII' ? 'selected' : '' }}>VII</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="professional_requirements_per_job_systematisation" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Professional Requirements per Job Systematisation:</label>
                            <div class="col-md-6">
                                <input type="text" name="professional_requirements_per_job_systematisation" class="form-control" value="{{ old('professional_requirements_per_job_systematisation', $contract->professional_requirements_per_job_systematisation) }}">
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