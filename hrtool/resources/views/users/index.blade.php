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
                        <h4 class="font-size-16" style="margin-left: 10px; margin-top:5px;">EMPLOYEES</h4>
                    </div>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">HRTool</a></li>
                            <li class="breadcrumb-item active">Employees</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Create New Employee</a>
                </div>

            </div>
        </div>

        <div class="row">

            <div class="card">
                <div class="card-body">
                    <div id="scroll-vertical-datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

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
                                                        <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 13%;" aria-label="EmployeeID: activate to sort column ascending">Employee Number</th>
                                                        <th class="sorting_asc" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 16%;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Name</th>
                                                        <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 22%;" aria-label="Email: activate to sort column ascending">Email</th>
                                                        <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 21%;" aria-label="Position: activate to sort column ascending">Position</th>
                                                        <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 15%;" aria-label="Mobile: activate to sort column ascending">Mobile</th>
                                                        <th style="width: 100px;"></th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="dataTables_scrollBody" style="position: relative; overflow: auto; max-height: 39vh; width: 100%;">
                                        <table id="scroll-vertical-datatable" class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline" role="grid" aria-describedby="scroll-vertical-datatable_info" style="width: 100%;">
                                            <thead>
                                                <tr role="row" style="height: 0px;">
                                                    <th class="sorting_asc" aria-controls="scroll-vertical-datatable" rowspan="1" colspan="1" style="width: 14%; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                        <div class="dataTables_sizing" style="height: 0px; overflow: hidden;">Name</div>
                                                    </th>
                                                    <th class="sorting" aria-controls="scroll-vertical-datatable" rowspan="1" colspan="1" style="width: 16%; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-label="Position: activate to sort column ascending">
                                                        <div class="dataTables_sizing" style="height: 0px; overflow: hidden;">Email</div>
                                                    </th>
                                                    <th class="sorting" aria-controls="scroll-vertical-datatable" rowspan="1" colspan="1" style="width: 22%; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-label="Office: activate to sort column ascending">
                                                        <div class="dataTables_sizing" style="height: 0px; overflow: hidden;">Position</div>
                                                    </th>
                                                    <th class="sorting" aria-controls="scroll-vertical-datatable" rowspan="1" colspan="1" style="width: 21%; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-label="Office: activate to sort column ascending">
                                                        <div class="dataTables_sizing" style="height: 0px; overflow: hidden;">Mobile</div>
                                                    </th>
                                                </tr>
                                            </thead>


                                            <tbody>

                                                @foreach ($users as $user)
                                                <tr>
                                                    <th scope="row">{{ $user->employee_number }}</th>
                                                    <td class="sorting_1 dtr-control"><a id="user" href="{{ route('users.profile-card', $user->id) }}">{{ $user->first_name }} {{ $user->last_name }}</a></td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>
                                                        @php
                                                        $activeContracts = $user->contract()->where('status', 'active')->get();
                                                        if ($activeContracts->count() > 0) {
                                                        foreach ($activeContracts as $contr) {
                                                        $annex = $contr->annexes()->where('reason', 'Promene pozicije')->where('deleted', false)->latest('created_at')->first();
                                                        $annexPositionName = $annex ? $annex->new_value : '';
                                                        $annexPosition = '';
                                                        $currentPosition = '';
                                                        $currentOrganization = $contr->organization;
                                                        $annexOrganization = '';

                                                        foreach ($contr->organization->position as $pos) {
                                                        if ($pos->id == $contr->position) {
                                                        $currentPosition = $pos;
                                                        $currentPositionName = $currentPosition->name;
                                                        }
                                                        }

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
                                                        echo '<span class="changed" title="Position Changed with Annex"><a id="link" href="' . route('positions.position-card', $annexPosition->id) . '">' . $annexPosition->name . '</a></span>';
                                                        } else {
                                                        echo '<a id="link" href="' . route('positions.position-card', $currentPosition->id) . '">' . $currentPositionName . '</a>';
                                                        }
                                                        echo "<br>"; // Add line break after each position
                                                        }
                                                        } else {
                                                        echo "No active contract found";
                                                        }
                                                        @endphp
                                                    </td>

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

                                                    <td>{{ $user->mobile }}</td>

                                                    <td>
                                                        <div>
                                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-link"><i class="fas fa-pencil-alt" title="Edit"></i></a>

                                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline-block; width: auto;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-link" onclick="return confirm('Are you sure you want to delete this employee?')"><i class="fa fa-trash" title="Delete"></i></button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach

                                                <style>
                                                    /* Set link color to the same color as normal text */
                                                    #user {
                                                        color: inherit;
                                                        text-decoration: none;
                                                    }

                                                    /* Set link color to a different color on hover */
                                                    #user:hover {
                                                        color: #002EFF;
                                                    }
                                                </style>

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

        <style>
          
        </style>

    </div>

</div>
<!-- End Page-content -->
@endsection