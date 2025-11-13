<?php $page = 'index-13'; ?>
@extends('web.layout.layout')
@section('title', 'Verify Email')

@section('main-content')
    <style>
        .verify-request .card {
            transition: all 0.3s ease-in-out;
        }

        .verify-request .card:hover {
            transform: scale(1.01);
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.1);
        }
    </style>

    <section class="verify-request py-5" style="background: #f4f8fb;">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-10">
                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                        <div class="row g-0">
                            <!-- Left Image -->
                            <div class="col-lg-6 d-none d-lg-block bg-light position-relative">
                                <div class="p-5 text-center">
                                    <img src="{{ URL::asset('/assets/img/login-banner.png') }}" alt="Verify Email Illustration"
                                        class="img-fluid rounded-3" style="max-height: 400px; object-fit: contain;">
                                    <h4 class="mt-4 text-primary fw-bold">{{ __('web.verify_email') }}</h4>
                                    <p class="text-muted">
                                        {{ __('web.enter_email_to_verify') ?? 'Please enter your email to receive a verification link.' }}
                                    </p>
                                </div>
                            </div>

                            <!-- Right Form -->
                            <div class="col-lg-6 bg-white">
                                <div class="p-5">
                                    <div dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" class="text-center mb-4">
                                        <h3 class="fw-bold">{{ __('web.verify_email') }}</h3>
                                        <p class="text-muted">
                                            {{ __('web.we_will_send_verification_link') ?? 'We will send a verification link to your email.' }}
                                        </p>
                                    </div>

                                    @if (session('status') == 'verification-link-sent')
                                        <div class="alert alert-success">
                                            {{ __('web.verification_link_sent') ?? 'A new verification link has been sent to your email address.' }}
                                        </div>
                                    @endif

                                    @if (session('error'))
                                        <div class="alert alert-danger">{{ session('error') }}</div>
                                    @endif
                                    @if (session('success'))
                                        <div class="alert alert-success">{{ session('success') }}</div>
                                    @endif

                                    <form method="POST" action="{{ route('verification.send') }}">
                                        @csrf

                                        <div class="mb-3">
                                            <label class="form-label">{{ __('web.email') }}</label>
                                            <input type="email" class="form-control form-control-lg" name="email"
                                                value="{{ old('email') }}" placeholder="example@email.com">
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="d-grid">
                                            <button class="btn btn-primary btn-lg rounded-3" type="submit">
                                                {{ __('web.verify') }}
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
@endsection
