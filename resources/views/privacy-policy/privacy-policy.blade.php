<?php $page = 'index-13'; ?>
@extends('layout.mainlayout_index1')
@section('title', 'Privacy Policy')
@section('content')

    @include('components.patient_header')

    <div class="row align-items-center mt-4">

    </div>
    <section class="about-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <a href="" class="about-titile mb-4">Privacy Policy</a>
                    <h3 class="mb-4">Company Profile</h3>
                    <p>This is the privacy policy of our website.</p>
                    <p>
                        {!! $setting->privacy_policy !!}
                    </p>
                <div class="col-md-6">
                </div>
            </div>
        </div>
    </section>

@endsection
