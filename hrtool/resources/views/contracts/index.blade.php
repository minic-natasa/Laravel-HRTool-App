@extends('admin.master')
@section('admin')

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
                        <h4 class="font-size-16" style="margin-left: 10px; margin-top:5px;">CONTRACTS</h4>
                    </div>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">HRTool</a></li>
                            <li class="breadcrumb-item active">Contracts</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">

            <div class="card">
                <div class="card-body">
                    <div id="scroll-vertical-datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer table-responsive">

                        <div class="row">
                            <div class="col-sm-12 col-md-6"></div>
                            <div class="col-sm-12 col-md-6">
                                <div id="scroll-vertical-datatable_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" style="margin-top: 10px;" placeholder="" aria-controls="scroll-vertical-datatable"></label></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="dataTables_scroll">
                                    <div class="dataTables_scrollHead" style="overflow: hidden; position: relative; border: 0px; width: 100%;">
                                        <div class="dataTables_scrollHeadInner" style="box-sizing: content-box;">

                                            <table class="table dt-responsive nowrap w-100 dataTable no-footer" role="grid">
                                                <thead>
                                                    <tr role="row">
                                                        <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 13%;" aria-label="ContractID: activate to sort column ascending">Contract Number</th>
                                                        <th class="sorting_asc" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 25%;" aria-sort="ascending" aria-label="Employee: activate to sort column descending">Employee</th>
                                                        <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 25%;" aria-label="OrganizationUnit: activate to sort column ascending">Organization Unit</th>
                                                        <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 25%;" aria-label="Position: activate to sort column ascending">Position</th>
                                                        <th style="width: 100px;"></th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="dataTables_scrollBody" style="position: relative; overflow: auto; max-height: 400px; width: 100%;">
                                        <table id="scroll-vertical-datatable" class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline" role="grid" aria-describedby="scroll-vertical-datatable_info" style="width: 100%;">
                                            <thead>
                                                <tr role="row" style="height: 0px;">
                                                    <th class="sorting_asc" aria-controls="scroll-vertical-datatable" rowspan="1" colspan="1" style="width: 115px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                        <div class="dataTables_sizing" style="height: 0px; overflow: hidden;">Employee</div>
                                                    </th>
                                                    <th class="sorting" aria-controls="scroll-vertical-datatable" rowspan="1" colspan="1" style="width: 265px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-label="Position: activate to sort column ascending">
                                                        <div class="dataTables_sizing" style="height: 0px; overflow: hidden;">Organization Unit</div>
                                                    </th>
                                                    <th class="sorting" aria-controls="scroll-vertical-datatable" rowspan="1" colspan="1" style="width: 260px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-label="Position: activate to sort column ascending">
                                                        <div class="dataTables_sizing" style="height: 0px; overflow: hidden;">Position</div>
                                                    </th>
                                                </tr>
                                            </thead>



                                            <tbody>

                                                @foreach ($contracts as $contract)
                                                <tr>
                                                    <th scope="row">{{ $contract->contract_number }}</th>
                                                    <td class="sorting_1 dtr-control">
                                                        <a href="{{ route('users.profile-card', ['id' => $contract->employee->id]) }}">{{ $contract->employee->first_name}} {{ $contract->employee->last_name}}</a>
                                                    </td>
                                                    <td> @php
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
                                                        echo '<span title="Organization Changed with Annex"><a href="' . route('organizations.organization-card', $annexOrganization->id) . '">' . $annexOrganization->name . '</a></span>';

                                                        } else {
                                                        echo '<a href="' . route('organizations.organization-card', $currentOrganization->id) . '">' . $currentOrganization->name . '</a>';
                                                        }
                                                        @endphp</td>
                                                    <td>
                                                        @php
                                                        $currentPosition = '';

                                                        foreach ($contract->organization->position as $pos) {
                                                        if ($pos->id == $contract->position){
                                                        $currentPosition = $pos;
                                                        $currentPositionName = $currentPosition->name;
                                                        }
                                                        }

                                                        if ($annex) {

                                                        echo '<span title="Position Changed with Annex"><a href="' . route('positions.position-card', $annexPosition->id) . '">' . $annexPosition->name . '</a></span>';
                                                        } else {
                                                        echo '<a href="' . route('positions.position-card', $currentPosition->id) . '">' . $currentPositionName . '</a>';
                                                        }
                                                        @endphp
                                                    </td>

                                                    <td>

                                                        <div class="btn-group-vertical" role="group" aria-label="Vertical button group">

                                                            <div class="btn-group" role="group">
                                                                <button id="btnGroupVerticalDrop1" type="button" class="btn waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="ri-more-line"></i>
                                                                </button>

                                                                <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1">
                                                                    <a href="{{ route('contracts.profile', $contract->employee->id) }}" class="btn btn-primary" style="margin-left:12px"><i class="fas fa-file-contract" title="Contract"></i></a>
                                                                    <a href="{{ route('contracts.edit', $contract->id) }}" class="btn btn-primary" style="margin-right:5px; margin-left:5px"><i class="fas fa-pencil-alt" title="Edit"></i></a>
                                                                    <form action="{{ route('contracts.destroy', $contract->id) }}" method="POST" style="display: inline;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this contract?')"><i class="fa fa-trash" title="Delete"></i></button>
                                                                    </form>
                                                                </div>

                                                            </div>

                                                        </div>
                                    </div>

                                    <style>
                                        a {
                                            color: inherit;
                                        }

                                        a:hover {
                                            color: #002EFF;
                                        }
                                    </style>
                                </div>

                                </td>
                                </tr>
                                @endforeach

                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div> <!-- end card body-->
    </div> <!-- end card -->

</div>

@endsection