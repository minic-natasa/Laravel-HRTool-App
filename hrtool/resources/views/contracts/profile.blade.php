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
                                    <span style="display: block; margin-bottom: 8px;">
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


                                        $location = $latestAnnexAdd ? ($latestAnnexAdd->address_of_work == $contract->employee->current_address ? "Remote" : "Hybrid") : "Hybrid";

                                        if ($latestAnnexAdd) {
                                        echo '<span style="cursor: default; font-weight: bold;" title="Value Changed with Annex">' . $location . '</span>';
                                        }
                                        else {
                                        echo $location;
                                        }

                                        @endphp
                                    </span>

                                    <strong>Address of Work:</strong>
                                    <span style="display: block; margin-bottom: 8px;">
                                        @php

                                        if ($latestAnnexAdd) {
                                        echo '<span style="cursor: default; font-weight: bold;" title="Value Changed with Annex">' . $addressValue . '</span>';
                                        }
                                        else {
                                        echo $addressValue;
                                        }
                                        @endphp
                                    </span>


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
                                            <table class="table" style="font-size: 13px; margin-bottom:3vh">
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
                                                            $reasonToSearch = 'Promena pozicije';

                                                            $latestAnnexPos = $contract->annexes()
                                                            ->where('deleted', 0)
                                                            ->whereRaw("FIND_IN_SET('$reasonToSearch', reason) > 0")
                                                            ->orderByDesc('annex_date')
                                                            ->first();

                                                            $annexPositionName = $latestAnnexPos ? $latestAnnexPos->position : '';
                                                            $currentOrganization = $contract->organization;
                                                            $annexOrganization = '';

                                                            if ($latestAnnexPos) {
                                                            foreach ($organizations as $org) {
                                                            foreach ($org->position as $pos) {
                                                            if ($pos->name == $annexPositionName) {
                                                            $annexOrganization = $pos->organization;
                                                            $annexPosition = $pos;
                                                            break;
                                                            }
                                                            }
                                                            }
                                                            echo '<span title="Organization Changed with Annex"><a href="' . route('organizations.organization-card', $annexOrganization->id) . '">' . $annexOrganization->name . '</a></span>';
                                                            } else {
                                                            echo '<a href="' . route('organizations.organization-card', $currentOrganization->id) . '">' . $currentOrganization->name . '</a>';
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

                                                            if ($latestAnnexPos) {

                                                            echo '<span title="Position Changed with Annex"><a href="' . route('positions.position-card', $annexPosition->id) . '">' . $annexPosition->name . '</a></span>';
                                                            } else {
                                                            echo '<a href="' . route('positions.position-card', $currentPosition->id) . '">' . $currentPositionName . '</a>';
                                                            }
                                                            @endphp
                                                        </td>

                                                        <td class="text-center">
                                                            @php
                                                            $reasonToSearch = 'Povećanje bruto 1 zarade';

                                                            $latestAnnexGross = $contract->annexes()
                                                            ->where('deleted', 0)
                                                            ->whereRaw("FIND_IN_SET('$reasonToSearch', reason) > 0")
                                                            ->orderByDesc('annex_date')
                                                            ->first();

                                                            $gross = $latestAnnexGross ? $latestAnnexGross->gross_salary : $contract->gross_salary_1;
                                                            $n = $gross * 0.701 + 2171.2;
                                                            $net = $latestAnnexGross ? $n : $contract->net_salary;


                                                            if ($latestAnnexGross) {
                                                            echo '<span style="cursor: default; font-weight: bold;" title="Value Changed with Annex">' . number_format($net, 2, ',', '.') . ' RSD</span>';
                                                            } else {
                                                            echo number_format($net, 2, ',', '.') . ' RSD';
                                                            }
                                                            @endphp
                                                        </td>

                                                        <td class="text-center">
                                                            @php
                                                            if ($latestAnnexGross) {
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

                                            <!-- Documents button -->
                                            <div class="float-end">
                                                <div class="btn-group dropup" role="group">
                                                    <button id="btnGroupVerticalDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-file"></i> Documents
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1">
                                                        <li><a class="dropdown-item" href="{{ route('contracts.mob', $contract->id) }}" target="_blank">Obaveštenje o mobingu</a></li>
                                                        <li><a class="dropdown-item" href="{{ route('contracts.uzb', $contract->id)}}" target="_blank">Obaveštenje o Zakonu o uzbunjivačima</a></li>
                                                        <li><a class="dropdown-item" href="{{ route('contracts.nda', $contract->id)}}" target="_blank">Sporazum o poverljivosti</a></li>
                                                        <!--<li><a class="dropdown-item" href="{{ route('contracts.odm', $contract->id)}}" target="_blank">Zahtev za korišćenje godišnjeg odmora</a></li>
                                                     <li><a class="dropdown-item" href="{{ route('contracts.rev', $contract->id)}}">Revers</a></li> -->
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Print button -->
                                            <div class="d-print-none">
                                                <div class="float-end">
                                                    <a href="{{ route('contracts.pdf', $contract->id) }}" class="btn btn-primary waves-effect waves-light" style="margin-right:10px" target="_blank"><i class="fa fa-print"></i> Print</a>
                                                </div>
                                            </div>

                                            @if(count($contract->annexes->where('deleted', false)) > 0)
                                            <div class="d-print-none">
                                                <div class="float-end">
                                                    <button class="btn btn-primary waves-effect waves-light annexes-button" style="margin-right:10px" target="_blank" data-contract-id="{{ $contract->id }}">
                                                        <i class="fas fa-file-alt"></i> Annexes
                                                    </button>
                                                </div>
                                            </div>
                                            @else
                                            <div class="d-print-none">
                                                <div class="float-end">
                                                    <a href="{{ route('annexes.create', $contract->id) }}" class="btn btn-primary waves-effect waves-light" style="margin-right:10px"><i class="fas fa-file-alt"></i></i> Create New Annex</a>
                                                </div>
                                            </div>
                                            @endif

                                            <!-- Delete Button -->
                                            <div class="d-print-none">
                                                <div class="float-end">
                                                    <form action="{{ route('contracts.destroy', $contract->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" class="annexes-data" value="{{ json_encode($contract->annexes ?? []) }}">
                                                        <button type="submit" class="btn btn-link" style="margin-right:10px" onclick="event.preventDefault(); checkFunction(event, this.previousElementSibling);"><i class="fa fa-trash" title="Delete"></i></button>
                                                    </form>
                                                </div>
                                            </div>

                                            <br>

                                            <div class="table-responsive annexes-table" id="annexes-table-{{ $contract->id }}" style="display: none; padding-top: 5vh; width: max-content;">
                                                <table class="table mb-0">


                                                    <!-- Create New Annex button -->
                                                    <div class="d-print-none">
                                                        <div>
                                                            <a href="{{ route('annexes.create', $contract->id) }}" class="btn btn-outline-primary waves-effect waves-light" style="margin-right:10px; margin-bottom:3vh; margin-top:1vh"><i class="fas fa-file-alt"></i></i> Create New Annex</a>
                                                        </div>
                                                    </div>

                                                    <thead>
                                                        <tr>
                                                            <th>Annex</th>
                                                            <th>Reason for Annex</th>
                                                            <th>Contract Value</th>
                                                            <th>New Value</th>
                                                            <th>Created At</th>
                                                            <th>Start Date</th>
                                                            <th>Print</th>
                                                            <th>Delete</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php $count = 0; ?>

                                                        @if($contract && $contract->status == 'active')
                                                        @foreach ($contract->annexes as $key => $annex)
                                                        @if ($annex->deleted === 0)
                                                        <?php $count++; ?>
                                                        <tr>
                                                            <td class="text-center">{{ $count }}</td>
                                                            <td>
                                                                @php
                                                                $reasons = explode(',', $annex->reason);
                                                                @endphp
                                                                @foreach($reasons as $key => $reason)
                                                                {{$reason}}@if($key !== count($reasons) - 1),<br>
                                                                @endif
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                @if(in_array('Povećanje bruto 1 zarade', explode(',', $annex->reason)))
                                                                {{ number_format($annex->old_gross_salary, 2, ',', '.')}} RSD<br>
                                                                @endif

                                                                @if(in_array('Promena pozicije', explode(',', $annex->reason)))
                                                                {{$annex->old_position}}<br>
                                                                @endif

                                                                @if(in_array('Promena adrese obavljanja posla', explode(',', $annex->reason)))
                                                                {{ $annex->old_address_of_work; }}<br>
                                                                @endif

                                                                @if(in_array('Promena adrese poslodavca', explode(',', $annex->reason)))
                                                                {{$annex->old_address_of_employer}}<br>
                                                                @endif

                                                                @if(in_array('Promena radnih sati', explode(',', $annex->reason)))
                                                                {{$annex->old_working_hours}}h<br>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if(in_array('Povećanje bruto 1 zarade', explode(',', $annex->reason)))
                                                                {{ number_format($annex->gross_salary, 2, ',', '.') }} RSD<br>
                                                                @endif

                                                                @if(in_array('Promena pozicije', explode(',', $annex->reason)))
                                                                {{$annex->position}}<br>
                                                                @endif

                                                                @if(in_array('Promena adrese obavljanja posla', explode(',', $annex->reason)))
                                                                {{ $annex->address_of_work; }}<br>
                                                                @endif

                                                                @if(in_array('Promena adrese poslodavca', explode(',', $annex->reason)))
                                                                {{$annex->address_of_employer}}<br>
                                                                @endif

                                                                @if(in_array('Promena radnih sati', explode(',', $annex->reason)))
                                                                {{$annex->working_hours}}h<br>
                                                                @endif
                                                            </td>
                                                            <td>{{ date('d.m.Y.', strtotime($annex->annex_created_date)) }}</td>
                                                            <td>{{ date('d.m.Y.', strtotime($annex->annex_date)) }}</td>

                                                            <td>
                                                                <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                                                                    <div class="btn-group" role="group">
                                                                        <button id="btnGroupVerticalDrop1" type="button" class="btn waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            <i class="ri-more-line"></i>
                                                                        </button>

                                                                        <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1">
                                                                            <a href="{{ route('annexes.annex-pdf', ['id' => $annex->id, 'annex_number' => $count]) }}" class="btn btn-primary waves-effect waves-light" style="margin-left:10px; margin-right:5px" target="_blank" id="printAnnexBtn"> Annex</a>
                                                                            <a href="{{ route('annexes.notice-pdf', $annex->id) }}" class="btn btn-primary waves-effect waves-light" target="_blank" id="printNoticeBtn">Notice</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <form action="{{ route('annexes.destroy', $annex->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-link" onclick="return confirm('Are you sure you want to delete this annex?')"><i class="fa fa-trash" title="Delete"></i></button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                        @endif
                                                        @endforeach
                                                        @endif

                                                    </tbody>

                                                </table>
                                            </div> <br><br>


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

    </div>
</div>

<script>
    const annexesButtons = document.querySelectorAll('.annexes-button');
    const annexesTables = document.querySelectorAll('.annexes-table');

    annexesButtons.forEach((annexesButton) => {
        annexesButton.addEventListener('click', () => {
            const contractId = annexesButton.getAttribute('data-contract-id');
            const annexesTable = document.querySelector(`#annexes-table-${contractId}`);

            if (annexesTable.style.display === 'none') {
                annexesTable.style.display = 'block';
                annexesButton.innerHTML = '<i class="fas fa-times"></i> Hide Annexes';
            } else {
                annexesTable.style.display = 'none';
                annexesButton.innerHTML = '<i class="fas fa-file-alt"></i> Annexes';
            }
        });
    });
</script>

<script>
    function checkFunction(event, annexesDataElement) {
        var contractAnnexes = JSON.parse(annexesDataElement.value);

        // Check if there are any active annexes
        var hasActiveAnnexes = false;
        for (var i = 0; i < contractAnnexes.length; i++) {
            if (contractAnnexes[i].deleted == false) {
                hasActiveAnnexes = true;
                break;
            }
        }

        if (hasActiveAnnexes) {
            alert('You cannot delete contract with annexes.');
        } else {
            if (confirm('Are you sure you want to delete this contract?')) {
                // Submit the form to delete the contract
                event.target.parentElement.submit();
            }
        }
    }
</script>

@endsection