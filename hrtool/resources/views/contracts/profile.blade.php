@extends('admin.master')
@section('admin')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        @if(Auth::user()->id == $user_id)
                        <a href="{{route('profile.show')}}" class="btn" style="margin-right:5px;"><i class="fa fa-caret-left" title="Back"></i></a>
                        @else
                        <a href="{{route('users.profile-card', ['id' => $user_id])}}" class="btn" style="margin-right:5px;"><i class="fa fa-caret-left" title="Back"></i></a>
                        @endif

                        <h4 class="font-size-16" style="margin-left: 10px; margin-top:5px;">CONTRACTS</h4>
                    </div>

                    <div class="d-flex align-items-center">
                        <a href="{{route('contracts.create', ['id' => $user_id])}}" class="btn btn-outline-primary waves-effect waves-light" style="margin-right:5px"><i class="fas fa-pencil-alt" title="Create"></i> Create New Contract</a>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <!--
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="#" class="btn btn-primary mb-3">Create New Annex</a>
                </div>
                -->
            </div>
        </div>

        @foreach ($contracts as $contract)
        @if($contract->status == 'active')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body" id="contract-{{$contract->id}}">


                        <div class="row">
                            <!-- Contract Details -->
                            <div class="row align-items-center" style="margin-bottom: 10px; margin-left:3px">
                                <!-- Logo -->
                                <div class="col-auto">
                                    <img src="{{ asset('logo.png') }}" alt="Logo" height="30">
                                </div>
                                <!-- Employee Details -->
                                <div class="col">
                                    <h2 class="font-size-14" style="margin-bottom: 3px; letter-spacing: 0.6px; color: black;"><strong><a href="{{ route('users.profile-card', $employee->id) }}" style="color: black;">{{$employee->first_name}} {{$employee->last_name}}</a></strong></h2>
                                    <p class="mb-0"><small>Professional Qualifications Level: {{$employee->professional_qualifications_level}} - {{$employee->profession}}</small></p>
                                </div>

                                <!-- Contract Number -->
                                <div class="col-auto text-end">
                                    <h4 class="font-size-14"><strong>Contract # {{$contract->contract_number}}</strong></h4>
                                </div>
                            </div>
                            <hr>

                            <!-- Contract information -->
                            <div class="col-6">
                                <address style="font-size: 13px; padding-left:3px;">
                                    <strong>Start Date:</strong>
                                    <span style="display: block; margin-bottom: 8px;">{{ date('d.m.Y.', strtotime($contract->start_date)) }}</span>
                                    <strong>First Day On Job:</strong>
                                    <span style="display: block; margin-bottom: 8px;">{{ date('d.m.Y.', strtotime($contract->first_day_on_job)) }}</span>
                                    <strong>Contract Duration:</strong>
                                    @if($contract->contract_duration == 'unlimited')
                                    <span style="display: block; margin-bottom: 8px;">Unlimited</span>
                                    @else
                                    <span style="display: block; margin-bottom: 8px;">{{ $contract->contract_duration }} {{ $contract->contract_duration == 1 ? 'month' : 'months' }}</span>
                                    <strong>End Date:</strong>
                                    <span style="display: block; margin-bottom: 8px;">{{ date('d.m.Y.', strtotime('+' . $contract->contract_duration . ' months', strtotime($contract->start_date))) }}</span>
                                    @endif

                                    @if($contract->contract_duration === 'unlimited' && $contract->probationary_period !== null && $contract->probationary_period !== 0)
                                    <strong>Probationary Period:</strong>
                                    <span style="display: block; margin-bottom: 8px;">{{ $contract->probationary_period }} {{ $contract->probationary_period == 1 ? 'month' : 'months' }}</span>
                                    <strong>End Date For Probationary Period:</strong>
                                    <span style="display: block; margin-bottom: 8px;">{{ date('d.m.Y.', strtotime('+' . $contract->probationary_period . ' months', strtotime($contract->start_date))) }}</span>
                                    @endif
                                </address>

                            </div>

                            <!-- Employee information -->
                            <div class="col-6 text-end">
                                <address style="font-size: 13px; padding-right:3px;">
                                    <strong>Type of Contract:</strong>
                                    <span style="display: block; margin-bottom: 8px;">{{$contract->type_of_contract}}</span>
                                    <strong>Location of Work:</strong>
                                    <span style="display: block; margin-bottom: 8px;">{{$contract->location_of_work}}</span>
                                    <strong>Transportation:</strong>
                                    <span style="display: block; margin-bottom: 8px;">{{$contract->transportation}}</span>
                                </address>
                            </div>
                        </div>

                        <!-- Employee table -->
                        <div class="row">
                            <div class="col-12">
                                <div>

                                    <div class="">
                                        <div class="table-responsive">
                                            <table class="table" style="font-size: 13px;">
                                                <thead>
                                                    <tr>
                                                        <td class="text-center"><strong>Organization Unit</strong></td>
                                                        <td class="text-center"><strong>Position</strong></td>
                                                        <td class="text-center"><strong>Net Salary</strong></td>
                                                        <td class="text-center"><strong>Gross Salary 1</strong></td>
                                                        <td class="text-center"><strong>Gross Salary 2</strong></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center">
                                                            @php
                                                            $annex = $contract->annexes()->where('reason', 'Promene pozicije')->orderByDesc('created_at')->first();
                                                            $annexPositionName = $annex ? $annex->new_value : '';
                                                            $currentOrganization = $contract->organization;
                                                            $annexOrganization = '';

                                                            if ($annex) {
                                                            foreach ($organizations as $org) {
                                                            foreach ($org->position as $pos) {
                                                            if ($pos->name == $annexPositionName) {
                                                            $annexOrganization = $pos->organization;
                                                            $annexPosition = $pos;
                                                            break;
                                                            }
                                                            }
                                                            }
                                                            echo '<span title="Organization Changed with Annex"><a id="link" href="' . route('organizations.organization-card', $annexOrganization->id) . '">' . $annexOrganization->name . '</a></span>';

                                                            } else {
                                                            echo '<a id="link" href="' . route('organizations.organization-card', $currentOrganization->id) . '">' . $currentOrganization->name . '</a>';
                                                            }
                                                            @endphp
                                                        </td>

                                                        <td class="text-center">
                                                            @php
                                                            $currentPosition = '';

                                                            foreach ($contract->organization->position as $pos) {
                                                            if ($pos->id == $contract->position){
                                                            $currentPosition = $pos;
                                                            $currentPositionName = $currentPosition->name;
                                                            }
                                                            }

                                                            if ($annex) {

                                                            echo '<span title="Position Changed with Annex"><a id="link" href="' . route('positions.position-card', $annexPosition->id) . '">' . $annexPosition->name . '</a></span>';
                                                            } else {
                                                            echo '<a id="link" href="' . route('positions.position-card', $currentPosition->id) . '">' . $currentPositionName . '</a>';
                                                            }
                                                            @endphp
                                                        </td>

                                                        <td class="text-center">
                                                            @php

                                                            $annexGross = $contract->annexes()->where('reason', 'Povećanja bruto 1 zarade')->orderByDesc('created_at')->first();
                                                            $gross = $annexGross ? $annexGross->new_value : $contract->gross_salary_1;
                                                            $n = $gross * 0.701 + 2171.2;
                                                            $net = $annexGross ? $n : $contract->net_salary;
                                                            if ($annexGross) {
                                                            echo '<span style="cursor: default; font-weight: bold;" title="Value Changed with Annex">' . number_format($net, 2, ',', '.') . ' RSD</span>';
                                                            } else {
                                                            echo number_format($net, 2, ',', '.') . ' RSD';
                                                            }
                                                            @endphp
                                                        </td>

                                                        <td class="text-center" id="gross-annex">
                                                            @php
                                                            $annexGross = $contract->annexes()->where('reason', 'Povećanja bruto 1 zarade')->orderByDesc('created_at')->first();
                                                            $gross = $annexGross ? $annexGross->new_value : $contract->gross_salary_1;
                                                            if ($annexGross) {
                                                            echo '<span style="cursor: default; font-weight: bold;" title="Value Changed with Annex">' . number_format($gross, 2, ',', '.') . ' RSD</span>';
                                                            } else {
                                                            echo number_format($gross, 2, ',', '.') . ' RSD';
                                                            }
                                                            @endphp
                                                        </td>

                                                        <td class="text-center">{{ number_format($contract->gross_salary_2, 2, ',', '.') }} RSD</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <style>
                                                /* Set link color to the same color as normal text */
                                                #link {
                                                    color: inherit;
                                                }

                                                /* Set link color to a different color on hover */
                                                #link:hover {
                                                    color: #002EFF;
                                                }
                                            </style>

                                        </div>

                                        <!-- Documents button -->
                                        <div class="float-end">
                                            <div class="btn-group" role="group">
                                                <button id="btnGroupVerticalDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-file"></i> Documents
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" style="">
                                                    <li><a class="dropdown-item" href="{{ route('contracts.mob', $contract->id) }}" target="_blank">Obaveštenje o mobingu</a></li>
                                                    <li><a class="dropdown-item" href="{{ route('contracts.uzb', $contract->id)}}" target="_blank">Obaveštenje o Zakonu o uzbunjivačima</a></li>
                                                    <li><a class="dropdown-item" href="{{ route('contracts.nda', $contract->id)}}" target="_blank">Sporazum o poverljivosti</a></li>
                                                    <!--<li><a class="dropdown-item" href="{{ route('contracts.odm', $contract->id)}}" target="_blank">Zahtev za korišćenje godišnjeg odmora</a></li>
                                                     <li><a class="dropdown-item" href="{{ route('contracts.rev', $contract->id)}}">Revers</a></li> -->
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Annexes button -->
                                        <div class="float-end">
                                            <div class="btn-group" role="group">
                                                <button id="btnGroupVerticalDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-right:10px">
                                                    <i class="fas fa-file-alt"></i> Annexes
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1">
                                                    <!-- Only show the "See Contract Annexes" button if there are annexes -->
                                                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="openCreateAnnexPopup()">Create New Annex</a></li>
                                                    <li <?php if (count($contract->annexes) == 0) { ?> style="display:none" <?php } ?>><a class="dropdown-item" href="javascript:void(0)" onclick="openAnnexPopup()">See Contract Annexes</a></li>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Print button -->
                                        <div class="d-print-none">
                                            <div class="float-end">
                                                <a href="{{ route('contracts.pdf', $contract->id) }}" class="btn btn-primary waves-effect waves-light" style="margin-right:10px" target="_blank"><i class="fa fa-print"></i> Print</a>
                                            </div>
                                        </div>

                                        <!-- Edit button -->
                                        <div class="d-print-none">
                                            <div class="float-end">
                                                <a href="{{ route('contracts.edit', $contract->id) }}" class="btn btn-primary waves-effect waves-light" style="margin-right:10px"><i class="fas fa-pencil-alt"></i> Edit</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end row -->

                    </div>
                </div>
            </div> <!-- end col -->
        </div>

        @endif
        @endforeach


        <div class="modal fade" id="annexModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Contract Annexes</h5>
                        <button type="btn" class="close" style="color:black; border: none; background: transparent; cursor: pointer" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body" style="height: 55vh;">

                        <div class="table-responsive" style="max-height: 50vh; overflow: scroll;">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Annex</th>
                                        <th>Reason for Annex</th>
                                        <th>Contract Value</th>
                                        <th>New Value</th>
                                        <th>Created At</th>
                                        <th>Start Date</th>
                                        <th>Print</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count = 1; ?>
                                    @foreach ($contract->annexes as $key => $annex)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            @if($annex->reason == 'Povećanja bruto 1 zarade')
                                            Povećanje bruto 1 zarade
                                            @elseif($annex->reason == 'Promene pozicije')
                                            Promena pozicije
                                            @elseif($annex->reason == 'Promene adrese obavljanja posla')
                                            Promena adrese obavljanja posla
                                            @elseif($annex->reason == 'Promene adrese poslodavca')
                                            Promena adrese poslodavca
                                            @elseif($annex->reason == 'Promene radnih sati')
                                            Promena radnih sati
                                            @endif
                                        </td>
                                        <td>{{$annex->old_value}}</td>
                                        <td>{{$annex->new_value}}</td>
                                        <td>{{ date('d.m.Y.', strtotime($annex->annex_created_date)) }}</td>
                                        <td>{{ date('d.m.Y.', strtotime($annex->annex_date)) }}</td>

                                        <td>
                                            <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                                                <div class="btn-group" role="group">
                                                    <button id="btnGroupVerticalDrop1" type="button" class="btn waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="ri-more-line"></i>
                                                    </button>

                                                    <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1">
                                                        <a href="{{ route('annexes.annex-pdf', ['id' => $annex->id, 'annex_number' => $key + 1]) }}" class="btn btn-primary waves-effect waves-light" style="margin-left:10px; margin-right:5px" target="_blank" id="printAnnexBtn"> Annex</a>
                                                        <a href="{{ route('annexes.notice-pdf', $annex->id) }}" class="btn btn-primary waves-effect waves-light" target="_blank" id="printNoticeBtn">Notice</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                                                <div class="btn-group" role="group">
                                                    <button id="btnGroupVerticalDrop1" type="button" class="btn waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="ri-more-line"></i>
                                                    </button>

                                                    <div class="dropdown-menu" id="actionMenu" aria-labelledby="btnGroupVerticalDrop1">
                                                        <a href="{{ route('contracts.edit', $contract->id) }}" class="btn btn-primary" style="margin-right:5px; margin-left:5px"><i class="fas fa-pencil-alt" title="Edit"></i></a>
                                                        <form action="{{ route('annexes.destroy', $annex->id) }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this annex?')"><i class="fa fa-trash" title="Delete"></i></button>
                                                        </form>
                                                    </div>

                                                    <style>
                                                        #actionMenu {
                                                            min-width: 7vw !important;
                                                        }
                                                    </style>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $count++; ?>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>






        <div class="modal fade" id="annexCreateModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Create New Annex</h5>
                        <button type="btn" class="close" style="color:black; border: none; background: transparent; cursor: pointer" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body" style="height: 55vh;">

                        <form action="{{ route('annexes.store') }}" method="POST">
                            @csrf

                            <input type="hidden" name="contract_id" value="{{ $contract->id }}">

                            <div class="form-group row">
                                <label for="reason" class="col-md-3 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Reason:') }}</label>
                                <div class="col-md-8">
                                    <select id="reason" class="form-control @error('reason') is-invalid @enderror" name="reason" onchange="showOrHideFields()" required>
                                        <option value=""> -- Select reason for creating new annex -- </option>
                                        <option value="Povećanja bruto 1 zarade" {{ old('reason') == 'Povećanja bruto 1 zarade' ? 'selected' : '' }}>Povećanje bruto 1 zarade</option>
                                        <option value="Promene pozicije" {{ old('reason') == 'Promene pozicije' ? 'selected' : '' }}>Promena pozicije</option>
                                        <option value="Promene adrese obavljanja posla" {{ old('reason') == 'Promene adrese obavljanja posla' ? 'selected' : '' }}>Promena adrese obavljanja posla</option>
                                        <option value="Promene adrese poslodavca" {{ old('reason') == 'Promene adrese poslodavca' ? 'selected' : '' }}>Promena adrese poslodavca</option>
                                        <option value="Promene radnih sati" {{ old('reason') == 'Promene radnih sati' ? 'selected' : '' }}>Promena radnih sati</option>
                                    </select>
                                    @error('reason')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" id="old_value_container">
                                <label for="old_value" class="col-md-3 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Contract Value:') }}</label>
                                <div class="col-md-8">
                                    <input id="old_value" type="text" class="form-control" name="old_value" value="-- Select reason for creating new annex first --" readonly gross-1-salary="{{ $gross ? $gross : $contract->gross_salary_1 }}" position="{{ $annexPosition ? $annexPosition->name : $contract->organization->position->where('id', $contract->position)->first()->name }}" office-address="Makedonska 12, Beograd" working-hours="40" current-address="{{ $contract->location_of_work === 'Hybrid' ? 'Makedonska 12, Beograd' : $contract->employee->current_address }}">
                                    @error('old_value')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" id="net_salary" style="display: none;">
                                <label for="net_salary_value" class="col-md-3 col-form-label text-md-right" style="margin-bottom: 4px;">Net Salary:</label>

                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="net_salary_value" name="net_salary_value" placeholder="-- Enter Net Salary --" required>
                                </div>
                            </div>


                            <div class="form-group row" id="organizationDiv" style="display: none;">
                                <label for="organization_value" class="col-md-3 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Organization Unit:') }}</label>
                                <div class="col-md-8">
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


                            <div class="form-group row" id="positionDiv" style="display: none;">
                                <label for="position_value" class="col-md-3 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Position:') }}</label>
                                <div class="col-md-8">
                                    <select name="position_value" id="position_value" class="form-control" disabled>
                                        <option value="">-- Select organization unit first -- </option>
                                    </select>

                                    @error('position_value')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" id="locationDiv" style="display: none;">
                                <label for="location_value" class="col-md-3 col-form-label text-md-right" style="margin-bottom: 4px;">Location of Work:</label>

                                <div class="col-md-8">
                                    <select id="location_value" class="form-control @error('location_value') is-invalid @enderror" name="location_value" required>
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

                            <div class="form-group row" id="addressDiv" style="display: none;">
                                <label for="address_value" class="col-md-3 col-form-label text-md-right" style="margin-bottom: 4px;">Current Address:</label>

                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="address_value" name="address_value" placeholder="-- Enter Current Address --" required>
                                </div>
                            </div>

                            <div class="form-group row" id="newValueDiv">
                                <label for="new_value" class="col-md-3 col-form-label text-md-right" style="margin-bottom: 4px;">New Value:</label>

                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="new_value" name="new_value" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="annex_created_date" class="col-md-3 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Created Date:') }}</label>

                                <div class="col-md-8">
                                    <input id="annex_created_date" type="date" class="form-control @error('annex_created_date') is-invalid @enderror" name="annex_created_date" value="{{ old('annex_created_date') }}" required autocomplete="annex_created_date">

                                    @error('annex_created_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="annex_date" class="col-md-3 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Start Date:') }}</label>

                                <div class="col-md-8">
                                    <input id="annex_date" type="date" class="form-control @error('annex_date') is-invalid @enderror" name="annex_date" value="{{ old('annex_date') }}" required autocomplete="annex_date">

                                    @error('annex_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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
</div>

<script>
    const reasonSelect = document.getElementById('reason');

    function showOrHideFields() {
        var reason_for_annex = document.getElementById('reason').value;
        const netSalaryDiv = document.getElementById('net_salary');
        const orgDiv = document.getElementById('organizationDiv');
        const posDiv = document.getElementById('positionDiv');
        const locDiv = document.getElementById('locationDiv');
        const addrDiv = document.getElementById('addressDiv');

        var net_salary_value = document.getElementById('net_salary_value');
        var organization_value = document.getElementById('organization_value');
        var position_value = document.getElementById('position_value');
        var location_value = document.getElementById('location_value');
        var address_value = document.getElementById('address_value');

        if (reason_for_annex == 'Povećanja bruto 1 zarade') {
            netSalaryDiv.style.display = 'flex';
            net_salary_value.required = true;
        } else {
            netSalaryDiv.style.display = 'none';
            net_salary_value.required = false;
            net_salary_value.value = "";
        }

        if (reason_for_annex == 'Promene pozicije') {
            orgDiv.style.display = 'flex';
            posDiv.style.display = 'flex';
            organization_value.required = true;
            position_value.required = true;
            newValueDiv.style.display = 'none';
        } else {
            orgDiv.style.display = 'none';
            posDiv.style.display = 'none';
            organization_value.required = false;
            organization_value.value = "";
            position_value.required = false;
            position_value.value = "";
        }

        if (reason_for_annex == 'Promene adrese obavljanja posla') {
            locDiv.style.display = 'flex';
            location_value.required = true;
            addrDiv.style.display = 'flex';
            address_value.required = true;
            newValueDiv.style.display = 'none';
        } else {
            locDiv.style.display = 'none';
            location_value.required = false;
            location_value.value = "";
            addrDiv.style.display = 'none';
            address_value.required = false;
            address_value.value = "";
        }
    }

    reasonSelect.addEventListener('change', function() {
        const selectedReason = this.value;
        const oldValInput = document.getElementById('old_value');
        var net_salary_value = document.getElementById('net_salary_value');
        const newValInput = document.getElementById('new_value');

        // set the input field's value based on the selected reason
        if (selectedReason === 'Povećanja bruto 1 zarade') {
            oldValInput.value = document.getElementById('old_value').getAttribute('gross-1-salary');
            const newValueInput = document.getElementById('new_value');
            newValInput.readOnly = true;
            net_salary_value.addEventListener('input', function() {
                var net_salary = parseFloat(net_salary_value.value);
                if (!isNaN(net_salary)) {
                    var gross_1_salary = (net_salary - 2171.2) / 0.701;
                    const new_value = gross_1_salary.toFixed(2);
                    newValInput.value = new_value;
                }
            });
        } else if (selectedReason === 'Promene pozicije') {
            oldValInput.value = document.getElementById('old_value').getAttribute('position');
            newValInput.readOnly = false;
            newValInput.value = "";

            $(document).ready(function() {

                $('#position_value').prop('disabled', true);

                $('#organization_value').change(function() {
                    var organization_id = $(this).val();
                    $('#position_value').prop('disabled', false);
                    var org_name = $('#organization_value option:selected').text();

                    $.ajax({
                        url: "{{ route('positions.get-by-organization') }}",
                        type: 'GET',
                        data: {
                            organization_id: organization_id
                        },
                        success: function(response) {
                            $('#position_value').html('<option value=""> -- Select position from ' + org_name + ' unit -- </option>');
                            $.each(response.positions, function(index, position) {
                                $('#position_value').append('<option value="' + position.id + '">' + position.name + '</option>');
                            });
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                });
            });

            $('#position_value').change(function() {
                var position_name = $('#position_value option:selected').text();
                newValInput.value = position_name;
            });


        } else if (selectedReason === 'Promene adrese obavljanja posla') {
            oldValInput.value = document.getElementById('old_value').getAttribute('current-address');
            newValInput.readOnly = false;
            newValInput.value = "";
            var address = "";

            $(document).ready(function() {

                $('#address_value').prop('disabled', true);
                $('#location_value').change(function() {
                    var location_id = $(this).val();
                    $('#address_value').prop('disabled', false);
                    var location = $('#location_value option:selected').text();

                    if (location === 'Hybrid') {
                        address_value.value = "Makedonska 12, Beograd";
                        address_value.readOnly = true;
                        address = address_value.value;
                        newValInput.value = "Makedonska 12, Beograd";
                    } else if (location === 'Remote') {
                        address_value.readOnly = false;
                        address_value.value = "";

                        address_value.addEventListener('input', function() {
                            address = address_value.value;
                            newValInput.value = address;
                        });
                    }

                });
            });

        } else if (selectedReason === 'Promene adrese poslodavca') {
            oldValInput.value = document.getElementById('old_value').getAttribute('office-address');
            newValInput.readOnly = false;
            newValInput.value = "";


        } else if (selectedReason === 'Promene radnih sati') {
            oldValInput.value = document.getElementById('old_value').getAttribute('working-hours');
            newValInput.readOnly = false;
            newValInput.value = "";


        }
    });
</script>


<script>
    function openAnnexPopup() {
        $('#annexModal').modal('show');
    }
</script>

<script>
    function openCreateAnnexPopup() {
        $('#annexCreateModal').modal('show');
    }
</script>

@if(session('success'))
<script>
    $(function() {
        $('#annexCreateModal').modal('hide');
    });
</script>
@endif

@endsection