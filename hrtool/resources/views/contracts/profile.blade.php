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

                                        <!-- Annex button -->
                                        <div class="d-print-none">
                                            <div class="float-end">
                                                <a href="javascript:void(0)" class="btn btn-primary waves-effect waves-light" style="margin-right:10px" onclick="openAnnexPopup()"><i class="fas fa-file-alt"></i> Annexes</a>
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
                    <div class="modal-body"style="height: 55vh;">
                        <label for="dropdownMenu">Reason:</label>
                        <select id="dropdownMenu" name="dropdownMenu">
                            <option value="">Select reason for creating new annex</option>
                            <option value="Povećanja bruto 1 zarade">Povećanje bruto 1 zarade</option>
                            <option value="Promene adrese obavljanja posla">Promena adrese obavljanja posla</option>
                            <option value="Promene adrese poslodavca">Promena adrese poslodavca</option>
                            <option value="Promene pozicije">Promena pozicije</option>
                            <option value="Promene radnih sati">Promena radnih sati</option>
                        </select>

                        <div id="pdfButtons" style="display:none">
                            <div class="d-print-none">
                                <div class="float-end">
                                    <a href="{{ route('contracts.pdf', $contract->id) }}" class="btn btn-primary waves-effect waves-light" style="margin-right:10px" target="_blank"><i class="fa fa-print"></i> Print Annex</a>
                                </div>
                            </div>

                            <div class="d-print-none">
                                <div class="float-end">
                                    <a href="{{ route('contracts.pdf', $contract->id) }}" class="btn btn-primary waves-effect waves-light" style="margin-right:10px" target="_blank"><i class="fa fa-print"></i> Print Notice</a>
                                </div>
                            </div>

                        </div>

                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#annexModal">Create New Annex</button>

                      

                            {{$contract->annexes}}

                    </div>
                    <div class="modal-footer">
                        <!-- 
                <button class="btn" style="background: transparent; border: 2px solid blue; color: blue; padding: 10px 20px; font-size: 14px; cursor: pointer" data-dismiss="modal">Close</button>
                <button id="saveChangesBtn" class="btn" style="background: blue; border: 2px solid blue; color: white; padding: 10px 20px; font-size: 14px; cursor: pointer" onclick="showMembers()">Save changes</button> -->

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

    document.getElementById("dropdownMenu").addEventListener("change", function() {
        // Get the selected option
        var selectedOption = document.getElementById("dropdownMenu").value;
        // Show the PDF buttons if a reason has been selected
        if (selectedOption !== "") {
            document.getElementById("pdfButtons").style.display = "block";
        }
    });
</script>

@endsection