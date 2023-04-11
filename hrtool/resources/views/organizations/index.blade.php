@extends('admin.master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <h4 class="font-size-16" style="margin-left: 10px; margin-top:5px;">ORGANIZATIONS</h4>
                    </div>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">HRTool</a></li>
                            <li class="breadcrumb-item active">Organizations</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('organizations.create') }}" class="btn btn-primary mb-3">Create New Organization</a>
                </div>

            </div>
        </div>


        <div class="row">

            <div class="card">
                <div class="card-body">

                    <p class="card-title-desc"> See all Pelican Cement departments </p>

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
                                            <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 69.2px;" aria-label="OrgID: activate to sort column ascending">ID</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 139.2px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Department Name</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 139.2px;" aria-label="Manager: activate to sort column ascending">Manager</th>
                                            <th style="width: 100px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($organizations as $organization)
                                        <tr>
                                            <th scope="row">{{ $organization->id }}</th>
                                            <td class="sorting_1 dtr-control">{{ $organization->name }}</td>
                                            <td>{{ $organization->manager->first_name }} {{ $organization->manager->last_name }}</td>

                                            <td>

                                                <div class="btn-group-vertical" role="group" aria-label="Vertical button group">

                                                    <div class="btn-group" role="group">
                                                        <button id="btnGroupVerticalDrop1" type="button" class="btn waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="ri-more-line"></i>
                                                        </button>

                                                        <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1">
                                                            <a href="{{ route('organizations.organization-card', $organization->id) }}" class="btn btn-primary" style="margin-left:12px"><i class="fa fa-user" title="Organization"></i></a>
                                                            <a href="{{ route('organizations.edit', $organization->id) }}" class="btn btn-primary" style="margin-right:5px; margin-left:5px"><i class="fas fa-pencil-alt" title="Edit"></i></a>
                                                            <form action="{{ route('organizations.destroy', $organization->id) }}" method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this organization?')"><i class="fa fa-trash" title="Delete"></i></button>
                                                            </form>
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

</div>

</div>
<!-- End Page-content -->
@endsection