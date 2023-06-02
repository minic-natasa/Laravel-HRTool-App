@extends('admin.master')
@section('admin')

@section('title')
Positions | HRTool
@endsection

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
                            <li class="breadcrumb-item">
                                @if(Auth::user()->hasRole(['admin_hr', 'admin_it']))
                                <a href="{{ route('admin.index') }}">HRTool</a>
                                @else
                                <a href="/homepage">HRTool</a>
                                @endif
                            </li>
                            <li class="breadcrumb-item active">Positions</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        @if(Auth::user()->can('position.create'))
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('positions.create') }}" class="btn btn-primary mb-3">Create new Position</a>
                </div>

            </div>
        </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body" style="position: relative; overflow: auto; max-height: 59vh; width: 100%;">
                        <div class="table-responsive">
                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th>#</th>
                                        <th>Name</th>
                                        @if(Auth::user()->can('position.profile'))
                                        <th>Description</th>
                                        @endif
                                        <th>Organization</th>
                                        @if(Auth::user()->can('employee.edit') || Auth::user()->can('employee.delete'))
                                        <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>

                                <tbody>

                                    @php
                                    $counter = 1;
                                    @endphp

                                    @foreach ($positions as $position)
                                    <tr style="text-align: center;">
                                        <th scope="row">{{ $counter }}</th>
                                        <td>
                                            @if(Auth::user()->can('position.profile'))
                                            <a id="link" href="{{ route('positions.position-card', ['id' => $position->id]) }}">{{ $position->name }}</a>
                                            @else
                                            {{ $position->name }}
                                            @endif
                                        </td>
                                        @if(Auth::user()->can('position.profile'))
                                        <td>{{ Str::limit($position->description, $limit = 30, $end = '...') }}</td>
                                        @endif
                                        <td>
                                            @if(Auth::user()->can('organization.profile'))
                                            <a id="link" href="{{ route('organizations.organization-card', $position->organization->id) }}">{{ $position->organization->name }}</a>
                                        </td>
                                        @else
                                        {{ $position->organization->name }}
                                        @endif
                                        <td>
                                            <div>
                                                @if(Auth::User()->can('position.edit'))
                                                <a href="{{ route('positions.edit', $position->id) }}" class="btn btn-link"><i class="fas fa-pencil-alt" title="Edit"></i></a>
                                                @endif
                                                @if(Auth::User()->can('position.delete'))
                                                <form action="{{ route('positions.destroy', $position->id) }}" method="POST" style="display: inline-block; width: auto;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link" onclick="return confirm('Are you sure you want to delete this position?')"><i class="fa fa-trash" title="Delete"></i></button>
                                                </form>
                                                @endif
                                            </div>
                                        </td>

                                    </tr>

                                    @php
                                    $counter++;
                                    @endphp
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
            <!--
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="scroll-vertical-datatable_info" style="margin-top: 10px;" role="status" aria-live="polite">Showing {{ $positions->count() }} positions in total</div>
                            </div>
                            <div class="col-sm-12 col-md-7"></div>
                        </div>
                        -->
        </div>

    </div> <!-- end card body-->
</div> <!-- end card -->

</div>
</div>
</div>
<!-- End Page-content -->
@endsection