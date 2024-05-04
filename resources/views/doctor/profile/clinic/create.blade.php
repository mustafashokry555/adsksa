<?php $page = "doctor-dashboard"; ?>
@extends('layout.mainlayout_doctor')
@section('title', 'Add Your Experience')
@section('content')
    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="container">
            <!-- Profile Information -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm">
                        <form method="POST" action="{{ route('store_clinic') }}">
                            @csrf
                            <!-- Basic -->
                            <div class="col-md-12">
                                <div class="pro-title d-flex justify-content-between">
                                    <h4>Add Clinic</h4>
                                </div>
                            </div>
                            <div class="form-row row">
                                <div class="col-md-4 mb-3">
                                    <label for="clinic_title">Clinic Name:</label>
                                    <input type="text" class="form-control" id="clinic_title" name="clinic_title"
                                           placeholder="Enter Clinic Name" required>
                                </div>
                                {{-- <input type="hidden" name="user_id" value="{{ \Illuminate\Support\Facades\Auth::id() }}"> --}}
                                <input type="hidden" name="user_id" value="{{$user_id }}">
                                <div class="col-md-4 mb-3">
                                    <label for="clinic_location">Clinic Location:</label>
                                    <input type="text" class="form-control" id="clinic_location" name="clinic_location"
                                           placeholder="Enter Clinic Location" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="clinic_fee">Clinic Fee:</label>
                                    <input type="number" class="form-control" id="clinic_fee" name="clinic_fee"
                                           placeholder="Enter Amount in USD $" required>
                                </div>
                            </div>

                            <!-- Personal Info -->
                            <div class="form-row row">
                                <div class="col-md-4 mb-3">
                                    <label for="clinic_start_time">Started At:</label>
                                    <input type="time" class="form-control" id="clinic_start_time"
                                           name="clinic_start_time" placeholder="Starting time" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="clinic_end_time">Closing at:</label>
                                    <input type="time" class="form-control" id="clinic_end_time"
                                           name="clinic_end_time" placeholder="Closing time" required>
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit">Add Clinic</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /Profile Information -->
        </div>
    </div>
    </div>

    </div>

    </div>
    <!-- /Page Content -->
    </div>
@endsection
