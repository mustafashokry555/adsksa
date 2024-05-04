<?php $page = 'doctor-dashboard'; ?>
@extends('layout.mainlayout_doctor')
@section('title', 'My Patients')
@section('content')
    <div class="col-md-7 col-lg-8 col-xl-9">
        @if (session()->has('flash'))
            <x-alert>{{ session('flash')['message'] }}</x-alert>
        @endif
        <div class="row row-grid">
            @forelse($patients as $patient)
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="card widget-profile pat-widget-profile">
                        <div class="card-body">
                            <div class="pro-widget-content">
                                <div class="profile-info-widget">
                                    <a href="{{ route('profile.show', ['profile' => $patient->id]) }}"
                                        class="booking-doc-img">
                                        @if ($patient->profile_image ?? '')
                                            <img src="{{ asset($patient->profile_image) }}"
                                                alt="User Image">
                                        @else
                                            <img src="assets/img/patients/patient.jpg" alt="User Image">
                                        @endif
                                    </a>
                                    <div class="profile-det-info">
                                        <h3><a
                                                href="{{ route('profile.show', ['profile' => $patient->id]) }}">{{ $patient->name }}</a>
                                        </h3>
                                        <div class="patient-details">
                                            @if ($patient->address && $patient->state)
                                                <h5>
                                                    <i class="fas fa-map-marker-alt"></i> {{ $patient->address }},
                                                    {{ $patient->state }}
                                                </h5>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="patient-info">
                                <ul>
                                    <li>Phone <span>{{ $patient->mobile }}</span></li>
                                    <li>Age <span>{{ $patient->age }} Years, Male</span></li>
                                    <li>Blood Group <span>{{ $patient->blood_group }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @empty

             <h5>No patient found</h5>
            @endforelse
            <div class="pagination pagination-sm">
                {{ $patients->links() }}
            </div>
        </div>
    </div>
    </div>

    </div>

    </div>
    <!-- /Page Content -->
    </div>
@endsection
