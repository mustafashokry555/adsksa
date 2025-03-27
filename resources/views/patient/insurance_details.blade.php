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
                    {{-- <div class="col-md-7 col-lg-8 col-xl-9">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">Insurance Details</h5>
                            </div>
                            <div class="card-body">
                                @if ($insurance_details)
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
                                @else
                                    <p class="text-muted">No insurance details available.</p>
                                @endif
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-md-7 col-lg-8 col-xl-9">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white text-center">
                                <h4 class="mb-0">Medical Insurance Card</h4>
                            </div>
                            <div class="card-body text-center">
                                <h5 class="fw-bold">{{ optional($patient)->name }}</h5>
                                <hr>
                                @if ($insurance_details)
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-center">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>ID Number</th>
                                                    <th>Date of Birth</th>
                                                    <th>Network</th>
                                                    <th>Expiry Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ optional($patient)->id_number }}</td>
                                                    <td>{{ optional($patient)->date_of_birth }}</td>
                                                    <td>{{ optional($insurance_details)->medical_network }}</td>
                                                    <td>{{ optional($insurance_details)->insurance_expiry_date }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-bordered text-center mt-3">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>Discount Rate</th>
                                                    <th>Category</th>
                                                    <th>Maximum Limit</th>
                                                    <th>Policy Number</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ optional($insurance_details)->co_payment_percentage }}%</td>
                                                    <td>{{ optional($insurance_details)->category }}</td>
                                                    <td>{{ optional($insurance_details)->coverage_limits }}</td>
                                                    <td>{{ optional($insurance_details)->insurance_policy_number }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <h5 class="mt-4">Insurance Provider</h5>
                                    <p class="text-muted">{{ optional($insurance_details->insurance)->name_en }} <{{ optional($insurance_details->insurance)->name_ar }}></p>
                                    <h5 class="mt-4">Membership Number</h5>
                                    <p class="text-muted">{{ optional($insurance_details)->subscriber_number }}</p>
                                @else    
                                    <p class="text-muted">No Insurance Details Found</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- /Page Content -->

@endsection
