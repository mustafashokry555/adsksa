@php
$patient = \App\Models\User::query()->where('id', $invoice->patient_id)->first();
@endphp
@extends('layout.mainlayout_doctor')
@section('title', 'Invoice view')
@section('content')
    <!-- Page Content -->
    <div class="col-md-7 col-lg-8 col-xl-9">
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
                            <strong>Issued:</strong> {{ date('d M Y', strtotime($invoice->appointment_date)) }}
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
                                Dr. {{ auth()->user()->name }} <br>
                                {{ auth()->user()->address }},<br>
                                {{ auth()->user()->state }}, {{ auth()->user()->country}} <br>
                            </p>
                            <br>
                            <p class="invoice-details invoice-details-two">
                                    Appoitment Date : {{ date('d M Y', strtotime(@$invoice->appointment_date)) }}, {{ date('H:i A', strtotime(@$invoice->appointment_time)) }} <br>
                                    
                                </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="invoice-info invoice-info2">
                            <strong class="customer-text">Invoice To</strong>
                            <p class="invoice-details">
                                {{ $patient->name }} <br>
                                {{ $patient->address }} <br>
                                {{ $patient->state }}, {{ $patient->country }} <br>
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
                                    <td class="text-end">{{ $invoice->fee==0?'FREE':'SAR '.$invoice->fee }}</td>
                                </tr>
                                <!-- <tr>
                                    <td>Video Call Booking</td>
                                    <td class="text-center">1</td>
                                    <td class="text-center">SAR 0</td>
                                    <td class="text-end">SAR {{ auth()->user()->pricing }}</td>
                                </tr> -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4 ms-auto">
                        <div class="table-responsive">
                            <table class="invoice-table-two table">
                                <tbody>
                                <tr>
                                    <th>Subtotal:</th>
                                    <td><span> {{ $invoice->fee==0?'FREE':'SAR '.$invoice->fee }}</span></td>
                                </tr>
{{--                                <tr>--}}
{{--                                    <th>Discount:</th>--}}
{{--                                    <td><span>-10%</span></td>--}}
{{--                                </tr>--}}
                                <tr>
                                    <th>Total Amount:</th>
                                    <td><span>{{ $invoice->fee==0?'FREE':'SAR '.$invoice->fee }}</span></td>
                                </tr>
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

    </div>

    </div>
    <!-- /Page Content -->
    </div>

@endsection

