@extends('admin.master')
@section('admin')

@section('title')
Create New Annex | HRTool
@endsection


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <h4 class="font-size-16" style="margin-left: 10px; margin-top:5px;">CREATE NEW ANNEX</h4>
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
                            <li class="breadcrumb-item active">Create New Annex</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 text-gray-900 dark:text-gray-100" style="padding-left: 4vw;">

                <form method="POST" action="{{ route('annexes.store') }}">
                    @csrf

                    <input type="hidden" name="contract_id" value="{{ $contract->id }}">
                    <input type="hidden" name="deleted" value="0">

                    <div class="form-group row" id="reason_div">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Reason:') }}</label>

                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="reason[]" id="reason1" value="Povećanje bruto 1 zarade" onclick="toggleDiv('salary_div', this.checked)" {{ old('reason.0') == 'Povećanje bruto 1 zarade' ? 'checked' : '' }}>
                                <label class="form-check-label" for="reason1">
                                    Povećanje bruto 1 zarade
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="reason[]" id="reason2" value="Promena pozicije" onclick="toggleDiv('position_div', this.checked)" {{ old('reason.1') == 'Promena pozicije' ? 'checked' : '' }}>
                                <label class="form-check-label" for="reason2">
                                    Promena pozicije
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="reason[]" id="reason3" value="Promena adrese obavljanja posla" onclick="toggleDiv('address_div', this.checked)" {{ old('reason.2') == 'Promena adrese obavljanja posla' ? 'checked' : '' }}>
                                <label class="form-check-label" for="reason3">
                                    Promena adrese obavljanja posla
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="reason[]" id="reason4" value="Promena adrese poslodavca" onclick="toggleDiv('employer_address_div', this.checked)" {{ old('reason.3') == 'Promena adrese poslodavca' ? 'checked' : '' }}>
                                <label class="form-check-label" for="reason4">
                                    Promena adrese poslodavca
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="reason[]" id="reason5" value="Promena radnih sati" onclick="toggleDiv('working_hours_div', this.checked)" {{ old('reason.4') == 'Promena radnih sati' ? 'checked' : '' }}>
                                <label class="form-check-label" for="reason5" style="margin-bottom: 2vh;">
                                    Promena radnih sati
                                </label>
                            </div>

                            @error('reason')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="parent-div" id="salary_div" style="display: none;">
                        <div class="form-group row" id="old_gross_salary_div">
                            <label for="old_gross_salary_value" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Current Gross 1 Salary:') }}</label>
                            <div class="col-md-6">
                                @php
                                $reasonToSearch = 'Povećanje bruto 1 zarade';
                                $latestAnnexGross = $contract->annexes()
                                ->where('deleted', 0)
                                ->whereRaw("FIND_IN_SET('$reasonToSearch', reason) > 0")
                                ->orderByDesc('annex_date')
                                ->first();

                                $grossSalaryValue = $latestAnnexGross ? $latestAnnexGross->gross_salary : $contract->gross_salary_1;
                                @endphp

                                <input id="old_gross_salary_value" type="text" class="form-control" name="old_gross_salary" value="{{ $grossSalaryValue }}" readonly>

                                @error('old_gross_salary_value')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row" id="net_salary_div">
                            <label for="net_salary_value" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Net Salary:</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" id="net_salary_value" name="net_salary_value" placeholder="-- Enter net salary --">
                            </div>
                        </div>

                        <div class="form-group row" id="gross_salary_div">
                            <label for="gross_salary_value" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Gross 1 Salary:</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" id="gross_salary_value" name="gross_salary" placeholder="-- Enter net salary first --" readonly>
                            </div>
                        </div>

                        <script>
                            $(document).ready(function() {
                                var net_salary_value = document.getElementById('net_salary_value');
                                var gross_salary_value = document.getElementById('gross_salary_value');

                                net_salary_value.addEventListener('input', function() {
                                    var net_salary = parseFloat(net_salary_value.value);
                                    if (!isNaN(net_salary)) {
                                        var gross_1_salary = (net_salary - 2171.2) / 0.701;
                                        gross_salary_value.value = gross_1_salary.toFixed(2);
                                    }
                                });

                            });
                        </script>


                    </div>

                    <div class="parent-div" id="position_div" style="display: none;">
                        <div class="form-group row" id="old_position_div">
                            <label for="old_position_value" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Current Position:') }}</label>
                            <div class="col-md-6">

                                @php
                                $reasonToSearch = 'Promena pozicije';
                                $latestAnnexPos = $contract->annexes()
                                ->where('deleted', 0)
                                ->whereRaw("FIND_IN_SET('$reasonToSearch', reason) > 0")
                                ->orderByDesc('annex_date')
                                ->first();
                                $positionValue = $latestAnnexPos ? $latestAnnexPos->position : $contract->organization->position->where('id', $contract->position)->first()->name;
                                @endphp

                                <input id="old_position_value" type="text" class="form-control" name="old_position" value="{{ $positionValue }}" readonly>
                                @error('old_position_value')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row" id="organization_div">
                            <label for="organization_value" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Organization Unit:') }}</label>
                            <div class="col-md-6">
                                <select class="form-control" id="organization_value" name="organization_value" data-placeholder="-- Select organization unit --">
                                    <option value="">-- Select organization unit -- </option>
                                    @foreach ($organizations as $organization)
                                    <option value="{{ $organization->id }}">{{ $organization->name }}</option>
                                    @endforeach
                                </select>
                                @error('organization_value')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row" id="position_div">
                            <label for="position_value" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Position:') }}</label>
                            <div class="col-md-6">
                                <select name="position" id="position_value" class="form-control" disabled>
                                    <option value="">-- Select organization unit first -- </option>
                                </select>

                                @error('position_value')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <script>
                            $(document).ready(function() {
                                $('#organization_value').change(function() {
                                    var organization_id = $(this).val();
                                    var org_name = $('#organization_value option:selected').text();
                                    if (organization_id) {
                                        $.ajax({
                                            url: "{{ route('positions.get-by-organization') }}",
                                            type: 'GET',
                                            data: {
                                                organization_id: organization_id
                                            },
                                            success: function(response) {
                                                $('#position_value').html('<option value=""> -- Select position from ' + org_name + ' unit -- </option>');
                                                $.each(response.positions, function(index, position) {
                                                    $('#position_value').append('<option value="' + position.name + '">' + position.name + '</option>');
                                                });
                                                $('#position_value').prop('disabled', false);
                                            },
                                            error: function(xhr) {
                                                console.log(xhr.responseText);
                                            }
                                        });
                                    } else {
                                        $('#position_value').empty().append('<option value="">-- Select organization unit first --</option>');
                                        $('#position_value').prop('disabled', true);
                                    }
                                });
                            });
                        </script>


                    </div>

                    <div class="parent-div" id="address_div" style="display: none;">
                        <div class="form-group row" id="old_address_of_work_div">
                            <label for="old_address_of_work_value" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Current Address of Work:') }}</label>
                            <div class="col-md-6">

                                @php
                                $reasonToSearch = 'Promena adrese obavljanja posla';
                                $latestAnnexAdd = $contract->annexes()
                                ->where('deleted', 0)
                                ->whereRaw("FIND_IN_SET('$reasonToSearch', reason) > 0")
                                ->orderByDesc('annex_date')
                                ->first();

                                $reasonToSearchE = 'Promena adrese poslodavca';
                                $latestAnnexEmpl = $contract->annexes()
                                ->where('deleted', 0)
                                ->whereRaw("FIND_IN_SET('$reasonToSearchE', reason) > 0")
                                ->orderByDesc('annex_date')
                                ->first();

                                $addressValue = $latestAnnexAdd ? $latestAnnexAdd->address_of_work : (
                                $contract->location_of_work === 'Remote' ? $contract->employee->current_address :
                                ($latestAnnexEmpl ? $latestAnnexEmpl->address_of_employer : "Makedonska 12, Beograd"));

                                @endphp

                                <input id="old_address_of_work_value" type="text" class="form-control" name="old_address_of_work" value="{{ $addressValue }}" readonly>

                                @error('old_address_of_work_value')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row" id="location_div">
                            <label for="location_value" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Location of Work:</label>
                            <div class="col-md-6">
                                <select id="location_value" class="form-control @error('location_value') is-invalid @enderror" name="location_value">
                                    <option value=""> -- Select location of work -- </option>
                                    <option value="Hybrid" {{ old('location_value') == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                                    <option value="Remote" {{ old('location_value') == 'Remote' ? 'selected' : '' }}>Remote</option>
                                </select>
                                @error('location_value')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row" id="address_of_work_div">
                            <label for="address_of_work_value" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Address of Work:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="address_of_work_value" name="address_of_work" placeholder="" readonly>
                                @error('address_of_work')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <script>
                            $(document).ready(function() {
                                $('#location_value').change(function() {
                                    var location = $('#location_value').val();
                                    var address = "";

                                    if (location === 'Hybrid') {
                                        address = "{{ $latestAnnexEmpl ? $latestAnnexEmpl->address_of_employer : 'Makedonska 12, Beograd' }}";
                                    } else if (location === 'Remote') {
                                        address = "{{ $contract->employee->current_address }}";
                                    }

                                    $('#address_of_work_value').val(address);
                                });
                            });
                        </script>


                    </div>

                    <div class="parent-div" id="employer_address_div" style="display: none;">
                        <div class="form-group row" id="old_address_of_employer_div">
                            <label for="old_address_of_employer_value" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Current Address of Employer:') }}</label>
                            <div class="col-md-6">
                                @php
                                $reasonToSearch = 'Promena adrese poslodavca';
                                $latestAnnexEmpl = $contract->annexes()
                                ->where('deleted', 0)
                                ->whereRaw("FIND_IN_SET('$reasonToSearch', reason) > 0")
                                ->orderByDesc('annex_date')
                                ->first();
                                $employerValue = $latestAnnexEmpl ? $latestAnnexEmpl->address_of_employer : "Makedonska 12, Beograd";
                                @endphp

                                <input id="old_address_of_employer_value" type="text" class="form-control" name="old_address_of_employer" value="{{ $employerValue }}" readonly>
                                @error('old_address_of_employer_value')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row" id="address_of_employer_div">
                            <label for="address_of_employer_value" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Address of Employer:</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" id="address_of_employer_value" name="address_of_employer" placeholder="">
                                @error('address_of_employer_value')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="parent-div" id="working_hours_div" style="display: none;">
                        <div class="form-group row" id="old_working_hours_div">
                            <label for="old_working_hours_value" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Current Working Hours:') }}</label>
                            <div class="col-md-6">
                                @php
                                $reasonToSearch = 'Promena radnih sati';
                                $latestAnnexWH = $contract->annexes()
                                ->where('deleted', 0)
                                ->whereRaw("FIND_IN_SET('$reasonToSearch', reason) > 0")
                                ->orderByDesc('annex_date')
                                ->first();
                                $workingHoursValue = $latestAnnexWH ? $latestAnnexWH->working_hours : "40";
                                @endphp


                                <input id="old_working_hours_value" type="text" class="form-control" name="old_working_hours" value="{{ $workingHoursValue }}" readonly>
                                @error('old_working_hours_value')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row" id="working_hours_div">
                            <label for="working_hours_value" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">Working Hours:</label>

                            <div class="col-md-6">

                                <input type="text" class="form-control" id="working_hours_value" name="working_hours" placeholder="">
                                @error('working_hours_value')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="annex_created_date" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Created Date:') }}</label>

                        <div class="col-md-6">
                            <input id="annex_created_date" type="date" class="form-control @error('annex_created_date') is-invalid @enderror" name="annex_created_date" value="{{ old('annex_created_date') }}" required autocomplete="annex_created_date">

                            @error('annex_created_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="annex_date" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Start Date:') }}</label>

                        <div class="col-md-6">
                            <input id="annex_date" type="date" class="form-control @error('annex_date') is-invalid @enderror" name="annex_date" value="{{ old('annex_date') }}" required autocomplete="annex_date">

                            @error('annex_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

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

<script>
    function toggleDiv(divId, isVisible) {
        var div = document.getElementById(divId);
        if (isVisible) {
            div.style.display = "block";
        } else {
            div.style.display = "none";
        }
    }
</script>

<!-- End Page-content -->
@endsection