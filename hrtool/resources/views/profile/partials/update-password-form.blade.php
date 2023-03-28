<section>

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="row">
                            <div class="col-12">
                                <h4 class="mb-sm-0">Update Password</h4>
                            </div>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Ensure your account is using a long, random password to stay secure.') }}
                            </p>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="py-12">
                    <div class="max-w-7xl sm:px-6 lg:px-8">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <form method="post" action="{{ route('password.update') }}">
                                @csrf
                                @method('put')

                                <div class="form-group row">
                                    <label for="current_password" class="col-md-2 col-form-label" style="margin-bottom: 4px;">Current Password:</label>

                                    <x-form.input id="current_password" name="current_password" type="password" class="col-md-6" style="margin-bottom:10px" autocomplete="current-password" />

                                    <x-form.error :messages="$errors->updatePassword->get('current_password')" />
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-2 col-form-label" style="margin-bottom: 4px;">New Password:</label>


                                    <x-form.input id="password" name="password" type="password" class="col-md-6" style="margin-bottom:10px" autocomplete="new-password" />

                                    <x-form.error :messages="$errors->updatePassword->get('password')" />
                                </div>

                                <div class="form-group row">
                                    <label for="password_confirmation" class="col-md-2 col-form-label" style="margin-bottom: 4px;">Confirm Password:</label>

                                    <x-form.input id="password_confirmation" name="password_confirmation" type="password" class="col-md-6" style="margin-bottom:10px" autocomplete="new-password" />

                                    <x-form.error :messages="$errors->updatePassword->get('password_confirmation')" />
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-2">
                                        <button type="submit" class="btn btn-primary" style="margin-top:10px; margin-bottom:10px">Save</button>
                                    </div>
                                </div>

                                @if (session('status') === 'password-updated')
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
    <!-- End Page-content -->
</section>