{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}


<?php $page = "index-13"; ?>
@extends('layout.mainlayout_index1')
@section('title', 'Forget Password')
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
                                    <h3>{{ __('web.forget_password') }}</h3>
                                    <p>{{ __('web.forget_password_subtitle') ?? 'Enter your email to receive a reset OTP.' }}</p>
                                </div>
                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                    <div  class="form-group form-focus">
                                        <input  type="text" class="form-control floating" name="email" value="{{ old('email', request('email')) }}" id="Email">
                                        <label class="focus-label">{{ __('web.email') }}</label>
                                        @error('email')
                                            <div class="text-danger my-2">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    <input type="hidden" class="form-control floating pass-input" name="timezone" id="timezone" value="">
                                    
                                    <div class="d-grid">
                                        <button class="btn btn-primary" type="submit">{{ __('web.send_reset_otp') ?? 'Send Password Reset OTP' }}</button>
                                    </div>
                                    <div dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" class="dont-have">
                                        {{ __('web.remember_password') ?? 'Remember your password?' }}
                                        <a href="{{ route('login') }}">{{ __('web.login') }}</a>
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