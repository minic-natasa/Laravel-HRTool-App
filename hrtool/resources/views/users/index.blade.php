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
                    <h4 class="mb-sm-0">EMPLOYEES</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">HRTool</a></li>
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

        <!-- CARD
        <div class="d-flex justify-content-center flex-wrap">
            @foreach ($users as $user)
            <div class="col-lg-4" style="margin-top: 50px; margin-right: 17px;">
                <div class="card m-b-30">
                    <div class="card-body">

                        <div class="d-flex align-items-center">
                            <img class="d-flex me-3 rounded-circle img-thumbnail avatar-lg" src="{{asset('assets\images\users\Portrait_Placeholder.png')}}" alt="">
                            <div class="flex-grow-1">
                                <h5 class="mt-0 font-size-18 mb-1">{{ $user->first_name }} {{ $user->last_name }}</h5>
                                <p class="text-muted font-size-14">Position</p>
                                <p class="text-muted font-size-14">{{ $user->email }}</p>

                                <a href="{{ route('users.profile-card', $user->id) }}" class="btn btn-primary" style="margin-right:5px"><i class="fa fa-user" title="Profile"></i></a>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary" style="margin-right:5px"><i class="fas fa-pencil-alt" title="Edit"></i></a>

                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')"><i class="fa fa-trash" title="Delete"></i></button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
-->


        <div class="row">

            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">All Employees</h4>
                    <p class="card-title-desc"> This is the list of all Pelican Cement employees </p>

                    <div id="datatable-buttons_wrapper" class="table-responsive dataTables_wrapper">
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
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="datatable-buttons" class="table dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable-buttons_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 69.2px;" aria-label="EmployeeNumber: activate to sort column ascending">ID</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 139.2px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Name</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 139.2px;" aria-label="Email: activate to sort column ascending">Email</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 69.2px;" aria-label="Team: activate to sort column ascending">Team</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 69.2px;" aria-label="Position: activate to sort column ascending">Position</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 131.2px;" aria-label="Mobile: activate to sort column ascending">Mobile</th>
                                            <th style="width: 100px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($users as $user)
                                        <tr>
                                            <th scope="row">{{ $user->employee_number }}</th>
                                            <td class="sorting_1 dtr-control">{{ $user->first_name }} {{ $user->last_name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>Team</td>
                                            <td>Position</td>
                                            <td>{{ $user->mobile }}</td>
                                            <td>

                                                <div class="btn-group-vertical" role="group" aria-label="Vertical button group">

                                                    <div class="btn-group" role="group">
                                                        <button id="btnGroupVerticalDrop1" type="button" class="btn waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="ri-more-line"></i>
                                                        </button>

                                                        <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1">
                                                            <a href="{{ route('users.profile-card', $user->id) }}" class="btn btn-primary" style="margin-left:12px"><i class="fa fa-user" title="Profile"></i></a>
                                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary" style="margin-right:5px; margin-left:5px"><i class="fas fa-pencil-alt" title="Edit"></i></a>
                                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')"><i class="fa fa-trash" title="Delete"></i></button>
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

<!--
                <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="datatable-buttons_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="datatable-buttons_paginate">
                            <ul class="pagination pagination-rounded">
                                <li class="paginate_button page-item previous disabled" id="datatable-buttons_previous"><a href="#" aria-controls="datatable-buttons" data-dt-idx="0" tabindex="0" class="page-link"><i class="mdi mdi-chevron-left"></i></a></li>
                                <li class="paginate_button page-item active"><a href="#" aria-controls="datatable-buttons" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="datatable-buttons" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="datatable-buttons" data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="datatable-buttons" data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="datatable-buttons" data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="datatable-buttons" data-dt-idx="6" tabindex="0" class="page-link">6</a></li>
                                <li class="paginate_button page-item next" id="datatable-buttons_next"><a href="#" aria-controls="datatable-buttons" data-dt-idx="7" tabindex="0" class="page-link"><i class="mdi mdi-chevron-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

-->
            </div>
        </div>

    </div> <!-- end col -->
</div>


</table>
</div>
</div>
</div> <!-- end col -->
</div> <!-- end row -->


</div>

</div>
<!-- End Page-content -->

@endsection