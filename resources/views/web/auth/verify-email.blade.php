{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button>
                        {{ __('Resend Verification Email') }}
                    </x-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout> --}}

<?php $page = "index-13"; ?>
@extends('layout.mainlayout_index1')
@section('title', 'Verify Email')
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
                                    <h3>{{ __('web.verify_email') }}</h3>
                                    <p class="text-muted">{{ __('web.enter_email_to_verify') }}</p>
                                </div>
                                <form method="POST" action="{{ route('verification.send') }}">
                                    @csrf
                                    <div  class="form-group form-focus">
                                        <input  type="text" class="form-control floating" name="email" value="{{ old('email') }}" id="email">
                                        <label class="focus-label">{{ __('web.email') }}</label>
                                        @error('email')
                                            <div class="text-danger my-2">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    
                                    <div class="d-grid">
                                        <button class="btn btn-primary" type="submit">{{ __('web.verify') }}</button>
                                    </div>
                                    <div  dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" class="dont-have">
                                        {{ __('web.dont_have_account') }}
                                        <a href="{{ route('register') }}">{{ __('web.sign_up') }}</a>
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