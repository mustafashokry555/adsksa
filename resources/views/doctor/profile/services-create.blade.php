<?php $page = "doctor-dashboard"; ?>
@extends('layout.mainlayout_doctor')
@section('title', 'Add Your Services')
@section('content')
    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="container">
            <!-- Profile Information -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm">
                        <form method="POST" action="{{ route('store_services') }}">
                            @csrf
                            <!-- Basic -->
                            <div class="col-md-12">
                                <div class="pro-title d-flex justify-content-between">
                                    <h6>Add new Services</h6>
                                </div>
                            </div>
                            <div class="form-row row">
                                @for($i = 0; $i<=5; $i++)
                                    @if($services[$i]?->service_title ?? '')
                                        <div class="col-md-6 mb-3">
                                            <label for="service_title">Service Title {{ $i+1 }}</label>
                                            <input type="text" class="form-control" id="service_title"
                                                   name="titles[]" value="{{ $services[$i]->service_title }}">
                                        </div>
                                    @else
                                        <div class="col-md-6 mb-3">
                                            <label for="service_title">Service Title {{ $i+1 }}</label>
                                            <input type="text" class="form-control" id="service_title"
                                                   name="titles[]" placeholder="Service title">
                                        </div>
                                    @endif
                                    <input type="hidden" name="user_id"
                                           value="{{ $user_id }}">
                                @endfor

                            </div>
                            <button class="btn btn-primary" type="submit">Add Services</button>
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
