@extends('admin.master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">ORGANIZATIONS</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">HRTool</a></li>
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

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Manager</th>
                                    <th>Parent Organization</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($organizations as $organization)
                                <tr>
                                    <td>{{ $organization->name }}</td>
                                    <td>{{ $organization->manager->first_name }} {{ $organization->manager->last_name }}</td>
                                    <td>{{ $organization->parent ? $organization->parent->name : 'N/A' }}</td>
                                    <td>

                                        <a href="{{ route('organizations.edit', $organization->id) }}" class="btn btn-primary" style="margin-right:5px"><i class="fas fa-pencil-alt" title="Edit"></i></a>

                                        <form action="{{ route('organizations.destroy', $organization->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this organization?')"><i class="fa fa-trash" title="Delete"></i></button>
                                        </form>
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

</div>
<!-- End Page-content -->
@endsection