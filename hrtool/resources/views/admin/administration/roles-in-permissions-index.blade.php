@extends('admin.master')
@section('admin')

@section('title')
Roles with Permissions | HRTool
@endsection


<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <h4 class="font-size-16" style="margin-left: 10px; margin-top:5px;">ACCESS</h4>
                    </div>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">HRTool</a></li>
                            <li class="breadcrumb-item active">Access</a>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!--
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{route('roles.permissions.create')}}" class="btn btn-primary mb-3">Connect Roles with Permissions</a>
                </div>
 -->
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body" style="position: relative; overflow: auto; max-height: 59vh; width: 100%;">
                        <div class="table-responsive">
                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th>#</th>
                                        <th>Role</th>
                                        <th>Permissions</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                              
                                <tbody>
                                    @foreach($roles as $key => $item)
                                    <tr>
                                        <td style="text-align: center;">{{$key + 1}}</td>
                                        <td style="text-align: center;">
                                            @if($item->name == 'admin_it')
                                            Admin IT
                                            @elseif($item->name == 'admin_hr')
                                            Admin HR
                                            @elseif($item->name == 'user')
                                            User
                                            @else {{$item->name}}
                                            @endif</td>
                                        <td style="max-width: 50vw; word-wrap: break-word;">
                                            @foreach($item->permissions as $perm)
                                            <span class="badge rounded-pill badge-soft-primary">{{$perm->name}}</span>
                                            @endforeach
                                        </td>
                                        <td style="text-align: center;">
                                            <div>
                                                <a href="{{ route('roles.permissions.edit', $item->id) }}" class="btn btn-link"><i class="fas fa-pencil-alt" title="Edit"></i></a>
                                                <form action="{{ route('roles.permissions.destroy', $item->id) }}" method="POST" style="display: inline-block; width: auto;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link" onclick="return confirm('Are you sure you want to delete permissions for this role?')"><i class="fa fa-trash" title="Delete"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->



        </div>
    </div>
    <!-- End Page-content -->
    @endsection