<?php $page = "doctor-dashboard"; ?>
@extends('layout.mainlayout_doctor')
@section('title', 'Add Your Specialization')
@section('content')
    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="container">
            <!-- Profile Information -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm">
                        <form method="POST" action="{{ route('store_specializations') }}">
                            @csrf
                            <!-- Basic -->
                            <div class="col-md-12">
                                <div class="pro-title d-flex justify-content-between">
                                    <h6>Add new Specialization</h6>
                                </div>
                            </div>
                            <div class="form-row row">
                                @for($i = 0; $i<=5; $i++)
                                    @if($specializations[$i]->specialization_title ?? '')
                                        <div class="col-md-6 mb-3">
                                            <label for="specialization_title">Specialization Title {{ $i+1 }}</label>
                                            <input type="text" class="form-control" id="specialization_title"
                                                   name="specialization_titles[]"
                                                   value="{{ $specializations[$i]->specialization_title }}">
                                        </div>
                                    @else
                                        <div class="col-md-6 mb-3">
                                            <label for="specialization_title">Specialization Title {{ $i+1 }}</label>
                                            <input type="text" class="form-control" id="specialization_title"
                                                   name="specialization_titles[]" placeholder="Specializaiton Title">
                                        </div>
                                    @endif
                                    <input type="hidden" name="user_id"
                                           value="{{$user_id}}">
                                @endfor

                            </div>
                            <button class="btn btn-primary" type="submit">Add Specialization</button>
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
