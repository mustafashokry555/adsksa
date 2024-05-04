@extends('layout.mainlayout_hospital')
@section('title', 'Invoices')
@section('content')
    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="card card-table">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-hover table-center mb-0" id="datatable1">
                        <thead>
                        <tr>
                        <th> {{ __('hospital.invoice.id')  }}</th>
                            <th>{{ __('hospital.invoice.patient')  }}</th>
                            <th>{{ __('hospital.invoice.amount')  }}</th>
                            <th>{{ __('hospital.invoice.paid_on')  }}</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($invoices as $invoice)
                            @php
                                $patient = \App\Models\User::query()->where('id', $invoice->patient_id)->first();
                                $doctor = \App\Models\User::query()->where('id', $invoice->doctor_id)->first();
                            @endphp
                            <tr>
                                <td>{{$invoice->id}}</td>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="{{ route('profile.show', ['profile' => $patient->id]) }}" class="avatar avatar-sm me-2">
                                            @if(@$patient?->profile_image)
                                                <img class="avatar-img rounded-circle" src="{{ asset( @$patient?->profile_image) }}" alt="User Image">
                                            @else
                                                <img class="avatar-img rounded-circle" src="assets/img/patients/patient.jpg" alt="User Image">
                                            @endif
                                        </a>
                                        <a href="{{ route('profile.show', ['profile' => $patient->id]) }}">{{ $patient->name }}</a>
                                    </h2>
                                </td>
                                @if($invoice->fee == 0)
                                <td><span class="badge rounded-pill bg-success-light">{{ __('hospital.invoice.free')  }}</span></td>
                                @else
                                <td>
                                @if($invoice->fee=='Free')
                                {{ __('hospital.invoice.free')  }}
                                                @else
                                                {{ @$doctor->pricing? __('hospital.invoice.SAR') .@$invoice->fee: __('hospital.invoice.free')}}
                                                @endif
                                </td>
                                @endif
                                <td>{{ date('d M Y', strtotime($invoice->appointment_date)) }}
                                    <span
                                        class="d-block text-info">{{ date('H:i A', strtotime($invoice->appointment_time)) }}</span>
                                </td>
                                <td class="text-end">
                                    <div class="table-action">
                                        <a href="{{ route('show_invoice', $invoice) }}" class="btn btn-sm bg-info-light">
                                            <i class="far fa-eye"></i> {{ __('hospital.invoice.view')  }}
                                        </a>
                                        {{--                                    <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">--}}
                                        {{--                                        <i class="fas fa-print"></i> Print--}}
                                        {{--                                    </a>--}}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <!-- <tr class="bg-danger-light">
                                <td class="text-center" colspan="4">No Appointments found</td>
                            </tr> -->
                        @endforelse
                        </tbody>
                    </table>
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
