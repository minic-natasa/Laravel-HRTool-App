<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<section>

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="row">
                            <div class="col-12">
                                <h4 class="mb-sm-0">Profile Information</h4>
                            </div>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Update your account's profile information.") }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="py-12">
                    <div class="max-w-7xl sm:px-6 lg:px-8">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <!--    
                        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                                @csrf
                            </form>
                                -->
                            <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                                @csrf
                                @method('patch')

                                <div class="form-group row">
                                    <label for="name_of_one_parent" class="col-md-2 col-form-label" style="margin-bottom: 4px;">Name of the parent:</label>

                                    <x-form.input id="name_of_one_parent" name="name_of_one_parent" type="text" class="col-md-6" style="margin-bottom:10px" :value="old('name_of_one_parent', $user->name_of_one_parent)" required autofocus autocomplete="name_of_one_parent" />
                                    <x-form.error :messages="$errors->get('name_of_one_parent')" />

                                </div>

                                <div class="form-group row">
                                    <label for="birth_date" class="col-md-2 col-form-label" style="margin-bottom: 4px;">Birthdate:</label>

                                    <x-form.input id="birth_date" name="birth_date" type="date" class="col-md-6" style="margin-bottom:10px" :value="old('birth_date', $user->birth_date)" required autofocus autocomplete="birth_date" />

                                    <x-form.error :messages="$errors->get('birth_date')" />
                                </div>

                                <div class="form-group row">
                                    <label for="address_in_ID" class="col-md-2 col-form-label" style="margin-bottom: 4px;">Address in ID:</label>

                                    <x-form.input id="address_in_ID" name="address_in_ID" type="text" class="col-md-6" style="margin-bottom:10px" :value="old('address_in_ID', $user->address_in_ID)" required autocomplete="address_in_ID" />

                                    <x-form.error :messages="$errors->get('address_in_ID')" />
                                </div>

                                <div class="form-group row">
                                    <label for="current_address" class="col-md-2 col-form-label" style="margin-bottom: 4px;">Current address:</label>

                                    <x-form.input id="current_address" name="current_address" type="text" class="col-md-6" style="margin-bottom:10px" :value="old('current_address', $user->current_address)" required autocomplete="current_address" />

                                    <x-form.error :messages="$errors->get('current_address')" />
                                </div>

                                <div class="form-group row">
                                    <label for="slava" class="col-md-2 col-form-label" style="margin-bottom: 4px;">Slava:</label>

                                    <x-form.input id="slava" name="slava" type="text" class="col-md-6" style="margin-bottom:10px" :value="old('slava', $user->slava)" required autocomplete="slava" />

                                    <x-form.error :messages="$errors->get('slava')" />
                                </div>

                                <div class="form-group row">
                                    <label for="private_email" class="col-md-2 col-form-label" style="margin-bottom: 4px;">Private email:</label>

                                    <x-form.input id="private_email" name="private_email" type="text" class="col-md-6" style="margin-bottom:10px" :value="old('private_email', $user->private_email)" required autocomplete="private_email" />

                                    <x-form.error :messages="$errors->get('private_email')" />
                                </div>

                                <div class="form-group row">
                                    <label for="mobile" class="col-md-2 col-form-label" style="margin-bottom: 4px;">Mobile:</label>

                                    <x-form.input id="mobile" name="mobile" type="text" class="col-md-6" style="margin-bottom:10px" :value="old('mobile', $user->mobile)" required autocomplete="mobile" />

                                    <x-form.error :messages="$errors->get('mobile')" />
                                </div>

                                <div class="form-group row">
                                    <label for="bank_account_number" class="col-md-2 col-form-label" style="margin-bottom: 4px;">Bank account number:</label>

                                    <x-form.input id="bank_account_number" name="bank_account_number" type="text" class="col-md-6" style="margin-bottom:10px" :value="old('bank_account_number', $user->bank_account_number)" required autocomplete="bank_account_number" />

                                    <x-form.error :messages="$errors->get('bank_account_number')" />
                                </div>

                                <div class="form-group row">
                                    <label for="emergency_contact_name" class="col-md-2 col-form-label" style="margin-bottom: 4px;">Emergency Contact Name:</label>

                                    <x-form.input id="emergency_contact_name" name="emergency_contact_name" type="text" class="col-md-6" style="margin-bottom:10px" :value="old('emergency_contact_name', $user->emergency_contact_name)" required autocomplete="emergency_contact_name" />

                                    <x-form.error :messages="$errors->get('emergency_contact_name')" />
                                </div>

                                <div class="form-group row">
                                    <label for="emergency_contact_number" class="col-md-2 col-form-label" style="margin-bottom: 4px;">Emergency Contact Number:</label>

                                    <x-form.input id="emergency_contact_number" name="emergency_contact_number" type="text" class="col-md-6" style="margin-bottom:10px" :value="old('emergency_contact_number', $user->emergency_contact_number)" required autocomplete="emergency_contact_number" />

                                    <x-form.error :messages="$errors->get('emergency_contact_number')" />
                                </div>

                                <div class="form-group row">
                                    <label for="jmbg" class="col-md-2 col-form-label" style="margin-bottom: 4px;">JMBG:</label>

                                    <x-form.input id="jmbg" name="jmbg" type="text" class="col-md-6" style="margin-bottom:10px" :value="old('jmbg', $user->jmbg)" required autocomplete="jmbg" />

                                    <x-form.error :messages="$errors->get('jmbg')" />
                                </div>

                                <div class="form-group row">
                                    <label for="passport_number" class="col-md-2 col-form-label" style="margin-bottom: 4px;">Passport Number:</label>

                                    <x-form.input id="passport_number" name="passport_number" type="text" class="col-md-6" style="margin-bottom:10px" :value="old('passport_number', $user->passport_number)" required autocomplete="passport_number" />

                                    <x-form.error :messages="$errors->get('passport_number')" />
                                </div>

                                <div class="form-group row">
                                    <label for="ID_number" class="col-md-2 col-form-label" style="margin-bottom: 4px;">ID Number:</label>

                                    <x-form.input id="ID_number" name="ID_number" type="text" class="col-md-6" style="margin-bottom:10px" :value="old('ID_number', $user->ID_number)" required autocomplete="ID_number" />

                                    <x-form.error :messages="$errors->get('passport_number')" />
                                </div>

                                <div class="form-group row">
                                    <label for="employee_number" class="col-md-2 col-form-label" style="margin-bottom: 4px;">Employee Number:</label>

                                    <x-form.input id="employee_number" name="employee_number" type="text" class="col-md-6" style="margin-bottom:10px" :value="old('employee_number', $user->employee_number)" required autocomplete="employee_number" />

                                    <x-form.error :messages="$errors->get('employee_number')" />
                                </div>


                                <!--
                                <div class="form-group row">
                                    <x-form.label for="email" :value="__('Email')" />

                                    <x-form.input id="email" name="email" type="email" class="block w-full" :value="old('email', $user->email)" required autocomplete="email" />

                                    <x-form.error :messages="$errors->get('email')" />

                                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                    <div>
                                        <p class="text-sm mt-2 text-gray-800 dark:text-gray-300">
                                            {{ __('Your email address is unverified.') }}

                                            <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500  dark:text-gray-400 dark:hover:text-gray-200 dark:focus:ring-offset-gray-800">
                                                {{ __('Click here to re-send the verification email.') }}
                                            </button>
                                        </p>

                                        @if (session('status') === 'verification-link-sent')
                                        <p class="mt-2 font-medium text-sm text-green-600">
                                            {{ __('A new verification link has been sent to your email address.') }}
                                        </p>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                                    -->



                                <div class="form-group row">
                                    <label for="profile_picture" class="col-md-2 col-form-label" style="margin-bottom: 4px;">Profile Image:</label>

                                    <!-- 
                                    <input name="profile_picture" class="col-md-6 form-control" type="file" id="picture-input"style="margin-bottom:10px">
                                    -->

                                    <input id="picture-input" name="profile_picture" type="file" class="col-md-6" style="margin-bottom:10px;" :value="old('profile_picture', $user->profile_picture)" required autocomplete="profile_picture" />
                                    <div style="display: block; text-align: left; margin-left:12vw;">
                                        <img id="showImage" src="{{ (!empty(Auth::User()->profile_picture) ? url('upload/admin_images/'.Auth::User()->profile_picture) : url('upload/default_image.png')) }}" class="img-fluid rounded mx-auto" style="max-width: 100%; height: auto; width: 200px;" alt="Profile Picture">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-2">
                                        <button type="submit" class="btn btn-primary" style="margin-top:10px; margin-bottom:10px; margin-left:-11px">Save</button>
                                    </div>
                                </div>


                                @if (session('status') === 'profile-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600 dark:text-gray-400">
                                    {{ __('Saved.') }}
                                </p>
                                @endif
                        </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<script type="text/javascript">
    $(document).ready(function() {
        $('#picture-input').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>