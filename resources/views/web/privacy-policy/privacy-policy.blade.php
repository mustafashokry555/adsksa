<?php $page = 'index-13'; ?>
@extends('web.layout.layout')
@section('title', 'Privacy Policy')
@section('main-content')

    {{-- @include('components.patient_header') --}}

    <div class="row align-items-center mt-4">

    </div>
    <style>
        .about-section{
            background-image: none;
        }
    </style>
    <section class="about-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    {{-- <a href="" class="about-titile mb-4">Privacy Policy</a> --}}
                    <h3 class="mb-4">{{ __('web.Company Profile') }}</h3>
                    <p>{{ __('web.privacy_policy_p') }}</p>
                    <p>
                        {!! $setting->privacy_policy !!}
                    </p>
                <div class="col-md-6">
                </div>
            </div>
        </div>
    </section>

@endsection
