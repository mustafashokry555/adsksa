@php
    $patient = \App\Models\User::query()->where('id', $invoice->patient_id)->first();
    $doctor = \App\Models\User::query()->where('id', $invoice->doctor_id)->first();
@endphp
@extends('layout.mainlayout_admin')
@section('title', 'Invoices')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="invoice-content">
                <div class="invoice-item">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="invoice-logo">
                                <img src="{{ asset('assets/img/logo.jpg') }}" alt="logo" style="height: 3rem;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p class="invoice-details">
                                <strong>Issued:</strong> {{ date('d M Y', strtotime(@$invoice->appointment_date)) }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="invoice-item">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="invoice-info">
                                <strong class="customer-text">Invoice From</strong>
                                <p class="invoice-details invoice-details-two">
                                    Dr. {{ @$doctor->name }} <br>
                                    {{ @$doctor->address }},<br>
                                    {{ @$doctor->state }}, {{ @$doctor->country}} <br>
                                </p><br>
                                <p class="invoice-details invoice-details-two">
                                    Appoitment Date : {{ date('d M Y', strtotime(@$invoice->appointment_date)) }}, {{ date('H:i A', strtotime(@$invoice->appointment_time)) }} <br>
                                    
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="invoice-info invoice-info2">
                                <strong class="customer-text">Invoice To</strong>
                                <p class="invoice-details">
                                    {{ @$patient->name }} <br>
                                    {{ @$patient->address }} <br>
                                    {{ @$patient->state }}, {{ @$patient->country }} <br>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="invoice-item">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="invoice-info">
                                <!-- <strong class="customer-text">Payment Method</strong>
                                <p class="invoice-details invoice-details-two">
                                    Debit Card <br>
                                    XXXXXXXXXXXX-2541 <br>
                                    HDFC Bank<br>
                                </p> -->
                                <strong class="customer-text">Payment </strong>
                            <p class="invoice-details invoice-details-two">
                               
                                Online<br>
                            </p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="invoice-item invoice-table-wrap">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="invoice-table table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">VAT</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>General Consultation</td>
                                        <td class="text-center">1</td>
                                        <td class="text-center">SAR 0</td>
                                        @if(@$invoice->fee == 0)
                                            <td class="text-end"><span class="badge rounded-pill bg-success-light">FREE</span></td>
                                        @else
                                            <td class="text-end">SAR {{ @$invoice->fee }}</td>
                                        @endif
                                    </tr>
                                    <!-- <tr>
                                        <td>Video Call Booking</td>
                                        <td class="text-center">1</td>
                                        <td class="text-center">$0</td>
                                        @if(@$doctor->pricing == 'Free')
                                            <td class="text-end"><span class="badge rounded-pill bg-success-light">{{ @$doctor->pricing }}</span></td>
                                        @else
                                            <td class="text-end">${{ @$doctor->pricing }}</td>
                                        @endif
                                    </tr> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4 ms-auto">
                            <div class="table-responsive">
                                <table class="invoice-table-two table">
                                    <tbody>
                                    @if(@$invoice->fee == 0)
                                    @else
                                        <tr>
                                            <th>Subtotal:</th>

                                            @if(@$invoice->fee == 0)
                                                <td class="text-end"><span class="badge rounded-pill bg-success-light">FREE</span></td>
                                            @else
                                                <td class="text-end">SAR {{ @$invoice->fee }}</td>
                                            @endif
                                        </tr>
                                     
                                        <tr>
                                            <th>Total Amount:</th>
                                            @if(@$invoice->fee==0)
                                                <td class="text-end"><span class="badge rounded-pill bg-success-light">FREE</span></td>
                                            @else
                                                <td class="text-end">SAR {{ @$invoice->fee }}</td>
                                            @endif
                                        </tr>
                                    @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="other-info">
                    <h4>Other information</h4>
                    <p class="text-muted mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sed dictum
                        ligula, cursus blandit risus. Maecenas eget metus non tellus dignissim aliquam ut a ex. Maecenas sed
                        vehicula dui, ac suscipit lacus. Sed finibus leo vitae lorem interdum, eu scelerisque tellus
                        fermentum. Curabitur sit amet lacinia lorem. Nullam finibus pellentesque libero.</p>
                </div>

            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
    </div>
    <!-- /Main Wrapper -->
    @component('admin.components.modal-popup')
    @endcomponent

@endsection
