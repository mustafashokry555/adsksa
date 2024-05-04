<?php $page = "index-13"; ?>
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
        <!-- Page Content -->
        <div class="content" style="min-height:205px;">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-8 offset-md-2">

                        <!-- Register Content -->
                        <div class="account-content">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-md-7 col-lg-6 login-left">
                                    <img src="{{ URL::asset('/assets/img/login-banner.png')}}" class="img-fluid"
                                         alt="Doccure Register">
                                </div>
                                <div class="col-md-12 col-lg-6 login-right">
                                    <div class="login-header">
                                        <h3>Patient Register</h3>
                                    </div>

                                    <!-- Register Form -->
                                    <form action="{{ route('register') }}" method="POST">
                                        @csrf
                                        <div class="form-group form-focus">
                                            <input type="text" class="form-control floating" id="name" name="name"
                                                   value="{{old('name')}}" required>
                                            <label class="focus-label">Name</label>
                                            @error('name')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group form-focus">
                                            <input type="email" id="email_address" class="form-control floating"
                                                   name="email" required>
                                            <label class="focus-label"> Email</label>
                                            @error('email')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group form-focus">
                                            <input type="password" id="password"
                                                   class="form-control floating pass-input" name="password"
                                                   value="{{old('password')}}" required>
                                            <label class="focus-label">Enter Password</label><span
                                                class="fa fa-eye-slash toggle-password pt-4"></span>
                                            @error('password')
                                            <div class="text-danger pt-2">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="form-group form-focus">
                                            <input type="password" id="password_confirmation"
                                                   class="form-control floating pass-input"
                                                   name="password_confirmation" required>
                                            <label class="focus-label">Confirm Password</label><span
                                                class="fa toggle-password pt-4"></span>
                                            <div class="text-danger pt-2">
                                                @error('password')
                                                {{$message}}
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="custom_check mr-2 mb-0"> I agree to the <a
                                                            href="#" class="text-primary"> terms of service</a> and
                                                        <a href="#" class="text-primary">privacy policy</a>
                                                        <input type="checkbox" name="radio">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-grid">
                                            <button class="btn btn-primary" type="submit">Register</button>
                                        </div>
                                        <div class="dont-have">Already have an account? <a
                                                href="{{ route('login') }}">Login</a></div>
                                        <div class="login-or">
                                            <span class="or-line"></span>
                                            <!-- <p class="span-or">or login with </p> -->
                                        </div>
                                        <!-- Social Login -->
                                        <!-- <div class="social-login">
                                            <a href="#"><img
                                                    src="{{ URL::asset('/assets_admin/img/icon/google.png')}}"
                                                    class="img-fluid" alt="Logo"></a>
                                            <a href="#"><img
                                                    src="{{ URL::asset('/assets_admin/img/icon/facebook.png')}}"
                                                    class="img-fluid" alt="Logo"></a>
                                            <a href="#"><img
                                                    src="{{ URL::asset('/assets_admin/img/icon/twitter.png')}}"
                                                    class="img-fluid" alt="Logo"></a>
                                        </div> -->
                                        <!-- /Social Login -->
                                    </form>
                                    <!-- /Register Form -->

                                </div>
                            </div>
                        </div>
                        <!-- /Register Content -->

                    </div>
                </div>

            </div>

        </div>
        <!-- /Page Content -->
    </section>
    <!-- /Page Content -->

@endsection
