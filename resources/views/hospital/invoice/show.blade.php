@php
    $patient = \App\Models\User::query()->where('id', $invoice->patient_id)->first();
    $doctor = \App\Models\User::query()->where('id', $invoice->doctor_id)->first();
@endphp
@extends('layout.mainlayout_hospital')
@section('title', 'Invoices')
@section('content')
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
                            <strong>{{ __('hospital.invoice.issued')  }}:</strong> {{ date('d M Y', strtotime($invoice->appointment_date)) }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="invoice-item">
                <div class="row">
                    <div class="col-md-6">
                        <div class="invoice-info">
                            <strong class="customer-text">{{ __('hospital.invoice.invoice_from')  }}</strong>
                            <p class="invoice-details invoice-details-two">
                                {{ __('hospital.invoice.dr')  }}. {{ @$doctor->name }} <br>
                                {{ @$doctor->address }},<br>
                                {{ @$doctor->state }}, {{ $doctor->country}} <br>
                            </p>
                            <br>
                            <p class="invoice-details invoice-details-two">
                                {{ __('hospital.invoice.appointment_date')  }} : {{ date('d M Y', strtotime(@$invoice->appointment_date)) }}, {{ date('H:i A', strtotime(@$invoice->appointment_time)) }} <br>

                                </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="invoice-info invoice-info2">
                            <strong class="customer-text">{{ __('hospital.invoice.invoice_to')  }}</strong>
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
                                HDFC Bank<br> -->
                                 <strong class="customer-text">{{ __('hospital.invoice.payment')  }} </strong>
                            <p class="invoice-details invoice-details-two">

                                {{ __('hospital.invoice.online')  }}<br>
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
                                    <th>{{ __('hospital.invoice.description')  }}</th>
                                    <th class="text-center">{{ __('hospital.invoice.quantity')  }}</th>
                                    <th class="text-center">{{ __('hospital.invoice.VAT')  }}</th>
                                    <th class="text-end">{{ __('hospital.invoice.total')  }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ __('hospital.invoice.general_consultation')  }}</td>
                                    <td class="text-center">1</td>
                                    <td class="text-center">{{ __('hospital.invoice.SAR')  }} {{@$invoice->vat??'0'}}</td>
                                    @if(@$invoice->fee == 0)
                                    <td class="text-end"><span class="badge rounded-pill bg-success-light">{{ __('hospital.invoice.free')  }}</span></td>
                                    @else
                                    <td class="text-end">{{ __('hospital.invoice.SAR')  }} {{ @$invoice->fee }}</td>
                                    @endif
                                </tr>
                                <!-- <tr>
                                    <td>Video Call Booking</td>
                                    <td class="text-center">1</td>
                                    <td class="text-center">SAR 0</td>
                                    @if(@$doctor->pricing == 'Free')
                                        <td class="text-end"><span class="badge rounded-pill bg-success-light">{{ @$doctor->pricing }}</span></td>
                                    @else
                                        <td class="text-end">SAR {{ @$doctor->pricing }}</td>
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
                                    <th>{{ __('hospital.invoice.subtotal')  }}:</th>

                                    @if(@$invoice->fee == 'Free')
                                        <td class="text-end"><span class="badge rounded-pill bg-success-light">{{ @$invoice->fee }}</span></td>
                                    @else
                                        <td class="text-end">{{ __('hospital.invoice.SAR')  }} {{ @$invoice->fee }}</td>
                                    @endif
                                </tr>

                                <tr>
                                    <th>{{ __('hospital.invoice.total_amount')  }}:</th>
                                    @if(@$invoice->fee == 0)
                                        <td class="text-end"><span class="badge rounded-pill bg-success-light">{{ __('hospital.invoice.free')  }}</span></td>
                                    @else
                                        <td class="text-end">{{ __('hospital.invoice.SAR')  }} {{ @$invoice->fee }}</td>
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
                <h4>{{ __('hospital.invoice.other_information')  }}</h4>
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
