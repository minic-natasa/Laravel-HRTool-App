<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

@extends('admin.master')
@section('admin')

@section('title')
Create New Employee | HRTool
@endsection


<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <h4 class="font-size-16" style="margin-left: 10px; margin-top:5px;">CREATE NEW EMPLOYEE</h4>
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
                            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Employees</a>
                            <li class="breadcrumb-item active">Create New Employee</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="employee_number" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Employee Number') }}</label>

                            <div class="col-md-6">
                                <input id="employee_number" type="text" class="form-control @error('employee_number') is-invalid @enderror" name="employee_number" value="{{ old('employee_number') }}" required autocomplete="employee_number">

                                @error('employee_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name">

                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name_of_one_parent" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Name of One Parent') }}</label>

                            <div class="col-md-6">
                                <input id="name_of_one_parent" type="text" class="form-control @error('name_of_one_parent') is-invalid @enderror" name="name_of_one_parent" value="{{ old('name_of_one_parent') }}" required autocomplete="name_of_one_parent">

                                @error('name_of_one_parent')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="birth_date" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Birth Date') }}</label>

                            <div class="col-md-6">
                                <input id="birth_date" type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" value="{{ old('birth_date') }}" required>

                                @error('birth_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jmbg" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('JMBG') }}</label>

                            <div class="col-md-6">
                                <input id="jmbg" type="text" class="form-control @error('jmbg') is-invalid @enderror" name="jmbg" value="{{ old('jmbg') }}" required autocomplete="jmbg" autofocus>

                                @error('jmbg')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="ID_number" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('ID Number') }}</label>

                            <div class="col-md-6">
                                <input id="ID_number" type="text" class="form-control @error('ID_number') is-invalid @enderror" name="ID_number" value="{{ old('ID_number') }}" required autocomplete="ID_number">

                                @error('ID_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="passport_number" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Passport Number') }}</label>

                            <div class="col-md-6">
                                <input id="passport_number" type="text" class="form-control @error('passport_number') is-invalid @enderror" name="passport_number" value="{{ old('passport_number') }}" required autocomplete="passport_number">

                                @error('passport_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address_in_ID" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Address in ID') }}</label>

                            <div class="col-md-6">
                                <input id="address_in_ID" type="text" class="form-control @error('address_in_ID') is-invalid @enderror" name="address_in_ID" value="{{ old('address_in_ID') }}" required autocomplete="address_in_ID">

                                @error('address_in_ID')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="current_address" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Current Address') }}</label>

                            <div class="col-md-6">
                                <input id="current_address" type="text" class="form-control @error('current_address') is-invalid @enderror" name="current_address" value="{{ old('current_address') }}" required autocomplete="current_address" autofocus>

                                @error('current_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="slava" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Slava') }}</label>

                            <div class="col-md-6">
                                <input id="slava" type="text" class="form-control @error('slava') is-invalid @enderror" name="slava" value="{{ old('slava') }}" required autocomplete="slava">

                                @error('slava')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="private_email" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Private Email') }}</label>

                            <div class="col-md-6">
                                <input id="private_email" type="email" class="form-control @error('private_email') is-invalid @enderror" name="private_email" value="{{ old('private_email') }}" required autocomplete="private_email">

                                @error('private_email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mobile" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Mobile') }}</label>

                            <div class="col-md-6">
                                <input id="mobile" type="tel" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile">

                                @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="bank_account_number" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Bank Account Number') }}</label>

                            <div class="col-md-6">
                                <input id="bank_account_number" type="text" class="form-control @error('bank_account_number') is-invalid @enderror" name="bank_account_number" value="{{ old('bank_account_number') }}" required autocomplete="bank_account_number" autofocus>

                                @error('bank_account_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="emergency_contact_name" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Emergency Contact Name') }}</label>

                            <div class="col-md-6">
                                <input id="emergency_contact_name" type="text" class="form-control @error('emergency_contact_name') is-invalid @enderror" name="emergency_contact_name" value="{{ old('emergency_contact_name') }}" required autocomplete="emergency_contact_name">

                                @error('emergency_contact_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="emergency_contact_number" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Emergency Contact Number') }}</label>

                            <div class="col-md-6">
                                <input id="emergency_contact_number" type="text" class="form-control @error('emergency_contact_number') is-invalid @enderror" name="emergency_contact_number" value="{{ old('emergency_contact_number') }}" required autocomplete="emergency_contact_number">

                                @error('emergency_contact_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="professional_qualifications_level" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Professional Qualifications Level') }}</label>

                            <div class="col-md-6">
                                <select id="professional_qualifications_level" class="form-control @error('professional_qualifications_level') is-invalid @enderror" name="professional_qualifications_level" required>
                                    <option value=""> -- Select professional qualifications level -- </option>
                                    <option value="I" {{ old('professional_qualifications_level') == 'I' ? 'selected' : '' }}>I</option>
                                    <option value="II" {{ old('professional_qualifications_level') == 'II' ? 'selected' : '' }}>II</option>
                                    <option value="III" {{ old('professional_qualifications_level') == 'III' ? 'selected' : '' }}>III</option>
                                    <option value="IV" {{ old('professional_qualifications_level') == 'IV' ? 'selected' : '' }}>IV</option>
                                    <option value="V" {{ old('professional_qualifications_level') == 'V' ? 'selected' : '' }}>V</option>
                                    <option value="VI" {{ old('professional_qualifications_level') == 'VI' ? 'selected' : '' }}>VI</option>
                                    <option value="VII" {{ old('professional_qualifications_level') == 'VII' ? 'selected' : '' }}>VII</option>
                                </select>
                                @error('type_of_contract')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="profession" class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Profession') }}</label>

                            <div class="col-md-6">
                                <input id="profession" type="text" class="form-control @error('profession') is-invalid @enderror" name="profession" value="{{ old('profession') }}" required autocomplete="profession" autofocus>

                                @error('profession')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" style="margin-bottom: 4px;">{{ __('Manager') }}</label>

                            <div class="col-md-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="manager" id="manager_yes" value="1" required>
                                    <label class="form-check-label" for="manager_yes">{{ __('Yes') }}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="manager" id="manager_no" value="0" required>
                                    <label class="form-check-label" for="manager_no">{{ __('No') }}</label>
                                </div>

                                @error('manager')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="profile_picture" class="col-md-2 col-form-label" style="margin-bottom: 4px;">Profile Image</label>

                            <input id="picture-input" name="profile_picture" type="file" class="col-md-6" style="margin-bottom:10px;" :value="old('profile_picture', $user->profile_picture)" autocomplete="profile_picture" />

                            <div style="display: block; text-align: left; margin-left:12vw;">
                                <img id="showImage" src="{{ (!empty($user->profile_picture) ? url('upload/admin_images/'.$user->profile_picture) : url('upload/default_image.png')) }}" class="img-fluid rounded mx-auto" style="max-width: 100%; height: auto; width: 135px;" alt="Profile Picture">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" style="margin-top:10px; margin-bottom:10px">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>


        </div>

    </div>
    <!-- End Page-content -->
    @endsection


    <script>
        $(document).ready(function() {
            // Function to update the image with the cropped data
            function updateImage(imageData) {
                var image = document.getElementById('showImage');
                image.src = imageData;
            }

            $('#picture-input').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    // Create a new image object
                    var image = new Image();
                    // Set the source of the image to the uploaded file data
                    image.src = e.target.result;
                    // Once the image is loaded, crop it to a square and get the new data
                    image.onload = function() {
                        // Calculate the size of the square to crop
                        var size = Math.min(image.width, image.height);
                        // Create a new canvas element with the square size
                        var canvas = document.createElement('canvas');
                        canvas.width = size;
                        canvas.height = size;
                        // Get the context of the canvas
                        var context = canvas.getContext('2d');
                        // Draw the cropped image onto the canvas
                        context.drawImage(image, (image.width - size) / 2, (image.height - size) / 2, size, size, 0, 0, size, size);
                        // Get the new data URL of the cropped image
                        var newDataUrl = canvas.toDataURL('image/png');
                        // Call the function to update the image with the new data
                        updateImage(newDataUrl);
                    };
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>