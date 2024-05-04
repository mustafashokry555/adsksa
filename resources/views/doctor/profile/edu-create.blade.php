<?php $page = "doctor-dashboard"; ?>
@extends('layout.mainlayout_doctor')
@section('title', 'Add Your Education')
@section('content')
    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="container">
            <!-- Profile Information -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm">
                        <form method="POST" action="{{ route('education.store') }}">
                            @csrf
                            <!-- Basic -->
                            <div class="col-md-12">
                                <div class="pro-title d-flex justify-content-between">
                                    <h6>Education Details</h6>
                                </div>
                            </div>
                            <div class="form-row row">
                                <div class="col-md-6 mb-3">
                                    <label for="college_name">College / University name</label>
                                    <input type="text" class="form-control" id="college_name" name="college_name"
                                           placeholder="College / University name" required>
                                </div>
                                <input type="hidden" name="user_id"
                                       value="{{ $user_id }}">
                                <div class="col-md-6 mb-3">
                                    <label for="area">Study area</label>
                                    <input type="text" class="form-control" id="area" name="area"
                                           placeholder="Enter your Area of Study" required>
                                </div>
                            </div>

                            <!-- Personal Info -->
                            <div class="form-row row">
                                <div class="col-md-4 mb-3">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date"
                                           placeholder="start_date" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="end_date">Graduation Date</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date"
                                           placeholder="end_date" required>
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit">Add Education</button>
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
