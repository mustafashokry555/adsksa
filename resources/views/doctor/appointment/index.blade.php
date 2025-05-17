<?php $page = 'doctor-dashboard'; ?>
@extends('layout.mainlayout_doctor')
@section('title', 'Appointments')
@section('content')
    <!-- Page Content -->
    <div class="col-md-7 col-lg-8 col-xl-9">
        @if (session()->has('flash'))
            <x-alert>{{ session('flash')['message'] }}</x-alert>
        @endif
        <div class="container">
            <div class="appointments">
                @forelse($appointments as $appointment)
                    @php
                        $patient = \App\Models\User::query()
                            ->where('id', $appointment->patient_id)
                            ->first();
                    @endphp
                    <div class="appointment-list">
                        <div class="profile-info-widget">
                            <a href="{{ route('profile.show', ['profile' => $patient?->id]) }}" class="booking-doc-img">
                                <img src="{{ asset( $patient?->profile_image) }}" alt="User Image">
                            </a>
                            <?php //echo asset('storage/images/' . $patient->profile_image);
                            ?>
                            <div class="profile-det-info">
                                <h3><a
                                        href="{{ route('profile.show', ['profile' => $patient?->id]) }}">{{ $patient?->name }}</a>
                                </h3>
                                <div class="patient-details">
                                    <h5><i class="far fa-clock"></i>
                                        {{ date('d M Y', strtotime($appointment->appointment_date)) }},
                                        {{ date('H:i A', strtotime($appointment->appointment_time)) }}</h5>
                                    @if ($patient?->address && $patient?->state)
                                        <h5>
                                            <i class="fas fa-map-marker-alt"></i> {{ $patient?->address }},
                                            {{ $patient?->state }}
                                        </h5>
                                    @endif
                                    <h5><i class="fas fa-envelope"></i> {{ $patient?->email }}</h5>
                                    <h5 class="mb-0"><i class="fas fa-phone"></i>{{ $patient?->mobile }}</h5>
                                    <h5 class="mb-0">Insurance: {{ $appointment->insurance?->name??'N/A' }}</h5>
                                    <h5 class="mb-0">Price: {{ $appointment->fee?'SAR '.$appointment->fee:'FREE' }}</h5>

                                </div>
                            </div>
                        </div>
                        <div class="appointment-action gap-3">
                            @if ($appointment->status == 'P')
                                <form method="POST" action="{{ route('update_appointment_status', $appointment) }}">
                                    @method('patch')
                                    @csrf
                                    <input type="hidden" name="status" value="C">
                                    <button type="submit" href="javascript:void(0);" class="btn btn-sm bg-success-light">
                                        <i class="fas fa-check"></i> Accept
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('update_appointment_status', $appointment) }}">
                                    @method('patch')
                                    @csrf
                                    <input type="hidden" name="status" value="D">
                                    <button type="submit" href="javascript:void(0);" class="btn btn-sm bg-danger-light">
                                        <i class="fas fa-times"></i> Cancel
                                    </button>
                                </form>
                            @elseif($appointment->status == 'D')
                                 @if($appointment->cancel_by_patient=='0')
                                <form method="POST" action="{{ route('update_appointment_status', $appointment) }}">
                                    @method('patch')
                                    @csrf
                                    <input type="hidden" name="status" value="C">
                                    <button type="submit" href="javascript:void(0);" class="btn btn-sm bg-success-light">
                                        <i class="fas fa-check"></i> Accept
                                    </button>
                                </form>

                                <form method="POST" action="{{ route('update_appointment_status', $appointment) }}">
                                    @method('patch')
                                    @csrf
                                    <input type="hidden" name="status" value="D">
                                    <button type="submit" href="javascript:void(0);" class="btn btn-sm bg-danger-light">
                                        <i class="fas fa-times"></i> Cancel
                                    </button>
                                </form>

                                @else
                                <button type="submit" href="javascript:void(0);" class="btn btn-sm bg-danger-light">
                                        <i class=""></i> Canceled by patient
                                    </button>
                                @endif
                            @else
                                <a href="javascript:void(0);" class="btn btn-sm bg-success-light">
                                    <i class="fas fa-check"></i> Confirmed
                                </a>
                                <form method="POST" action="{{ route('update_appointment_status', $appointment) }}">
                                    @method('patch')
                                    @csrf
                                    <input type="hidden" name="status" value="D">
                                    <button type="submit" href="javascript:void(0);" class="btn btn-sm bg-danger-light">
                                        <i class="fas fa-times"></i> Cancel
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="appointment-list">
                        <div class="appointment-action">
                            <p href="javascript:void(0);" class="btn btn-sm bg-danger-light">
                                <i class="fas fa-times"></i> No Appointments Available
                            </p>
                        </div>
                    </div>
                @endforelse
                <div class="pagination pagination-sm">
                    {{ $appointments->links() }}
                </div>
            </div>
        </div>
    </div>
    </div>

    </div>

    </div>
    <!-- /Page Content -->
    </div>

@endsection
