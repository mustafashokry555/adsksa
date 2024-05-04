<?php $page = "index-13"; ?>
@extends('layout.mainlayout_index1')
@section('title', 'Blogs')
@section('content')
    <!-- Header -->
    @include('components.patient_header')
    <!-- /Header -->

    <div class="row align-items-center mt-4">

    </div>
    </div>

    </section>
    <!-- /Home Banner -->
    <section class="blog-details">
        <!-- Page Content -->
        <div class="content">
            <div class="container">

                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="blog-view">
                            <div class="blog blog-single-post">
                                <div class="blog-image">
                                    <a href="javascript:void(0);"><img alt=""
                                                                       src="{{URL::asset('images/'.$blog->blog_image)}}"
                                                                       class="img-fluid"></a>
                                </div>
                                <h3 class="blog-title">{{$blog->blog_title}}</h3>
                                <div class="blog-info clearfix">
                                    <div class="post-left">
                                        <ul>
                                            <li>
                                                <div class="post-author">
                                                    <a href="#"><img
                                                            src="{{ URL::asset($blog->user->profile_image)}}"
                                                            alt="Post Author"> <span>{{$blog->user->user_type=='D'?'':''}} {{$blog->user->name}}</span></a>
                                                </div>
                                            </li>
                                            <li><i class="far fa-calendar"></i>{{$blog->created_at->format('j M Y')}}</li>
                                            <!-- <li><i class="far fa-comments"></i>12 Comments</li> -->
                                            <li><i class="fa fa-tags"></i>{{$blog?->user?->speciality?->name}}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="blog-content">
                                    <p>{{$blog->blog_body}}</p>
                                </div>
                            </div>

                            <!-- <div class="card blog-share clearfix">
                                <div class="card-header">
                                    <h4 class="card-title">Share the post</h4>
                                </div>
                                <div class="card-body">
                                    <ul class="social-share">
                                        <li><a href="#" title="Facebook"><i class="fab fa-facebook"></i></a></li>
                                        <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                                        <li><a href="#" title="Google Plus"><i class="fab fa-google-plus"></i></a></li>
                                        <li><a href="#" title="Youtube"><i class="fab fa-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </div> -->
                            <!-- <div class="card author-widget clearfix">
                                <div class="card-header">
                                    <h4 class="card-title">About Author</h4>
                                </div>
                                <div class="card-body">
                                    <div class="about-author">
                                        <div class="about-author-img">
                                            <div class="author-img-wrap">
                                                <a href="#"><img
                                                        class="img-fluid rounded-circle" alt=""
                                                        src="{{ URL::asset('/assets/img/doctors/doctor-thumb-02.jpg')}}"></a>
                                            </div>
                                        </div>
                                        <div class="author-details">
                                            <a href="#" class="blog-author-name">Dr. Darren
                                                Elder</a>
                                            <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                                                do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
                                                ad minim veniam, quis nostrud exercitation.</p>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="card blog-comments clearfix">
                                <div class="card-header">
                                    <h4 class="card-title">Comments (12)</h4>
                                </div>
                                <div class="card-body pb-0">
                                    <ul class="comments-list">
                                        <li>
                                            <div class="comment">
                                                <div class="comment-author">
                                                    <img class="avatar" alt=""
                                                         src="{{ URL::asset('/assets/img/patients/patient1.jpg')}}">
                                                </div>
                                                <div class="comment-block">
													<span class="comment-by">
														<span class="blog-author-name">Michelle Fairfax</span>
													</span>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam
                                                        viverra euismod odio, gravida pellentesque urna varius vitae,
                                                        gravida pellentesque urna varius vitae. Lorem ipsum dolor sit
                                                        amet, consectetur adipiscing elit.</p>
                                                    <p class="blog-date">Dec 6, 2017</p>
                                                    <a class="comment-btn" href="#">
                                                        <i class="fas fa-reply"></i> Reply
                                                    </a>
                                                </div>
                                            </div>
                                            <ul class="comments-list reply">
                                                <li>
                                                    <div class="comment">
                                                        <div class="comment-author">

                                                            <img class="avatar" alt=""
                                                                 src="{{ URL::asset('/assets/img/patients/patient2.jpg')}}">

                                                        </div>
                                                        <div class="comment-block">
															<span class="comment-by">
																<span class="blog-author-name">Gina Moore</span>
															</span>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                                Nam viverra euismod odio, gravida pellentesque urna
                                                                varius vitae, gravida pellentesque urna varius
                                                                vitae.</p>
                                                            <p class="blog-date">Dec 6, 2017</p>
                                                            <a class="comment-btn" href="#">
                                                                <i class="fas fa-reply"></i> Reply
                                                            </a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="comment">
                                                        <div class="comment-author">
                                                            <img class="avatar" alt=""
                                                                 src="{{ URL::asset('/assets/img/patients/patient3.jpg')}}">
                                                        </div>
                                                        <div class="comment-block">
															<span class="comment-by">
																<span class="blog-author-name">Carl Kelly</span>
															</span>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                                Nam viverra euismod odio, gravida pellentesque urna
                                                                varius vitae, gravida pellentesque urna varius
                                                                vitae.</p>
                                                            <p class="blog-date">December 7, 2017</p>
                                                            <a class="comment-btn" href="#">
                                                                <i class="fas fa-reply"></i> Reply
                                                            </a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <div class="comment">
                                                <div class="comment-author">
                                                    <img class="avatar" alt=""
                                                         src="{{ URL::asset('/assets/img/patients/patient4.jpg')}}">
                                                </div>
                                                <div class="comment-block">
													<span class="comment-by">
														<span class="blog-author-name">Elsie Gilley</span>
													</span>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                    <p class="blog-date">December 11, 2017</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="comment">
                                                <div class="comment-author">
                                                    <img class="avatar" alt=""
                                                         src="{{ URL::asset('/assets/img/patients/patient3.jpg')}}">
                                                </div>
                                                <div class="comment-block">
													<span class="comment-by">
														<span class="blog-author-name">Joan Gardner</span>
													</span>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                    <p class="blog-date">December 13, 2017</p>
                                                    <a class="comment-btn" href="#">
                                                        <i class="fas fa-reply"></i> Reply
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="card new-comment clearfix">
                                <div class="card-header">
                                    <h4 class="card-title">Leave Comment</h4>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="form-group">
                                            <label>Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Your Email Address <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Comments</label>
                                            <textarea rows="4" class="form-control"></textarea>
                                        </div>
                                        <div class="submit-section">
                                            <button class="btn btn-primary submit-btn" type="submit">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div> -->

                        </div>
                    </div>

                    <!-- Blog Sidebar -->
                    <div class="col-lg-4 col-md-12 sidebar-right theiaStickySidebar">

                        <!-- Search -->
                        <div class="card search-widget">
                            <div class="card-body">
                                <form class="search-form" action="{{url('/blog-list')}}" method="get">
                                    <div class="input-group">
                                        <input type="text" placeholder="Search..." class="form-control" name="search" value="{{request('search')}}">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /Search -->

                        <!-- Latest Posts -->
                        <div class="card post-widget">
                            <div class="card-header">
                                <h4 class="card-title">Latest Posts</h4>
                            </div>
                            <div class="card-body">
                                <ul class="latest-posts">
                                @forelse($latestBlogs as $blog)

                                    <li>
                                        <div class="post-thumb">
                                            <a href="{{ url('/blog',$blog->slug) }}">
                                                <img class="img-fluid"
                                                     src="{{ URL::asset($blog->user->profile_image)}}"
                                                     alt="">
                                            </a>
                                        </div>
                                        <div class="post-info">
                                            <h4>
                                                <a href="{{ url('/blog_details',$blog->slug) }}">{{$blog->blog_title}}</a>
                                            </h4>
                                            <p>{{$blog->created_at->format('j M Y')}}</p>
                                        </div>
                                    </li>

                                 @empty

                                 No blog found

                                 @endforelse
                                </ul>
                            </div>
                        </div>
                        <!-- /Latest Posts -->

                        <!-- Categories -->
                        <!-- <div class="card category-widget">
                            <div class="card-header">
                                <h4 class="card-title">Blog Categories</h4>
                            </div>
                            <div class="card-body">
                                <ul class="categories">
                                    <li><a href="#">Cardiology <span>(62)</span></a></li>
                                    <li><a href="#">Health Care <span>(27)</span></a></li>
                                    <li><a href="#">Nutritions <span>(41)</span></a></li>
                                    <li><a href="#">Health Tips <span>(16)</span></a></li>
                                    <li><a href="#">Medical Research <span>(55)</span></a></li>
                                    <li><a href="#">Health Treatment <span>(07)</span></a></li>
                                </ul>
                            </div>
                        </div> -->
                        <!-- /Categories -->

                        <!-- Tags -->
                        <!-- <div class="card tags-widget">
                            <div class="card-header">
                                <h4 class="card-title">Tags</h4>
                            </div>
                            <div class="card-body">
                                <ul class="tags">
                                    <li><a href="#" class="tag">Children</a></li>
                                    <li><a href="#" class="tag">Disease</a></li>
                                    <li><a href="#" class="tag">Appointment</a></li>
                                    <li><a href="#" class="tag">Booking</a></li>
                                    <li><a href="#" class="tag">Kids</a></li>
                                    <li><a href="#" class="tag">Health</a></li>
                                    <li><a href="#" class="tag">Family</a></li>
                                    <li><a href="#" class="tag">Tips</a></li>
                                    <li><a href="#" class="tag">Shedule</a></li>
                                    <li><a href="#" class="tag">Treatment</a></li>
                                    <li><a href="#" class="tag">Dr</a></li>
                                    <li><a href="#" class="tag">Clinic</a></li>
                                    <li><a href="#" class="tag">Online</a></li>
                                    <li><a href="#" class="tag">Health Care</a></li>
                                    <li><a href="#" class="tag">Consulting</a></li>
                                    <li><a href="#" class="tag">Doctors</a></li>
                                    <li><a href="#" class="tag">Neurology</a></li>
                                    <li><a href="#" class="tag">Dentists</a></li>
                                    <li><a href="#" class="tag">Specialist</a></li>
                                    <li><a href="#" class="tag">Doccure</a></li>
                                </ul>
                            </div>
                        </div> -->
                        <!-- /Tags -->

                    </div>
                    <!-- /Blog Sidebar -->

                </div>
            </div>

        </div>
        <!-- /Page Content -->
    </section>
    <!-- /Page Content -->

@endsection

