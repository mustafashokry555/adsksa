<?php $page = 'index-13'; ?>
@extends('layout.mainlayout_index1')
@section('title', 'Edit Profile')
@section('content')
    <!-- Header -->
    @include('components.patient_header')
    <!-- /Header -->

    <div class="row align-items-center mt-4">

    </div>
    </div>
    </section>
    <!-- /Home Banner -->
    <section class="edit-profile">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @include('layout.partials.nav_patient')
                    <div class="col-md-7 col-lg-8 col-xl-9">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">Insurance Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <strong>Insurance:</strong>
                                        <p class="text-muted">{{ optional($insurance_details->insurance)->name_en }} < {{ optional($insurance_details->insurance)->name_ar }}></p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>Medical Network:</strong>
                                        <p class="text-muted">{{ optional($insurance_details)->medical_network }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>Category:</strong>
                                        <p class="text-muted">{{ optional($insurance_details)->category }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>Co-Payment Percentage:</strong>
                                        <p class="text-muted">{{ optional($insurance_details)->co_payment_percentage }}%</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>Submission Date:</strong>
                                        <p class="text-muted">{{ optional($insurance_details)->submission_date }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>Subscriber Type:</strong>
                                        <p class="text-muted">{{ optional($insurance_details)->subscriber_type }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>Insurance Policy Number:</strong>
                                        <p class="text-muted">{{ optional($insurance_details)->insurance_policy_number }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>Coverage Limits:</strong>
                                        <p class="text-muted">{{ optional($insurance_details)->coverage_limits }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>Insurance Expiry Date:</strong>
                                        <p class="text-muted">{{ optional($insurance_details)->insurance_expiry_date }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>Subscriber Number:</strong>
                                        <p class="text-muted">{{ optional($insurance_details)->subscriber_number }}</p>
                                    </div>
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
