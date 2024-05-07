<?php $page = "index-13"; ?>
@extends('layout.mainlayout_index1')
@section('title', 'Welcome')
@section('content')
<!-- Header -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@include('components.patient_header')
<style>
    .search_bar {
        display: flex;
        gap: 10px;
        padding: 10px;
        border: 1px solid;
        border-radius: 9px;
        align-items: end;
    }

    .search_bar .drop_down_wrap .dropdown {
        background: transparent;
    }

    .search_bar .drop_down_wrap {
        padding: 5px;
        /* border: 1px solid; */
        border-radius: 5px;
        width: 20%;
        padding-bottom: 0px;
    }

    .drop_down_wrap input {
        width: 100%;
    }

    .search_bar .drop_down_wrap .dropdown button {
        background: transparent;
        color: #000;
        padding: 0px;
        border: 0px;
    }

    .search_bar .drop_down_wrap .dropdown button:focus {
        outline: none;
        box-shadow: none;
    }

    .btn_search {
        flex: 1;
        background-color: #0071DC;
        border: 0px;
        padding: 10px;
        color: #fff;
        border-radius: 5px;
        font-size: 17px;
        font-weight: 500;
    }
    .main-menu-wrapper{
        margin-left:391px;
    }
</style>


<!-- /Header -->
<div class="row align-items-center">
    <!-- <div class="col-lg-12 col-md-12"></div> -->
    <div class="col-lg-12 col-md-12">
        <div class="home-four-doctor">
            <div class="home-four-header">
                <h2>{{ __('web.Search Doctor, Make an') }} <span>{{ __('web.Appointment') }}</span></h2>
            </div>

            <form method="GET" action="{{ route('search_doctor') }}" class="banner-four-search">

            <div class="search_bar" style="background-color:white">

                <div class="drop_down_wrap">
                    <label>{{ __('web.Select a specility') }}</label>
                    <div class="dropdown">
                        <select name="speciality_id" class="select form-control">
                            <option value="">{{ __('web.Select a specility') }}</option>
                            @forelse($specialities as $speciality)
                            <option value="{{$speciality->id}}">{{$speciality->name}}</option>
                            @empty

                            @endforelse

                        </select>
                    </div>
                </div>
                <div class="drop_down_wrap">
                    <label>{{ __('web.Select a Insurance') }}</label>
                    <div class="dropdown">
                    <select name="insurance" class="select form-control">
                                        <option value="">{{ __('web.Select a Insurance') }}</option>
                                        @forelse($insurances as $insurance)
                                        <option value="{{ $insurance->id }}">{{ $insurance->name }}</option>
                                        @empty
                                        <!-- <option>No Department Found</option> -->
                                        @endforelse
                                    </select>
                    </div>
                </div>
                <div class="drop_down_wrap">
                    <label>{{ __('web.Enter City') }}</label>
                    <div class="dropdown">
                    <input name="city" type="text" class="select form-control" placeholder="{{ __('web.Enter City') }}">
                    </div>
                </div>
                <div class="drop_down_wrap">
                    <label>{{ __('web.Enter Area') }}</label>
                    <div class="dropdown">
                    <input name="area" type="text" class="select form-control" placeholder="{{ __('web.Enter Area') }}">
                    </div>
                </div>

                <button class="btn_search">{{ __('web.Search') }}</button>
            </div>
            </form>

        </div>
    </div>
</div>
</div>
</section>
@if(session()->has('flash'))
<x-alert>{{ session('flash')['message'] }}</x-alert>
@endif
<!-- /Home Banner -->

<!-- Looking Section Four -->
@include('components.patient_search_section')
<!-- /Looking Section Four -->

<!-- Clinic Section Four -->
@include('components.patient_clinic_section')
<!-- /Clinic Section Four -->

<!-- Doctor Section Four -->
@include('components.patient_doctor_section')
<!-- /Doctor Section Four -->

<!-- Features Clinic Four -->
@include('components.patient_clinic_features_section')
<!-- /Features Clinic Four -->

<!-- Blog Section Four -->
<x-patient_blogs_section :blogs="$blogs" />
<!-- /Blog Section Four -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


@endsection
