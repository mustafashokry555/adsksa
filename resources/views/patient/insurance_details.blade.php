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
                        @if (session()->has('flash'))
                            <x-alert>{{ session('flash')['message'] }}</x-alert>
                        @endif
                        <div class="container">
                            <!-- Profile Information -->
                            <div class="card-body">


                                <div class="row m-3">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title">Insurance Details</h5>
                                            </div>
                                            <div class="card-body">
                                                <form method="POST"
                                                    action="{{ route('patient_insurance.update', $patient->id) }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('patch')
                                                    {{-- <!-- Patient Details -->
                                                    <div class="row">
                                                        <div class="form-group col-md-4">
                                                            <label for="name"
                                                                class="col-form-label">{{ __('admin.patient.patient_name') }}</label>
                                                            <div>
                                                                <label for="name"
                                                                class="col-form-label">{{ $patient->name }}</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="mobile"
                                                                class="col-form-label">{{ __('admin.patient.patient_mobile') }}</label>
                                                            <div>
                                                                <label for="mobile"
                                                                class="col-form-label">{{ $patient->mobile }}</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="id_number"
                                                                class="col-form-label">National Number</label>
                                                            <div>
                                                                <label for="id_number"
                                                                class="col-form-label">{{ $patient->id_number }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    --}}
                                                    <!-- insurance -->
                                                    <div class="form-group row">
                                                        <label for="insurance_id"
                                                            class="col-form-label col-md-2">Insurance</label>
                                                        <div class="col-md-10">
                                                            <select id="insurance_id" name="insurance_id"
                                                                class="form-control" required>
                                                                <option value="" disabled selected>Select Insurance
                                                                </option>
                                                                @foreach ($insurances as $one)
                                                                    <option value="{{ $one->id }}"
                                                                        {{ old('insurance_id', optional($insurance_details)->insurance_id) == $one->id ? 'selected' : '' }}>
                                                                        {{ $one->name_en }} < {{ $one->name_ar }}>
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('insurance_id')
                                                                <div class="text-danger pt-2">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- medical_network --}}
                                                    <div class="form-group row">
                                                        <label for="medical_network" class="col-form-label col-md-2">Medical
                                                            Network</label>
                                                        <div class="col-md-10">
                                                            <input id="medical_network" name="medical_network"
                                                                type="text"
                                                                value="{{ old('end_date', optional($insurance_details)->medical_network) }}"
                                                                class="form-control" placeholder="Medical Network" required>
                                                            @error('medical_network')
                                                                <div class="text-danger pt-2">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- Category --}}
                                                    <div class="form-group row">
                                                        <label for="category"
                                                            class="col-form-label col-md-2">Category</label>
                                                        <div class="col-md-10">
                                                            <input id="category" name="category" type="text"
                                                                value="{{ old('category', optional($insurance_details)->category) }}"
                                                                class="form-control" placeholder="Category" required>
                                                            @error('category')
                                                                <div class="text-danger pt-2">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- Co-Payment Percentage --}}
                                                    <div class="form-group row">
                                                        <label for="co_payment_percentage"
                                                            class="col-form-label col-md-2">Co-Payment Percentage</label>
                                                        <div class="col-md-10">
                                                            <input id="co_payment_percentage" name="co_payment_percentage"
                                                                type="number" step="0.01"
                                                                value="{{ old('co_payment_percentage', optional($insurance_details)->co_payment_percentage) }}"
                                                                class="form-control" placeholder="Co-Payment Percentage"
                                                                required>
                                                            @error('co_payment_percentage')
                                                                <div class="text-danger pt-2">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- Submission Date --}}
                                                    <div class="form-group row">
                                                        <label for="submission_date"
                                                            class="col-form-label col-md-2">Submission Date</label>
                                                        <div class="col-md-10">
                                                            <input id="submission_date" name="submission_date"
                                                                type="date"
                                                                value="{{ old('submission_date', optional($insurance_details)->submission_date) }}"
                                                                class="form-control" required>
                                                            @error('submission_date')
                                                                <div class="text-danger pt-2">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- Subscriber Type --}}
                                                    <div class="form-group row">
                                                        <label for="subscriber_type"
                                                            class="col-form-label col-md-2">Subscriber Type</label>
                                                        <div class="col-md-10">
                                                            <input id="subscriber_type" name="subscriber_type"
                                                                type="text"
                                                                value="{{ old('subscriber_type', optional($insurance_details)->subscriber_type) }}"
                                                                class="form-control" placeholder="Subscriber Type" required>
                                                            @error('subscriber_type')
                                                                <div class="text-danger pt-2">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- Insurance Policy Number --}}
                                                    <div class="form-group row">
                                                        <label for="insurance_policy_number"
                                                            class="col-form-label col-md-2">Insurance Policy Number</label>
                                                        <div class="col-md-10">
                                                            <input id="insurance_policy_number"
                                                                name="insurance_policy_number" type="text"
                                                                value="{{ old('insurance_policy_number', optional($insurance_details)->insurance_policy_number) }}"
                                                                class="form-control" placeholder="Policy Number" required>
                                                            @error('insurance_policy_number')
                                                                <div class="text-danger pt-2">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- Coverage Limits --}}
                                                    <div class="form-group row">
                                                        <label for="coverage_limits"
                                                            class="col-form-label col-md-2">Coverage Limits</label>
                                                        <div class="col-md-10">
                                                            <input id="coverage_limits" name="coverage_limits"
                                                                type="text"
                                                                value="{{ old('coverage_limits', optional($insurance_details)->coverage_limits) }}"
                                                                class="form-control" placeholder="Coverage Limits"
                                                                required>
                                                            @error('coverage_limits')
                                                                <div class="text-danger pt-2">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- Insurance Expiry Date --}}
                                                    <div class="form-group row">
                                                        <label for="insurance_expiry_date"
                                                            class="col-form-label col-md-2">Insurance Expiry Date</label>
                                                        <div class="col-md-10">
                                                            <input id="insurance_expiry_date" name="insurance_expiry_date"
                                                                type="date"
                                                                value="{{ old('insurance_expiry_date', optional($insurance_details)->insurance_expiry_date) }}"
                                                                class="form-control" required>
                                                            @error('insurance_expiry_date')
                                                                <div class="text-danger pt-2">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- Subscriber Number --}}
                                                    <div class="form-group row">
                                                        <label for="subscriber_number"
                                                            class="col-form-label col-md-2">Subscriber Number</label>
                                                        <div class="col-md-10">
                                                            <input id="subscriber_number" name="subscriber_number"
                                                                type="text"
                                                                value="{{ old('subscriber_number', optional($insurance_details)->subscriber_number) }}"
                                                                class="form-control" placeholder="Subscriber Number"
                                                                required>
                                                            @error('subscriber_number')
                                                                <div class="text-danger pt-2">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                    <button class="btn btn-primary btn-add"><i
                                                            class="feather-plus-square me-1"></i>
                                                        Update Insurance Details
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
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
