<?php $page = "reset-password"; ?>
@extends('web.layout.layout')

@section('title', __('web.reset_password'))

@section('main-content')

<!-- Page Content -->
<section class="section login-page">
    <div class="container">
        <div class="row align-items-center justify-content-center">

            <!-- Image Side -->
            <div class="col-md-6 col-lg-5 d-none d-md-block">
                <div class="text-center">
                    <img src="{{ asset('assets/img/login-banner.png') }}" class="img-fluid" alt="{{ __('web.reset_password') }}">
                </div>
            </div>

            <!-- Form Side -->
            <div class="col-md-10 col-lg-6">
                <div class="account-box">
                    <div dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" class="account-header text-center mb-4">
                        <h3>{{ __('web.reset_password') }}</h3>
                    </div>

                    <form method="POST" action="{{ route('password.update') }}" class="account-form">
                        @csrf

                        <input type="hidden" name="email" value="{{ $email }}">

                        <!-- OTP -->
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" name="token" id="token" value="{{ old('token') }}" required>
                            <label class="focus-label">{{ __('web.otp') }}</label>
                            @error('token')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div class="form-group form-focus">
                            <input type="password" class="form-control floating" name="password" id="Password" required>
                            <label class="focus-label">{{ __('web.new_password') }}</label>
                            @error('password')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group form-focus">
                            <input type="password" class="form-control floating" name="password_confirmation" id="PasswordConfirmation" required>
                            <label class="focus-label">{{ __('web.confirm_password') }}</label>
                        </div>

                        <!-- Submit -->
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('web.reset_password') }}
                            </button>
                        </div>

                        <!-- Resend OTP -->
                        <div class="text-center mt-3" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                            <a href="{{ route('password.request') }}" class="text-primary">
                                {{ __('web.resend_otp') }}
                            </a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- /Page Content -->

@endsection
