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
                        <form method="POST" action="{{ route('experience.store') }}">
                            @csrf
                            <!-- Basic -->
                            <div class="col-md-12">
                                <div class="pro-title d-flex justify-content-between">
                                    <h4>Add Experience</h4>
                                </div>
                            </div>
                            <div class="form-row row">
                                <div class="col-md-6 mb-3">
                                    <label for="experience_title">Work Position:</label>
                                    <input type="text" class="form-control" id="experience_title"
                                           name="experience_title" placeholder="Position of your past work" required>
                                </div>
                                <input type="hidden" name="user_id"
                                       value="{{$user_id }}">
                                <div class="col-md-6 mb-3">
                                    <label for="company_name">Company Name:</label>
                                    <input type="text" class="form-control" id="company_name" name="company_name"
                                           placeholder="Enter company name where you worked before." required>
                                </div>
                            </div>

                            <!-- Personal Info -->
                            <div class="form-row row">
                                <div class="col-md-4 mb-3">
                                    <label for="start_date">Started At:</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date"
                                           placeholder="start_date" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="end_date">Upto:</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date"
                                           placeholder="end_date" required>
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit">Add Experience</button>
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
