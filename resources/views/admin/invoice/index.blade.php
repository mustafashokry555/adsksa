@extends('layout.mainlayout_admin')
@section('title', 'Invoices')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="card card-table">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-hover table-center mb-0" id="data-table">
                            <thead>
                            <tr>
                            <th>{{ __('admin.invoice.id')  }}</th>
                                <th>{{ __('admin.invoice.patient')  }}</th>
                                <th>{{ __('admin.invoice.amount')  }}</th>
                                <th>{{ __('admin.invoice.paid_on')  }}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($invoices as $invoice)
                                <tr>
                                    <td>{{$invoice->id}}</td>
                                    <td>
                                        <h2 class="table-avatar">
                                            <a href="#" class="avatar avatar-sm me-2">
                                                @if(@$invoice->patient?->profile_image)
                                                    <img class="avatar-img rounded-circle" src="{{ asset( @$invoice->patient?->profile_image) }}" alt="User Image">
                                                @else
                                                    <img class="avatar-img rounded-circle" src="assets/img/patients/patient.jpg" alt="User Image">
                                                @endif
                                            </a>
                                            <a href="#">{{ @$invoice->patient->name }}</a>
                                        </h2>
                                    </td>
                                    @if(@$invoice->subtotal == 0)
                                        <td><span class="badge rounded-pill bg-success-light">{{ $invoice->subtotal==0?'FREE':$invoice->subtotal }}</span></td>
                                    @else
                                        <td>SAR {{ @$invoice->subtotal }}</td>
                                    @endif
                                    <td>{{ date('d M Y', strtotime(@$invoice->invoice_date)) }}
                                        <span
                                            class="d-block text-info">{{ date('H:i A', strtotime(@$invoice->invoice_date)) }}</span>
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
                                <tr class="bg-danger-light">
                                    <td class="text-center" colspan="4">{{ __('admin.invoice.no_appointments_found')  }}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

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
