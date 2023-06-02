@extends('admin.master')
@section('admin')

@section('title')
Create New Contract | HRTool
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <h4 class="font-size-16" style="margin-left: 10px; margin-top:5px;">CREATE NEW CONTRACT FOR {{$employee->first_name}} {{$employee->last_name}} </h4>
                    </div>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                @if(Auth::user()->hasRole(['admin_hr', 'admin_it']))
                                <a href="{{ route('admin.index') }}">HRTool</a>
                                @else
                                <a href="/homepage">HRTool</a>
                                @endif
                            </li>
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
                        <label for="first_day_on_job" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('First Day On Job') }}</label>

                        <div class="col-md-6">
                            <input id="first_day_on_job" type="date" class="form-control @error('first_day_on_job') is-invalid @enderror" name="first_day_on_job" value="{{ old('first_day_on_job') }}" required autocomplete="first_day_on_job">

                            @error('first_day_on_job')
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
                            <input id="contract_duration" type="text" class="form-control @error('contract_duration') is-invalid @enderror" name="contract_duration" value="{{ old('contract_duration') }}" placeholder="-- Enter unlimited or number of months --" required autocomplete="contract_duration">
                            @error('contract_duration')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row" id="probationary_period_container">
                        <label for="probationary_period" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Probationary Period') }}</label>
                        <div class="col-md-6">
                            <input id="probationary_period" type="text" class="form-control @error('probationary_period') is-invalid @enderror" name="probationary_period" placeholder="-- Select contract duration as unlimited in order to enable this field --" disabled>

                            @error('probationary_period')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <script>
                        const contractDuration = document.querySelector('#contract_duration');
                        const probationaryPeriod = document.querySelector('#probationary_period');

                        // listen for changes to the contract duration input field
                        contractDuration.addEventListener('change', function() {
                            if (contractDuration.value !== 'unlimited') {
                                // set the value of the probationary period input field to 0 and disable it
                                probationaryPeriod.disabled = true;
                                probationaryPeriod.placeholder = '-- Select contract duration as unlimited in order to enable this field-- ';
                            } else {
                                // enable the probationary period input field
                                probationaryPeriod.disabled = false;
                                probationaryPeriod.placeholder = '-- Enter number of months-- ';
                            }
                        });
                    </script>


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
                            <input id="gross_salary_1" type="text" class="form-control" name="gross_salary_1" value="" readonly>
                        </div>
                    </div>

                    <script>
                        const netSalaryInput = document.getElementById('net_salary');
                        const grossSalary1Input = document.getElementById('gross_salary_1');

                        netSalaryInput.addEventListener('input', function() {
                            const netSalary = parseFloat(netSalaryInput.value);
                            const grossSalary1 = (netSalary - 2171.2) / 0.701;

                            grossSalary1Input.value = grossSalary1.toFixed(2);
                        });
                    </script>


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

                    <script>
                        // Get the Location of Work and Transportation select elements
                        const locationSelect = document.getElementById('location_of_work');
                        const transportationSelect = document.getElementById('transportation');

                        // Add an event listener to the Location of Work select element
                        locationSelect.addEventListener('change', function() {
                            // If Hybrid is selected, show Private Car and Public Transportation options
                            if (locationSelect.value === 'Hybrid') {
                                transportationSelect.innerHTML = `
                                <option value="">-- Select transportation type --</option>
                                <option value="Public Transportation">Public Transportation</option>
                                <option value="Private Car">Private Car</option>
                                `;
                            }
                            // If Remote is selected, show Remote Allowance option
                            else if (locationSelect.value === 'Remote') {
                                transportationSelect.innerHTML = `
                                <option value="Remote allowance">Remote allowance</option>
                                `;
                            }
                            // If no option is selected, show the default option
                            else {
                                transportationSelect.innerHTML = `
                                <option value=""> -- Select transportation type -- </option>
                                `;
                            }
                        });
                    </script>


                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary" style="margin-top:10px; margin-bottom:2px">
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