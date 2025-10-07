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
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($invoices as $invoice)
                        <tr>
                            <td>{{$invoice->id}}</td>
                            <td>
                                <h2 class="table-avatar">
                                    @if ($invoice->patient)
                                        <a href="{{ route('profile.show', ['profile' => $invoice->patient->id]) }}" class="avatar avatar-sm me-2">
                                            @if ($invoice->patient->profile_image)
                                                <img class="avatar-img rounded-circle" src="{{ asset($invoice->patient->profile_image) }}" alt="Patient Image">
                                            @else
                                                <img class="avatar-img rounded-circle" src="{{ URL::asset('/assets/img/patients/patient.jpg') }}" alt="Patient Image">
                                            @endif
                                        </a>
                                        <a href="{{ route('profile.show', ['profile' => $invoice->patient->id]) }}">{{ $invoice->patient?->name??'' }}</a>
                                    @else
                                        <a href="#" class="avatar avatar-sm me-2">
                                            <img class="avatar-img rounded-circle" src="{{ URL::asset('/assets/img/patients/patient.jpg') }}" alt="Patient Image">
                                        </a>
                                        <a href="#">Unknown Patient</a>
                                    @endif
                                </h2>
                            </td>
                            <td>{{ $invoice->subtotal?'SAR '.$invoice->subtotal:'FREE' }}</td>
                            <td>{{ date('d M Y', strtotime($invoice->invoice_date)) }}
                                <span
                                    class="d-block text-info">{{ date('H:i A', strtotime($invoice->invoice_date)) }}</span>
                            </td>
                            <td class="text-end">
                                <div class="table-action">
                                    <a href="{{ route('show_invoice', $invoice) }}" class="btn btn-sm bg-info-light">
                                        <i class="far fa-eye"></i> View
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
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

