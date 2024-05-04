@extends('layout.mainlayout_hospital')
@section('title', 'Appointments')
@section('content')
    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="page-header p-8 m-2">
            <div class="row align-items-center">
                <div class="col-md-12 d-flex justify-content-end">
                    <div class="doc-badge me-3">{{ __('hospital.appointments.appointments')  }} <span class="ms-1">{{ count($appointments) }}</span></div>
                </div>
            </div>
        </div>
        @if (session()->has('flash'))
            <x-alert>{{ session('flash')['message'] }}</x-alert>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div>
                    <div class="tab-content">

                        <!-- Doctor List -->
                        <div>
                            <div class="card card-table mb-0">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-center mb-0" id="datatable1">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('hospital.appointments.id')  }}</th>
                                                    <th>{{ __('hospital.appointments.doctor')  }}</th>
                                                    <th>{{ __('hospital.appointments.patient')  }}</th>
                                                    <th>{{ __('hospital.appointments.insurance')  }}</th>
                                                    <th>{{ __('hospital.appointments.appt_date')  }}</th>
                                                    <th>{{ __('hospital.appointments.booking_date')  }}</th>
                                                    <th>{{ __('hospital.appointments.amount')  }}</th>
                                                    <th>{{ __('hospital.appointments.status')  }}</th>
                                                    <th>{{ __('hospital.appointments.action')  }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($appointments as $appointment)
                                                    @php
                                                        $patient = \App\Models\User::query()
                                                            ->where('id', $appointment->patient_id)
                                                            ->first();
                                                        $doctor = \App\Models\User::query()
                                                            ->where('id', $appointment->doctor_id)
                                                            ->first();
                                                    @endphp
                                                    <tr>
                                                        <td>{{$appointment->id}}</td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                @if ($doctor->profile_image ?? '')
                                                                    <a class="avatar avatar-sm me-2"
                                                                        href="{{ route('profile.show', ['profile' => $doctor->id]) }}"><img
                                                                            class="avatar-img rounded-circle"
                                                                            src="{{ asset( $doctor->profile_image) }}"
                                                                            alt="User Image"></a>
                                                                @else
                                                                    <a class="avatar avatar-sm me-2"><img
                                                                            class="avatar-img rounded-circle"
                                                                            src="{{ URL::asset('/assets/img/patients/patient.jpg') }}"
                                                                            alt="User Image"></a>
                                                                @endif
                                                                <a
                                                                    href="{{ route('profile.show', ['profile' => $doctor->id]) }}">{{ $doctor->name }}
                                                                    <span></span></a>
                                                            </h2>
                                                        </td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                @if ($patient->profile_image ?? '')
                                                                    <a class="avatar avatar-sm me-2"
                                                                        href="{{ route('profile.show', ['profile' => $patient->id]) }}"><img
                                                                            class="avatar-img rounded-circle"
                                                                            src="{{ asset($patient->profile_image) }}"
                                                                            alt="User Image"></a>
                                                                @else
                                                                    <a class="avatar avatar-sm me-2"><img
                                                                            class="avatar-img rounded-circle"
                                                                            src="{{ URL::asset('/assets/img/patients/patient.jpg') }}"
                                                                            alt="User Image"></a>
                                                                @endif
                                                                <a
                                                                    href="{{ @route('profile.show', ['profile' => @$patient->id]) }}">{{ @$patient->name }}
                                                                    <span></span></a>
                                                            </h2>
                                                        </td>
                                                        <td>{{ $appointment->insurance?->name??'N/A' }}</td>
                                                        <td>{{ date('d M Y', strtotime($appointment->appointment_date)) }}
                                                            <span
                                                                class="d-block text-info">{{ date('H:i A', strtotime($appointment->appointment_time)) }}</span>
                                                        </td>
                                                        <td>{{ date('d M Y', strtotime($appointment->created_at)) }}</td>
                                                        <td class="text-center">
                                                        {{ @$appointment->fee? __('hospital.appointments.SAR') .@$appointment->fee:__('hospital.appointments.free')}}
                                                        </td>
                                                        <td>
                                                        @if ($appointment->status == 'P')
                                                            <span
                                                                    class="badge rounded-pill bg-warning-light">{{ __('hospital.appointments.pending')  }}</span>
                                                        @elseif($appointment->status == 'C')
                                                                <span
                                                                    class="badge rounded-pill bg-success-light">{{ __('hospital.appointments.confirm')  }}</span>
                                                        @elseif($appointment->status == 'D')
                                                                <span
                                                                    class="badge rounded-pill bg-danger-light">{{ __('hospital.appointments.cancelled')  }}</span>

                                                        @endif
                                                        </td>
                                                        {{-- <td class="text-end">
                                                        <div class="table-action d-flex justify-content-between gap-3">
                                                            <form method="POST"
                                                                  action="{{ route('update_appointment_status', $appointment) }}">
                                                                @method('patch')
                                                                @csrf
                                                                <input type="hidden" name="status" value="C">
                                                                <button type="submit"
                                                                        class="btn btn-sm bg-success-light">
                                                                    <i class="fas fa-check"></i> Accept
                                                                </button>
                                                            </form>
                                                            <form method="POST"
                                                                  action="{{ route('update_appointment_status', $appointment) }}">
                                                                @method('patch')
                                                                @csrf
                                                                <input type="hidden" name="status" value="D">
                                                                <button type="submit"
                                                                        class="btn btn-sm bg-danger-light">
                                                                    <i class="fas-regular fa-times"></i> Cancel
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td> --}}


                                                        <td class="text-end">
                                                            <div class="table-action">
                                                                <div class="d-flex justify-content-end gap-3">
                                                                    @if ($appointment->status == 'P')
                                                                        <form method="POST"
                                                                            action="{{ route('update_appointment_status', $appointment) }}">
                                                                            @method('patch')
                                                                            @csrf
                                                                            <input type="hidden" name="status"
                                                                                value="C">
                                                                            <button type="submit"
                                                                                href="javascript:void(0);"
                                                                                class="btn btn-sm bg-success-light">
                                                                                <i class="fas fa-check"></i> {{ __('hospital.appointments.accept')  }}
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
                                                                                <i class="fas fa-times"></i> {{ __('hospital.appointments.cancel')  }}
                                                                            </button>
                                                                        </form>
                                                                    @elseif($appointment->status == 'D')
                                                                        <form method="POST"
                                                                            action="{{ route('update_appointment_status', $appointment) }}">
                                                                            @method('patch')
                                                                            @csrf
                                                                            <input type="hidden" name="status"
                                                                                value="C">
                                                                            <button type="submit"
                                                                                href="javascript:void(0);"
                                                                                class="btn btn-sm bg-success-light">
                                                                                <i class="fas fa-check"></i> {{ __('hospital.appointments.accept')  }}
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
                                                                                <i class="fas fa-times"></i> {{ __('hospital.appointments.cancel')  }}
                                                                            </button>
                                                                        </form>
                                                                    @else
                                                                        <a href="javascript:void(0);"
                                                                            class="btn btn-sm bg-success-light">
                                                                            <i class="fas fa-check"></i> {{ __('hospital.appointments.confirmed')  }}
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
                                                                                <i class="fas fa-times"></i> {{ __('hospital.appointments.cancel')  }}
                                                                            </button>
                                                                        </form>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <!-- <tr class="col-span-6">
                                                        <td>No Appointments Available</td>
                                                    </tr> -->
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Doctor List -->

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
