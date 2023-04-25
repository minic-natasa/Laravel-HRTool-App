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
                                                        <td class="text-center"><a href="{{ route('organizations.organization-card', $contract->organization->id) }}">{{ $contract->organization->name }}</a></td>
                                                        <td class="text-center">
                                                            @foreach($contract->organization->position as $pos)
                                                            @if($pos->id == $contract->position)
                                                            <a href="{{ route('positions.position-card', $pos->id) }}">{{ $pos->name }}</a>
                                                            @endif
                                                            @endforeach
                                                        </td>
                                                        <td class="text-center">{{ number_format($contract->net_salary, 2, ',', '.') }} RSD</td>
                                                        <td class="text-center">{{ number_format($contract->gross_salary_1, 2, ',', '.') }} RSD</td>
                                                        <td class="text-center">{{ number_format($contract->gross_salary_2, 2, ',', '.') }} RSD</td>
                                                    </tr>

                                                </tbody>
                                            </table>
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

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Annex</th>
                                        <th>Reason for Annex</th>
                                        <th>Contract Value</th>
                                        <th>New Value</th>
                                        <th>Date</th>
                                        <th>Print</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count = 1; ?>
                                    @foreach ($contract->annexes as $annex)
                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{$annex->reason}}</td>
                                        <td>{{$annex->contract->gross_salary_1}}</td>
                                        <td>{{$annex->new_value}}</td>
                                        <td>{{ date('d.m.Y.', strtotime($annex->annex_date)) }}</td>

                                        <td>
                                            <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                                                <div class="btn-group" role="group">
                                                    <button id="btnGroupVerticalDrop1" type="button" class="btn waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="ri-more-line"></i>
                                                    </button>

                                                    <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1">
                                                        <a href="{{ route('annexes.annex-pdf', $annex->id) }}" class="btn btn-primary waves-effect waves-light" style="margin-left:10px; margin-right:5px" target="_blank" id="printAnnexBtn">Annex</a>
                                                        <a href="{{ route('annexes.notice-pdf', $annex->id) }}" class="btn btn-primary waves-effect waves-light" target="_blank" id="printNoticeBtn">Notice</a>
                                                    </div>
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
            <div class="modal-dialog modal-l modal-dialog-centered" role="document">
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

                            <div class="form-group row">
                                <label for="reason" class="col-md-3 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Reason:') }}</label>

                                <div class="col-md-8">
                                    <select id="reason" class="form-control @error('reason') is-invalid @enderror" name="reason" required>
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

                            <div class="form-group row">
                                <label for="old_value" class="col-md-3 col-form-label text-md-right" style="margin-bottom: 4px;">Old Value:</label>
                                <div class="col-md-8">

                                </div>
                            </div>

                            <div class="form-group row" id="old_value">
                                <label for="old_value" class="col-md-3 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Old Value:') }}</label>
                                <div class="col-md-8">
                                    <input id="old_value" type="text" class="form-control @error('old_value') is-invalid @enderror" name="old_value" placeholder="-- Select reason for creating new annex first --" disabled>

                                    @error('old_value')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="new_value" class="col-md-3 col-form-label text-md-right" style="margin-bottom: 4px;">New Value:</label>

                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="new_value" name="new_value" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="annex_date" class="col-md-3 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Date:') }}</label>

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
    function openAnnexPopup() {
        $('#annexModal').modal('show');
    }
</script>

<script>
    function openCreateAnnexPopup() {
        $('#annexCreateModal').modal('show');
    }
</script>

@endsection