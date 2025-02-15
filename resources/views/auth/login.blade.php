<?php $page = "index-13"; ?>
@extends('layout.mainlayout_index1')
@section('title', 'Login')
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
                                    <h3>{{ __('web.login') }} </h3>
                                </div>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div  class="form-group form-focus">
                                        <input  type="text" class="form-control floating" name="email" value="{{ old('email', request('email')) }}" id="Email">
                                        <label class="focus-label">{{ __('web.email') }}</label>
                                        @error('0')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                        @enderror
                                        @error('email')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    <input type="hidden" class="form-control floating pass-input" name="timezone" id="timezone" value="">
                                    <div class="form-group form-focus">
                                        <input type="password" class="form-control floating pass-input" name="password" id="password">
                                        <label class="focus-label">{{ __('web.password') }}</label>
                                        <span class="fa fa-eye-slash toggle-password pt-4"></span>
                                        @error('0')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                        @enderror
                                        @error('password')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-6">
                                                <label class="custom_check mr-2 mb-0 d-inline-flex">
                                                    {{ __('web.remember_me') }}
                                                    <input type="checkbox" name="remember">
                                                    <span class="checkmark"></span>
                                                </label>
                                                @error('checkbox')
                                                    <div class="text-danger pt-2">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-6 text-end">
                                                <a class="forgot-link" href="{{url('admin/forgot-password')}}">
                                                    {{ __('web.forgot_password') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-grid">
                                        <button class="btn btn-primary" type="submit">{{ __('web.login') }}</button>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var userTimezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
        var inputElement = document.getElementById('timezone');

        // Set the value of the input element
        inputElement.value = userTimezone;
    });
</script>