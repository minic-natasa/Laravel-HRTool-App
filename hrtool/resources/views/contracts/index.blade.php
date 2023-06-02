@extends('admin.master')
@section('admin')

@section('title')
Contracts | HRTool
@endsection

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script defer src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <h4 class="font-size-16" style="margin-left: 10px; margin-top:5px;">CONTRACTS</h4>
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
                            <li class="breadcrumb-item active">Contracts</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body" style="position: relative; overflow: auto; max-height: 59vh; width: 100%;">
                        <div class="table-responsive">
                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th>Contract Number</th>
                                        <th>Profile Picture</th>
                                        <th>Name</th>
                                        <th>Organization</th>
                                        <th>Position</th>
                                        @if(Auth::user()->can('contract.delete'))
                                        <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($contracts as $contract)
                                    @if ($contract->status == 'active')
                                    <tr style="text-align: center;">
                                        <th scope="row">{{ $contract->contract_number }}</th>
                                        <td>
                                            <img src="{{ (!empty($user->profile_picture) ? url('upload/admin_images/'.$user->profile_picture) : url('upload/default_image.png')) }}" alt="" class="avatar-sm rounded-circle">
                                        </td>
                                        <td>
                                            @if(Auth::user()->can('employee.profile'))
                                            <a href="{{ route('contracts.profile', ['id' => $contract->employee->id]) }}">{{ $contract->employee->first_name}} {{ $contract->employee->last_name}}</a>
                                            @else
                                            {{ $contract->employee->first_name}} {{ $contract->employee->last_name}}
                                            @endif
                                        </td>

                                        <td>
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
                                            $annexPosition = '';
                                            $currentPosition = '';

                                            foreach ($contract->organization->position as $pos) {
                                            if ($pos->id == $contract->position) {
                                            $currentPosition = $pos;
                                            $currentPositionName = $currentPosition->name;
                                            }
                                            }

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
                                            if (Auth::user()->can('organization.profile')) {
                                            echo '<span title="Organization Changed with Annex"><a href="' . route('organizations.organization-card', $annexOrganization->id) . '">' . $annexOrganization->name . '</a></span>';
                                            } else {
                                            echo $annexOrganization->name;
                                            }
                                            } else {
                                            if (Auth::user()->can('organization.profile')) {
                                            echo '<a href="' . route('organizations.organization-card', $currentOrganization->id) . '">' . $currentOrganization->name . '</a>';
                                            } else {
                                            echo $currentOrganization->name;
                                            }
                                            }
                                            @endphp
                                        </td>

                                        <td>
                                            @php
                                            if ($latestAnnexPos) {
                                            if (Auth::user()->can('position.profile')) {
                                            echo '<span class="changed" title="Position Changed with Annex"><a id="link" href="' . route('positions.position-card', $annexPosition->id) . '">' . $annexPosition->name . '</a></span>';
                                            } else {
                                            echo $annexPosition->name;
                                            }
                                            } else {
                                            if (Auth::user()->can('position.profile')) {
                                            echo '<a id="link" href="' . route('positions.position-card', $currentPosition->id) . '">' . $currentPositionName . '</a>';
                                            } else {
                                            echo $currentPositionName;
                                            }
                                            }
                                            @endphp
                                        </td>



                                        <td>
                                            @if(Auth::User()->can('contract.delete'))
                                            <form action="{{ route('contracts.destroy', $contract->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" class="annexes-data" value="{{ json_encode($contract->annexes ?? []) }}">
                                                <button type="submit" class="btn btn-link" onclick="event.preventDefault(); checkFunction(event, this.previousElementSibling);"><i class="fa fa-trash" title="Delete"></i></button>
                                            </form>
                                            @endif

                                        </td>


                                        <style>
                                            a {
                                                color: inherit;
                                            }

                                            a:hover {
                                                color: #002EFF;
                                            }
                                        </style>

                                    </tr>
                                    @endif
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

</div>

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
            toastr.error('You cannot delete a contract with annexes!');
        } else {
            if (confirm('Are you sure you want to delete this contract?')) {
                // Submit the form to delete the contract
                event.target.parentElement.submit();
            }
        }
    }
</script>

@endsection