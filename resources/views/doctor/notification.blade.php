<?php $page = 'doctor-dashboard'; ?>
@extends('layout.mainlayout_doctor')
@section('title', 'Doctor Dashboard')
@section('content')
    <!-- Page Content -->
    <div class="col-md-7 col-lg-8 col-xl-9">
    
        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-4">Notifications</h4>
                <div class="appointment-tab">

                    <div class="tab-content">

                        <!-- Upcoming Appointment Tab -->
                        <div class="tab-pane show active" id="upcoming-appointments">
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
                                                        <td>{{$notification?->sender->name??''}}</td>
                                                        <td>{{$notification?->message??''}}</td>
                                                        <td>{{$notification?->created_at??''}}</td>
                                                    </tr>
                                                @empty
                                                    {{-- <tr class="bg-danger-light">
                                                        <td class="text-center" colspan="6">No New Notifications available</td>
                                                    </tr> --}}
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Upcoming Appointment Tab -->

                    </div>
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
