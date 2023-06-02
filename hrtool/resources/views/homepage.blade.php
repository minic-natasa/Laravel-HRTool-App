@extends('admin.master')
@section('admin')

@section('title')
Homepage | HRTool
@endsection

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
                        <h4 class="font-size-16" style="margin-left: 10px; margin-top:5px;">HOMEPAGE</h4>
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
                            <li class="breadcrumb-item active">Homepage</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->


        @role('admin_it|admin_hr')
        <!--
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <a class="btn btn-primary" style="margin-top:10px; margin-bottom:10px; margin-left:60px" href="/admin-dashboard">
                 Admin Dashboard
                </a>
            </div>
        </div><br><br>
        -->
        @endrole

        @role('user')
        <!--
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <a class="btn btn-primary" style="margin-top:10px; margin-bottom:10px; margin-left:60px" href="/user-dashboard">
                    User Dashboard
                </a>
            </div>
        </div>
        -->
        @endrole





    </div>

</div>
<!-- End Page-content -->
@endsection