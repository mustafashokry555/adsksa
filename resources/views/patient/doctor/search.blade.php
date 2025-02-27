<?php $page = 'index-13'; ?>
@extends('layout.mainlayout_index1')
@section('title', 'Search Doctor')
@section('content')
    <!-- Header -->
    @include('components.patient_header')
    <!-- /Header -->

    <div class="row align-items-center mt-4">

    </div>
    </div>
    </section>
    <!-- /Home Banner -->
    <section class="doctor-search">
        <!-- Page Content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-lg-4 col-xl-3 theiaStickySidebar">
                        <!-- Search Filter -->
                        <div class="card search-filter">
                            <div class="card-header">
                                <h4 class="card-title mb-0">{{ __('web.search_filter') }}</h4>
                            </div>
                            <div class="card-body">
                                {{--                                <div class="filter-widget"> --}}
                                {{--                                    <div class=""> --}}
                                {{--                                        <input type="date" class="form-control " --}}
                                {{--                                               placeholder="Select Date"> --}}
                                {{--                                    </div> --}}
                                {{--                                </div> --}}
                                <form method="get" action="">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" name="search" class="form-control"
                                                value="{{ request('search') }}" placeholder="{{ __('web.search') }}">
                                        </div>
                                    </div>
                                    <div class="filter-widget">
                                        <h4>{{ __('web.Gender') }}</h4>
                                        <div>
                                            <label class="custom_check">
                                                <input type="checkbox" name="gender[]" value="M"
                                                    @if (is_array(request('gender')) && in_array('M', request('gender'))) checked @endif>
                                                <span class="checkmark"></span> {{ __('web.Male') }}
                                            </label>
                                        </div>
                                        <div>
                                            <label class="custom_check">
                                                <input type="checkbox" name="gender[]" value="F"
                                                    @if (is_array(request('gender')) && in_array('F', request('gender'))) checked @endif>
                                                <span class="checkmark"></span> {{ __('web.female') }}
                                            </label>
                                        </div>
                                        {{-- <div>
                                            <label class="custom_check">
                                                <input type="checkbox" name="gender[]" value="O"
                                                    @if (is_array(request('gender')) && in_array('O', request('gender'))) checked @endif>
                                                    <span class="checkmark"></span> {{ __("web.other") }}
                                                </label>
                                        </div> --}}
                                    </div>
                                    <div class="filter-widget">
                                        <h4>{{ __('web.Select_Specialist') }}</h4>
                                        @forelse($specialities as $speciality)
                                            <div>
                                                <label class="custom_check">
                                                    <input type="checkbox" name="speciality[]" value="{{ $speciality->id }}"
                                                        @if (is_array(request('speciality')) && in_array($speciality->id, request('speciality'))) checked @endif>
                                                    <span class="checkmark"></span> {{ $speciality->name }}
                                                </label>
                                            </div>
                                        @empty
                                            <div>
                                                <label class="custom_check">
                                                    <input type="checkbox" name="select_specialist" checked>
                                                    <span class="checkmark"></span> No Specaility Found
                                                </label>
                                            </div>
                                        @endforelse
                                    </div>
                                    <div class="btn-search">
                                        <button type="submit" class="btn w-100 w-100">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /Search Filter -->

                    </div>

                    <div class="col-md-12 col-lg-8 col-xl-9">

                        @forelse($doctors as $doctor)
                            <!-- Doctor Widget -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="doctor-widget">
                                        <div class="doc-info-left">
                                            <div class="doctor-img">
                                                <a href="{{ route('doctor_profile', $doctor->id) }}">
                                                    <img src="{{ asset($doctor->profile_image) }}" class="img-fluid"
                                                        alt="User Image">
                                                </a>
                                            </div>
                                            <div class="doc-info-cont">
                                                <h4 class="doc-name"><a
                                                        href="{{ route('doctor_profile', $doctor->id) }}">Dr.
                                                        {{ $doctor->name }}</a>
                                                </h4>
                                                <h5>{{ $doctor?->hospital?->hospital_name }}</h5>
                                                @if ($doctor->speciality->name ?? '')
                                                    <!-- <p class="doc-speciality">{{ $doctor->speciality->name }}</p> -->
                                                    <h5 class="doc-department"><img
                                                            src="{{ asset($doctor->speciality->image) }}" class="img-fluid"
                                                            alt="Speciality">{{ $doctor->speciality->name }}</h5>
                                                @else
                                                    <p class="doc-speciality">Speciality</p>
                                                @endif

                                                @php
                                                    $reviews = App\Models\Review::query()
                                                        ->where('doctor_id', $doctor->id)
                                                        ->get();
                                                    $review_sum = App\Models\Review::where(
                                                        'doctor_id',
                                                        $doctor->id,
                                                    )->sum('star_rated');
                                                    if ($reviews->count() > 0) {
                                                        $review_value = $review_sum / $reviews->count();
                                                    } else {
                                                        $review_value = 0;
                                                    }
                                                @endphp

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
                                                    <span
                                                        class="d-inline-block average-rating">{{ $reviews->count() }}</span>
                                                </div>
                                                <div class="clinic-details">
                                                    @if ($doctor->address)
                                                        <p class="doc-location"><i class="fas fa-map-marker-alt"></i>
                                                            {{ $doctor->address }}
                                                            ,
                                                            {{ $doctor->state }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="doc-info-right">
                                            <div class="clini-infos">
                                                <ul>
                                                    <!-- <li><i class="far fa-thumbs-up"></i> 98%</li> -->
                                                    <li><i class="far fa-comment"></i>{{ $reviews->count() ?? 0 }}
                                                        {{ __('web.Feedback') }}
                                                    </li>
                                                    @if ($doctor->address)
                                                        <li>
                                                            <i class="fas fa-map-marker-alt"></i> {{ $doctor->address }}
                                                            ,
                                                            {{ $doctor->state }}
                                                        </li>
                                                    @endif
                                                    @if ($doctor->pricing)
                                                        <li><i class="far fa-money-bill-alt"></i>
                                                            {{ $doctor->pricing == 'Free' ? 'Free' : 'SAR ' . $doctor->pricing }}
                                                            <i class="fas fa-info-circle" data-bs-toggle="tooltip"
                                                                title="Lorem Ipsum"></i>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="doc-info-right">
                                            <div class="clinic-booking">
                                                <a class="view-pro-btn" href="{{ route('doctor_profile', $doctor->id) }}">
                                                    {{ __('web.doc_profile') }}
                                                </a>
                                                <a class="view-pro-btn"
                                                    href="{{ route('hospital_profile', $doctor->hospital_id) }}">
                                                    {{ __('web.hospital_profile') }}
                                                </a>
                                                <a class="apt-btn" href="{{ route('create_appointment', $doctor->id) }}">
                                                    {{ __('web.book_appoint') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Doctor Widget -->
                        @empty
                            <div>
                                <h4>No Doctor Found</h4>
                            </div>
                        @endforelse
                        {{ $doctors->appends($queryParams)->links() }}

                        {{--                        <div class="load-more text-center"> --}}
                        {{--                            <a class="btn btn-primary btn-sm" href="javascript:void(0);">Load More</a> --}}
                        {{--                        </div> --}}
                    </div>
                </div>

            </div>

        </div>
        <!-- /Page Content -->
    </section>
    <!-- /Page Content -->

@endsection
