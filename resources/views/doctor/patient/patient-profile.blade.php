{{-- @extends('layout.mainlayout_index1') --}}

<?php $page = 'doctor-dashboard'; ?>
@section('title', 'Patient Profile')
@extends('layout.mainlayout_doctor')

@section('content')
    

<div class="col-md-7 col-lg-8 col-xl-9">
        @if (session()->has('flash'))
            <x-alert>{{ session('flash')['message'] }}</x-alert>
        @endif
        <div class="row row-grid">
        <div class="container">

<!-- Doctor Widget -->
<div class="card">
    <div class="card-body">
        <div class="doctor-widget">
            <div class="doc-info-left">
                <div class="doctor-img">
                    <?php //dd($patient)
                    ?>
                    @if ($patient->profile_image ?? '')
                        <img src="{{ asset($patient->profile_image) }}"
                            class="img-fluid" alt="User Image">
                    @else
                        <img src="{{ URL::asset('/assets/img/patients/patient.jpg') }}"
                            class="img-fluid" alt="User Image">
                    @endif
                </div>

                <div class="doc-info-cont">
                    <p class="doc-name">{{ $patient->name }}</p>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Doctor Widget -->

<!-- Doctor Details Tab -->
<div class="card">
    <div class="card-body pt-0">

        <!-- Tab Content -->
        <div class="tab-content pt-0">

            <!-- Overview Content -->
            <div role="tabpanel" id="doc_overview" class="tab-pane fade show active">
                <div class="row">
                    <div class="col-md-12 col-lg-9">
                        <div class="row">
                            <div class="col-md-12 mt-4">
                                <h6 class="pro-title">Personal Information</h6>

                                <div class="col-md-12">
                                    <h5>About me</h5>
                                    @if ($patient->description ?? '')
                                        <p>{{ $patient->description }}</p>
                                    @else
                                        <p>N/A</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <h5>Date of Birth</h5>
                                @if ($patient->date_of_birth)
                                    <p>{{ $patient->date_of_birth }}</p>
                                @else
                                    <p>N/A</p>
                                @endif
                            </div>
                            <div class="col-md-4 mb-3">
                                <h5>Gender</h5>
                                @if ($patient->gender ?? '')
                                    @if ($patient->gender == 'M')
                                        <p>Male</p>
                                    @elseif($patient->gender == 'F')
                                        <p>Female</p>
                                    @elseif($patient->gender == 'O')
                                        <p>Others</p>
                                    @endif
                                @else
                                    <p>N/A</p>
                                @endif
                            </div>
                            <div class="col-md-4 mb-3">
                                <h5>Age</h5>
                                @if ($patient->age ?? '')
                                    <p>{{ $patient->age }} years</p>
                                @else
                                    <p>N/A</p>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <h6 class="pro-title">Address & Location</h6>
                            </div>
                            <div class="col-md-3">
                                <h5>Address</h5>
                                @if ($patient->address ?? '')
                                    <p>{{ $patient->address }}</p>
                                @else
                                    <p>N/A</p>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <h5>Country</h5>
                                @if ($patient->country ?? '')
                                    <p>{{ $patient->country }}</p>
                                @else
                                    <p>N/A</p>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <h5>State</h5>
                                @if ($patient->state ?? '')
                                    <p>{{ $patient->state }}</p>
                                @else
                                    <p>N/A</p>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <h5>Zip code</h5>
                                @if ($patient->zip_code ?? '')
                                    <p>{{ $patient->zip_code }}</p>
                                @else
                                    <p>N/A</p>
                                @endif
                            </div>
                        </div>
                        <!-- /Services List -->
                        <div class="profile-list">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pro-title d-flex justify-content-between">
                                        <h6>Account Information</h6>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h5>Email Address</h5>
                                    <p>{{ $patient->email }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h5>Phone Number</h5>
                                    @if ($patient->mobile ?? '')
                                        <p>{{ $patient->mobile }}</p>
                                    @else
                                        <p>N/A</p>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <h5>Social Links</h5>
                                    <div
                                        class="social-icon d-flex justify-content-between mt-2">
                                        <div>
                                            @if ($patient->twitter ?? '')
                                                <a href="{{ $patient->twitter }}"><i
                                                        class="feather-twitter"></i></a>
                                            @else
                                                <a href="#"><i
                                                        class="feather-twitter"></i></a>
                                            @endif

                                        </div>
                                        <div>
                                            @if ($patient->facebook ?? '')
                                                <a href="{{ $patient->facebook }}"><i
                                                        class="feather-facebook"></i></a>
                                            @else
                                                <a href="#"><i
                                                        class="feather-facebook"></i></a>
                                            @endif
                                        </div>
                                        <div>
                                            @if ($patient->linkedin ?? '')
                                                <a href="{{ $patient->linkedin }}"><i
                                                        class="feather-linkedin"></i></a>
                                            @else
                                                <a href="#"><i
                                                        class="feather-linkedin"></i></a>
                                            @endif
                                        </div>
                                        <div>
                                            @if ($patient->instagram ?? '')
                                                <a href="{{ $patient->instagram }}"><i
                                                        class="feather-instagram"></i></a>
                                            @else
                                                <a href="#"><i
                                                        class="feather-instagram"></i></a>
                                            @endif
                                        </div>
                                        <div>
                                            @if ($patient->youtube ?? '')
                                                <a href="{{ $patient->youtube }}"><i
                                                        class="feather-youtube"></i></a>
                                            @else
                                                <a href="#"><i
                                                        class="feather-youtube"></i></a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /Overview Content -->
        </div>
    </div>
</div>
<!-- /Doctor Details Tab -->

</div>
        </div>
    </div>
    </div>

    </div>

    </div>
    <!-- /Page Content -->
    </div>
    <!-- /Page Content -->

@endsection
