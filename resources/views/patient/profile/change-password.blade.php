<?php $page = "index-13"; ?>
@extends('layout.mainlayout_index1')
@section('title', 'Change Password')
@section('content')
    <!-- Header -->
    @include('components.patient_header')
    <!-- /Header -->

    <div class="row align-items-center mt-4">

    </div>
    </div>
    </section>
    <!-- /Home Banner -->
    <section class="change-password">
        <div class="content">
            <div class="container-fluid">

                <div class="row">

                    @include('layout.partials.nav_patient')

                    <div class="col-md-7 col-lg-8 col-xl-9">
                        <div class="container">
                            <!-- Profile Information -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm">

                                        <!-- Change Password Form -->
                                        <form method="POST" action="{{ route('store_new_password') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label>Old Password</label>
                                                <input type="password" name="current_password" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>New Password</label>
                                                <input type="password" name="new_password" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input type="password" name="confirm_password" class="form-control">
                                            </div>
                                            <div class="submit-section">
                                                <button type="submit" class="btn btn-primary submit-btn">Save New
                                                    Password
                                                </button>
                                            </div>
                                        </form>
                                        <!-- /Change Password Form -->

                                    </div>
                                </div>
                            </div>
                            <!-- /Profile Information -->
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- /Page Content -->

@endsection
