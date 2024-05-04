@extends('layout.mainlayout_index1')
@section('title', 'Appointments')
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

                        <div class="row">
                            <h4 class="mb-4">Notifications</h4>

                            <div class="tab-content pt-0">
                                @if (session()->has('flash'))
                                    <x-alert>{{ session('flash')['message'] }}</x-alert>
                                @endif
                                <div id="pat_appointments" class="tab-pane fade show active">
                                    <div class="card card-table mb-0">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-center mb-0" id="datatable1">
                                                    <thead>
                                                        <tr>
                                                            <th>Sender</th>
                                                            <th>Message</th>
                                                            <th>Cancellation Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($notifications as $notification)
                                                            <tr>
                                                                <td>{{ $notification?->sender->name ?? '' }}</td>
                                                                <td>{{ $notification?->message ?? '' }}</td>
                                                                <td>{{ $notification?->created_at ?? '' }}</td>

                                                            </tr>
                                                        @empty
                                                            {{-- <tr>
                                                                <td class="col-span-6">
                                                                    <h3 class="bg-danger-light">No New Notification found</h3>
                                                                </td>
                                                            </tr> --}}
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>

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
