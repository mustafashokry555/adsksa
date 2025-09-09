<?php $page = 'doctor-dashboard'; ?>
@extends('layout.mainlayout_doctor')
@section('title', 'Profile')
@section('content')
<!-- Page Content -->
<div class="col-md-7 col-lg-8 col-xl-9">
    @if (session()->has('flash'))
    <x-alert>{{ session('flash')['message'] }}</x-alert>
    @endif
    <div class="container">

        <!-- Doctor Widget -->
        <div class="card">
            <div class="card-body">
                <div class="doctor-widget">
                    <div class="doc-info-left">
                        <div class="doctor-img">
                            @if ($doctor->profile_image ?? '')
                            <img src="{{ asset($doctor->profile_image) }}" class="img-fluid" alt="User Image">
                            @else
                            <img src="{{ asset('/assets/img/doctors/doctor-thumb-02.jpg') }}" class="img-fluid" alt="User Image">
                            @endif
                        </div>
                        <div class="doc-info-cont">
                            <h4 class="doc-name">Dr. {{ $doctor?->name ?? '' }}</h4>
                            <p class="doc-speciality">{{ $doctor?->hospital?->hospital_name ?? '' }}</p>
                            @if ($doctor->username ?? '')
                            <p class="doc-speciality">{{ $doctor?->username ?? '' }}</p>
                            @else
                            <p class="doc-speciality">N/A</p>
                            @endif
                            <p class="doc-department"><img src="{{ asset($doctor->speciality->image) }}" class="img-fluid" alt="Speciality">{{ $doctor?->speciality?->name ?? '' }}</p>
                            {{-- {{asset('storage/images/' . $doctor->profile_image)}} --}}
                            <div class="rating">
                                @php
                            $reviews = App\Models\Review::query()->where('doctor_id', $doctor->id)->get();
                                                $review_sum = App\Models\Review::where('doctor_id',  $doctor->id)->sum('star_rated');
                                                    if ($reviews->count() > 0) {
                                                        $review_value = $review_sum / $reviews->count();
                                                    } else {
                                                        $review_value = 0;
                                                    }
                                                @endphp
                                                @php
                                                        $rat_num = number_format($review_value);
                                                    @endphp
                                                    @for ($i = 1; $i <= $rat_num; $i++)
                                                        <i class="fas fa-star filled"></i>
                                                    @endfor
                                                    @for ($j = $rat_num; $j < 5; $j++)
                                                        <i class="fas fa-star"></i>
                                                    @endfor
                                <span class="d-inline-block average-rating">({{ $reviews->count().' reviews' }})</span>
                            </div>
                            <div class="clinic-details">
                                @if ($doctor->address ?? '')
                                <p class="doc-location"><i class="fas fa-map-marker-alt"></i>
                                    {{ $doctor?->address ?? '' }}
                                </p>
                                @else
                                <p class="doc-location"><i class="fas fa-map-marker-alt"></i> N/A</p>
                                @endif
                                {{-- <ul class="clinic-gallery"> --}}
                                {{-- <li> --}}
                                {{-- <a href="{{url('assets/img/features/feature-01.jpg')}}" data-fancybox="gallery"> --}}
                                {{-- <img src="{{ URL::asset('/assets/img/features/feature-01.jpg')}}" alt="Feature"> --}}
                                {{-- </a> --}}
                                {{-- </li> --}}
                                {{-- <li> --}}
                                {{-- <a href="{{url('assets/img/features/feature-02.jpg')}}" data-fancybox="gallery"> --}}
                                {{-- <img  src="{{ URL::asset('/assets/img/features/feature-02.jpg')}}" alt="Feature Image"> --}}
                                {{-- </a> --}}
                                {{-- </li> --}}
                                {{-- <li> --}}
                                {{-- <a href="{{url('assets/img/features/feature-03.jpg')}}" data-fancybox="gallery"> --}}
                                {{-- <img src="{{ URL::asset('/assets/img/features/feature-03.jpg')}}" alt="Feature"> --}}
                                {{-- </a> --}}
                                {{-- </li> --}}
                                {{-- <li> --}}
                                {{-- <a href="{{url('assets/img/features/feature-04.jpg')}}" data-fancybox="gallery"> --}}
                                {{-- <img src="{{ URL::asset('/assets/img/features/feature-04.jpg')}}" alt="Feature"> --}}
                                {{-- </a> --}}
                                {{-- </li> --}}
                                {{-- </ul> --}}
                            </div>
                            <div class="clinic-services">
                                {{-- <span>Dental Fillings</span> --}}
                                {{-- <span>Teeth Whitneing</span> --}}
                            </div>
                        </div>
                    </div>
                    <div class="doc-info-right">
                        <div class="clini-infos">
                            <ul>
                                {{-- <li><i class="far fa-thumbs-up"></i> 99%</li> --}}
                                <li><i class="far fa-comment"></i> {{$reviews->count()}} Feedback</li>
                                @if ($doctor->state ?? '')
                                <li><i class="fas fa-map-marker-alt"></i> {{ $doctor->state->name }}</li>
                                @else
                                <li><i class="fas fa-map-marker-alt"></i> N/A</li>
                                @endif
                                <li><i class="far fa-money-bill-alt"></i> {{ $doctor->pricing==0?'FREE':'SAR '.$doctor->pricing }}</li>
                            </ul>
                        </div>
                        {{-- <div class="doctor-action"> --}}
                        {{-- <a href="javascript:void(0)" class="btn btn-white fav-btn"> --}}
                        {{-- <i class="far fa-bookmark"></i> --}}
                        {{-- </a> --}}
                        {{-- <a href="chat" class="btn btn-white msg-btn"> --}}
                        {{-- <i class="far fa-comment-alt"></i> --}}
                        {{-- </a> --}}
                        {{-- <a href="javascript:void(0)" class="btn btn-white call-btn" data-bs-toggle="modal" data-bs-target="#voice_call"> --}}
                        {{-- <i class="fas fa-phone"></i> --}}
                        {{-- </a> --}}
                        {{-- <a href="javascript:void(0)" class="btn btn-white call-btn" data-bs-toggle="modal" data-bs-target="#video_call"> --}}
                        {{-- <i class="fas fa-video"></i> --}}
                        {{-- </a> --}}
                        {{-- </div> --}}
                        {{-- <div class="clinic-booking"> --}}
                        {{-- <a class="apt-btn" href="{{url('booking')}}">Book Appointment</a> --}}
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- /Doctor Widget -->

        <!-- Doctor Details Tab -->
        <div class="card">
            <div class="card-body pt-0">

              <!-- Doctor Schedule -->
                           
                            
              <div class="col-md-12">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="card-title">Doctor Schedule</h5>
                            </div>
                            <div class="col-auto d-flex">
                                <ul role="tablist" class="nav nav-pills card-header-pills float-end">
                                    <li class="nav-item" role="presentation">
                                        <a href="#regular-avail" data-bs-toggle="tab" class="nav-link active" aria-selected="true" role="tab">Regular Availability</a>
                                    </li>
                                    <!-- <li class="nav-item" role="presentation">
                                        <a href="#onetime-avail" data-bs-toggle="tab" class="nav-link" aria-selected="false" role="tab" tabindex="-1">One-time Availability</a>
                                    </li> -->
                                    <li class="nav-item" role="presentation">
                                        <a href="#unavail" data-bs-toggle="tab" class="nav-link" aria-selected="false" tabindex="-1" role="tab">Unavailability</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="tab-content pt-0">
                            <div role="tabpanel" id="regular-avail" class="tab-pane fade active show">
                                <div class="profile-box">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card schedule-widget mb-0">

                                                <!-- Schedule Header -->
                                                <div class="schedule-header">

                                                    <!-- Schedule Nav -->
                                                    <div class="schedule-nav">
                                                        <ul class="nav nav-tabs nav-justified" role="tablist">
                                                            <li class="nav-item" role="presentation">
                                                                <a class="nav-link" data-bs-toggle="tab" href="#slot_sunday" aria-selected="false" tabindex="-1" role="tab">Sunday</a>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <a class="nav-link active" data-bs-toggle="tab" href="#slot_monday" aria-selected="true" role="tab">Monday</a>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <a class="nav-link" data-bs-toggle="tab" href="#slot_tuesday" aria-selected="false" tabindex="-1" role="tab">Tuesday</a>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <a class="nav-link" data-bs-toggle="tab" href="#slot_wednesday" aria-selected="false" tabindex="-1" role="tab">Wednesday</a>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <a class="nav-link" data-bs-toggle="tab" href="#slot_thursday" aria-selected="false" tabindex="-1" role="tab">Thursday</a>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <a class="nav-link" data-bs-toggle="tab" href="#slot_friday" aria-selected="false" tabindex="-1" role="tab">Friday</a>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <a class="nav-link" data-bs-toggle="tab" href="#slot_saturday" aria-selected="false" tabindex="-1" role="tab">Saturday</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- /Schedule Nav -->

                                                </div>
                                                <!-- /Schedule Header -->

                                                <!-- Schedule Content -->
                                                <div class="tab-content schedule-cont">

                                                    <!-- Sunday Slot -->
                                                    <div id="slot_sunday" class="tab-pane fade" role="tabpanel">
                                                        @php
                                                            $sundaySlots = $doctor->regularAvailabilities->firstWhere('week_day', 'sunday');
                                                        @endphp
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            <span>Time Slots</span>
                                                            <div>
                                                                @if ($sundaySlots)
                                                                <a class="edit-link" href="{{route('doctor.doctor-schedule.regular.edit',['doctor'=> $doctor, 'week_day' => 'sunday'])}}">
                                                                    <i class="fa fa-edit me-1"></i>Edit
                                                                </a>
                                                                <a class="text-danger" href="" onclick="event.preventDefault();document.getElementById('clear_sun').submit();">
                                                                    <i class="fa fa-trash me-1"></i>Clear All
                                                                </a>
                                                                <form action="{{route('doctor.doctor-schedule.regular.destroy',['doctor'=> $doctor, 'week_day' => 'sunday'])}}" id="clear_sun" method="POST">@csrf</form>
                                                                @else
                                                                <a class="edit-link" href="{{route('doctor.doctor-schedule.regular',['doctor'=> $doctor, 'week_day' => 'sunday'])}}">
                                                                    <i class="fa fa-plus-circle"></i> Add Slot
                                                                </a>
                                                                @endif
                                                            </div>
                                                        </h4>
                                                        @if ($sundaySlots)
                                                            <!-- Slot List -->
                                                            <div class="doc-times">
                                                                @foreach ($sundaySlots->slots as $slot)
                                                                <div class="doc-slot-list">
                                                                    {{date("h:i A",strtotime($slot['start_time']))}} - {{date("h:i A",strtotime($slot['end_time']))}}
                                                                    {{-- <a href="javascript:void(0)" class="delete_schedule">
                                                                        <i class="fa fa-times"></i>
                                                                    </a> --}}
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                            <!-- /Slot List -->
                                                        @else
                                                            <p class="text-muted mb-0">Not Available</p>
                                                        @endif
                                                    </div>
                                                    <!-- /Sunday Slot -->

                                                    <!-- Monday Slot -->
                                                    <div id="slot_monday" class="tab-pane fade show active" role="tabpanel">
                                                        @php
                                                            $mondaySlots = $doctor->regularAvailabilities->firstWhere('week_day', 'monday');
                                                        @endphp
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            <span>Time Slots</span>
                                                            <div>
                                                                @if ($mondaySlots)
                                                                <a class="edit-link" href="{{route('doctor.doctor-schedule.regular.edit',['doctor'=> $doctor, 'week_day' => 'monday'])}}">
                                                                    <i class="fa fa-edit me-1"></i>Edit
                                                                </a>
                                                                <a class="text-danger" href="" onclick="event.preventDefault();document.getElementById('clear_mon').submit();">
                                                                    <i class="fa fa-trash me-1"></i>Clear All
                                                                </a>
                                                                <form action="{{route('doctor.doctor-schedule.regular.destroy',['doctor'=> $doctor, 'week_day' => 'monday'])}}" id="clear_mon" method="POST">@csrf</form>
                                                                @else
                                                                <a class="edit-link" href="{{route('doctor.doctor-schedule.regular',['doctor'=> $doctor, 'week_day' => 'monday'])}}">
                                                                    <i class="fa fa-plus-circle"></i> Add Slot
                                                                </a>
                                                                @endif
                                                            </div>
                                                        </h4>

                                                        @if ($mondaySlots)
                                                            <!-- Slot List -->
                                                            <div class="doc-times">
                                                                @foreach ($mondaySlots->slots as $slot)
                                                                <div class="doc-slot-list">
                                                                    {{date("h:i A",strtotime($slot['start_time']))}} - {{date("h:i A",strtotime($slot['end_time']))}}
                                                                    {{-- <a href="javascript:void(0)" class="delete_schedule">
                                                                        <i class="fa fa-times"></i>
                                                                    </a> --}}
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                            <!-- /Slot List -->
                                                        @else
                                                            <p class="text-muted mb-0">Not Available</p>
                                                        @endif

                                                    </div>
                                                    <!-- /Monday Slot -->

                                                    <!-- Tuesday Slot -->
                                                    <div id="slot_tuesday" class="tab-pane fade" role="tabpanel">
                                                        @php
                                                            $tuesdaySlots = $doctor->regularAvailabilities->firstWhere('week_day', 'tuesday');
                                                        @endphp
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            <span>Time Slots</span>
                                                            <div>
                                                                @if ($tuesdaySlots)
                                                                <a class="edit-link" href="{{route('doctor.doctor-schedule.regular.edit',['doctor'=> $doctor, 'week_day' => 'tuesday'])}}">
                                                                    <i class="fa fa-edit me-1"></i>Edit
                                                                </a>
                                                                <a class="text-danger" href="" onclick="event.preventDefault();document.getElementById('clear_tues').submit();">
                                                                    <i class="fa fa-trash me-1"></i>Clear All
                                                                </a>
                                                                <form action="{{route('doctor.doctor-schedule.regular.destroy',['doctor'=> $doctor, 'week_day' => 'tuesday'])}}" id="clear_tues" method="POST">@csrf</form>
                                                                @else
                                                                <a class="edit-link" href="{{route('doctor.doctor-schedule.regular',['doctor'=> $doctor, 'week_day' => 'tuesday'])}}">
                                                                    <i class="fa fa-plus-circle"></i> Add Slot
                                                                </a>
                                                                @endif
                                                            </div>
                                                        </h4>
                                                        @if ($tuesdaySlots)
                                                            <!-- Slot List -->
                                                            <div class="doc-times">
                                                                @foreach ($tuesdaySlots->slots as $slot)
                                                                <div class="doc-slot-list">
                                                                    {{date("h:i A",strtotime($slot['start_time']))}} - {{date("h:i A",strtotime($slot['end_time']))}}
                                                                    {{-- <a href="javascript:void(0)" class="delete_schedule">
                                                                        <i class="fa fa-times"></i>
                                                                    </a> --}}
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                            <!-- /Slot List -->
                                                        @else
                                                            <p class="text-muted mb-0">Not Available</p>
                                                        @endif
                                                    </div>
                                                    <!-- /Tuesday Slot -->

                                                    <!-- Wednesday Slot -->
                                                    <div id="slot_wednesday" class="tab-pane fade" role="tabpanel">
                                                        @php
                                                            $wednesdaySlots = $doctor->regularAvailabilities->firstWhere('week_day', 'wednesday');
                                                        @endphp
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            <span>Time Slots</span>
                                                            <div>
                                                                @if ($wednesdaySlots)
                                                                <a class="edit-link" href="{{route('doctor.doctor-schedule.regular.edit',['doctor'=> $doctor, 'week_day' => 'wednesday'])}}">
                                                                    <i class="fa fa-edit me-1"></i>Edit
                                                                </a>
                                                                <a class="text-danger" href="" onclick="event.preventDefault();document.getElementById('clear_wed').submit();">
                                                                    <i class="fa fa-trash me-1"></i>Clear All
                                                                </a>
                                                                <form action="{{route('doctor.doctor-schedule.regular.destroy',['doctor'=> $doctor, 'week_day' => 'wednesday'])}}" id="clear_wed" method="POST">@csrf</form>
                                                                @else
                                                                <a class="edit-link" href="{{route('doctor.doctor-schedule.regular',['doctor'=> $doctor, 'week_day' => 'wednesday'])}}">
                                                                    <i class="fa fa-plus-circle"></i> Add Slot
                                                                </a>
                                                                @endif
                                                            </div>
                                                        </h4>
                                                        @if ($wednesdaySlots)
                                                            <!-- Slot List -->
                                                            <div class="doc-times">
                                                                @foreach ($wednesdaySlots->slots as $slot)
                                                                <div class="doc-slot-list">
                                                                    {{date("h:i A",strtotime($slot['start_time']))}} - {{date("h:i A",strtotime($slot['end_time']))}}
                                                                    {{-- <a href="javascript:void(0)" class="delete_schedule">
                                                                        <i class="fa fa-times"></i>
                                                                    </a> --}}
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                            <!-- /Slot List -->
                                                        @else
                                                            <p class="text-muted mb-0">Not Available</p>
                                                        @endif
                                                    </div>
                                                    <!-- /Wednesday Slot -->

                                                    <!-- Thursday Slot -->
                                                    <div id="slot_thursday" class="tab-pane fade" role="tabpanel">
                                                        @php
                                                            $thursdaySlots = $doctor->regularAvailabilities->firstWhere('week_day', 'thursday');
                                                        @endphp
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            <span>Time Slots</span>
                                                            <div>
                                                                @if ($thursdaySlots)
                                                                <a class="edit-link" href="{{route('doctor.doctor-schedule.regular.edit',['doctor'=> $doctor, 'week_day' => 'thursday'])}}">
                                                                    <i class="fa fa-edit me-1"></i>Edit
                                                                </a>
                                                                <a class="text-danger" href="" onclick="event.preventDefault();document.getElementById('clear_thurs').submit();">
                                                                    <i class="fa fa-trash me-1"></i>Clear All
                                                                </a>
                                                                <form action="{{route('doctor.doctor-schedule.regular.destroy',['doctor'=> $doctor, 'week_day' => 'thursday'])}}" id="clear_thurs" method="POST">@csrf</form>
                                                                @else
                                                                <a class="edit-link" href="{{route('doctor.doctor-schedule.regular',['doctor'=> $doctor, 'week_day' => 'thursday'])}}">
                                                                    <i class="fa fa-plus-circle"></i> Add Slot
                                                                </a>
                                                                @endif
                                                            </div>
                                                        </h4>
                                                        @if ($thursdaySlots)
                                                            <!-- Slot List -->
                                                            <div class="doc-times">
                                                                @foreach ($thursdaySlots->slots as $slot)
                                                                <div class="doc-slot-list">
                                                                    {{date("h:i A",strtotime($slot['start_time']))}} - {{date("h:i A",strtotime($slot['end_time']))}}
                                                                    {{-- <a href="javascript:void(0)" class="delete_schedule">
                                                                        <i class="fa fa-times"></i>
                                                                    </a> --}}
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                            <!-- /Slot List -->
                                                        @else
                                                            <p class="text-muted mb-0">Not Available</p>
                                                        @endif
                                                    </div>
                                                    <!-- /Thursday Slot -->

                                                    <!-- Friday Slot -->
                                                    <div id="slot_friday" class="tab-pane fade" role="tabpanel">
                                                        @php
                                                            $fridaySlots = $doctor->regularAvailabilities->firstWhere('week_day', 'friday');
                                                        @endphp
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            <span>Time Slots</span>
                                                            <div>
                                                                @if ($fridaySlots)
                                                                <a class="edit-link" href="{{route('doctor.doctor-schedule.regular.edit',['doctor'=> $doctor, 'week_day' => 'friday'])}}">
                                                                    <i class="fa fa-edit me-1"></i>Edit
                                                                </a>
                                                                <a class="text-danger" href="" onclick="event.preventDefault();document.getElementById('clear_fri').submit();">
                                                                    <i class="fa fa-trash me-1"></i>Clear All
                                                                </a>
                                                                <form action="{{route('doctor.doctor-schedule.regular.destroy',['doctor'=> $doctor, 'week_day' => 'friday'])}}" id="clear_fri" method="POST">@csrf</form>
                                                                @else
                                                                <a class="edit-link" href="{{route('doctor.doctor-schedule.regular',['doctor'=> $doctor, 'week_day' => 'friday'])}}">
                                                                    <i class="fa fa-plus-circle"></i> Add Slot
                                                                </a>
                                                                @endif
                                                            </div>
                                                        </h4>
                                                        @if ($fridaySlots)
                                                            <!-- Slot List -->
                                                            <div class="doc-times">
                                                                @foreach ($fridaySlots->slots as $slot)
                                                                <div class="doc-slot-list">
                                                                    {{date("h:i A",strtotime($slot['start_time']))}} - {{date("h:i A",strtotime($slot['end_time']))}}
                                                                    {{-- <a href="javascript:void(0)" class="delete_schedule">
                                                                        <i class="fa fa-times"></i>
                                                                    </a> --}}
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                            <!-- /Slot List -->
                                                        @else
                                                            <p class="text-muted mb-0">Not Available</p>
                                                        @endif
                                                    </div>
                                                    <!-- /Friday Slot -->

                                                    <!-- Saturday Slot -->
                                                    <div id="slot_saturday" class="tab-pane fade" role="tabpanel">
                                                        @php
                                                            $saturdaySlots = $doctor->regularAvailabilities->firstWhere('week_day', 'saturday');
                                                        @endphp
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            <span>Time Slots</span>
                                                            @if ($saturdaySlots)
                                                            <a class="edit-link" href="{{route('doctor.doctor-schedule.regular.edit',['doctor'=> $doctor, 'week_day' => 'saturday'])}}">
                                                                <i class="fa fa-edit me-1"></i>Edit
                                                            </a>
                                                            <a class="text-danger" href="" onclick="event.preventDefault();document.getElementById('clear_sat').submit();">
                                                                <i class="fa fa-trash me-1"></i>Clear All
                                                            </a>
                                                            <form action="{{route('doctor.doctor-schedule.regular.destroy',['doctor'=> $doctor, 'week_day' => 'saturday'])}}" id="clear_sat" method="POST">@csrf</form>
                                                            @else
                                                            <a class="edit-link" href="{{route('doctor.doctor-schedule.regular',['doctor'=> $doctor, 'week_day' => 'saturday'])}}">
                                                                <i class="fa fa-plus-circle"></i> Add Slot
                                                            </a>
                                                            @endif
                                                        </h4>
                                                        @if ($saturdaySlots)
                                                            <!-- Slot List -->
                                                            <div class="doc-times">
                                                                @foreach ($saturdaySlots->slots as $slot)
                                                                <div class="doc-slot-list">
                                                                    {{date("h:i A",strtotime($slot['start_time']))}} - {{date("h:i A",strtotime($slot['end_time']))}}
                                                                    {{-- <a href="javascript:void(0)" class="delete_schedule">
                                                                        <i class="fa fa-times"></i>
                                                                    </a> --}}
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                            <!-- /Slot List -->
                                                        @else
                                                            <p class="text-muted mb-0">Not Available</p>
                                                        @endif
                                                    </div>
                                                    <!-- /Saturday Slot -->

                                                </div>
                                                <!-- /Schedule Content -->

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" id="onetime-avail" class="tab-pane fade">
                                <div class="card">
                                    <div class="card-header border-bottom-0">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h5 class="card-title"></h5>
                                            </div>
                                            @php
                                                        $items = $doctor->oneTimeailabilities->sortBy("date")->values();
                                                    @endphp
                                            <div class="col-auto d-flex">
                                                <a class="edit-link" href="{{route('doctor.doctor-schedule.onetime',['doctor'=> $doctor])}}">
                                                    <i class="fa fa-plus-circle"></i> Add Availability
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-borderless hover-table">
                                                <thead class="thead-light">
                                                    <tr>
                                                       <th>SR.</th>
                                                       <th>Date</th>
                                                       <th>Time Interval</th>
                                                       <th>Slots</th>
                                                       <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   
                                                    @foreach ($items as $key => $item)
                                                        <tr>
                                                            <td>{{$key+1}}</td>
                                                            <td>{{date("d-m-Y", strtotime($item->date))}}</td>
                                                            <td>{{$item->time_interval}}</td>
                                                            <td class="doc-times">
                                                                @foreach ($item->slots as $slot)
                                                                <div class="doc-slot-list">
                                                                    <small>{{date("h:i A",strtotime($slot['start_time']))}} - {{date("h:i A",strtotime($slot['end_time']))}}</small>
                                                                </div>
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                <a class="text-black" href="{{route('doctor.doctor-schedule.onetime.edit',['doctor'=> $doctor, $item->date])}}">
                                                                    <i class="feather-edit-3 me-1"></i> Edit
                                                                </a>
                                                                <a class="text-danger" href="" onclick="event.preventDefault();document.getElementById('delet_form_{{$key}}').submit();">
                                                                    <i class="feather-trash-2 me-1"></i> Delete
                                                                </a>
                                                                <form class="d-inline" action="{{route('doctor.doctor-schedule.onetime.delete',['doctor'=> $doctor, $item->date])}}" method="post" id="delet_form_{{$key}}">@csrf</form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" id="unavail" class="tab-pane fade">
                                <div class="card">
                                    <div class="card-header border-bottom-0">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h5 class="card-title"></h5>
                                            </div>
                                            @php
                                                        $items = $doctor->unavailailities->sortBy("date")->values();
                                                    @endphp
                                            <div class="col-auto d-flex">
                                                <a class="edit-link" href="{{route('doctor.doctor-schedule.unavailability',['doctor'=> $doctor])}}">
                                                    <i class="fa fa-plus-circle"></i> Add Unavailability
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-borderless hover-table">
                                                <thead class="thead-light">
                                                    <tr>
                                                       <th>SR.</th>
                                                       <th>Date</th>
                                                       <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   
                                                    @foreach ($items as $key => $item)
                                                        <tr>
                                                            <td>{{$key+1}}</td>
                                                            <td>{{date("d-m-Y", strtotime($item->date))}}</td>
                                                            <td>
                                                                <a class="text-black" href="{{route('doctor.doctor-schedule.unavailability.edit',['doctor'=> $doctor, $item->date])}}">
                                                                    <i class="feather-edit-3 me-1"></i> Edit
                                                                </a>
                                                                <a class="text-danger" href="" onclick="event.preventDefault();document.getElementById('delet_form_un{{$key}}').submit();">
                                                                    <i class="feather-trash-2 me-1"></i> Delete
                                                                </a>
                                                                <form class="d-inline" action="{{route('doctor.doctor-schedule.unavailability.delete',['doctor'=> $doctor, $item->date])}}" method="post" id="delet_form_un{{$key}}">@csrf</form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <!-- Tab Menu -->
                <nav class="user-tabs mb-4">
                    <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ url('#doc_overview') }}" data-bs-toggle="tab">Overview</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('#doc_clinic') }}" data-bs-toggle="tab">Clinic
                                Details</a>
                        </li>
                        {{-- <li class="nav-item"> --}}
                        {{-- <a class="nav-link" href="{{url('#doc_reviews')}}" data-bs-toggle="tab">Reviews</a> --}}
                        {{-- </li> --}}
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="{{ url('#doc_schedule') }}" data-bs-toggle="tab">Schedule</a>
                        </li> -->
                    </ul>
                </nav>
                <!-- /Tab Menu -->

                <!-- Tab Content -->
                <div class="tab-content pt-0">

                    <!-- Overview Content -->
                    <div role="tabpanel" id="doc_overview" class="tab-pane fade show active">
                        <div class="row">
                            <div class="col-md-12 col-lg-9">

                                <!-- About Details -->
                                <div class="widget about-widget">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="widget-title">About Me</h4>
                                        <div class="clini-infos">
                                            <a href="{{ route('profile.edit', $doctor) }}" class="edit-pro"><i class="feather-edit"></i> Edit</a>
                                        </div>
                                    </div>
                                    @if ($doctor->description ?? '')
                                    <p>{{ $doctor->description }}</p>
                                    @else
                                    <p>N/A</p>
                                    @endif
                                </div>
                                <!-- /About Details -->

                                <!-- Education Details -->
                                <div class="widget education-widget">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="widget-title">Education</h4>
                                        <div class="clini-infos">

                                            <form action="{{ route('education.create') }}" method="GET">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ $doctor->id }}">
                                                <button type="submit" class="edit-pro"><i class="fas fa-plus"></i>
                                                    Add</button>
                                            </form>
                                            {{-- <a href="{{ route('education.create') }}" class="edit-pro"><i class="fas fa-plus"></i> Add</a> --}}
                                        </div>
                                    </div>
                                    <div class="experience-box">
                                        <ul class="experience-list">
                                            @forelse($edu_details as $edu)
                                            <li>
                                                <div class="experience-user">
                                                    <div class="before-circle"></div>
                                                </div>
                                                <div class="experience-content">
                                                    <div class="timeline-content">
                                                        <a href="{{ route('education.edit', $edu->id) }}" class="name">{{ $edu->college_name }}</a>
                                                        <div>{{ $edu->area }}</div>
                                                        <div>
                                                            <span class="time">{{ date('Y', strtotime($edu->start_date)) }}
                                                                @if ($edu->end_date ?? '')
                                                                - {{ date('Y', strtotime($edu->end_date)) }}
                                                                @else
                                                                -Present
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            @empty
                                            <li>
                                                <div class="experience-user">
                                                    <div class="before-circle"></div>
                                                </div>
                                                <div class="experience-content">
                                                    <div class="timeline-content">
                                                        <a href="#" class="name">No Education Added.</a>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                                <!-- /Education Details -->

                                <!-- Experience Details -->
                                <div class="widget experience-widget">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="widget-title">Work & Experience</h4>
                                        <div class="clini-infos">
                                            {{-- <a href="{{ route('experience.create') }}" class="edit-pro"><i class="fas fa-plus"></i> Add</a> --}}

                                            <form action="{{ route('experience.create') }}" method="GET">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ $doctor->id }}">
                                                <button type="submit" class="edit-pro"><i class="fas fa-plus"></i>
                                                    Add</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="experience-box">
                                        <ul class="experience-list">
                                            @forelse($experiences as $experience)
                                            <li>
                                                <div class="experience-user">
                                                    <div class="before-circle"></div>
                                                </div>
                                                <div class="experience-content">
                                                    <div class="timeline-content">
                                                        <a href="{{ route('experience.edit', $experience) }}">{{ $experience->experience_title }}</a>
                                                        <h6 class="name">{{ $experience->company_name }}</h6>
                                                        <span class="time">{{ date('Y', strtotime($experience->start_date)) }}
                                                            @if ($experience->end_date ?? '')
                                                            - {{ date('Y', strtotime($experience->end_date)) }}
                                                            @else
                                                            -Present
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                            @empty
                                            <li>
                                                <div class="experience-user">
                                                    <div class="before-circle"></div>
                                                </div>
                                                <div class="experience-content">
                                                    <div class="timeline-content">
                                                        <a href="#/" class="name">No Experience Added</a>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                                <!-- /Experience Details -->

                                <!-- Services List -->
                                <div class="service-list">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="widget-title">Services</h4>
                                        <div class="clini-infos">
                                            <form action="{{ route('doctor_services') }}" method="GET">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ $doctor->id }}">
                                                <button type="submit" class="edit-pro"><i class="fas fa-plus"></i>
                                                    Add or Update</button>
                                            </form>
                                        </div>
                                    </div>
                                    <ul class="clearfix">
                                        @forelse($doctor->services as $service)
                                        <li>{{ $service->service_title }}</li>
                                        @empty
                                        <li>No services. Add upto six Services</li>
                                        @endforelse
                                    </ul>
                                </div>
                                <!-- /Services List -->

                                <!-- Specializations List -->
                                <div class="service-list">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="widget-title">Specializations</h4>
                                        <div class="clini-infos">
                                            {{-- <a href="{{ route('doctor_specialization') }}" class="edit-pro"><i class="fas fa-plus"></i> Add or Update</a> --}}
                                            <form action="{{ route('doctor_specialization') }}" method="GET">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ $doctor->id }}">
                                                <button type="submit" class="edit-pro"><i class="fas fa-plus"></i>
                                                    Add or Update</button>
                                            </form>
                                        </div>
                                    </div>
                                    <ul class="clearfix">
                                        @forelse($doctor->specializations as $specialization)
                                        <li>{{ $specialization->specialization_title }}</li>
                                        @empty
                                        <li>No Specialization. Add upto six specialization</li>
                                        @endforelse
                                    </ul>
                                </div>
                                <!-- /Specializations List -->

                            </div>
                        </div>
                    </div>
                    <!-- /Overview Content -->

                    <!-- Clinic Content -->
                    <div role="tabpanel" id="doc_clinic" class="tab-pane fade">
                        <div class="d-flex justify-content-between">
                            <h4 class="widget-title">Clinic Details</h4>
                            <div class="clini-infos">
                                {{-- <a href="{{ route('doctor_clinic') }}" class="edit-pro"><i class="feather-edit"></i>
                                Add Clinic</a> --}}

                                <form action="{{ route('doctor_clinic') }}" method="GET">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $doctor->id }}">
                                    <button type="submit" class="edit-pro"><i class="fas fa-plus"></i>
                                        Add Clinic</button>
                                </form>
                            </div>
                        </div>
                        <!-- Location List -->
                        @forelse($doctor->clinics as $clinic)
                        <div class="location-list">
                            <div class="row">
                                <!-- Clinic Content -->
                                <div class="col-md-6">
                                    <div class="clinic-content">
                                        <h4 class="clinic-name"><a href="#">{{ $clinic->clinic_title }}</a>
                                        </h4>
                                        <p class="doc-speciality">{{ $doctor->speciality->name }}</p>
                                        {{-- <div class="rating"> --}}
                                        {{-- <i class="fas fa-star filled"></i> --}}
                                        {{-- <i class="fas fa-star filled"></i> --}}
                                        {{-- <i class="fas fa-star filled"></i> --}}
                                        {{-- <i class="fas fa-star filled"></i> --}}
                                        {{-- <i class="fas fa-star"></i> --}}
                                        {{-- <span class="d-inline-block average-rating">(4)</span> --}}
                                        {{-- </div> --}}

                                        <div class="clinic-details mb-0">
                                            <h5 class="clinic-direction"><i class="fas fa-map-marker-alt"></i>
                                                {{ $clinic->clinic_location }}
                                                {{-- <br> --}}
                                                {{-- <a href="javascript:void(0);">Get Directions</a> --}}
                                            </h5>
                                            <ul>
                                                {{-- <li>
                                                            <a href="{{ url('assets/img/features/feature-01.jpg') }}"
                                                data-fancybox="gallery2">
                                                <img src="{{ URL::asset('/assets/img/features/feature-01.jpg') }}" alt="Feature Image">
                                                </a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('assets/img/features/feature-02.jpg') }}" data-fancybox="gallery2">
                                                        <img src="{{ URL::asset('/assets/img/features/feature-02.jpg') }}" alt="Feature Image">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('assets/img/features/feature-03.jpg') }}" data-fancybox="gallery2">
                                                        <img src="{{ URL::asset('/assets/img/features/feature-03.jpg') }}" alt="Feature Image">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('assets/img/features/feature-04.jpg') }}" data-fancybox="gallery2">
                                                        <img src="{{ URL::asset('/assets/img/features/feature-04.jpg') }}" alt="Feature Image">
                                                    </a>
                                                </li> --}}
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                                <!-- /Clinic Content -->

                                <!-- Clinic Timing -->
                                <div class="col-md-4">
                                    <div class="clinic-timing">
                                        <div>
                                            <p class="timings-days">
                                                <span> Mon - Sat </span>
                                            </p>
                                            <p class="timings-times">
                                                <span>{{ $clinic->clinic_start_time }} -
                                                    {{ $clinic->clinic_end_time }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Clinic Timing -->

                                <div class="col-md-2">
                                    <div class="consult-price">
                                        $ {{ $clinic->clinic_fee }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="location-list">
                            <div class="row">
                                <!-- Clinic Content -->
                                <div class="col-md-6">
                                    <div class="clinic-content">
                                        <h4 class="clinic-name">No Record Found</h4>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforelse
                    <!-- /Clinic List -->
                    {{-- <!-- Reviews Content --> --}}
                    {{-- <div role="tabpanel" id="doc_reviews" class="tab-pane fade"> --}}

                    {{-- <!-- Review Listing --> --}}
                    {{-- <div class="widget review-listing"> --}}
                    {{-- <ul class="comments-list"> --}}

                    {{-- <!-- Comment List --> --}}
                    {{-- <li> --}}
                    {{-- <div class="comment"> --}}
                    {{-- <img class="avatar avatar-sm rounded-circle" alt="User Image" --}}
                    {{-- src="{{ URL::asset('/assets/img/patients/patient.jpg')}}"> --}}
                    {{-- <div class="comment-body"> --}}
                    {{-- <div class="meta-data"> --}}
                    {{-- <span class="comment-author">Richard Wilson</span> --}}
                    {{-- <span class="comment-date">Reviewed 2 Days ago</span> --}}
                    {{-- <div class="review-count rating"> --}}
                    {{-- <i class="fas fa-star filled"></i> --}}
                    {{-- <i class="fas fa-star filled"></i> --}}
                    {{-- <i class="fas fa-star filled"></i> --}}
                    {{-- <i class="fas fa-star filled"></i> --}}
                    {{-- <i class="fas fa-star"></i> --}}
                    {{-- </div> --}}
                    {{-- </div> --}}
                    {{-- <p class="recommended"><i class="far fa-thumbs-up"></i> I recommend the --}}
                    {{-- doctor</p> --}}
                    {{-- <p class="comment-content"> --}}
                    {{-- Lorem ipsum dolor sit amet, consectetur adipisicing elit, --}}
                    {{-- sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. --}}
                    {{-- Ut enim ad minim veniam, quis nostrud exercitation. --}}
                    {{-- Curabitur non nulla sit amet nisl tempus --}}
                    {{-- </p> --}}
                    {{-- <div class="comment-reply"> --}}
                    {{-- <a class="comment-btn" href="#"> --}}
                    {{-- <i class="fas fa-reply"></i> Reply --}}
                    {{-- </a> --}}
                    {{-- <p class="recommend-btn"> --}}
                    {{-- <span>Recommend?</span> --}}
                    {{-- <a href="#" class="like-btn"> --}}
                    {{-- <i class="far fa-thumbs-up"></i> Yes --}}
                    {{-- </a> --}}
                    {{-- <a href="#" class="dislike-btn"> --}}
                    {{-- <i class="far fa-thumbs-down"></i> No --}}
                    {{-- </a> --}}
                    {{-- </p> --}}
                    {{-- </div> --}}
                    {{-- </div> --}}
                    {{-- </div> --}}

                    {{-- <!-- Comment Reply --> --}}
                    {{-- <ul class="comments-reply"> --}}
                    {{-- <li> --}}
                    {{-- <div class="comment"> --}}
                    {{-- <img class="avatar avatar-sm rounded-circle" alt="User Image" --}}
                    {{-- src="{{ URL::asset('/assets/img/patients/patient1.jpg')}}"> --}}
                    {{-- <div class="comment-body"> --}}
                    {{-- <div class="meta-data"> --}}
                    {{-- <span class="comment-author">Charlene Reed</span> --}}
                    {{-- <span class="comment-date">Reviewed 3 Days ago</span> --}}
                    {{-- <div class="review-count rating"> --}}
                    {{-- <i class="fas fa-star filled"></i> --}}
                    {{-- <i class="fas fa-star filled"></i> --}}
                    {{-- <i class="fas fa-star filled"></i> --}}
                    {{-- <i class="fas fa-star filled"></i> --}}
                    {{-- <i class="fas fa-star"></i> --}}
                    {{-- </div> --}}
                    {{-- </div> --}}
                    {{-- <p class="comment-content"> --}}
                    {{-- Lorem ipsum dolor sit amet, consectetur adipisicing elit, --}}
                    {{-- sed do eiusmod tempor incididunt ut labore et dolore magna --}}
                    {{-- aliqua. --}}
                    {{-- Ut enim ad minim veniam. --}}
                    {{-- Curabitur non nulla sit amet nisl tempus --}}
                    {{-- </p> --}}
                    {{-- <div class="comment-reply"> --}}
                    {{-- <a class="comment-btn" href="#"> --}}
                    {{-- <i class="fas fa-reply"></i> Reply --}}
                    {{-- </a> --}}
                    {{-- <p class="recommend-btn"> --}}
                    {{-- <span>Recommend?</span> --}}
                    {{-- <a href="#" class="like-btn"> --}}
                    {{-- <i class="far fa-thumbs-up"></i> Yes --}}
                    {{-- </a> --}}
                    {{-- <a href="#" class="dislike-btn"> --}}
                    {{-- <i class="far fa-thumbs-down"></i> No --}}
                    {{-- </a> --}}
                    {{-- </p> --}}
                    {{-- </div> --}}
                    {{-- </div> --}}
                    {{-- </div> --}}
                    {{-- </li> --}}
                    {{-- </ul> --}}
                    {{-- <!-- /Comment Reply --> --}}

                    {{-- </li> --}}
                    {{-- <!-- /Comment List --> --}}

                    {{-- <!-- Comment List --> --}}
                    {{-- <li> --}}
                    {{-- <div class="comment"> --}}
                    {{-- <img class="avatar avatar-sm rounded-circle" alt="User Image" --}}
                    {{-- src="{{ URL::asset('/assets/img/patients/patient2.jpg')}}"> --}}
                    {{-- <div class="comment-body"> --}}
                    {{-- <div class="meta-data"> --}}
                    {{-- <span class="comment-author">Travis Trimble</span> --}}
                    {{-- <span class="comment-date">Reviewed 4 Days ago</span> --}}
                    {{-- <div class="review-count rating"> --}}
                    {{-- <i class="fas fa-star filled"></i> --}}
                    {{-- <i class="fas fa-star filled"></i> --}}
                    {{-- <i class="fas fa-star filled"></i> --}}
                    {{-- <i class="fas fa-star filled"></i> --}}
                    {{-- <i class="fas fa-star"></i> --}}
                    {{-- </div> --}}
                    {{-- </div> --}}
                    {{-- <p class="comment-content"> --}}
                    {{-- Lorem ipsum dolor sit amet, consectetur adipisicing elit, --}}
                    {{-- sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. --}}
                    {{-- Ut enim ad minim veniam, quis nostrud exercitation. --}}
                    {{-- Curabitur non nulla sit amet nisl tempus --}}
                    {{-- </p> --}}
                    {{-- <div class="comment-reply"> --}}
                    {{-- <a class="comment-btn" href="#"> --}}
                    {{-- <i class="fas fa-reply"></i> Reply --}}
                    {{-- </a> --}}
                    {{-- <p class="recommend-btn"> --}}
                    {{-- <span>Recommend?</span> --}}
                    {{-- <a href="#" class="like-btn"> --}}
                    {{-- <i class="far fa-thumbs-up"></i> Yes --}}
                    {{-- </a> --}}
                    {{-- <a href="#" class="dislike-btn"> --}}
                    {{-- <i class="far fa-thumbs-down"></i> No --}}
                    {{-- </a> --}}
                    {{-- </p> --}}
                    {{-- </div> --}}
                    {{-- </div> --}}
                    {{-- </div> --}}
                    {{-- </li> --}}
                    {{-- <!-- /Comment List --> --}}

                    {{-- </ul> --}}

                    {{-- <!-- Show All --> --}}
                    {{-- <div class="all-feedback text-center"> --}}
                    {{-- <a href="#" class="btn btn-primary btn-sm"> --}}
                    {{-- Show all feedback <strong>(167)</strong> --}}
                    {{-- </a> --}}
                    {{-- </div> --}}
                    {{-- <!-- /Show All --> --}}

                    {{-- </div> --}}
                    {{-- <!-- /Review Listing --> --}}

                    {{-- <!-- Write Review --> --}}
                    {{-- <div class="write-review"> --}}
                    {{-- <h4>Write a review for <strong>Dr. Darren Elder</strong></h4> --}}

                    {{-- <!-- Write Review Form --> --}}
                    {{-- <form> --}}
                    {{-- <div class="form-group"> --}}
                    {{-- <label>Review</label> --}}
                    {{-- <div class="star-rating"> --}}
                    {{-- <input id="star-5" type="radio" name="rating" value="star-5"> --}}
                    {{-- <label for="star-5" title="5 stars"> --}}
                    {{-- <i class="active fa fa-star"></i> --}}
                    {{-- </label> --}}
                    {{-- <input id="star-4" type="radio" name="rating" value="star-4"> --}}
                    {{-- <label for="star-4" title="4 stars"> --}}
                    {{-- <i class="active fa fa-star"></i> --}}
                    {{-- </label> --}}
                    {{-- <input id="star-3" type="radio" name="rating" value="star-3"> --}}
                    {{-- <label for="star-3" title="3 stars"> --}}
                    {{-- <i class="active fa fa-star"></i> --}}
                    {{-- </label> --}}
                    {{-- <input id="star-2" type="radio" name="rating" value="star-2"> --}}
                    {{-- <label for="star-2" title="2 stars"> --}}
                    {{-- <i class="active fa fa-star"></i> --}}
                    {{-- </label> --}}
                    {{-- <input id="star-1" type="radio" name="rating" value="star-1"> --}}
                    {{-- <label for="star-1" title="1 star"> --}}
                    {{-- <i class="active fa fa-star"></i> --}}
                    {{-- </label> --}}
                    {{-- </div> --}}
                    {{-- </div> --}}
                    {{-- <div class="form-group"> --}}
                    {{-- <label>Title of your review</label> --}}
                    {{-- <input class="form-control" type="text" placeholder="If you could say it in one sentence, what would you say?"> --}}
                    {{-- </div> --}}
                    {{-- <div class="form-group"> --}}
                    {{-- <label>Your review</label> --}}
                    {{-- <textarea id="review_desc" maxlength="100" class="form-control"></textarea> --}}

                    {{-- <div class="d-flex justify-content-between mt-3"><small class="text-muted"><span id="chars">100</span> characters remaining</small></div> --}}
                    {{-- </div> --}}
                    {{-- <hr> --}}
                    {{-- <div class="form-group"> --}}
                    {{-- <div class="terms-accept"> --}}
                    {{-- <div class="custom-checkbox"> --}}
                    {{-- <input type="checkbox" id="terms_accept"> --}}
                    {{-- <label for="terms_accept">I have read and accept <a href="#">Terms &amp; Conditions</a></label> --}}
                    {{-- </div> --}}
                    {{-- </div> --}}
                    {{-- </div> --}}
                    {{-- <div class="submit-section"> --}}
                    {{-- <button type="submit" class="btn btn-primary submit-btn">Add Review</button> --}}
                    {{-- </div> --}}
                    {{-- </form> --}}
                    {{-- <!-- /Write Review Form --> --}}

                    {{-- </div> --}}
                    {{-- <!-- /Write Review --> --}}

                    {{-- </div> --}}
                    {{-- <!-- /Reviews Content --> --}}

                    <!-- Business Hours Content -->

                    <div role="tabpanel" id="doc_schedule" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-6 offset-md-3">

                                {{-- @dd($doctor->schedules) --}}
                                <!-- Business Hours Widget -->
                                <div class="widget business-widget">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="widget-title">Schedule</h4>
                                        <div class="clini-infos">
                                            <a href="{{ route('schedule.create') }}" class="edit-pro"><i class="fas fa-plus"></i> Add or Update</a>
                                        </div>
                                    </div>
                                    <div class="widget-content">
                                        <div class="listing-hours">
                                            @for ($i = 0; $i <= 6; $i++) <div class="listing-day">
                                                <div class="day">{{ \App\Commons::Days[$i] }}</div>
                                                <div class="time-items">

                                                    @if ($doctor->schedules[$i]->from ?? '')
                                                    <span class="open-status"><span class="badge bg-success-light">Open</span></span>
                                                    <span class="time">{{ date('g:i a', strtotime($doctor->schedules[$i]->from)) }}
                                                        -
                                                        {{ date('g:i a', strtotime($doctor->schedules[$i]->to)) }}</span>
                                                    @else
                                                    <span class="time"><span class="badge bg-danger-light">Closed</span></span>
                                                    @endif
                                                </div>
                                        </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <!-- /Business Hours Widget -->

                        </div>
                    </div>
                    
                </div>
                <!-- /Business Hours Content -->

            </div>
        </div>
    </div>
    <!-- /Doctor Details Tab -->

</div>
</div>
</div>

</div>

</div>
<!-- /Page Content -->
</div>

@endsection