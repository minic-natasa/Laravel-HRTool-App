@extends('admin.master')
@section('admin')

@section('title')
Admin Panel | HRTool
@endsection


<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <h4 class="font-size-16" style="margin-left: 10px; margin-top:5px;">Admin Panel</h4>
                    </div>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">HRTool</a></li>
                            <li class="breadcrumb-item active">Admin Panel</a>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->




        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body" style="position: relative; overflow: auto; max-height: 59vh; width: 100%;">
                        <div class="table-responsive">
                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th>#</th>
                                        <th>Profile Picture</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @php
                                    $counter = 1;
                                    @endphp


                                    @foreach ($admins as $admin)
                                    <tr style="text-align: center;">
                                        <th scope="row">{{ $counter }}</th>
                                        <td>
                                            <img src="{{ (!empty($admin->profile_picture) ? url('upload/admin_images/'.$admin->profile_picture) : url('upload/default_image.png')) }}" alt="" class="avatar-sm rounded-circle">
                                        </td>
                                        <td>{{$admin->first_name}} {{$admin->last_name}}</td>
                                        <td>
                                            @if($admin->roles->first()->name == 'admin_it')
                                            Admin IT
                                            @elseif($admin->roles->first()->name == 'admin_hr')
                                            Admin HR
                                            @else
                                            {{ $roles[$admin->roles->first()->id] }}
                                            @endif
                                        </td>
                                        <td>{{$admin->email}}</td>
                                        <td>{{$admin->mobile}}</td>
                                        <td>
                                            @if($admin->status == 'active')
                                            <span class="badge rounded-pill badge-soft-success">Active</span>
                                            @elseif($admin->status == 'inactive')
                                            <span class="badge rounded-pill badge-soft-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div>
                                                <a href="#" class="btn btn-link"><i class="fas fa-pencil-alt" title="Edit"></i></a>
                                                <form action="#" method="POST" style="display: inline-block; width: auto;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link" onclick="return confirm('Are you sure you want to delete admin role for this user?')"><i class="fas fa-times" title="Delete"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @php
                                    $counter++;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>


                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
                Delete - Change admin to user?<br>
                Edit - Change status to Inactive?<br><br>
                Add New Admin: From Employees (change role from user to admin) or open Create form with role:admin (in employees, role:user)<br>
                Status needs to be Active in order to display user - Add Status in List of all users
            </div>
            <!-- end row-->



        </div>
    </div>
    <!-- End Page-content -->
    @endsection