@extends('admin.master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <h4 class="font-size-16" style="margin-left: 10px; margin-top:5px;">POSITIONS</h4>
                    </div>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">HRTool</a></li>
                            <li class="breadcrumb-item active">Positions</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('positions.create') }}" class="btn btn-primary mb-3">Create New Position</a>
                </div>

            </div>
        </div>

        <div class="row">

            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">All Pelican Cement Positions</h4>
                    <p class="card-title-desc">
                        See all positions and organization units related to them. Description. Description.
                    </p>

                    <div id="scroll-vertical-datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer table-responsive">

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
                                <div id="scroll-vertical-datatable_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="scroll-vertical-datatable"></label></div>
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
                                                        <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 69.2px;" aria-label="PositionID: activate to sort column ascending">ID</th>
                                                        <th class="sorting_asc" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 139.2px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Name</th>
                                                        <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 139.2px;" aria-label="Description: activate to sort column ascending">Description</th>
                                                        <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 131.2px;" aria-label="Unit: activate to sort column ascending">Unit</th>
                                                        <th style="width: 100px;"></th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="dataTables_scrollBody" style="position: relative; overflow: auto; max-height: 350px; width: 100%;">
                                        <table id="scroll-vertical-datatable" class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline" role="grid" aria-describedby="scroll-vertical-datatable_info" style="width: 100%;">
                                            <thead>
                                                <tr role="row" style="height: 0px;">
                                                    <th class="sorting_asc" aria-controls="scroll-vertical-datatable" rowspan="1" colspan="1" style="width: 188.075px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                                        <div class="dataTables_sizing" style="height: 0px; overflow: hidden;">Name</div>
                                                    </th>
                                                    <th class="sorting" aria-controls="scroll-vertical-datatable" rowspan="1" colspan="1" style="width: 284.812px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-label="Position: activate to sort column ascending">
                                                        <div class="dataTables_sizing" style="height: 0px; overflow: hidden;">Description</div>
                                                    </th>
                                                    <th class="sorting" aria-controls="scroll-vertical-datatable" rowspan="1" colspan="1" style="width: 136.275px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;" aria-label="Office: activate to sort column ascending">
                                                        <div class="dataTables_sizing" style="height: 0px; overflow: hidden;">Unit</div>
                                                    </th>
                                                </tr>
                                            </thead>



                                            <tbody>

                                                @foreach ($positions as $position)
                                                <tr>
                                                    <th scope="row">{{ $position->id }}</th>
                                                    <td class="sorting_1 dtr-control">{{ $position->name }}</td>
                                                    <td>{{ Str::limit($position->description, $limit = 30, $end = '...') }}</td>
                                                    <td>{{ $position->organization->name }}</td>
                                                    <td>

                                                        <div class="btn-group-vertical" role="group" aria-label="Vertical button group">

                                                            <div class="btn-group" role="group">
                                                                <button id="btnGroupVerticalDrop1" type="button" class="btn waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="ri-more-line"></i>
                                                                </button>

                                                                <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1">
                                                                    <a href="{{ route('positions.index') }}" class="btn btn-primary" style="margin-left:12px"><i class="fa fa-user" title="Details"></i></a>
                                                                    <a href="{{ route('positions.edit', $position->id) }}" class="btn btn-primary" style="margin-right:5px; margin-left:5px"><i class="fas fa-pencil-alt" title="Edit"></i></a>
                                                                    <form action="{{ route('positions.destroy', $position->id) }}" method="POST" style="display: inline;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this position?')"><i class="fa fa-trash" title="Delete"></i></button>
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
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="scroll-vertical-datatable_info" role="status" aria-live="polite">Showing {{ $positions->count() }} positions in total</div>
                            </div>
                            <div class="col-sm-12 col-md-7"></div>
                        </div>
                    </div>

                </div> <!-- end card body-->
            </div> <!-- end card -->

        </div>






        _______________________________________________________________________________________________________________________________________________________
        <div class="row">

            <div class="card">
                <div class="card-body">


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
                                            <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 69.2px;" aria-label="PositionID: activate to sort column ascending">ID</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 139.2px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Name</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 139.2px;" aria-label="Description: activate to sort column ascending">Description</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1" colspan="1" style="width: 131.2px;" aria-label="Unit: activate to sort column ascending">Unit</th>
                                            <th style="width: 100px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($positions as $position)
                                        <tr>
                                            <th scope="row">{{ $position->id }}</th>
                                            <td class="sorting_1 dtr-control">{{ $position->name }}</td>
                                            <td>{{ Str::limit($position->description, $limit = 30, $end = '...') }}</td>
                                            <td>{{ $position->organization->name }}</td>
                                            <td>

                                                <div class="btn-group-vertical" role="group" aria-label="Vertical button group">

                                                    <div class="btn-group" role="group">
                                                        <button id="btnGroupVerticalDrop1" type="button" class="btn waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="ri-more-line"></i>
                                                        </button>

                                                        <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1">
                                                            <a href="{{ route('positions.index') }}" class="btn btn-primary" style="margin-left:12px"><i class="fa fa-user" title="Details"></i></a>
                                                            <a href="{{ route('positions.edit', $position->id) }}" class="btn btn-primary" style="margin-right:5px; margin-left:5px"><i class="fas fa-pencil-alt" title="Edit"></i></a>
                                                            <form action="{{ route('positions.destroy', $position->id) }}" method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this position?')"><i class="fa fa-trash" title="Delete"></i></button>
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

        <!--
        @foreach ($positions as $position)
        @if ($position->id == 12)
            {{$position->description}}
        @endif
        @endforeach
-->
    </div>
</div>
</div> <!-- end col -->
</div> <!-- end row -->

</div>

</div>
<!-- End Page-content -->
@endsection