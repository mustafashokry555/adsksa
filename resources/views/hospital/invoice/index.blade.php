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
                                <th> {{ __('hospital.invoice.id') }}</th>
                                <th>{{ __('hospital.invoice.patient') }}</th>
                                <th>{{ __('hospital.invoice.amount') }}</th>
                                <th>{{ __('hospital.invoice.paid_on') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->id }}</td>
                                    <td>
                                        <h2 class="table-avatar">
                                            @if (@$invoice->patient?->profile_image)
                                                <a href="{{ route('profile.show', ['profile' => $invoice->patient->id]) }}"
                                                    class="avatar avatar-sm me-2">
                                                    <img class="avatar-img rounded-circle"
                                                        src="{{ asset(@$invoice->patient?->profile_image) }}" alt="User Image">
                                                </a>
                                                <a
                                                    href="{{ route('profile.show', ['profile' => $invoice->patient->id]) }}">{{ $invoice->patient->name }}</a>
                                            @else
                                                <a class="avatar avatar-sm me-2">
                                                    <img class="avatar-img rounded-circle"
                                                        src="assets/img/patients/patient.jpg" alt="User Image">
                                                </a>
                                            @endif

                                        </h2>
                                    </td>
                                    @if ($invoice->subtotal == 0)
                                        <td>
                                            <span class="badge rounded-pill bg-success-light">
                                                {{ __('hospital.invoice.free') }}
                                            </span>
                                        </td>
                                    @else
                                        <td>
                                            @if ($invoice->subtotal == 'Free')
                                                {{ __('hospital.invoice.free') }}
                                            @else
                                                {{ @$invoice->doctor?->pricing ? __('hospital.invoice.SAR') . @$invoice->subtotal : __('hospital.invoice.free') }}
                                            @endif
                                        </td>
                                    @endif
                                    <td>{{ date('d M Y', strtotime($invoice->invoice_date)) }}
                                        <span
                                            class="d-block text-info">{{ date('H:i A', strtotime($invoice->invoice_date)) }}</span>
                                    </td>
                                    <td class="text-end">
                                        <div class="table-action">
                                            <a href="{{ route('show_invoice', $invoice) }}"
                                                class="btn btn-sm bg-info-light">
                                                <i class="far fa-eye"></i> {{ __('hospital.invoice.view') }}
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
