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
                                                        <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 13%;" aria-label="OrganizationID: activate to sort column ascending">ID</th>
                                                        <th class="sorting_asc" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 25%;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Department Name</th>
                                                        <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 21%;" aria-label="Manager: activate to sort column ascending">Manager</th>
                                                        <th style="width: 100px;"></th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="dataTables_scrollBody" style="position: relative; overflow: auto;max-height: 39vh; width: 100%;">
                                        <table id="scroll-vertical-datatable" class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline" role="grid" aria-describedby="scroll-vertical-datatable_info" style="width: 100%;">
                                            <thead>
                                                <tr role="row" style="height: 0px;">
                                                    <th class="sorting_asc" aria-controls="scroll-vertical-datatable" rowspan="1" colspan="1" style="width: 13%; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                        <div class="dataTables_sizing" style="height: 0px; overflow: hidden;">Department Name</div>
                                                    </th>
                                                    <th class="sorting" aria-controls="scroll-vertical-datatable" rowspan="1" colspan="1" style="width: 25%; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-label="Position: activate to sort column ascending">
                                                        <div class="dataTables_sizing" style="height: 0px; overflow: hidden;">Manager</div>
                                                    </th>
                                                </tr>
                                            </thead>



                                            <tbody>

                                                @foreach ($organizations as $organization)
                                                <tr>
                                                    <th scope="row">{{ $organization->id }}</th>
                                                    <td class="sorting_1 dtr-control"><a id="link" href="{{ route('organizations.organization-card', $organization->id) }}">{{ $organization->name }}</a></td>
                                                    <td>
                                                        @if ($organization->manager_id)
                                                        <a id="link" href="{{ route('users.profile-card', $organization->manager_id) }}">{{ $organization->manager->first_name }} {{ $organization->manager->last_name }}</a>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <div>
                                                            <a href="{{ route('organizations.edit', $organization->id) }}" class="btn btn-link"><i class="fas fa-pencil-alt" title="Edit"></i></a>

                                                            <form action="{{ route('organizations.destroy', $organization->id) }}" method="POST" style="display: inline-block; width: auto;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-link" onclick="return confirm('Are you sure you want to delete this organization?')"><i class="fa fa-trash" title="Delete"></i></button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach

                                                <style>
                                                    /* Set link color to the same color as normal text */
                                                    #link {
                                                        color: inherit;
                                                        text-decoration: none;
                                                    }

                                                    /* Set link color to a different color on hover */
                                                    #link:hover {
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

    </div>

</div>
<!-- End Page-content -->
@endsection