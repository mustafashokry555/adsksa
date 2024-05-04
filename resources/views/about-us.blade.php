<?php $page = "index-13"; ?>
@extends('layout.mainlayout_index1')
@section('title', 'About Us')
@section('content')
    <!-- Header -->
    @include('components.patient_header')
    <!-- /Header -->

    <div class="row align-items-center mt-4">

    </div>
    </div>
    </section>
    <!-- /Home Banner -->
    <section class="about-us">
        <!-- Page Content -->
        <section class="about-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <a href="" class="about-titile mb-4">About Doccure</a>
                        <h3 class="mb-4">Company Profile</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In porta luctus est interdum
                            pretium. Fusce id tortor fringilla, suscipit turpis ac, varius ex. Cras vel metus
                            ligula. Nam enim ligula, bibendum a iaculis ut, cursus id augue. Proin vitae purus id
                            tortor vehicula scelerisque non in libero.</p>
                        <p class="mb-0">Nulla non turpis sit amet purus pharetra sollicitudin. Proin rutrum urna ut
                            suscipit ullamcorper. Proin sapien felis, dignissim non finibus eget, luctus vel purus.
                            Pellentesque efficitur congue orci ornare accumsan. Nullam ultrices libero vel imperdiet
                            scelerisque. Donec vel mauris eros.</p>
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
            </div>
        </section>

        <!-- Category Section -->
        <section class="select-category">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 category-col d-flex">
                        <div class="category-subox pb-0 d-flex flex-wrap w-100">
                            <h4>Visit a Doctor</h4>
                            <p>We hire the best specialists to deliver top-notch diagnostic services for you.</p>
                            <div class="subox-img">
                                <div class="subox-circle">
                                    <img src="{{ URL::asset('/assets/img/icons/vect-01.png')}}" alt="" width="42">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 category-col d-flex">
                        <div class="category-subox pb-0 d-flex flex-wrap w-100">
                            <h4>Find a Pharmacy</h4>
                            <p>We provide the a wide range of medical services, so every person could have the
                                opportunity.</p>
                            <div class="subox-img">
                                <div class="subox-circle">
                                    <img src="{{ URL::asset('/assets/img/icons/vect-02.png')}}" alt="" width="42">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 category-col d-flex">
                        <div class="category-subox pb-0 d-flex flex-wrap w-100">
                            <h4>Find a Lab</h4>
                            <p>We use the first-class medical equipment for timely diagnostics of various
                                diseases.</p>
                            <div class="subox-img">
                                <div class="subox-circle">
                                    <img src="{{ URL::asset('/assets/img/icons/vect-03.png')}}" alt="" width="42">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Category Section -->

        <section class="section section-featurebox">
            <div class="container">
                <div class="section-header text-center">
                    <h2 class="text-white">Available Features in Our Clinic</h2>
                    <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div class="row justify-content-center">
                    <div class="feature-col-list">
                        <div class="feature-col">
                            <div class="feature-subox d-flex flex-wrap justify-content-center">
                                <img src="{{ asset('/assets/img/features/feature-05.jpg')}}" class="img-fluid"
                                     alt="Features">
                                <h4>Operation</h4>
                            </div>
                        </div>
                        <div class="feature-col">
                            <div class="feature-subox d-flex flex-wrap justify-content-center">
                                <img src="{{ asset('/assets/img/features/feature-06.jpg')}}" class="img-fluid"
                                     alt="Features">
                                <h4>Medical</h4>
                            </div>
                        </div>
                        <div class="feature-col">
                            <div class="feature-subox d-flex flex-wrap justify-content-center">
                                <img src="{{ asset('/assets/img/features/feature-01.jpg')}}" class="img-fluid"
                                     alt="Features">
                                <h4>Patient Ward</h4>
                            </div>
                        </div>
                        <div class="feature-col">
                            <div class="feature-subox d-flex flex-wrap justify-content-center">
                                <img src="{{ asset('/assets/img/features/feature-02.jpg')}}" class="img-fluid"
                                     alt="Features">
                                <h4>Test Room</h4>
                            </div>
                        </div>
                        <div class="feature-col">
                            <div class="feature-subox d-flex flex-wrap justify-content-center">
                                <img src="{{ asset('/assets/img/features/feature-03.jpg')}}" class="img-fluid"
                                     alt="Features">
                                <h4>ICU</h4>
                            </div>
                        </div>
                        <div class="feature-col">
                            <div class="feature-subox d-flex flex-wrap justify-content-center">
                                <img src="{{ asset('/assets/img/features/feature-04.jpg')}}" class="img-fluid"
                                     alt="Features">
                                <h4>Laboratory</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <!-- Clinic and Specialities -->
        <section class="section section-specialities">
            <div class="container-fluid">
                <div class="section-header text-center">
                    <h2>Clinic and Specialities</h2>
                    <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-9">
                        <!-- Slider -->
                        <div class="specialities-slider slider slick-initialized slick-slider slick-dotted">
                            <div class="slick-list draggable">
                                <div class="slick-track"
                                     style="opacity: 1; width: 25000px; transform: translate3d(-194px, 0px, 0px);">
                                    <div class="slick-slide slick-cloned" data-slick-index="-1" id=""
                                         aria-hidden="true" tabindex="-1">
                                        <div>
                                            <div class="speicality-item text-center"
                                                 style="width: 100%; display: inline-block;">
                                                <div class="speicality-img">
                                                    <img
                                                        src="http://127.0.0.1:8000/assets/img/specialities/specialities-05.png"
                                                        class="img-fluid" alt="Speciality">
                                                    <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                </div>
                                                <p>Dentist</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slick-slide slick-current slick-active" data-slick-index="0"
                                         aria-hidden="false" role="tabpanel" id="slick-slide00">
                                        <div>
                                            <div class="speicality-item text-center"
                                                 style="width: 100%; display: inline-block;">
                                                <div class="speicality-img">
                                                    <img
                                                        src="http://127.0.0.1:8000/assets/img/specialities/specialities-01.png"
                                                        class="img-fluid" alt="Speciality">
                                                    <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                </div>
                                                <p>Urology</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slick-slide" data-slick-index="1" aria-hidden="true" tabindex="-1"
                                         role="tabpanel" id="slick-slide01">
                                        <div>
                                            <div class="speicality-item text-center"
                                                 style="width: 100%; display: inline-block;">
                                                <div class="speicality-img">
                                                    <img
                                                        src="http://127.0.0.1:8000/assets/img/specialities/specialities-02.png"
                                                        class="img-fluid" alt="Speciality">
                                                    <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                </div>
                                                <p>Neurology</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slick-slide" data-slick-index="2" aria-hidden="true" tabindex="-1"
                                         role="tabpanel" id="slick-slide02">
                                        <div>
                                            <div class="speicality-item text-center"
                                                 style="width: 100%; display: inline-block;">
                                                <div class="speicality-img">
                                                    <img
                                                        src="http://127.0.0.1:8000/assets/img/specialities/specialities-03.png"
                                                        class="img-fluid" alt="Speciality">
                                                    <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                </div>
                                                <p>Orthopedic</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slick-slide" data-slick-index="3" aria-hidden="true" tabindex="-1"
                                         role="tabpanel" id="slick-slide03">
                                        <div>
                                            <div class="speicality-item text-center"
                                                 style="width: 100%; display: inline-block;">
                                                <div class="speicality-img">
                                                    <img
                                                        src="http://127.0.0.1:8000/assets/img/specialities/specialities-04.png"
                                                        class="img-fluid" alt="Speciality">
                                                    <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                </div>
                                                <p>Cardiologist</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slick-slide" data-slick-index="4" aria-hidden="true" tabindex="-1"
                                         role="tabpanel" id="slick-slide04">
                                        <div>
                                            <div class="speicality-item text-center"
                                                 style="width: 100%; display: inline-block;">
                                                <div class="speicality-img">
                                                    <img
                                                        src="http://127.0.0.1:8000/assets/img/specialities/specialities-05.png"
                                                        class="img-fluid" alt="Speciality">
                                                    <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                </div>
                                                <p>Dentist</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slick-slide slick-cloned" data-slick-index="5" id=""
                                         aria-hidden="true" tabindex="-1">
                                        <div>
                                            <div class="speicality-item text-center"
                                                 style="width: 100%; display: inline-block;">
                                                <div class="speicality-img">
                                                    <img
                                                        src="http://127.0.0.1:8000/assets/img/specialities/specialities-01.png"
                                                        class="img-fluid" alt="Speciality">
                                                    <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                </div>
                                                <p>Urology</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slick-slide slick-cloned" data-slick-index="6" id=""
                                         aria-hidden="true" tabindex="-1">
                                        <div>
                                            <div class="speicality-item text-center"
                                                 style="width: 100%; display: inline-block;">
                                                <div class="speicality-img">
                                                    <img
                                                        src="http://127.0.0.1:8000/assets/img/specialities/specialities-02.png"
                                                        class="img-fluid" alt="Speciality">
                                                    <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                </div>
                                                <p>Neurology</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slick-slide slick-cloned" data-slick-index="7" id=""
                                         aria-hidden="true" tabindex="-1">
                                        <div>
                                            <div class="speicality-item text-center"
                                                 style="width: 100%; display: inline-block;">
                                                <div class="speicality-img">
                                                    <img
                                                        src="http://127.0.0.1:8000/assets/img/specialities/specialities-03.png"
                                                        class="img-fluid" alt="Speciality">
                                                    <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                </div>
                                                <p>Orthopedic</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slick-slide slick-cloned" data-slick-index="8" id=""
                                         aria-hidden="true" tabindex="-1">
                                        <div>
                                            <div class="speicality-item text-center"
                                                 style="width: 100%; display: inline-block;">
                                                <div class="speicality-img">
                                                    <img
                                                        src="http://127.0.0.1:8000/assets/img/specialities/specialities-04.png"
                                                        class="img-fluid" alt="Speciality">
                                                    <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                </div>
                                                <p>Cardiologist</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slick-slide slick-cloned" data-slick-index="9" id=""
                                         aria-hidden="true" tabindex="-1">
                                        <div>
                                            <div class="speicality-item text-center"
                                                 style="width: 100%; display: inline-block;">
                                                <div class="speicality-img">
                                                    <img
                                                        src="http://127.0.0.1:8000/assets/img/specialities/specialities-05.png"
                                                        class="img-fluid" alt="Speciality">
                                                    <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                </div>
                                                <p>Dentist</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="slick-dots" style="" role="tablist">
                                <li class="slick-active" role="presentation">
                                    <button type="button" role="tab" id="slick-slide-control00"
                                            aria-controls="slick-slide00" aria-label="1 of 5" tabindex="0"
                                            aria-selected="true">1
                                    </button>
                                </li>
                                <li role="presentation">
                                    <button type="button" role="tab" id="slick-slide-control01"
                                            aria-controls="slick-slide01" aria-label="2 of 5" tabindex="-1">2
                                    </button>
                                </li>
                                <li role="presentation">
                                    <button type="button" role="tab" id="slick-slide-control02"
                                            aria-controls="slick-slide02" aria-label="3 of 5" tabindex="-1">3
                                    </button>
                                </li>
                                <li role="presentation">
                                    <button type="button" role="tab" id="slick-slide-control03"
                                            aria-controls="slick-slide03" aria-label="4 of 5" tabindex="-1">4
                                    </button>
                                </li>
                                <li role="presentation">
                                    <button type="button" role="tab" id="slick-slide-control04"
                                            aria-controls="slick-slide04" aria-label="5 of 5" tabindex="-1">5
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <!-- /Slider -->

                    </div>
                </div>
            </div>
        </section>
        <!-- Clinic and Specialities -->

        <!-- Testimonial Section -->
        <section class="section section-testimonial">
            <div class="container">
                <div class="section-header text-center mb-4">
                    <h2>Testimonials</h2>
                    <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <!-- Slider -->
                        <div class="testimonial-slider slider slick-initialized slick-slider slick-dotted">
                            <div class="slick-list draggable">
                                <div class="slick-track"
                                     style="opacity: 1; width: 4092px; transform: translate3d(-1116px, 0px, 0px);">
                                    <div class="slick-slide slick-cloned" data-slick-index="-3" id=""
                                         aria-hidden="true" tabindex="-1" style="width: 372px;">
                                        <div>
                                            <div class="testimonial-item text-center"
                                                 style="width: 100%; display: inline-block;">
                                                <div class="testimonial-img">
                                                    <img
                                                        src="http://127.0.0.1:8000/assets/img/patients/patient2.jpg"
                                                        class="img-fluid" alt="Speciality">
                                                </div>
                                                <div class="testimonial-content">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                                                        do eiusmod tempor incididunt ut labore et dolore magna
                                                        aliqua.</p>
                                                    <p class="user-name">- Denise Stevens</p>
                                                    <p class="user-location mb-0">Abington, USA</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slick-slide slick-cloned" data-slick-index="-2" id=""
                                         aria-hidden="true" tabindex="-1" style="width: 372px;">
                                        <div>
                                            <div class="testimonial-item text-center"
                                                 style="width: 100%; display: inline-block;">
                                                <div class="testimonial-img">
                                                    <img
                                                        src="http://127.0.0.1:8000/assets/img/patients/patient3.jpg"
                                                        class="img-fluid" alt="Speciality">
                                                </div>
                                                <div class="testimonial-content">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                                                        do eiusmod tempor incididunt ut labore et dolore magna
                                                        aliqua.</p>
                                                    <p class="user-name">- Charles Ortega</p>
                                                    <p class="user-location mb-0">El Paso, USA</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slick-slide slick-cloned" data-slick-index="-1" id=""
                                         aria-hidden="true" tabindex="-1" style="width: 372px;">
                                        <div>
                                            <div class="testimonial-item text-center"
                                                 style="width: 100%; display: inline-block;">
                                                <div class="testimonial-img">
                                                    <img
                                                        src="http://127.0.0.1:8000/assets/img/patients/patient4.jpg"
                                                        class="img-fluid" alt="">
                                                </div>
                                                <div class="testimonial-content">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                                                        do eiusmod tempor incididunt ut labore et dolore magna
                                                        aliqua.</p>
                                                    <p class="user-name">- Jennifer Robinson</p>
                                                    <p class="user-location mb-0">Leland, USA</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slick-slide slick-current slick-active" data-slick-index="0"
                                         aria-hidden="false" role="tabpanel" id="slick-slide10"
                                         style="width: 372px;">
                                        <div>
                                            <div class="testimonial-item text-center"
                                                 style="width: 100%; display: inline-block;">
                                                <div class="testimonial-img">
                                                    <img
                                                        src="{{ asset('assets/img/patients/patient1.jpg') }}"
                                                        class="img-fluid" alt="Speciality">
                                                </div>
                                                <div class="testimonial-content">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                                                        do eiusmod tempor incididunt ut labore et dolore magna
                                                        aliqua.</p>
                                                    <p class="user-name">- Jennifer Robinson</p>
                                                    <p class="user-location mb-0">Leland, USA</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slick-slide slick-active" data-slick-index="1" aria-hidden="false"
                                         role="tabpanel" id="slick-slide11" style="width: 372px;">
                                        <div>
                                            <div class="testimonial-item text-center"
                                                 style="width: 100%; display: inline-block;">
                                                <div class="testimonial-img">
                                                    <img
                                                        src="{{ asset('assets/img/patients/patient2.jpg') }}"
                                                        class="img-fluid" alt="Speciality">
                                                </div>
                                                <div class="testimonial-content">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                                                        do eiusmod tempor incididunt ut labore et dolore magna
                                                        aliqua.</p>
                                                    <p class="user-name">- Denise Stevens</p>
                                                    <p class="user-location mb-0">Abington, USA</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slick-slide slick-active" data-slick-index="2" aria-hidden="false"
                                         role="tabpanel" id="slick-slide12" style="width: 372px;">
                                        <div>
                                            <div class="testimonial-item text-center"
                                                 style="width: 100%; display: inline-block;">
                                                <div class="testimonial-img">
                                                    <img
                                                        src="{{ asset('assets/img/patients/patient3.jpg') }}"
                                                        class="img-fluid" alt="Speciality">
                                                </div>
                                                <div class="testimonial-content">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                                                        do eiusmod tempor incididunt ut labore et dolore magna
                                                        aliqua.</p>
                                                    <p class="user-name">- Charles Ortega</p>
                                                    <p class="user-location mb-0">El Paso, USA</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slick-slide" data-slick-index="3" aria-hidden="true" tabindex="-1"
                                         role="tabpanel" id="slick-slide13" style="width: 372px;">
                                        <div>
                                            <div class="testimonial-item text-center"
                                                 style="width: 100%; display: inline-block;">
                                                <div class="testimonial-img">
                                                    <img
                                                        src="http://127.0.0.1:8000/assets/img/patients/patient4.jpg"
                                                        class="img-fluid" alt="">
                                                </div>
                                                <div class="testimonial-content">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                                                        do eiusmod tempor incididunt ut labore et dolore magna
                                                        aliqua.</p>
                                                    <p class="user-name">- Jennifer Robinson</p>
                                                    <p class="user-location mb-0">Leland, USA</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slick-slide slick-cloned" data-slick-index="4" id=""
                                         aria-hidden="true" tabindex="-1" style="width: 372px;">
                                        <div>
                                            <div class="testimonial-item text-center"
                                                 style="width: 100%; display: inline-block;">
                                                <div class="testimonial-img">
                                                    <img
                                                        src="http://127.0.0.1:8000/assets/img/patients/patient1.jpg"
                                                        class="img-fluid" alt="Speciality">
                                                </div>
                                                <div class="testimonial-content">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                                                        do eiusmod tempor incididunt ut labore et dolore magna
                                                        aliqua.</p>
                                                    <p class="user-name">- Jennifer Robinson</p>
                                                    <p class="user-location mb-0">Leland, USA</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slick-slide slick-cloned" data-slick-index="5" id=""
                                         aria-hidden="true" tabindex="-1" style="width: 372px;">
                                        <div>
                                            <div class="testimonial-item text-center"
                                                 style="width: 100%; display: inline-block;">
                                                <div class="testimonial-img">
                                                    <img
                                                        src="http://127.0.0.1:8000/assets/img/patients/patient2.jpg"
                                                        class="img-fluid" alt="Speciality">
                                                </div>
                                                <div class="testimonial-content">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                                                        do eiusmod tempor incididunt ut labore et dolore magna
                                                        aliqua.</p>
                                                    <p class="user-name">- Denise Stevens</p>
                                                    <p class="user-location mb-0">Abington, USA</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slick-slide slick-cloned" data-slick-index="6" id=""
                                         aria-hidden="true" tabindex="-1" style="width: 372px;">
                                        <div>
                                            <div class="testimonial-item text-center"
                                                 style="width: 100%; display: inline-block;">
                                                <div class="testimonial-img">
                                                    <img
                                                        src="http://127.0.0.1:8000/assets/img/patients/patient3.jpg"
                                                        class="img-fluid" alt="Speciality">
                                                </div>
                                                <div class="testimonial-content">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                                                        do eiusmod tempor incididunt ut labore et dolore magna
                                                        aliqua.</p>
                                                    <p class="user-name">- Charles Ortega</p>
                                                    <p class="user-location mb-0">El Paso, USA</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slick-slide slick-cloned" data-slick-index="7" id=""
                                         aria-hidden="true" tabindex="-1" style="width: 372px;">
                                        <div>
                                            <div class="testimonial-item text-center"
                                                 style="width: 100%; display: inline-block;">
                                                <div class="testimonial-img">
                                                    <img
                                                        src="http://127.0.0.1:8000/assets/img/patients/patient4.jpg"
                                                        class="img-fluid" alt="">
                                                </div>
                                                <div class="testimonial-content">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                                                        do eiusmod tempor incididunt ut labore et dolore magna
                                                        aliqua.</p>
                                                    <p class="user-name">- Jennifer Robinson</p>
                                                    <p class="user-location mb-0">Leland, USA</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="slick-dots" style="" role="tablist">
                                <li class="slick-active" role="presentation">
                                    <button type="button" role="tab" id="slick-slide-control10"
                                            aria-controls="slick-slide10" aria-label="1 of 2" tabindex="0"
                                            aria-selected="true">1
                                    </button>
                                </li>
                                <li role="presentation">
                                    <button type="button" role="tab" id="slick-slide-control11"
                                            aria-controls="slick-slide11" aria-label="2 of 2" tabindex="-1">2
                                    </button>
                                </li>
                                <li role="presentation">
                                    <button type="button" role="tab" id="slick-slide-control12"
                                            aria-controls="slick-slide12" aria-label="3 of 2" tabindex="-1">3
                                    </button>
                                </li>
                                <li role="presentation">
                                    <button type="button" role="tab" id="slick-slide-control13"
                                            aria-controls="slick-slide13" aria-label="4 of 2" tabindex="-1">4
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <!-- /Slider -->

                    </div>
                </div>
            </div>
        </section>
        <!-- Testimonial Section -->

        <!-- /Page Content -->
    </section>

@endsection

