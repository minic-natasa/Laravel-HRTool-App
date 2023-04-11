@extends('admin.master')
@section('admin')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <script>
        function printContract(id) {
            // hide the buttons
            var buttons = document.getElementsByClassName('d-print-none');
            for (var i = 0; i < buttons.length; i++) {
                buttons[i].style.display = 'none';
            }

            // get the content to print
            var content = document.getElementById('contract-' + id).innerHTML;

            // open a new window and write the content to it
            var printWindow = window.open('', '', 'height=500,width=800');
            printWindow.document.write('<html><head><title>Contract</title>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(content);
            printWindow.document.write('</body></html>');
            printWindow.document.close();

            // focus and print the window
            printWindow.focus();
            printWindow.print();
            printWindow.close();

            // show the buttons again
            for (var i = 0; i < buttons.length; i++) {
                buttons[i].style.display = 'block';
            }
        }
    </script>

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
                        <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light" style="margin-right:5px"><i class="fa fa-print"></i></a>
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

                        <!-- Contract Details -->
                        <div class="row">
                            <!-- Contract title and logo -->
                            <div class="col-12">
                                <div class="invoice-title">
                                    <h4 class="float-end font-size-16"><strong>Contract # {{$contract->contract_number}}</strong></h4>
                                    <h3>
                                        <img src="{{ asset('logo.png') }}" alt="Logo" height="24">
                                    </h3>
                                </div>
                                <hr>
                            </div>

                            <!-- Contract information -->
                            <div class="col-6">
                                <address>
                                    <strong>Start Date:</strong><br>
                                    {{ date('d.m.Y.', strtotime($contract->start_date)) }}<br><br>

                                    <strong>Contract Duration:</strong><br>
                                    {{ $contract->contract_duration }} months<br><br>

                                    <strong>End Date:</strong><br>
                                    {{ date('d.m.Y.', strtotime('+' . $contract->contract_duration . ' months', strtotime($contract->start_date))) }}
                                </address>
                            </div>

                            <!-- Employee information -->
                            <div class="col-6 text-end">
                                <address>
                                    <strong>Type of Contract:</strong><br>
                                    {{$contract->type_of_contract}}<br><br>
                                    <strong>Location of Work:</strong><br>
                                    {{$contract->location_of_work}}<br><br>
                                    <strong>Transportation:</strong><br>
                                    {{$contract->transportation}}<br><br>
                                </address>
                            </div>
                        </div>

                        <!-- Employee table -->
                        <div class="row">
                            <div class="col-12">
                                <div>
                                    <div class="p-2">
                                        <h3 class="font-size-16"><strong> Employee: {{$employee->first_name}} {{$employee->last_name}}</strong></h3>
                                    </div>
                                    <div class="">
                                        <div class="table-responsive">
                                            <table class="table">
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
                                                        <td class="text-center">{{$contract->organization->name}}</td>
                                                        <td class="text-center">
                                                            @foreach($contract->organization->position as $pos)
                                                            @if($pos->id == $contract->position)
                                                            {{ $pos->name }}
                                                            @endif
                                                            @endforeach
                                                        </td>
                                                        <td class="text-center">{{$contract->net_salary}}</td>
                                                        <td class="text-center">{{$contract->gross_salary_1}}</td>
                                                        <td class="text-center">{{$contract->gross_salary_2}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- Print button -->
                                        <div class="d-print-none">
                                            <div class="float-end">
                                                <a href="javascript:void(0)" class="btn btn-primary waves-effect waves-light" onclick="printContract('{{ $contract->id }}')" style="margin-right:10px"><i class="fa fa-print"></i> Print</a>
                                            </div>
                                        </div>

                                        <!-- Edit and upload buttons -->
                                        <div class="d-print-none">
                                            <div class="float-end">
                                                <a href="{{ route('contracts.edit', $contract->id) }}" class="btn btn-primary waves-effect waves-light" style="margin-right:10px"><i class="fas fa-pencil-alt"></i> Edit</a>
                                                <!-- <a href="" class="btn btn-primary waves-effect waves-light"><i class="fa fa-upload"></i> Upload Document</a> -->
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

        
    </div>
</div>

@endsection