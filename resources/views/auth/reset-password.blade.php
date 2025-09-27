{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Reset Password') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}


<?php $page = "index-13"; ?>
@extends('layout.mainlayout_index1')
@section('title', 'Reset Password')
@section('content')
<!-- Header -->
@include('components.patient_header')
<!-- /Header -->

<div class="row align-items-center mt-4">

</div>
</div>
</section>
<!-- /Home Banner -->
<section class="login">
    <div class="content" style="min-height:205px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="account-content">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-7 col-lg-6 login-left">
                                <img src="{{ URL::asset('/assets/img/login-banner.png')}}" class="img-fluid" alt="Doccure Login">
                            </div>
                            <div  class="col-md-12 col-lg-6 login-right">
                                <div  dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" class="login-header">
                                    <h3>{{ __('web.reset_password') }} </h3>
                                </div>
                                <form method="POST" action="{{ route('verification.send') }}">
                                    @csrf
                                    
                                    <input type="hidden" class="form-control floating pass-input" name="timezone" id="timezone" value="">
                                    <input type="hidden" class="form-control floating pass-input" name="email" value="{{ $email }}">
                                    
                                    <div class="form-group form-focus">
                                        <input type="text" class="form-control floating" name="token" value="{{ old('token') }}" id="token">
                                        <label class="focus-label">{{ __('web.otp') }}</label>
                                        @error('token')
                                            <div class="text-danger my-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group form-focus">
                                        <input type="password" class="form-control floating" name="password" id="Password">
                                        <label class="focus-label">{{ __('web.new_password') }}</label>
                                        @error('password')
                                            <div class="text-danger my-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group form-focus">
                                        <input type="password" class="form-control floating" name="password_confirmation" id="PasswordConfirmation">
                                        <label class="focus-label">{{ __('web.confirm_password') }}</label>
                                    </div>

                                    <input type="hidden" class="form-control floating pass-input" name="timezone" id="timezone" value="">

                                    <div class="d-grid">
                                        <button class="btn btn-primary" type="submit">{{ __('web.reset_password') }}</button>
                                    </div>
                                    <div  dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" class="dont-have">
                                        <a href="{{ route('password.request') }}">{{ __('web.resend_otp') }}</a>
                                    </div>
                                    <div class="login-or">
                                        <span class="or-line"></span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Page Content -->

@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var userTimezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
        var inputElement = document.getElementById('timezone');

        // Set the value of the input element
        inputElement.value = userTimezone;
    });
</script>