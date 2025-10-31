<?php $page = 'index-13'; ?>
@extends('web.layout.layout')
@section('title', 'Register')
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
        .register .card {
            transition: all 0.3s ease-in-out;
        }

        .register .card:hover {
            transform: scale(1.01);
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.1);
        }
    </style>
    <section class="register py-5" style="background: #f4f8fb;">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-11">
                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                        <div class="row g-0">

                            <!-- Left Image -->
                            <div class="col-lg-5 d-none d-lg-block bg-light">
                                <div class="p-5 text-center">
                                    <img src="{{ URL::asset('/assets/img/login-banner.png') }}" alt="Register Illustration"
                                        class="img-fluid rounded-3" style="max-height: 420px; object-fit: contain;">
                                    <h4 class="mt-4 text-primary fw-bold">
                                        {{ __('web.join_us_today') ?? 'Join Arab Care Today' }}</h4>
                                    <p class="text-muted">Create your patient account and manage appointments easily.</p>
                                </div>
                            </div>

                            <!-- Right Form -->
                            <div class="col-lg-7 bg-white">
                                <div class="p-5">
                                    <div dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" class="text-center mb-4">
                                        <h3 class="fw-bold">{{ __('web.patient_register') }}</h3>
                                        <p class="text-muted">
                                            {{ __('web.create_your_account') ?? 'Fill in the details below to get started' }}
                                        </p>
                                    </div>

                                    @if (session('error'))
                                        <div class="alert alert-danger">{{ session('error') }}</div>
                                    @endif

                                    <form action="{{ route('register') }}" method="POST">
                                        @csrf

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">{{ __('web.name') }}</label>
                                                <input type="text" class="form-control form-control-lg" name="name_en"
                                                    value="{{ old('name_en') }}" required>
                                                @error('name_en')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">{{ __('web.gender') }}</label>
                                                <select name="gender" class="form-select form-select-lg">
                                                    <option value="">{{ __('web.select') }}</option>
                                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>
                                                        {{ __('web.male') }}</option>
                                                    <option value="female"
                                                        {{ old('gender') == 'female' ? 'selected' : '' }}>
                                                        {{ __('web.female') }}</option>
                                                </select>
                                                @error('gender')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">{{ __('web.date_of_birth') }}</label>
                                                <input type="date" class="form-control form-control-lg"
                                                    name="date_of_birth" value="{{ old('date_of_birth') }}">
                                                @error('date_of_birth')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">{{ __('web.id_number') }}</label>
                                                <input type="text" class="form-control form-control-lg" name="id_number"
                                                    value="{{ old('id_number') }}" required>
                                                @error('id_number')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">{{ __('web.nationality') }}</label>
                                                <select name="nationality" class="form-select form-select-lg" required>
                                                    <option value="">{{ __('web.select') }}</option>
                                                    @foreach ($religions as $religion)
                                                        <option value="{{ $religion->id }}"
                                                            {{ old('nationality') == $religion->id ? 'selected' : '' }}>
                                                            {{ $religion->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('nationality')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">{{ __('web.email') }}</label>
                                                <input type="email" class="form-control form-control-lg" name="email"
                                                    value="{{ old('email') }}" required>
                                                @error('email')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">{{ __('web.mobile') }}</label>
                                                <input type="text" class="form-control form-control-lg" name="mobile"
                                                    value="{{ old('mobile') }}" placeholder="05xxxxxxxx" required>
                                                @error('mobile')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">{{ __('web.enter_password') }}</label>
                                                <input type="password" class="form-control form-control-lg" name="password"
                                                    required>
                                                @error('password')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">{{ __('web.confirm_password') }}</label>
                                                <input type="password" class="form-control form-control-lg"
                                                    name="password_confirmation" required>
                                            </div>
                                        </div>

                                        <div class="form-check mb-4">
                                            <input class="form-check-input" type="checkbox" name="terms" id="terms"
                                                required>
                                            <label class="form-check-label" for="terms">
                                                {{ __('web.terms_agree') }}
                                                <a href="#" class="text-primary">{{ __('web.terms_of_service') }}</a>
                                                {{ __('web.and') }}
                                                <a href="#" class="text-primary">{{ __('web.privacy_policy') }}</a>
                                            </label>
                                            @error('terms')
                                                <small class="text-danger d-block">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="d-grid">
                                            <button class="btn btn-primary btn-lg rounded-3" style="background-position: 0 -30px;" type="submit">
                                                {{ __('web.register') }}
                                            </button>
                                        </div>

                                        <div class="text-center mt-4">
                                            <small class="text-muted">{{ __('web.already_have_account') }}</small>
                                            <a href="{{ route('login') }}"
                                                class="fw-semibold text-primary">{{ __('web.login') }}</a>
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
