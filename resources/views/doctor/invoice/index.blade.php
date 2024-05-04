<?php $page = "doctor-dashboard"; ?>
@extends('layout.mainlayout_doctor')
@section('title', 'Invcoices')
@section('content')
    <!-- Page Content -->
    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="card card-table">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-hover table-center mb-0" id="datatable1">
                        <thead>
                        <tr>
                        <th>ID</th>
                            <th>Patient</th>
                            <th>Amount</th>
                            <th>Paid On</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($invoices as $invoice)
                            @php
                            $patient = \App\Models\User::query()->where('id', $invoice->patient_id)->first();
                            @endphp
                        <tr>
                            <td>{{$invoice->id}}</td>
                            <td>
                                <h2 class="table-avatar">
                                    <a href="{{ route('profile.show', ['profile' => $patient->id])}}" class="avatar avatar-sm me-2">
                                        @if($patient->profile_image)
                                        <img class="avatar-img rounded-circle" src="{{ asset($patient->profile_image) }}" alt="User Image">
                                        @else
                                        <img class="avatar-img rounded-circle" src="assets/img/patients/patient.jpg" alt="User Image">
                                        @endif
                                    </a>
                                    <a href="{{ route('profile.show', ['profile' => $patient->id])}}">{{ $patient->name }}</a>
                                </h2>
                            </td>
                            <td>{{ $invoice->fee?'SAR '.$invoice->fee:'FREE' }}</td>
                            <td>{{ date('d M Y', strtotime($invoice->appointment_date)) }}
                                <span
                                    class="d-block text-info">{{ date('H:i A', strtotime($invoice->appointment_time)) }}</span>
                            </td>
                            <td class="text-end">
                                <div class="table-action">
                                    <a href="{{ route('show_invoice', $invoice) }}" class="btn btn-sm bg-info-light">
                                        <i class="far fa-eye"></i> View
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

