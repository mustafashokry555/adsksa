<?php $page = 'index-13'; ?>
@extends('web.layout.layout')
@section('title', 'Doctor Profile')
@section('main-content')
    <style>
        /* General Page Styling */
        .doctor-profile {
            background-color: #f8f9fa;
            padding: 60px 0;
        }

        .doctor-widget {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
            padding: 30px;
        }

        .doctor-img img {
            border-radius: 20px;
            width: 180px;
            height: 180px;
            object-fit: cover;
            border: 3px solid #e6e6e6;
        }

        .doc-info-cont h4 {
            font-weight: 700;
            color: #222;
        }

        .doc-info-cont p {
            color: #777;
        }

        .rating i.filled {
            color: #fbbc04;
        }

        .clinic-booking .apt-btn {
            border-radius: 30px;
            padding: 10px 30px;
            font-weight: 600;
        }

        /* Tabs */
        .nav-tabs {
            border: none;
            margin-top: 30px;
            justify-content: center;
        }

        .nav-tabs .nav-link {
            border: none;
            background: #f2f2f2;
            color: #333;
            border-radius: 50px;
            margin: 0 5px;
            padding: 10px 25px;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .nav-tabs .nav-link.active {
            background: #007bff;
            color: #fff;
            box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3);
        }

        /* Tab Content */
        .tab-content {
            background: #fff;
            border-radius: 20px;
            padding: 40px;
            margin-top: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .tab-content .widget {
            background: #fff;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 25px;
            border: 1px solid #eee;
        }

        .widget-title {
            font-size: 20px;
            font-weight: 600;
            color: #007bff;
            margin-bottom: 15px;
        }

        .experience-list li {
            margin-bottom: 20px;
            position: relative;
            padding-left: 25px;
        }

        .experience-list .before-circle {
            width: 10px;
            height: 10px;
            background: #007bff;
            border-radius: 50%;
            position: absolute;
            left: 0;
            top: 7px;
        }

        .service-list ul {
            padding: 0;
            list-style: none;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .service-list ul li {
            background: #f8f9ff;
            border-radius: 30px;
            padding: 8px 15px;
            font-size: 14px;
            color: #007bff;
            border: 1px solid #e2e8ff;
            transition: all 0.3s;
        }

        .service-list ul li:hover {
            background: #007bff;
            color: #fff;
        }

        /* Reviews */
        .review-listing ul {
            list-style: none;
            padding: 0;
        }

        .review-listing li {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #eee;
        }

        .comment-author {
            font-weight: 600;
            color: #222;
        }

        .comment-content {
            color: #666;
            margin-top: 5px;
        }

        /* Business Hours */
        .listing-hours .listing-day {
            background: #f8f9ff;
            border-radius: 10px;
            padding: 12px 20px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .badge {
            font-size: 12px;
            border-radius: 10px;
            padding: 5px 10px;
        }

        .service-list ul{
            gap: 3px !important;
        }

        /* Responsive */
        @media (max-width: 767px) {
            .doctor-widget {
                text-align: center;
            }

            .doctor-img img {
                margin: 0 auto 15px;
            }

            .nav-tabs .nav-link {
                font-size: 14px;
                padding: 8px 16px;
            }

            .tab-content {
                padding: 20px;
            }
        }
    </style>
    <section class="doctor-profile">
        <div class="content">
            <div class="container">

                <!-- Doctor Widget -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="doctor-widget d-flex flex-wrap">
                            <div class="doc-info-left me-4 mb-4">
                                <div class="doctor-img mb-3">
                                    @if (!empty($doctor?->profile_image))
                                        <img src="{{ asset($doctor->profile_image) }}" class="img-fluid" alt="Doctor Image">
                                    @else
                                        <img src="{{ URL::asset('/assets/img/doctors/doctor-thumb-02.jpg') }}"
                                            class="img-fluid" alt="Doctor Image">
                                    @endif
                                </div>
                                <div class="doc-info-cont">
                                    <h4 class="doc-name">{{ $doctor?->name ?? '' }}</h4>
                                    @if (!empty($doctor?->username))
                                        <p class="doc-speciality">{{ $doctor->username }}</p>
                                    @else
                                        <h5>{{ $doctor?->hospital?->hospital_name }}</h5>
                                        <p class="doc-speciality">N/A</p>
                                    @endif

                                    @if (!empty($doctor?->speciality?->name))
                                        <p class="doc-department">
                                            <img src="{{ $doctor->speciality->image }}" class="img-fluid" alt="Spec Image">
                                            {{ $doctor->speciality->name }}
                                        </p>
                                    @else
                                        <p class="doc-speciality">Department</p>
                                    @endif

                                    <div class="rating mb-2">
                                        @php $rat_num = number_format($review_value); @endphp
                                        @for ($i = 1; $i <= $rat_num; $i++)
                                            <i class="fas fa-star filled"></i>
                                        @endfor
                                        @for ($j = $rat_num; $j < 5; $j++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                        <span class="average-rating">{{ $reviews->count() }}</span>
                                    </div>

                                    <div class="clinic-details">
                                        <p class="doc-location"><i class="fas fa-map-marker-alt"></i>
                                            {{ $doctor?->address ?? '' }},
                                            {{ $doctor->country?->name ?? '' }},
                                            {{ $doctor->state?->name ?? '' }},
                                            {{ $doctor->city?->name ?? '' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="doc-info-right flex-grow-1">
                                <div class="clini-infos mb-3">
                                    <ul class="list-unstyled">
                                        <li><i class="far fa-comment"></i> {{ $reviews->count() }} Feedback</li>
                                        @if (!empty($doctor?->address))
                                            <li><i class="fas fa-map-marker-alt"></i>
                                                {{ $doctor->address }},
                                                {{ $doctor->country?->name ?? '' }},
                                                {{ $doctor->state?->name ?? '' }},
                                                {{ $doctor->city?->name ?? '' }}
                                            </li>
                                        @endif
                                        @if (!empty($doctor?->pricing))
                                            <li><i class="far fa-money-bill-alt"></i> {{ $doctor->pricing }}</li>
                                        @endif
                                    </ul>
                                </div>

                                <div class="doctor-action mb-3">
                                    <a href="#voice_call" class="btn btn-white msg-btn me-2">
                                        <i class="far fa-comment-alt"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-white call-btn me-2" data-bs-toggle="modal"
                                        data-bs-target="#voice_call">
                                        <i class="fas fa-phone"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-white call-btn" data-bs-toggle="modal"
                                        data-bs-target="#video_call">
                                        <i class="fas fa-video"></i>
                                    </a>
                                </div>

                                <div class="clinic-booking" >
                                    <a class="apt-btn btn btn-primary" style="background-position: 0 0;"
                                        href="{{ route('create_appointment', $doctor->id) }}">
                                        {{ __('web.make_appoint') }}
                                    </a>
                                </div>
                            </div>
                        </div>

                        @if ($errors->any())
                            <div class="mt-3 alert alert-danger">
                                <ul class="mb-0">
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
                            <div class="mt-3 alert alert-warning alert-dismissible" role="alert">
                                <strong>Warning!</strong> {{ session('error') }}
                            </div>
                        @endif
                    </div>
                </div>
                <!-- /Doctor Widget -->

                <!-- Doctor Details / Tabs -->
                <style>
                    .tab-content .tab-pane.active {
                        opacity: 1 !important;
                    }
                </style>
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Nav Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bottom nav-justified" id="doctorTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="overview-tab" data-bs-toggle="tab"
                                    data-bs-target="#doc_overview" type="button" role="tab"
                                    aria-controls="doc_overview" aria-selected="true">
                                    {{ __('web.Overview') }}
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#doc_reviews"
                                    type="button" role="tab" aria-controls="doc_reviews" aria-selected="false">
                                    {{ __('web.Reviews') }}
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="hours-tab" data-bs-toggle="tab"
                                    data-bs-target="#doc_business_hours" type="button" role="tab"
                                    aria-controls="doc_business_hours" aria-selected="false">
                                    {{ __('web.work_Hours') }}
                                </button>
                            </li>
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content pt-3" id="doctorTabContent">
                            <!-- Overview -->
                            <div class="tab-pane fade show active" id="doc_overview" role="tabpanel"
                                aria-labelledby="overview-tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="widget about-widget mb-4">
                                            <h4 class="widget-title">{{ __('web.about_me') }}</h4>
                                            <p>{{ $doctor?->description }}</p>
                                        </div>

                                        <div class="widget education-widget mb-4">
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
                                                                    <h4 class="name">{{ $edu?->college_name }}</h4>
                                                                    <div>{{ $edu->area }}</div>
                                                                    <span class="time">
                                                                        {{ date('Y', strtotime($edu->start_date)) }}
                                                                        @if ($edu->end_date)
                                                                            - {{ date('Y', strtotime($edu->end_date)) }}
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

                                        <div class="widget experience-widget mb-4">
                                            <h4 class="widget-title">{{ __('web.Work_Experience') }}</h4>
                                            <div class="experience-box">
                                                <ul class="experience-list">
                                                    @forelse($doctor?->experiences as $exp)
                                                        <li>
                                                            <div class="experience-user">
                                                                <div class="before-circle"></div>
                                                            </div>
                                                            <div class="experience-content">
                                                                <div class="timeline-content">
                                                                    <h4 class="name">{{ $exp?->experience_title }}</h4>
                                                                    <h5 class="name">{{ $exp?->company_name }}</h5>
                                                                    <span class="time">
                                                                        {{-- You may want to show real years --}}
                                                                        {{ $exp?->start_date ?? '' }} -
                                                                        {{ $exp?->end_date ?? 'Present' }}
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

                                        <div class="service-list mb-4">
                                            <h4>{{ __('web.Services') }}</h4>
                                            <ul class="clearfix">
                                                @forelse($doctor?->services as $service)
                                                    <li>{{ $service?->service_title }}</li>
                                                @empty
                                                    <li>{{ __('web.No_Record_Found') }}</li>
                                                @endforelse
                                            </ul>
                                        </div>

                                        <div class="service-list mb-4">
                                            <h4>{{ __('web.Specializations') }}</h4>
                                            <ul class="clearfix">
                                                @forelse($doctor?->specializations as $spec)
                                                    <li>{{ $spec?->specialization_title }}</li>
                                                @empty
                                                    <li>{{ __('web.No_Record_Found') }}</li>
                                                @endforelse
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Reviews -->
                            <div class="tab-pane fade" id="doc_reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                <div class="widget review-listing mb-4">
                                    <ul class="comments-list">
                                        @forelse($reviews as $review)
                                            @php
                                                $patient = \App\Models\User::find($review->user_id);
                                            @endphp
                                            <li>
                                                <div class="comment d-flex align-items-start">
                                                    <div class="me-3">
                                                        @if (!empty($patient?->profile_image))
                                                            <img class="avatar avatar-sm rounded-circle"
                                                                src="{{ asset($patient->profile_image) }}"
                                                                alt="User Image">
                                                        @else
                                                            <img class="avatar avatar-sm rounded-circle"
                                                                src="{{ URL::asset('/assets/img/patients/patients.jfif') }}"
                                                                alt="User Image">
                                                        @endif
                                                    </div>
                                                    <div class="comment-body flex-grow-1">
                                                        <div class="meta-data mb-1">
                                                            <span class="comment-author">{{ $patient?->name }}</span>
                                                            <span class="comment-date">Reviewed
                                                                {{ $review->created_at->diffForHumans() }}</span>
                                                        </div>
                                                        <div class="review-count rating mb-1">
                                                            @for ($i = 1; $i <= $review->star_rated; $i++)
                                                                <i class="fas fa-star filled"></i>
                                                            @endfor
                                                            @for ($j = $review->star_rated; $j < 5; $j++)
                                                                <i class="fas fa-star"></i>
                                                            @endfor
                                                        </div>
                                                        <p class="recommended"><i class="far fa-thumbs-up"></i>
                                                            {{ $review->review_title }}</p>
                                                        <p class="comment-content">{{ $review->review_body }}</p>
                                                    </div>
                                                </div>
                                            </li>
                                        @empty
                                            <li>No reviews found.</li>
                                        @endforelse
                                    </ul>
                                </div>

                                <div class="write-review">
                                    <h4>{{ __('web.Write_review') }} <strong>{{ __('web.Dr') }}.
                                            {{ $doctor->name }}</strong></h4>
                                    <form method="POST" action="{{ route('add_review') }}">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                        <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                                        <input type="hidden" name="hospital_id" value="{{ $doctor->hospital_id }}">
                                        <div class="mb-3">
                                            <label>{{ __('web.Review') }}</label>
                                            <div class="star-rating">
                                                <input id="star-5" type="radio" name="star_rated" value="5">
                                                <label for="star-5" title="5 stars"><i class="fa fa-star"></i></label>
                                                <input id="star-4" type="radio" name="star_rated" value="4">
                                                <label for="star-4" title="4 stars"><i class="fa fa-star"></i></label>
                                                <input id="star-3" type="radio" name="star_rated" value="3">
                                                <label for="star-3" title="3 stars"><i class="fa fa-star"></i></label>
                                                <input id="star-2" type="radio" name="star_rated" value="2">
                                                <label for="star-2" title="2 stars"><i class="fa fa-star"></i></label>
                                                <input id="star-1" type="radio" name="star_rated" value="1">
                                                <label for="star-1" title="1 star"><i class="fa fa-star"></i></label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label>{{ __('web.Title_review') }}</label>
                                            <input type="text" class="form-control" name="review_title"
                                                placeholder="{{ __('web.one_sentence') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label>{{ __('web.Your_review') }}</label>
                                            <textarea id="review_desc" maxlength="100" name="review_body" class="form-control"></textarea>
                                            <div class="d-flex justify-content-between mt-2">
                                                <small class="text-muted"><span id="chars">100</span> characters
                                                    remaining</small>
                                            </div>
                                        </div>
                                        <div class="d-grid">
                                            <button type="submit"
                                                class="btn btn-primary">{{ __('web.Add_Review') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Business Hours -->
                            <div class="tab-pane fade" id="doc_business_hours" role="tabpanel"
                                aria-labelledby="hours-tab">
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="widget business-widget">
                                            <div class="widget-content">
                                                <div class="listing-hours">
                                                    <div class="listing-day current mb-3">
                                                        <div class="day">{{ __('web.Today') }}
                                                            <span>{{ \Carbon\Carbon::now()->locale(app()->getLocale())->translatedFormat('j M Y') }}</span>
                                                        </div>
                                                        <div class="time-items">
                                                            @if ($todaysAvailability)
                                                                <span class="open-status">
                                                                    <span
                                                                        class="badge bg-success-light">{{ __('web.Open_Now') }}</span>
                                                                </span>
                                                                <span class="time badge badge-warning">
                                                                    {{ \Carbon\Carbon::parse($todaysAvailability->slots[0]['start_time'])->format('h:i A') }}
                                                                    -
                                                                    {{ \Carbon\Carbon::parse($todaysAvailability->slots[0]['end_time'])->format('h:i A') }}
                                                                </span>
                                                            @else
                                                                <span class="open-status">
                                                                    <span
                                                                        class="badge bg-danger-light">{{ __('web.Closed') }}</span>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    @for ($i = 0; $i <= 6; $i++)
                                                        <div class="listing-day mb-2">
                                                            <div class="day">{{ __(\App\Commons::Days[$i]) }}</div>
                                                            <div class="time-items">
                                                                @php $open = false; @endphp
                                                                @foreach ($regularAvailability as $availability)
                                                                    @if ($availability->week_day === strtolower(\App\Commons::Days[$i]))
                                                                        @php $open = true; @endphp
                                                                        <span class="open-status">
                                                                            <span
                                                                                class="badge bg-success-light">{{ __('web.Open') }}</span>
                                                                        </span>
                                                                        <span class="time badge badge-warning">
                                                                            {{ \Carbon\Carbon::parse($availability->slots[0]['start_time'])->format('h:i A') }}
                                                                            -
                                                                            {{ \Carbon\Carbon::parse($availability->slots[0]['end_time'])->format('h:i A') }}
                                                                        </span>
                                                                        @if (!empty($availability->slots[1]))
                                                                            <span class="time badge badge-warning">
                                                                                {{ \Carbon\Carbon::parse($availability->slots[1]['start_time'])->format('h:i A') }}
                                                                                -
                                                                                {{ \Carbon\Carbon::parse($availability->slots[1]['end_time'])->format('h:i A') }}
                                                                            </span>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                                @if (!$open)
                                                                    <span class="open-status">
                                                                        <span
                                                                            class="badge bg-danger-light">{{ __('web.Closed') }}</span>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endfor

                                                </div> <!-- listing-hours -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- business hours -->
                        </div> <!-- tab-content -->
                    </div> <!-- card-body -->
                </div> <!-- card -->
            </div> <!-- container -->
        </div> <!-- content -->
    </section>

@endsection
