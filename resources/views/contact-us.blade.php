<?php $page = "index-13"; ?>
@extends('layout.mainlayout_index1')
@section('title', 'Contact Us')
@section('content')
    <!-- Header -->
    @include('components.patient_header')
    <!-- /Header -->

    <div class="row align-items-center mt-4">

    </div>
    </div>
    </section>
    <!-- /Home Banner -->
    <section class="contact-us">
        <!-- Page Content -->
        <section class="contact-section">
            <div class="container">
                <div class="row mb-5">
                @if(session()->has('flash'))
                <x-alert>{{ session('flash')['message'] }}</x-alert>
            @endif
                    <div class="col-md-12 text-center">
                        <h3 class="mb-4">Contact Us</h3>
                        <p>Great doctor if you need your family member to get effective immediate
                            assistance, emergency treatment or a simple consultation.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 d-flex">
                        <div class="contact-box flex-fill">
                            <div class="infor-img">
                                <div class="image-circle">
                                    <i class="feather-phone"></i>
                                </div>
                            </div>
                            <div class="infor-details text-center">
                                <label>Phone Number</label>
                                <p>+152 534-468-854</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex">
                        <div class="contact-box flex-fill">
                            <div class="infor-img">
                                <div class="image-circle bg-primary">
                                    <i class="feather-mail"></i>
                                </div>
                            </div>
                            <div class="infor-details text-center">
                                <label>Email</label>
                                <p>contact@example.com</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex">
                        <div class="contact-box flex-fill">
                            <div class="infor-img">
                                <div class="image-circle">
                                    <i class="feather-map-pin"></i>
                                </div>
                            </div>
                            <div class="infor-details text-center">
                                <label>Location</label>
                                <p>C/54 Northwest Freeway, Suite 558,
                                    Houston, USA 485</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Form -->
        <section class="contact-form mt-4">
            <div class="container">
                <div class="section-header text-center">
                    <h2>Get in touch!</h2>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{url('contactus')}}" method="post" enctype="multipart/form">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Your Name <span>*</span></label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Your Email <span>*</span></label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Subject</label>
                                        <input type="text" name="subject" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Comments <span>*</span></label>
                                        <textarea class="form-control" name="message" required></textarea>
                                    </div>
                                </div>
                            </div>
                            @csrf
                            <button class="btn bg-primary">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Contact Form -->

        <!-- Contact Map -->
        <section class="contact-map d-flex mt-4">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3459.716346058072!2d-95.5565430855612!3d29.872453233633234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8640cfe4516785ed%3A0x774974592a609121!2s54%20Northwest%20Fwy%20%23558%2C%20Houston%2C%20TX%2077040%2C%20USA!5e0!3m2!1sen!2sin!4v1631855334452!5m2!1sen!2sin"
                allowfullscreen="" loading="lazy"></iframe>
        </section>
        <!-- /Contact Map -->
    </section>
    <!-- /Page Content -->

@endsection

