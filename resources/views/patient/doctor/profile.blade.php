<?php $page = 'index-13'; ?>
@extends('layout.mainlayout_index1')
@section('title', 'Doctor Profile')
@section('content')
    <!-- Header -->
    @include('components.patient_header')
    <!-- /Header -->

    <div class="row align-items-center mt-4">

    </div>
    </div>
    </section>
    <!-- /Home Banner -->
    <section class="doctor-profile">
        <!-- Page Content -->
        <div class="content">
            <div class="container">

                <!-- Doctor Widget -->
                <div class="card">
                    <div class="card-body">
                        <div class="doctor-widget">
                            <div class="doc-info-left">
                                <div class="doctor-img">
                                    @if ($doctor?->profile_image ?? '')
                                        <img src="{{ asset($doctor->profile_image) }}" class="img-fluid" alt="User Image">
                                    @else
                                        <img src="{{ URL::asset('/assets/img/doctors/doctor-thumb-02.jpg') }}"
                                            class="img-fluid" alt="User Image">
                                    @endif
                                </div>
                                <div class="doc-info-cont">
                                    <h4 class="doc-name">{{ $doctor?->name ?? '' }}</h4>
                                    @if ($doctor?->username ?? '')
                                        <p class="doc-speciality">{{ $doctor?->username ?? '' }}</p>
                                    @else
                                        <h5>{{ $doctor?->hospital?->hospital_name }}</h5>
                                        <p class="doc-speciality">N/A</p>
                                    @endif
                                    @if ($doctor?->speciality?->name ?? '')
                                        {{-- <p class="doc-speciality">{{ $doctor->speciality->name }}</p> --}}
                                        <p class="doc-department"><img src="{{ $doctor->speciality->image }}"
                                                class="img-fluid" alt="Speciality">{{ $doctor?->speciality?->name ?? '' }}
                                        </p>
                                    @else
                                        <p class="doc-speciality">Department</p>
                                    @endif
                                    <div class="rating">
                                        @php
                                            $rat_num = number_format($review_value);
                                        @endphp
                                        @for ($i = 1; $i <= $rat_num; $i++)
                                            <i class="fas fa-star filled"></i>
                                        @endfor
                                        @for ($j = $rat_num; $j < 5; $j++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                        <span class="d-inline-block average-rating">{{ $reviews->count() }}</span>
                                    </div>
                                    <div class="clinic-details">
                                        <p class="doc-location"><i class="fas fa-map-marker-alt"></i>
                                            {{ $doctor?->address ?? '' }}
                                            ,
                                            {{ $doctor?->state ?? '' }}
                                            {{-- - <a href="javascript:void(0);">Get Directions</a> --}}
                                        </p>
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
                                    <!-- <div class="clinic-services">
                                                @forelse($doctor?->services as $service)
    <span>{{ $service?->service_title ?? '' }}</span>
                                        @empty
                                                    <span>No Record Found</span>
    @endforelse
                                            </div> -->
                                </div>
                            </div>
                            <div class="doc-info-right">
                                <div class="clini-infos">
                                    <ul>
                                        <!-- <li><i class="far fa-thumbs-up"></i> 99%</li> -->
                                        <li><i class="far fa-comment"></i> {{ $reviews->count() }} Feedback</li>
                                        @if ($doctor?->address)
                                            <li>
                                                <i class="fas fa-map-marker-alt"></i>{{ $doctor?->address ?? '' }}
                                                ,
                                                {{ $doctor?->state ?? '' }}
                                            </li>
                                        @endif
                                        @if ($doctor?->pricing)
                                            <li><i class="far fa-money-bill-alt"></i> SAR {{ $doctor?->pricing ?? '' }}
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="doctor-action">
                                    <!-- <a href="javascript:void(0)" class="btn btn-white fav-btn"> -->
                                    <!-- <i class="far fa-bookmark"></i> -->
                                    <!-- </a> -->
                                    <a href="chat" class="btn btn-white msg-btn">
                                        <i class="far fa-comment-alt"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-white call-btn" data-bs-toggle="modal"
                                        data-bs-target="#voice_call">
                                        <i class="fas fa-phone"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-white call-btn" data-bs-toggle="modal"
                                        data-bs-target="#video_call">
                                        <i class="fas fa-video"></i>
                                    </a>
                                </div>
                                <div class="clinic-booking">
                                    <a class="apt-btn" href="{{ route('create_appointment', $doctor->id) }}">
                                        {{ __('web.make_appoint') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        @if ($errors->any())
                            <br>
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session()->has('flash'))
                            <x-alert>{{ session('flash')['message'] }}</x-alert>
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-warning alert-dismissible" role="alert">

                                <strong>Warning !</strong> {{ session('error') }}
                            </div>
                        @endif
                    </div>
                </div>
                <!-- /Doctor Widget -->

                <!-- Doctor Details Tab -->
                <div class="card">
                    <div class="card-body pt-0">

                        <!-- Tab Menu -->
                        <nav class="user-tabs mb-4">
                            <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{ url('#doc_overview') }}"
                                        data-bs-toggle="tab">{{ __('web.Overview') }}</a>
                                </li>
                                <!-- <li class="nav-item">
                                            <a class="nav-link" href="{{ url('#doc_locations') }}"
                                                data-bs-toggle="tab">Locations</a>
                                        </li> -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('#doc_reviews') }}"
                                        data-bs-toggle="tab">{{ __('web.Reviews') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('#doc_business_hours') }}" data-bs-toggle="tab">
                                        {{ __('web.work_Hours') }}
                                    </a>
                                </li>
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
                                            <h4 class="widget-title">{{ __('web.about_me') }}</h4>
                                            <p>{{ $doctor?->description }}</p>
                                        </div>
                                        <!-- /About Details -->

                                        <!-- Education Details -->
                                        <div class="widget education-widget">
                                            <h4 class="widget-title">{{ __('web.Education') }}</h4>
                                            <div class="experience-box">
                                                <ul class="experience-list">
                                                    @forelse($doctor?->education as $edu)
                                                        <li>
                                                            <div class="experience-user">
                                                                <div class="before-circle"></div>
                                                            </div>
                                                            <div class="experience-content">
                                                                <div class="timeline-content">
                                                                    <h4 class="name">{{ $edu?->college_name ?? '' }}</h4>
                                                                    <div>{{ $edu->area }}</div>
                                                                    <span
                                                                        class="time">{{ date('Y', strtotime($edu?->start_date)) }}
                                                                        @if ($edu->end_date ?? '')
                                                                            - {{ date('Y', strtotime($edu?->end_date)) }}
                                                                        @else
                                                                            - Present
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
                                                                    <h4 class="name">{{ __('web.No_Record_Found') }}
                                                                    </h4>
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
                                            <h4 class="widget-title">{{ __('web.Work_Experience') }}</h4>
                                            <div class="experience-box">
                                                <ul class="experience-list">
                                                    @forelse($doctor?->experiences as $experience)
                                                        <li>
                                                            <div class="experience-user">
                                                                <div class="before-circle"></div>
                                                            </div>
                                                            <div class="experience-content">
                                                                <div class="timeline-content">
                                                                    <h4 class="name">
                                                                        {{ $experience?->experience_title ?? '' }}
                                                                    </h4>
                                                                    <h5 class="name">
                                                                        {{ $experience?->company_name ?? '' }}
                                                                    </h5>
                                                                    <span class="time">2010 - Present (5 years)</span>
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
                                                                    <h4 class="name">{{ __('web.No_Record_Found') }}
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- /Experience Details -->

                                        <!-- Awards Details -->
                                        {{-- <div class="widget awards-widget"> --}}
                                        {{-- <h4 class="widget-title">Awards</h4> --}}
                                        {{-- <div class="experience-box"> --}}
                                        {{-- <ul class="experience-list"> --}}
                                        {{-- <li> --}}
                                        {{-- <div class="experience-user"> --}}
                                        {{-- <div class="before-circle"></div> --}}
                                        {{-- </div> --}}
                                        {{-- <div class="experience-content"> --}}
                                        {{-- <div class="timeline-content"> --}}
                                        {{-- <p class="exp-year">July 2019</p> --}}
                                        {{-- <h4 class="exp-title">Humanitarian Award</h4> --}}
                                        {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. --}}
                                        {{-- Proin a ipsum tellus. Interdum et malesuada fames ac --}}
                                        {{-- ante ipsum primis in faucibus.</p> --}}
                                        {{-- </div> --}}
                                        {{-- </div> --}}
                                        {{-- </li> --}}
                                        {{-- <li> --}}
                                        {{-- <div class="experience-user"> --}}
                                        {{-- <div class="before-circle"></div> --}}
                                        {{-- </div> --}}
                                        {{-- <div class="experience-content"> --}}
                                        {{-- <div class="timeline-content"> --}}
                                        {{-- <p class="exp-year">March 2011</p> --}}
                                        {{-- <h4 class="exp-title">Certificate for International --}}
                                        {{-- Volunteer Service</h4> --}}
                                        {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. --}}
                                        {{-- Proin a ipsum tellus. Interdum et malesuada fames ac --}}
                                        {{-- ante ipsum primis in faucibus.</p> --}}
                                        {{-- </div> --}}
                                        {{-- </div> --}}
                                        {{-- </li> --}}
                                        {{-- <li> --}}
                                        {{-- <div class="experience-user"> --}}
                                        {{-- <div class="before-circle"></div> --}}
                                        {{-- </div> --}}
                                        {{-- <div class="experience-content"> --}}
                                        {{-- <div class="timeline-content"> --}}
                                        {{-- <p class="exp-year">May 2008</p> --}}
                                        {{-- <h4 class="exp-title">The Dental Professional of The Year --}}
                                        {{-- Award</h4> --}}
                                        {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. --}}
                                        {{-- Proin a ipsum tellus. Interdum et malesuada fames ac --}}
                                        {{-- ante ipsum primis in faucibus.</p> --}}
                                        {{-- </div> --}}
                                        {{-- </div> --}}
                                        {{-- </li> --}}
                                        {{-- </ul> --}}
                                        {{-- </div> --}}
                                        {{-- </div> --}}
                                        <!-- /Awards Details -->

                                        <!-- Services List -->
                                        <div class="service-list">
                                            <h4>{{ __('web.Services') }}</h4>
                                            <ul class="clearfix">
                                                @forelse($doctor?->services as $service)
                                                    <li>{{ $service?->service_title ?? '' }}</li>
                                                @empty
                                                    <li>{{ __('web.No_Record_Found') }}</li>
                                                @endforelse
                                            </ul>
                                        </div>
                                        <!-- /Services List -->

                                        <!-- Specializations List -->
                                        <div class="service-list">
                                            <h4>{{ __('web.Specializations') }}</h4>
                                            <ul class="clearfix">
                                                @forelse($doctor?->specializations as $specialization)
                                                    <li>{{ $specialization?->specialization_title ?? '' }}</li>
                                                @empty
                                                    <li>{{ __('web.No_Record_Found') }}</li>
                                                @endforelse
                                            </ul>
                                        </div>
                                        <!-- /Specializations List -->

                                    </div>
                                </div>
                            </div>
                            <!-- /Overview Content -->

                            <!-- Locations Content -->

                            <!-- /Locations Content -->

                            <!-- Reviews Content -->
                            <div role="tabpanel" id="doc_reviews" class="tab-pane fade">

                                <!-- Review Listing -->
                                <div class="widget review-listing">
                                    <ul class="comments-list">

                                        <!-- Comment List -->
                                        @forelse($reviews as $review)
                                            @php
                                                $patient = \App\Models\User::query()
                                                    ->where('id', $review->user_id)
                                                    ->first();
                                            @endphp
                                            <li>
                                                <div class="comment">
                                                    @if ($patient->profile_image ?? '')
                                                        <img class="avatar avatar-sm rounded-circle" alt="User Image"
                                                            src="{{ asset($patient->profile_image) }}">
                                                    @else
                                                        <img class="avatar avatar-sm rounded-circle" alt="User Image"
                                                            src="{{ URL::asset('/assets/img/patients/patients.jfif') }}">
                                                    @endif
                                                    <div class="comment-body">
                                                        <div class="meta-data">
                                                            <span class="comment-author">{{ $patient->name ?? "" }}</span>
                                                            <span class="comment-date">Reviewed
                                                                {{ $review->created_at->diffForHumans() }}</span>
                                                            <div class="review-count rating">
                                                                @php
                                                                    $rat_num = number_format($review_value);
                                                                @endphp
                                                                @for ($i = 1; $i <= $review->star_rated; $i++)
                                                                    <i class="fas fa-star filled"></i>
                                                                @endfor
                                                                @for ($j = $review->star_rated; $j < 5; $j++)
                                                                    <i class="fas fa-star"></i>
                                                                @endfor
                                                            </div>
                                                        </div>
                                                        <p class="recommended"><i class="far fa-thumbs-up"></i>
                                                            {{ $review->review_title }}</p>
                                                        <p class="comment-content">
                                                            {{ $review->review_body }}
                                                        </p>
                                                    </div>
                                                </div>

                                                <!-- Comment Reply -->

                                                <!-- /Comment Reply -->
                                            </li>
                                        @empty
                                        @endforelse
                                        <!-- /Comment List -->

                                    </ul>
                                    <hr>

                                    <!-- Show All -->
                                    <!-- <div class="all-feedback text-center">
                                                                           <a href="#" class="btn btn-primary btn-sm">
                                                                               Show all feedback <strong>(167)</strong>
                                                                          </a>
                                                                      </div> -->
                                    <!-- /Show All -->

                                </div>
                                <!-- /Review Listing -->

                                <!-- Write Review -->
                                <div class="write-review">
                                    <h4>{{ __('web.Write_review') }} <strong>{{ __('web.Dr') }}.
                                            {{ $doctor->name }}</strong></h4>

                                    <!-- Write Review Form -->
                                    <form method="POST" action="{{ route('add_review') }}">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                        <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                                        <input type="hidden" name="hospital_id" value="{{ $doctor->hospital_id }}">
                                        <div class="form-group">
                                            <label>{{ __('web.Review') }}</label>
                                            <div class="star-rating">
                                                <input id="star-5" type="radio" name="star_rated" value="5">
                                                <label for="star-5" title="5 stars">
                                                    <i class="active fa fa-star"></i>
                                                </label>
                                                <input id="star-4" type="radio" name="star_rated" value="4">
                                                <label for="star-4" title="4 stars">
                                                    <i class="active fa fa-star"></i>
                                                </label>
                                                <input id="star-3" type="radio" name="star_rated" value="3">
                                                <label for="star-3" title="3 stars">
                                                    <i class="active fa fa-star"></i>
                                                </label>
                                                <input id="star-2" type="radio" name="star_rated" value="2">
                                                <label for="star-2" title="2 stars">
                                                    <i class="active fa fa-star"></i>
                                                </label>
                                                <input id="star-1" type="radio" name="star_rated" value="1">
                                                <label for="star-1" title="1 star">
                                                    <i class="active fa fa-star"></i>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>{{ __('web.Title_review') }}</label>
                                            <input class="form-control" type="text" name="review_title"
                                                placeholder="{{ __('web.one_sentence') }}">
                                        </div>
                                        <div class="form-group">
                                            <label>{{ __('web.Your_review') }}</label>
                                            <textarea id="review_desc" maxlength="100" name="review_body" class="form-control"></textarea>

                                            <div class="d-flex justify-content-between mt-3"><small
                                                    class="text-muted"><span id="chars">100</span> characters
                                                    remaining</small></div>
                                        </div>
                                        <div class="submit-section">
                                            <button type="submit"
                                                class="btn btn-primary submit-btn">{{ __('web.Add_Review') }}
                                            </button>
                                        </div>
                                    </form>
                                    <!-- /Write Review Form -->

                                </div>
                                <!-- /Write Review -->


                                <!-- /Reviews Content -->

                                <!-- Business Hours Content -->

                            </div>
                            <!-- /Business Hours Content -->
                            <div role="tabpanel" id="doc_business_hours" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-md-6 offset-md-3">
                                        @php
                                            use Carbon\Carbon;
                                        @endphp
                                        <!-- Business Hours Widget -->
                                        <div class="widget business-widget">
                                            <div class="widget-content">
                                                <div class="listing-hours">
                                                    <div class="listing-day current">
                                                        <div class="day">{{ __('web.Today') }}
                                                            <span>{{ \Carbon\Carbon::now()->locale(app()->getLocale())->translatedFormat('j M Y') }}</span>
                                                        </div>
                                                        <div class="time-items">
                                                            @if ($todaysAvailability)
                                                                <span class="open-status"><span
                                                                        class="badge bg-success-light">
                                                                        {{ __('web.Open_Now') }}
                                                                    </span>
                                                                </span>
                                                                <span
                                                                    class="time badge badge-warning">{{ @Carbon::parse(@$todaysAvailability->slots[0]['start_time'])->format('h:i A') }}
                                                                    -
                                                                    {{ @Carbon::parse(@$todaysAvailability->slots[0]['end_time'])->format('h:i A') }}</span>
                                                            @else
                                                                <span class="open-status"><span
                                                                        class="badge bg-danger-light">{{ __('web.Closed') }}</span></span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    @for ($i = 0; $i <= 6; $i++)
                                                        <div class="listing-day">
                                                            {{-- <div class="day">{{ \App\Commons::Days[$i] }}</div> --}}
                                                            <div class="day">{{ __(\App\Commons::Days[$i]) }}</div>
                                                            {{-- <div class="day">{{ __('web.days')[$i] }}</div> --}}
                                                            <div class="time-items">
                                                                @php
                                                                    $open = false; // Initialize a variable to track if it's open
                                                                @endphp

                                                                @forelse ($regularAvailability as $availability)
                                                                    @if ($availability->week_day == strtolower(\App\Commons::Days[$i]))
                                                                        @php
                                                                            $open = true; // Set open to true if an open availability is found
                                                                        @endphp
                                                                        <span class="open-status"><span
                                                                                class="badge bg-success-light">{{ __('web.Open') }}</span></span>
                                                                        <span
                                                                            class="time badge badge-warning">{{ @Carbon::parse(@$availability->slots[0]['start_time'])->format('h:i A') }}
                                                                            -
                                                                            {{ @Carbon::parse(@$availability->slots[0]['end_time'])->format('h:i A') }}</span>
                                                                        @if (@$availability->slots[1])
                                                                            <span
                                                                                class="time badge badge-warning">{{ @Carbon::parse(@$availability->slots[1]['start_time'])->format('h:i A') }}
                                                                                -
                                                                                {{ @Carbon::parse(@$availability->slots[1]['end_time'])->format('h:i A') }}
                                                                        @endif
                                                                        </span>
                                                                    @endif
                                                                @empty
                                                                    @php
                                                                        $open = false; // No availability found, set open to false
                                                                    @endphp
                                                                @endforelse

                                                                @if (!$open)
                                                                    <!-- Check the open status after the loop -->
                                                                    <span class="open-status"><span
                                                                            class="badge bg-danger-light">{{ __('web.Closed') }}</span></span>
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
                        </div>
                    </div>
                    <!-- /Doctor Details Tab -->

                </div>
            </div>
            <!-- /Page Content -->
    </section>
    <!-- /Page Content -->

@endsection
