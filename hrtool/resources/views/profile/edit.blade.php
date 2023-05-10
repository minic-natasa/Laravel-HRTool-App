  @extends('admin.master')
  @section('admin')

  <div class="page-content">
      <div class="container-fluid">

          <!-- start page title -->
          <div class="row">
              <div class="col-12">
                  <div class="page-title-box d-flex align-items-center justify-content-between">
                      <div class="d-flex align-items-center">
                          <a href="{{ route('profile.show') }}" class="btn" style="margin-right:5px"><i class="fa fa-caret-left" title="Back"></i></a>
                          <h4 class="font-size-16" style="margin-left: 10px; margin-top:5px;">CHOOSE NEW PASSWORD</h4>
                      </div>
                      <div class="d-flex align-items-center">
                          <div class="page-title-right">
                              <ol class="breadcrumb m-0">
                                  <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">HRTool</a></li>
                                  <li class="breadcrumb-item"><a href="{{ route('profile.show') }}">Profile</a>
                                  <li class="breadcrumb-item active">Update Password</li>
                              </ol>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- end page title -->


          <div class="space-y-6">
             
              <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800" style="margin-bottom: 20px;">
                  <div class="max-w-xl">
                      @include('profile.partials.update-password-form')
                  </div>
              </div>


              <!--
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
                <div class="max-w-xl">
                 @include('profile.partials.delete-user-form') 
                </div>
            </div>
            -->
          </div>
      </div>
  </div>
  <!-- End Page-content -->
  @endsection