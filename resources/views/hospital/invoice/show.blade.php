@php
    $patient = \App\Models\User::query()->where('id', $invoice->patient_id)->first();
    $doctor = \App\Models\User::query()->where('id', $invoice->doctor_id)->first();
@endphp
@extends('layout.mainlayout_hospital')
@section('title', 'Invoices')
@section('content')
    {{-- <div class="col-md-7 col-lg-8 col-xl-9">
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
                            <strong>Issued:</strong> {{ date('d M Y', strtotime($invoice->invoice_date)) }}
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
                                Dr. {{ $invoice->doctor?->name }} <br>
                                {{ $invoice->doctor?->address }},<br>
                                {{ $invoice->doctor?->state?->name }}, {{ $invoice->doctor?->country?->name }} <br>
                            </p>
                            <br>
                            <p class="invoice-details invoice-details-two">
                                    Appoitment Date : {{ date('d M Y', strtotime(@$invoice->appointment?->appointment_date)) }}, {{ date('H:i A', strtotime(@$invoice->appointment?->appointment_date)) }} <br>

                                </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="invoice-info invoice-info2">
                            <strong class="customer-text">Invoice To</strong>
                            <p class="invoice-details">
                                {{ $patient->name }} <br>
                                {{ $patient->address }} <br>
                                {{ $patient->state?->name }}, {{ $patient->country?->name }} <br>
                            </p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="invoice-item">
                <div class="row">
                    <div class="col-md-12">
                        <div class="invoice-info">
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
                                    <th class="text-end">SubTotal</th>
                                    <th class="text-center">VAT ({{ $invoice->vat }}%)</th>
                                    <th class="text-end">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>General Consultation</td>
                                    <td class="text-center">1</td>
                                    <td class="text-center">SAR {{ $invoice->subtotal }}</td>
                                    @php
                                        $vat_amount = $invoice->subtotal == 0 ? 0 :  ($invoice->subtotal * ($invoice->vat / 100));
                                        $totla = $invoice->subtotal + $vat_amount;
                                    @endphp
                                    <td class="text-center">SAR {{ $vat_amount }}</td>
                                    <td class="text-end">{{ $totla == 0 ? 'FREE' : 'SAR '. $totla }}</td>
                                </tr>
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
                                    <td><span> {{ $invoice->subtotal == 0 ? 'FREE' : 'SAR '.$invoice->subtotal }}</span></td>
                                </tr>
                                <tr>
                                    <th>VAT ({{ $invoice->vat }}%):</th>
                                    <td><span> {{ $vat_amount }}</span></td>
                                </tr>
                                <tr>
                                    <th>Total Amount:</th>
                                    <td><span>{{ $totla == 0 ? 'FREE' : 'SAR '.$totla }}</span></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-end mt-4">
                <a class="btn btn-primary" href="{{ route('invoice.download', $invoice->id) }}" target="_blank">
                    <i class="fa fa-print"></i> Print Invoice
                </a>
            </div>

        </div>
    </div> --}}

    <style>
        #invoice {
            font-family: 'DejaVu Sans', sans-serif;
            direction: rtl;
            text-align: right;
            font-size: 12px;
        }

        .invoice-container {
            width: 400px;
            margin: 0 auto;
            background: white;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 20px;
        }

        #invoice .header {
            text-align: center;
            padding: 10px;
            border-bottom: 2px solid #4CAF50;
        }

        #invoice .header h1 {
            font-size: 14px;
            margin-bottom: 5px;
        }

        .invoice-number {
            /* background: #4CAF50; */
            color: Black;
            padding: 3px 8px;
            font-size: 10px;
            display: inline-block;
            margin-top: 5px;
        }

        .customer-info {
            padding: 10px;
            border-bottom: 1px solid #4CAF50;
            font-size: 11px;
            text-align: center;
        }

        .date-section {
            text-align: center;
            padding: 8px;
            border-bottom: 1px solid #4CAF50;
            font-size: 11px;
        }

        .tax-number {
            text-align: center;
            padding: 5px;
            font-size: 10px;
            border-bottom: 1px solid #4CAF50;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }

        .items-table th,
        .items-table td {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: center;
            font-size: 10px;
        }

        .items-table th {
            background: #f8f8f8;
        }

        .totals-section {
            padding: 10px;
            border-top: 1px solid #4CAF50;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            font-size: 11px;
        }

        .final-total {
            font-weight: bold;
            font-size: 12px;
            border-top: 1px solid #ddd;
            padding-top: 5px;
        }

        .qr-section {
            text-align: center;
            padding: 15px;
            border-top: 2px dashed #ccc;
        }

        .footer-text {
            font-size: 9px;
            margin-bottom: 10px;
            color: #666;
        }
    </style>
    <!-- Page Content -->
    @php
        $vat_amount = $invoice->subtotal == 0 ? 0 : $invoice->subtotal * ($invoice->vat / 100);
        $total = $invoice->subtotal + $vat_amount;
    @endphp
    <div class="invoice-container" id="invoice">
        <!-- Header -->
        <div class="header">
            <div href="{{ route('home') }}" class="logo" style="margin-right: 0 !important">
                <img src="{{ URL::asset('images/' . $setting->logo) }}" alt="Logo"
                    style="height: 3rem; margin-bottom: 10px;">
            </div>
            <h1>فاتورة ضريبية مبسطة</h1>
            <div class="invoice-number" dir="ltr">{{ $invoice->invoice_number }} :رقم الفاتورة</div>
        </div>

        <!-- Customer Info -->
        <!-- Customer & Patient Info -->
        <div class="customer-info" style="display: flex; justify-content: space-between; text-align: right;">
            <!-- Patient Info -->
            <div style="width: 48%; border-right: 1px solid #4CAF50; padding-right: 10px;">
                <div>اسم المريض:</div>
                <div>{{ $invoice->patient?->name ?? '---' }}</div>
                <div>رقم الهوية:</div>
                <div>{{ $invoice->patient?->id_number ?? '---' }}</div>
            </div>
            <!-- Company Info -->
            <div style="width: 48%;">
                <div>اسم المؤسسة:</div>
                <div>{{ $invoice->company_name }}</div>
                <div>عنوان المؤسسة:</div>
                <div>{{ $invoice->company_address }}</div>
            </div>
        </div>

        <!-- Date -->
        <div class="date-section">
            التاريخ: {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d-m-Y (A H:i)') }}
        </div>

        <!-- Tax Number -->
        <div class="tax-number">
            الرقم الضريبي لمقدم الخدمة: {{ $invoice->tax_number }}
        </div>

        <!-- Items Table -->
        <table class="items-table">
            <thead>
                <tr>
                    <th>البيان</th>
                    <th>الموعد</th>
                    <th>التكلفه</th>
                    <th>قيمة الضريبة</th>
                    <th>الإجمالي</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>استشاره طبية</td>
                    <td>{{ $invoice->appointment?->appointment_date . ' ' . \Carbon\Carbon::parse($invoice->appointment?->appointment_time)->format('(A H:i)') }}
                    </td>
                    <td>{{ number_format($invoice->subtotal, 2) }}</td>
                    <td>{{ number_format($vat_amount, 2) }}</td>
                    <td>{{ number_format($total, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Totals -->
        <div class="totals-section">
            <div class="total-row">
                <span>إجمالي المبلغ الخاضع للضريبة</span>
                <span>{{ number_format($invoice->subtotal, 2) }}</span>
            </div>
            <div class="total-row">
                <span>ضريبة القيمة المضافة (%15)</span>
                <span>{{ number_format($vat_amount, 2) }}</span>
            </div>
            <div class="total-row final-total">
                <span>المجموع الإجمالي</span>
                <span>{{ number_format($total, 2) }}</span>
            </div>
        </div>

        <!-- QR Code Section -->
        <div class="qr-section">
            <div class="footer-text" dir="ltr">
                ({{ $invoice->invoice_number }}) الفاتورة الضريبية المبسطة
            </div>
            <div>
                {!! $qrCode !!}
            </div>
        </div>
    </div>


    </div>

    </div>

    </div>
    <!-- /Page Content -->
    </div>
@endsection
