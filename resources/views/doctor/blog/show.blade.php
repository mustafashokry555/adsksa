<?php $page = 'doctor-dashboard'; ?>
@extends('layout.mainlayout_doctor')
@section('title', 'Edit Blog Details')

@section('content')

    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="blog blog-single-post">
                        <div class="blog-image">
                            <a href="javascript:void(0);">
                                @if ($blog->blog_image ?? '')
                                    <img alt="" src="{{ asset('images/' . $blog->blog_image) }}" class="img-fluid"
                                        style="height: 800px;">
                                @else
                                    <img alt="" src="{{ URL::asset('/assets/img/blog/blog-01.jpg') }}"
                                        class="img-fluid">
                                @endif
                            </a>
                        </div>
                        <h3 class="blog-title">{{ $blog->blog_title }}</h3>
                        <div class="blog-info clearfix">
                            <div class="post-left">
                                <ul>
                                    <li>
                                        <div class="post-author">
                                            <a href="#">
                                                <img src="{{ asset( auth()->user()->profile_image) }}"
                                                    alt="">
                                                {{-- {{auth()->user()->profile_image}} --}}
                                                <span>Dr. {{ auth()->user()->name }}</span></a>
                                        </div>
                                    </li>
                                    <li><i class="far fa-calendar"></i>{{ $blog->created_at->diffForHumans() }}</li>
                                    {{--                                    <li><i class="far fa-comments"></i>12 Comments</li> --}}
                                    {{--                                    <li><i class="fa fa-tags"></i>Health Tips</li> --}}
                                </ul>
                            </div>
                        </div>
                        <div class="blog-content">
                            <p>{{ $blog->blog_body }}</p>
                        </div>
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
