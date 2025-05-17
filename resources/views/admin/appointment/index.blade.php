@extends('layout.mainlayout_admin')
@section('title', 'Appointments')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-12 d-flex justify-content-end">
                        <div class="doc-badge me-3">{{ __('admin.appointments.appointments') }} <span
                                class="ms-1">{{ count($appointments) }}</span></div>
                    </div>
                </div>
            </div>
            @if (session()->has('flash'))
                <x-alert>{{ session('flash')['message'] }}</x-alert>
            @endif
            <!-- Doctor List -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="card-title">{{ __('admin.appointments.appointments') }}</h5>
                                </div>
                                <div class="col-auto d-flex flex-wrap">
                                    <div class="form-custom me-2">
                                        <div id="tableSearch" class="dataTables_wrapper"></div>
                                    </div>
                                    <div class="multipleSelection">
                                        <div class="selectBox">
                                            <p class="mb-0 me-2"><i class="feather-filter me-1"></i> Filter By
                                                Speciality </p>
                                            <span class="down-icon"><i class="feather-chevron-down"></i></span>
                                        </div>
                                        <div id="checkBoxes">
                                            @php
                                                $selectedSpeciality = request()->speciality ?? [];
                                            @endphp
                                            <form action="{{ route('appointments') }}">
                                                <p class="lab-title">Doctors</p>
                                                <div class="selectBox-cont">
                                                    @forelse($specialities as $speciality)
                                                        <label class="custom_check w-100">
                                                            <input type="checkbox" name="speciality[]"
                                                                value="{{ $speciality->id }}"
                                                                {{ in_array($speciality->id, $selectedSpeciality) ? 'checked' : '' }}>
                                                            <span class="checkmark"></span> {{ $speciality->name }}
                                                        </label>
                                                    @empty
                                                    @endforelse

                                                </div>
                                                <button type="submit" class="btn w-100 btn-primary">Apply</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="datatable table table-borderless hover-table" id="data-table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>{{ __('admin.appointments.id') }}</th>
                                            <th>{{ __('admin.appointments.doctor') }}</th>
                                            <th>{{ __('admin.appointments.patient') }}</th>
                                            <th>{{ __('admin.appointments.hospital') }}</th>
                                            <th>{{ __('admin.appointments.insurance') }}</th>
                                            <th>{{ __('admin.appointments.appt_date') }}</th>
                                            <th>{{ __('admin.appointments.amount') }}</th>
                                            <th>{{ __('admin.appointments.status') }}</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($appointments as $appointment)
                                            @php
                                                $doctor = \App\Models\User::query()
                                                    ->where('id', $appointment->doctor_id)
                                                    ->first();
                                                $patient = \App\Models\User::query()
                                                    ->where('id', $appointment->patient_id)
                                                    ->first();
                                                $hospital = \App\Models\Hospital::query()
                                                    ->where('id', $appointment->hospital_id)
                                                    ->first();
                                            @endphp
                                            <tr>
                                                <td>{{ $appointment->id }}</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a class="avatar-pos" href="#" data-bs-target="#doctorlist"
                                                            data-bs-toggle="modal">
                                                            @if ($doctor?->profile_image ?? '')
                                                                <img class="avatar avatar-img"
                                                                    src="{{ asset($doctor?->profile_image) }}"
                                                                    alt="User Image">
                                                            @else
                                                                <img class="avatar avatar-img"
                                                                    src="{{ asset('assets/img/doctors/doctor-01.jpg') }}"
                                                                    alt="">
                                                            @endif
                                                        </a>
                                                        <a href="#" data-bs-target="#doctorlist"
                                                            data-bs-toggle="modal" class="user-name">Dr.
                                                            {{ @$doctor?->name }}</a>
                                                    </h2>
                                                </td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a class="avatar-pos" href="#" data-bs-target="#doctorlist"
                                                            data-bs-toggle="modal">
                                                            @if ($patient?->profile_image ?? '')
                                                                <img class="avatar avatar-img"
                                                                    src="{{ asset($patient?->profile_image) }}"
                                                                    alt="User Image">
                                                            @else
                                                                <img class="avatar avatar-img"
                                                                    src="{{ asset('assets/img/doctors/doctor-01.jpg') }}"
                                                                    alt="">
                                                            @endif
                                                        </a>
                                                        <a href="#" data-bs-target="#doctorlist"
                                                            data-bs-toggle="modal"
                                                            class="user-name">{{ @$patient?->name }}</a>
                                                    </h2>
                                                </td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a class="avatar-pos" href="#" data-bs-target="#doctorlist"
                                                            data-bs-toggle="modal">
                                                            @if ($hospital->image ?? '')
                                                            <img class="avatar avatar-img"
                                                            src="{{ asset(optional($hospital->users->first())->profile_image ?? 'default-profile.png') }}"
                                                            alt="User Image">
                                                            @else
                                                                <img class="avatar avatar-img"
                                                                    src="{{ asset('assets/img/doctors/doctor-01.jpg') }}"
                                                                    alt="">
                                                            @endif
                                                        </a>
                                                        <a href="#" data-bs-target="#doctorlist"
                                                            data-bs-toggle="modal"
                                                            class="user-name">{{ $hospital->hospital_name }}</a>
                                                    </h2>

                                                </td>
                                                <td>{{ $appointment->insurance?->name ?? 'N/A' }}</td>
                                                <td>{{ date('d M Y', strtotime($appointment->appointment_date)) }}
                                                    <span
                                                        class="d-block text-info">{{ date('H:i A', strtotime($appointment->appointment_time)) }}</span>
                                                </td>
                                                <td>

                                                    {{ @$appointment->fee ? 'SAR ' . @$appointment->fee : 'FREE' }}

                                                </td>
                                                <td>
                                                    @if ($appointment->status == 'P')
                                                        <span class="badge rounded-pill bg-warning-light">Pending</span>
                                                    @elseif($appointment->status == 'C')
                                                        <span class="badge rounded-pill bg-success-light">Confirm</span>
                                                    @elseif($appointment->status == 'D')
                                                        <span class="badge rounded-pill bg-danger-light">Cancelled</span>
                                                    @endif
                                                </td>
                                                @if ($appointment->status == 'D')
                                                    <td class="text-end d-flex justify-content-between">
                                                        <form method="POST"
                                                            action="{{ route('update_appointment_status', $appointment) }}">
                                                            @method('patch')
                                                            @csrf
                                                            <input type="hidden" name="status" value="P">
                                                            <button type="submit" href="javascript:void(0);"
                                                                class="btn btn-sm bg-success-light">
                                                                <i class="fas fa-check"></i> Book Again
                                                            </button>
                                                        </form>

                                                        <form method="POST"
                                                            action="{{ route('update_appointment_status', $appointment) }}">
                                                            @method('patch')
                                                            @csrf
                                                            <input type="hidden" name="status" value="D">
                                                            <button type="submit" href="javascript:void(0);"
                                                                class="btn btn-sm bg-danger-light">
                                                                <i class="fas fa-times"></i> Cancel
                                                            </button>
                                                        </form>
                                                    </td>
                                                @else
                                                    <td class="text-end d-flex justify-content-between">
                                                        <div></div>
                                                        <form method="POST"
                                                            action="{{ route('update_appointment_status', $appointment) }}">
                                                            @method('patch')
                                                            @csrf
                                                            <input type="hidden" name="status" value="D">
                                                            <button type="submit" href="javascript:void(0);"
                                                                class="btn btn-sm bg-danger-light">
                                                                <i class="fas fa-times"></i> Cancel
                                                            </button>
                                                        </form>
                                                    </td>
                                                @endif
                                            </tr>
                                            {{ $appointment->links }}
                                        @empty
                                            <tr class="col-span-5">
                                                <td>{{ __('admin.appointments.no_appointments_available') }}</td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="tablepagination" class="dataTables_wrapper"></div>
                </div>
            </div>
            <!-- /Doctor List -->
        </div>
    </div>
    <!-- /Page Wrapper -->
    </div>
    <!-- /Main Wrapper -->
@endsection
