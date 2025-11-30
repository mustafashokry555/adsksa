<?php $page = 'index-13'; ?>
@extends('web.layout.layout')
@section('title', 'Login')
@section('main-content')
    <!-- Header -->
    {{-- @include('components.patient_header') --}}
    <!-- /Header -->

    <div class="row align-items-center mt-4">

    </div>
    </div>
    </section>
    <!-- /Home Banner -->
    <style>
        .login .card {
            transition: all 0.3s ease-in-out;
        }

        .login .card:hover {
            transform: scale(1.01);
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.1);
        }
    </style>
    <section class="login py-5" >
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-10">
                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                        <div class="row g-0">
                            <!-- Left Image -->
                            <div class="col-lg-6 d-none d-lg-block bg-light position-relative">
                                <div class="p-5 text-center">
                                    <img src="{{ URL::asset('/assets/img/login-banner.png') }}" alt="Login Illustration"
                                        class="img-fluid rounded-3" style="max-height: 400px; object-fit: contain;">
                                    <h4 class="mt-4 text-primary fw-bold">Welcome Back!</h4>
                                    <p class="text-muted">Sign in to manage your appointments and medical records.</p>
                                </div>
                            </div>

                            <!-- Right Form -->
                            <div class="col-lg-6 bg-white">
                                <div class="p-5">
                                    <div dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" class="text-center mb-4">
                                        <h3 class="fw-bold">{{ __('web.login') }}</h3>
                                        <p class="text-muted">
                                            {{ __('web.sign_in_to_continue') ?? 'Access your account below' }}</p>
                                    </div>

                                    @if (session('error'))
                                        <div class="alert alert-danger">{{ session('error') }}</div>
                                    @endif
                                    @if (session('success'))
                                        <div class="alert alert-success">{{ session('success') }}</div>
                                    @endif

                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div class="mb-3">
                                            <label class="form-label">{{ __('web.email') }}</label>
                                            <input type="text" class="form-control form-control-lg" name="email"
                                                value="{{ old('email', request('email')) }}"
                                                placeholder="example@email.com">
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <input type="hidden" name="timezone" id="timezone" value="">

                                        <div class="mb-3">
                                            <label class="form-label">{{ __('web.password') }}</label>
                                            <input type="password" class="form-control form-control-lg" name="password"
                                                placeholder="••••••••">
                                            @error('password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember">
                                                <label class="form-check-label"
                                                    for="remember">{{ __('web.remember_me') }}</label>
                                            </div>
                                            <a href="{{ route('password.request') }}"
                                                class="text-decoration-none text-primary">
                                                {{ __('web.forgot_password') }}
                                            </a>
                                        </div>

                                        <div class="d-grid">
                                            <button class="btn btn-primary btn-lg rounded-3" style="background-position: 0 -30px;" type="submit">
                                                {{ __('web.login') }}
                                            </button>
                                        </div>

                                        <div class="text-center mt-4">
                                            <small class="text-muted">{{ __('web.dont_have_account') }}</small>
                                            <a href="{{ route('register') }}" class="fw-semibold text-primary">
                                                {{ __('web.sign_up') }}
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- End Right Form -->
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
