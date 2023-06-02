@extends('admin.master')
@section('admin')

@section('title')
Organizations | HRTool
@endsection

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
                        <li class="breadcrumb-item">
                                @if(Auth::user()->hasRole(['admin_hr', 'admin_it']))
                                <a href="{{ route('admin.index') }}">HRTool</a>
                                @else
                                <a href="/homepage">HRTool</a>
                                @endif
                            </li>
                            <li class="breadcrumb-item active">Organizations</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        @if(Auth::user()->can('organization.create'))
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('organizations.create') }}" class="btn btn-primary mb-3">Create new Organization</a>
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
                                        <th>Organization Name</th>
                                        <th>Manager</th>
                                        @if(Auth::user()->can('organization.edit') || Auth::user()->can('organization.delete'))
                                        <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>

                                    @php
                                    $counter = 1;
                                    @endphp


                                    @foreach ($organizations as $organization)
                                    <tr style="text-align: center;">
                                        <th scope="row">{{ $counter }}</th>
                                        <td>
                                            @if(Auth::user()->can('organization.profile'))
                                            <a id="link" href="{{ route('organizations.organization-card', ['id' => $organization->id]) }}">{{ $organization->name }}</a>
                                            @else
                                            {{ $organization->name }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($organization->manager_id)
                                            @can('employee.profile')
                                            <a id="link" href="{{ route('users.profile-card', $organization->manager_id) }}">{{ $organization->manager->first_name }} {{ $organization->manager->last_name }}</a>
                                            @else
                                            {{ $organization->manager->first_name }} {{ $organization->manager->last_name }}
                                            @endcan
                                            @else
                                            {{ '/' }}
                                            @endif
                                        </td>
                                        <td>
                                            <div>
                                                @if(Auth::User()->can('organization.edit'))
                                                <a href="{{ route('organizations.edit', $organization->id) }}" class="btn btn-link"><i class="fas fa-pencil-alt" title="Edit"></i></a>
                                                @endif
                                                @if(Auth::User()->can('organization.delete'))
                                                <form action="{{ route('organizations.destroy', $organization->id) }}" method="POST" style="display: inline-block; width: auto;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link" onclick="return confirm('Are you sure you want to delete this organization?')"><i class="fa fa-trash" title="Delete"></i></button>
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

        </div>

    </div> <!-- end card body-->
</div> <!-- end card -->

</div>

</div>

</div>
<!-- End Page-content -->
@endsection