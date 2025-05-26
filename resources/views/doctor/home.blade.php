<?php $page = 'doctor-dashboard'; ?>
@extends('layout.mainlayout_doctor')
@section('title', 'Doctor Dashboard')
@section('content')
    <!-- Page Content -->
    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="row">
            <div class="col-md-12">
                <div class="card dash-card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-4">
                                <div class="dash-widget dct-border-rht">
                                    <div class="circle-bar circle-bar1">
                                        <div class="circle-graph1" data-percent="75">
                                            <img src="{{ URL::asset('/assets/img/icon-01.png') }}" class="img-fluid"
                                                alt="patient">
                                        </div>
                                    </div>
                                    <div class="dash-widget-info">
                                        <h6>Total Appoinments</h6>
                                        <h3>{{ $total_appointments }}</h3>
                                        <!-- <p class="text-muted">Till Today</p> -->
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-4">
                                <div class="dash-widget dct-border-rht">
                                    <div class="circle-bar circle-bar2">
                                        <div class="circle-graph2" data-percent="65">
                                            <img src="{{ URL::asset('/assets/img/icon-02.png') }}" class="img-fluid"
                                                alt="Patient">
                                        </div>
                                    </div>
                                    <div class="dash-widget-info">
                                        <h6>Total Patients</h6>
                                        <h3>{{ $total_patients }}</h3>
                                        <!-- <p class="text-muted">{{ now()->format('Y-m-d') }}</p> -->
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-4">
                                <div class="dash-widget">
                                    <div class="circle-bar circle-bar3">
                                        <div class="circle-graph3" data-percent="50">
                                            <img src="{{ URL::asset('/assets/img/icon-03.png') }}" class="img-fluid"
                                                alt="Patient">
                                        </div>
                                    </div>
                                    <div class="dash-widget-info">
                                        <h6>Today's Appoinments</h6>
                                        <h3>{{ count($today_appointments) }}</h3>
                                        <!-- <p class="text-muted">{{ now()->format('Y-m-d') }}</p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-4">Patient Appoinment</h4>
                <div class="appointment-tab">

                    <!-- Appointment Tab -->
                    <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ url('#upcoming-appointments') }}"
                                data-bs-toggle="tab">Upcoming</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('#today-appointments') }}" data-bs-toggle="tab">Today</a>
                            {{-- {{dd($today_appointments)}} --}}
                        </li>
                    </ul>
                    <!-- /Appointment Tab -->

                    <div class="tab-content">

                        <!-- Upcoming Appointment Tab -->
                        <div class="tab-pane show active" id="upcoming-appointments">
                            <div class="card card-table mb-0">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-center mb-0" id="datatable1">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Patient Name</th>
                                                    <th>Appt Date</th>
                                                    <!-- <th>Type</th> -->
                                                    <th>Insurance</th>
                                                    <th class="text-center">Paid Amount</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($appointments as $appointment)
                                                    @php
                                                        $patient = \App\Models\User::query()
                                                            ->where('id', $appointment->patient_id)
                                                            ->first();
                                                    @endphp
                                                    <tr>
                                                        <td>{{$appointment->id}}</td>

                                                        <td>
                                                            <h2 class="table-avatar">
                                                                @if ($patient)
                                                                    <a href="{{ route('profile.show', ['profile' => $patient->id]) }}" class="avatar avatar-sm me-2">
                                                                        @if ($patient->profile_image)
                                                                            <img class="avatar-img rounded-circle" src="{{ asset($patient->profile_image) }}" alt="Patient Image">
                                                                        @else
                                                                            <img class="avatar-img rounded-circle" src="{{ URL::asset('/assets/img/patients/patient.jpg') }}" alt="Patient Image">
                                                                        @endif
                                                                    </a>
                                                                    <a href="{{ route('profile.show', ['profile' => $patient->id]) }}">{{ $patient?->name??'' }}</a>
                                                                @else
                                                                    <a href="#" class="avatar avatar-sm me-2">
                                                                        <img class="avatar-img rounded-circle" src="{{ URL::asset('/assets/img/patients/patient.jpg') }}" alt="Patient Image">
                                                                    </a>
                                                                    <a href="#">Unknown Patient</a>
                                                                @endif
                                                            </h2>
                                                        </td>

                                                        <td>{{ date('d M Y', strtotime($appointment?->appointment_date??'')) }}
                                                            <span
                                                                class="d-block text-info">{{ date('H:i A', strtotime($appointment?->appointment_time??'')) }}</span>
                                                        </td>

                                                        <!-- <td>New Patient</td> -->
                                                        <td>{{$appointment->insurance?->name??'N/A'}}</td>

                                                        @if ($appointment->fee == 'Free')
                                                            <td class="text-center bg-green-light">Free</td>
                                                        @else
                                                        <td class="text-center">{{ $appointment->fee?'SAR '.$appointment->fee:'FREE' }}</td>
                                                        @endif

                                                        @if ($appointment?->status == 'P')
                                                            <td><span
                                                                    class="badge rounded-pill bg-warning-light">Pending</span>
                                                            </td>
                                                        @elseif($appointment?->status == 'C')
                                                            <td>
                                                                <span
                                                                    class="badge rounded-pill bg-success-light">Confirm</span>
                                                            </td>
                                                        @elseif($appointment?->status == 'D')
                                                            <td><span
                                                                    class="badge rounded-pill bg-danger-light">Cancelled</span>
                                                            </td>
                                                        @else
                                                            <td>N/A</td>
                                                        @endif

                                                        <td class="text-end">
                                                            <div class="table-action">
                                                                <div class="d-flex justify-content-end gap-3">
                                                                    @if ($appointment?->status == 'P')
                                                                        <form method="POST"
                                                                            action="{{ route('update_appointment_status', $appointment) }}">
                                                                            @method('patch')
                                                                            @csrf
                                                                            <input type="hidden" name="status"
                                                                                value="C">
                                                                            <button type="submit"
                                                                                href="javascript:void(0);"
                                                                                class="btn btn-sm bg-success-light">
                                                                                <i class="fas fa-check"></i> Accept
                                                                            </button>
                                                                        </form>
                                                                        <form method="POST"
                                                                            action="{{ route('update_appointment_status', $appointment) }}">
                                                                            @method('patch')
                                                                            @csrf
                                                                            <input type="hidden" name="status"
                                                                                value="D">
                                                                            <button type="submit"
                                                                                href="javascript:void(0);"
                                                                                class="btn btn-sm bg-danger-light">
                                                                                <i class="fas fa-times"></i> Cancel
                                                                            </button>
                                                                        </form>
                                                                    @elseif($appointment?->status == 'D')
                                                                        <form method="POST"
                                                                            action="{{ route('update_appointment_status', $appointment) }}">
                                                                            @method('patch')
                                                                            @csrf
                                                                            <input type="hidden" name="status"
                                                                                value="C">
                                                                            <button type="submit"
                                                                                href="javascript:void(0);"
                                                                                class="btn btn-sm bg-success-light">
                                                                                <i class="fas fa-check"></i> Accept
                                                                            </button>
                                                                        </form>
                                                                        <form method="POST"
                                                                            action="{{ route('update_appointment_status', $appointment) }}">
                                                                            @method('patch')
                                                                            @csrf
                                                                            <input type="hidden" name="status"
                                                                                value="D">
                                                                            <button type="submit"
                                                                                href="javascript:void(0);"
                                                                                class="btn btn-sm bg-danger-light">
                                                                                <i class="fas fa-times"></i> Cancel
                                                                            </button>
                                                                        </form>
                                                                    @else
                                                                        <a href="javascript:void(0);"
                                                                            class="btn btn-sm bg-success-light">
                                                                            <i class="fas fa-check"></i> Confirmed
                                                                        </a>
                                                                        <form method="POST"
                                                                            action="{{ route('update_appointment_status', $appointment) }}">
                                                                            @method('patch')
                                                                            @csrf
                                                                            <input type="hidden" name="status"
                                                                                value="D">
                                                                            <button type="submit"
                                                                                href="javascript:void(0);"
                                                                                class="btn btn-sm bg-danger-light">
                                                                                <i class="fas fa-times"></i> Cancel
                                                                            </button>
                                                                        </form>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                @empty
                                                    <!-- <tr class="bg-danger-light">
                                                                    <td class="text-center" colspan="6">No appointment available
                                                                    </td>
                                                                </tr> -->
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Upcoming Appointment Tab -->

                        <!-- Today Appointment Tab -->
                        <div class="tab-pane" id="today-appointments">
                            <div class="card card-table mb-0">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-center mb-0" id="datatable2">
                                            <thead>
                                                <tr>
                                                   <th>ID</th>
                                                    <th>Patient Name</th>
                                                    <th>Appt Date</th>
                                                    <!-- <th>Type</th> -->
                                                    <th>Insurance</th>
                                                    <th>Paid Amount</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($today_appointments as $today_appointment)

                                                    <tr>
                                                        <td>{{$today_appointment->id}}</td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="#" class="avatar avatar-sm me-2">
                                                                    @if ($today_appointment?->patient?->profile_image)
                                                                        <img class="avatar-img rounded-circle"
                                                                            src="{{ asset($today_appointment->patient->profile_image) }}"
                                                                            alt="Patient Image">
                                                                    @else
                                                                        <img class="avatar-img rounded-circle"
                                                                            src="{{ URL::asset('/assets/img/patients/patient.jpg') }}"
                                                                            alt="Patient Image">
                                                                    @endif
                                                                </a>
                                                                <a
                                                                    href="#">{{ $today_appointment?->patient?->name??'' }}</a>
                                                            </h2>
                                                        </td>
                                                        <td>{{ date('d M Y', strtotime($today_appointment?->appointment_date??'')) }}

                                                            <span
                                                                class="d-block text-info">{{ date('H:i A', strtotime($today_appointment?->appointment_time??'')) }}</span>
                                                        </td>
                                                        <td>{{$appointment->insurance?->name??'N/A'}}</td>
                                                        <!-- <td>New Patient</td> -->
                                                        <td class="text-center">{{ $today_appointment->fee?'SAR '.$today_appointment->fee:'FREE' }}</td>
                                                        @if ($today_appointment?->status == 'P')
                                                            <td><span
                                                                    class="badge rounded-pill bg-warning-light">Pending</span>
                                                            </td>
                                                        @elseif($today_appointment?->status == 'C')
                                                            <td><span
                                                                    class="badge rounded-pill bg-success-light">Confirm</span>
                                                            </td>
                                                        @elseif($today_appointment?->status == 'D')
                                                            <td><span
                                                                    class="badge rounded-pill bg-danger-light">Cancelled</span>
                                                            </td>
                                                        @endif
                                                        <td class="text-end">
                                                            <div>
                                                                <div class="d-flex justify-content-end gap-3">
                                                                    @if ($today_appointment?->status == 'P')
                                                                        <form method="POST"
                                                                            action="{{ route('update_appointment_status', $today_appointment) }}">
                                                                            @method('patch')
                                                                            @csrf
                                                                            <input type="hidden" name="status"
                                                                                value="C">
                                                                            <button type="submit"
                                                                                href="javascript:void(0);"
                                                                                class="btn btn-sm bg-success-light">
                                                                                <i class="fas fa-check"></i> Accept
                                                                            </button>
                                                                        </form>
                                                                        <form method="POST"
                                                                            action="{{ route('update_appointment_status', $today_appointment) }}">
                                                                            @method('patch')
                                                                            @csrf
                                                                            <input type="hidden" name="status"
                                                                                value="D">
                                                                            <button type="submit"
                                                                                href="javascript:void(0);"
                                                                                class="btn btn-sm bg-danger-light">
                                                                                <i class="fas fa-times"></i> Cancel
                                                                            </button>
                                                                        </form>
                                                                    @elseif($today_appointment?->status == 'D')
                                                                        <form method="POST"
                                                                            action="{{ route('update_appointment_status', $today_appointment) }}">
                                                                            @method('patch')
                                                                            @csrf
                                                                            <input type="hidden" name="status"
                                                                                value="C">
                                                                            <button type="submit"
                                                                                href="javascript:void(0);"
                                                                                class="btn btn-sm bg-success-light">
                                                                                <i class="fas fa-check"></i> Accept
                                                                            </button>
                                                                        </form>
                                                                        <form method="POST"
                                                                            action="{{ route('update_appointment_status', $today_appointment) }}">
                                                                            @method('patch')
                                                                            @csrf
                                                                            <input type="hidden" name="status"
                                                                                value="D">
                                                                            <button type="submit"
                                                                                href="javascript:void(0);"
                                                                                class="btn btn-sm bg-danger-light">
                                                                                <i class="fas fa-times"></i> Cancel
                                                                            </button>
                                                                        </form>
                                                                    @else
                                                                        <a href="javascript:void(0);"
                                                                            class="btn btn-sm bg-success-light">
                                                                            <i class="fas fa-check"></i> Confirmed
                                                                        </a>
                                                                        <form method="POST"
                                                                            action="{{ route('update_appointment_status', $today_appointment) }}">
                                                                            @method('patch')
                                                                            @csrf
                                                                            <input type="hidden" name="status"
                                                                                value="D">
                                                                            <button type="submit"
                                                                                href="javascript:void(0);"
                                                                                class="btn btn-sm bg-danger-light">
                                                                                <i class="fas fa-times"></i> Cancel
                                                                            </button>
                                                                        </form>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <!-- <tr class="bg-danger-light">
                                                                    <td class="text-center" colspan="6">No Appointments found</td>
                                                                </tr> -->
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Today Appointment Tab -->

                    </div>
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
