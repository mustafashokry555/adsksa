<?php $page = "doctor-dashboard"; ?>
@extends('layout.mainlayout_doctor')
@section('title', 'Reviews')
@section('content')
    <!-- Page Content -->
    <div class="col-md-7 col-lg-8 col-xl-9">
        @if(session()->has('flash'))
            <x-alert>{{ session('flash')['message'] }}</x-alert>
        @endif
        <div class="container">
            <div class="doc-review review-listing">

                <ul class="comments-list">

                    @forelse($reviews as $review)
                        @php
                            $patient = \App\Models\User::query()->where('id', $review->user_id)->first();
                        @endphp
                    <li>
                        <div class="comment">
                            @if($patient->profile_image ?? '')
                            <img class="avatar rounded-circle" alt="User Image" src="{{ asset($patient->profile_image) }}">
                            @else
                            <img class="avatar rounded-circle" alt="User Image" src="assets/img/patients/patient.jpg">
                            @endif
                            <div class="comment-body">
                                <div class="meta-data">
                                    <span class="comment-author">{{ $patient->name }}</span>
                                    <span class="comment-date">Reviewed {{ $review->created_at->diffForHumans() }}</span>
                                    <div class="review-count rating">
                                        @for($i = 1; $i<= $review->star_rated; $i++)
                                        <i class="fas fa-star filled"></i>
                                        @endfor
                                        @for($j = $review->star_rated; $j<5; $j++)
                                        <i class="fas fa-star"></i>
                                            @endfor
                                    </div>
                                </div>
                                <p class="recommended"><i class="far fa-thumbs-up"></i>{{ $review->review_title }}</p>
                                <p class="comment-content">
                                    {{ $review->review_body }}
                                </p>
{{--                                <div class="comment-reply">--}}
{{--                                    <a class="comment-btn" href="#">--}}
{{--                                        <i class="fas fa-reply"></i> Reply--}}
{{--                                    </a>--}}
{{--                                    <p class="recommend-btn">--}}
{{--                                        <span>Recommend?</span>--}}
{{--                                        <a href="#" class="like-btn">--}}
{{--                                            <i class="far fa-thumbs-up"></i> Yes--}}
{{--                                        </a>--}}
{{--                                        <a href="#" class="dislike-btn">--}}
{{--                                            <i class="far fa-thumbs-down"></i> No--}}
{{--                                        </a>--}}
{{--                                    </p>--}}
{{--                                </div>--}}
                            </div>
                        </div>

{{--                        <ul class="comments-reply">--}}

{{--                            <li>--}}
{{--                                <div class="comment">--}}
{{--                                    <img class="avatar rounded-circle" alt="User Image" src="assets/img/doctors/doctor-thumb-02.jpg">--}}
{{--                                    <div class="comment-body">--}}
{{--                                        <div class="meta-data">--}}
{{--                                            <span class="comment-author">Dr. Darren Elder</span>--}}
{{--                                            <span class="comment-date">Reviewed 3 Days ago</span>--}}
{{--                                        </div>--}}
{{--                                        <p class="comment-content">--}}
{{--                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit,--}}
{{--                                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.--}}
{{--                                            Ut enim ad minim veniam.--}}
{{--                                            Curabitur non nulla sit amet nisl tempus--}}
{{--                                        </p>--}}
{{--                                        <div class="comment-reply">--}}
{{--                                            <a class="comment-btn" href="#">--}}
{{--                                                <i class="fas fa-reply"></i> Reply--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </li>--}}

{{--                        </ul>--}}


                    </li>
                    @empty
                    <h3> No Review found</h3>
                    @endforelse

                </ul>
                {{ $reviews->links() }}
            </div>
        </div>
    </div>
    </div>

    </div>

    </div>
    <!-- /Page Content -->
    </div>

@endsection

