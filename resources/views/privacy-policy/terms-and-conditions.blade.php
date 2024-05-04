<?php $page = 'index-13'; ?>
@extends('layout.mainlayout_index1')
@section('title', 'Terms Conditions')
@section('content')

    {{-- Header --}}
    @include('components.patient_header')
    {{-- /Header --}}

    <div class="row align-items-center mt-4">

    </div>
    <section class="about-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <h1>Terms and Conditions</h1>
                    <p>Welcome to our website. If you continue to browse and use this website, you are agreeing to comply
                        with and be bound by the following terms and conditions of use.</p>
                    <p>The use of this website is subject to the following terms of use:</p>
                    <ul>
                        <li>Your use of any information or materials on this website is entirely at your own risk, for which
                            we shall not be liable.</li>
                        <li>This website may also include links to other websites. These links are provided for your
                            convenience to provide further information.</li>
                    </ul>
                    <p>If you disagree with any part of these terms and conditions, please do not use our website.</p>
                    <h2>Privacy Policy</h2>
                    <p>Please review our <a href="{{ route('privacy') }}">Privacy Policy</a> to understand how we
                        collect, use, and protect your personal information.</p>
                </div>
                <div class="col-md-6">
                </div>
            </div>
        </div>
    </section>

@endsection
