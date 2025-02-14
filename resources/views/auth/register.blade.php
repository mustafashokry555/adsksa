<?php $page = 'index-13'; ?>
@extends('layout.mainlayout_index1')
@section('title', 'Register')
@section('content')
    <!-- Header -->
    @include('components.patient_header')
    <!-- /Header -->

    <div class="row align-items-center mt-4">

    </div>
    </div>
    </section>
    <!-- /Home Banner -->
    <section class="register">
        <div class="content" style="min-height:205px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="account-content">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-md-7 col-lg-6 login-left">
                                    <img src="{{ URL::asset('/assets/img/login-banner.png') }}" class="img-fluid"
                                        alt="Doccure Register">
                                </div>
                                <div class="col-md-12 col-lg-6 login-right">
                                    <div dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" class="login-header">
                                        <h3>{{ __('web.patient_register') }}</h3>
                                    </div>

                                    <!-- Register Form -->
                                    <form action="{{ route('register') }}" method="POST">
                                        @csrf
                                        <div class="form-group form-focus">
                                            <input type="text" class="form-control floating" id="name_en"
                                                name="name_en" value="{{ old('name_en') }}" required>
                                            <label class="focus-label">{{ __('web.name') }}</label>
                                            @error('name_en')
                                                <div class="text-danger pt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group form-focus">
                                            <input type="email" id="email_address" class="form-control floating"
                                                name="email" value="{{ old('email') }}" required>
                                            <label class="focus-label">{{ __('web.email') }}</label>
                                            @error('email')
                                                <div class="text-danger pt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group form-focus">
                                            <input type="password" id="password" class="form-control floating pass-input"
                                                name="password" required>
                                            <label class="focus-label">{{ __('web.enter_password') }}</label>
                                            <span class="fa fa-eye-slash toggle-password pt-4"></span>
                                            @error('password')
                                                <div class="text-danger pt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group form-focus">
                                            <input type="password" id="password_confirmation"
                                                class="form-control floating pass-input" name="password_confirmation"
                                                required>
                                            <label class="focus-label">{{ __('web.confirm_password') }}</label>
                                            <span class="fa fa-eye-slash toggle-password pt-4"></span>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div  class="col-12">
                                                    <label class="custom_check mr-2 mb-0">
                                                        {{ __('web.terms_agree') }}
                                                        <a href="#" class="text-primary">
                                                            {{ __('web.terms_of_service') }}</a>
                                                        {{ __('web.and') }}
                                                        <a href="#"
                                                            class="text-primary">{{ __('web.privacy_policy') }}</a>
                                                        <input type="checkbox" name="terms" required>
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    @error('terms')
                                                        <div class="text-danger pt-2">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-grid">
                                            <button class="btn btn-primary"
                                                type="submit">{{ __('web.register') }}</button>
                                        </div>

                                        <div dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" class="dont-have">
                                            {{ __('web.already_have_account') }}
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
