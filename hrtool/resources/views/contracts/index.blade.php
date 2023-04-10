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

                    <p class="card-title-desc">See the contracts of all Pelican Cement employees</p>

                    <div id="datatable-buttons_wrapper" class="table-responsive dataTables_wrapper">
                        <!--
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="dt-buttons btn-group flex-wrap"> <button class="btn btn-secondary buttons-copy buttons-html5" tabindex="0" aria-controls="datatable-buttons" type="button"><span>Copy</span></button> <button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="datatable-buttons" type="button"><span>Excel</span></button> <button class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="datatable-buttons" type="button"><span>PDF</span></button>
                                    <div class="btn-group"><button class="btn btn-secondary buttons-collection dropdown-toggle buttons-colvis" tabindex="0" aria-controls="datatable-buttons" type="button" aria-haspopup="true" aria-expanded="false"><span>Column visibility</span></button></div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div id="datatable-buttons_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="datatable-buttons"></label></div>
                            </div>
                        </div>
-->
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="datatable-buttons" class="table dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable-buttons_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 69.2px;" aria-label="ContractNumber: activate to sort column ascending">Contract Number</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 139.2px;" aria-sort="ascending" aria-label="Employee: activate to sort column descending">Employee</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 69.2px;" aria-label="OrgUnit: activate to sort column ascending">Organization Unit</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 131.2px;" aria-label="Position: activate to sort column ascending">Position</th>
                                            <th style="width: 100px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($contracts as $contract)
                                        <tr>
                                            <th scope="row">{{ $contract->contract_number }}</th>
                                            <td class="sorting_1 dtr-control">{{ $contract->employee->first_name}} {{ $contract->employee->last_name}}</td> <!-- First and Last name of employee -->
                                            <td>{{ $contract->organization->name }}</td>
                                            <td>
                                                @foreach($contract->organization->position as $pos)
                                                @if($pos->id == $contract->position)
                                                {{ $pos->name }}
                                                @endif
                                                @endforeach
                                            </td>

                                            <td>

                                                <div class="btn-group-vertical" role="group" aria-label="Vertical button group">

                                                    <div class="btn-group" role="group">
                                                        <button id="btnGroupVerticalDrop1" type="button" class="btn waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="ri-more-line"></i>
                                                        </button>

                                                        <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1">
                                                            <a href="{{ route('contracts.profile', $contract->employee->id) }}" class="btn btn-primary" style="margin-left:12px"><i class="fa fa-user" title="Contract"></i></a>
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

    </div> <!-- end col -->
</div>


</table>
</div>
</div>
</div> <!-- end col -->
</div> <!-- end row -->


<!-- End Page-content -->

@endsection