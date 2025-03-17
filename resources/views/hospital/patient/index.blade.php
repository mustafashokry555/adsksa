@extends('layout.mainlayout_hospital')
@section('title', 'Hospital Patients')
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
                                    <a href="{{ route('profile.show', ['profile' => $patient->id]) }}" class="booking-doc-img">
                                        @if ($patient->profile_image ?? '')
                                            <img src="{{ asset( $patient->profile_image) }}"
                                                alt="User Image">
                                        @else
                                            <img src="assets/img/patients/patient.jpg" alt="User Image">
                                        @endif
                                    </a>
                                    <div class="profile-det-info">
                                        <h3><a href="{{ route('profile.show', ['profile' => $patient->id]) }}">{{ $patient->name }}</a></h3>
                                        <div class="patient-details">
                                            @if ($patient->address && $patient->state)
                                                <h5>
                                                    <i class="fas fa-map-marker-alt"></i> {{ $patient->address }},
                                                    {{ $patient->state }}
                                                </h5>
                                            @endif
                                            {{-- <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> {{ $patient->address }},
                                                {{ $patient->state }}</h5> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="patient-info">
                                <ul>
                                    <li>{{ __('hospital.patient.mobile')  }} <span>{{ $patient->mobile }}</span></li>
                                    <li>{{ __('hospital.patient.age')  }}  <span>{{$patient->age? $patient->age.' Years, Male':'N/A' }} </span></li>
                                    <li>{{ __('hospital.patient.blood_group')  }}  <span>{{ $patient->blood_group }}</span></li>
                                    <li>
                                        <a href="{{ route('patient_insurance.show', $patient->id) }}">
                                            Insurance Details
                                            <span class="right">Edit >></span>
                                        </a>
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                {{-- <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="card widget-profile pat-widget-profile">
                        <div class="card-body">
                            <div class="pro-widget-content">
                                <div class="profile-info-widget">
                                    <a href="patient-profile.html" class="booking-doc-img">
                                        <img src="assets/img/patients/patient1.jpg" alt="User Image">
                                    </a>
                                    <div class="profile-det-info">
                                        <h3><a href="patient-profile.html">Charlene Reed</a></h3>
                                        <div class="patient-details">
                                            <h5><b>Patient ID :</b> P0001</h5>
                                            <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> North Carolina, USA
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="patient-info">
                                <ul>
                                    <li>Phone <span>+1 828 632 9170</span></li>
                                    <li>Age <span>29 Years, Female</span></li>
                                    <li>Blood Group <span>O+</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> --}}
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
