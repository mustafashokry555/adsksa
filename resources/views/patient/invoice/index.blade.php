@extends('layout.mainlayout_index1')
@section('title', 'Patient Invcoices')
@section('content')
    <!-- Header -->
    @include('components.patient_header')
    <!-- /Header -->

    <div class="row align-items-center mt-4">

    </div>
    </div>
    </section>
    <!-- /Home Banner -->
    <section class="about-us">
        <!-- Page Content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">

                    @include('layout.partials.nav_patient')
                    <div class="col-md-7 col-lg-8 col-xl-9">
                        <div class="card card-table">
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-hover table-center mb-0" id="datatable1">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Doctor</th>
                                                <th>Amount</th>
                                                <th>Paid On</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($invoices as $invoice)
                                                <tr>
                                                    <td>{{ $invoice->id }}</td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            @if ($invoice->doctor)
                                                                <a href="{{ route('doctor_profile', ['doctor' => $invoice->doctor->id]) }}"
                                                                    class="avatar avatar-sm me-2">
                                                                    @if ($invoice->doctor->profile_image)
                                                                        <img class="avatar-img rounded-circle"
                                                                            src="{{ asset($invoice->doctor->profile_image) }}"
                                                                            alt="Doctor Image">
                                                                    @else
                                                                        <img class="avatar-img rounded-circle"
                                                                            src="{{ URL::asset('/assets/img/patients/patient.jpg') }}"
                                                                            alt="Doctor Image">
                                                                    @endif
                                                                </a>
                                                                <a
                                                                    href="{{ route('doctor_profile', ['doctor' => $invoice->doctor->id]) }}">{{ $invoice->doctor?->name ?? '' }}</a>
                                                            @else
                                                                <a href="#" class="avatar avatar-sm me-2">
                                                                    <img class="avatar-img rounded-circle"
                                                                        src="{{ URL::asset('/assets/img/patients/patient.jpg') }}"
                                                                        alt="Doctor Image">
                                                                </a>
                                                                <a href="#">Unknown Doctor</a>
                                                            @endif
                                                        </h2>
                                                    </td>
                                                    <td>{{ $invoice->subtotal ? 'SAR ' . $invoice->subtotal : 'FREE' }}</td>
                                                    <td>{{ date('d M Y', strtotime($invoice->invoice_date)) }}
                                                        <span
                                                            class="d-block text-info">{{ date('H:i A', strtotime($invoice->invoice_date)) }}</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <div class="table-action">
                                                            <a href="{{ route('show_invoice', $invoice) }}"
                                                                class="btn btn-sm bg-info-light">
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
    </section>

@endsection
