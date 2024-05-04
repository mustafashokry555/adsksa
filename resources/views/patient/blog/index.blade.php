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
    <section>
        <!-- Page Content -->
        <div class="content">
            <div class="container">

                <div class="row">

                    <div class="col-lg-8 col-md-12">

                        <!-- Blog Post -->
                        @forelse($blogs as $blog)
                        <div class="blog">
                            <div class="blog-image">
                                <a href="{{ url('/blog',$blog->slug) }}"><img class="img-fluid"
                                                                           src="{{URL::asset('images/'.$blog->blog_image)}}"
                                                                           alt="Post Image"></a>
                            </div>
                            <h3 class="blog-title"><a href="{{ route('blog',$blog->slug) }}">{{$blog->blog_title}}</a></h3>
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
                                        <!-- <li><i class="far fa-clock"></i>4 Dec 2019</li> -->
                                        <li><i class="far fa-clock"></i>{{$blog->created_at->format('j M Y')}}</li>

                                        <!-- <li><i class="far fa-comments"></i>12 Comments</li> -->
                                        <!-- <li><i class="fa fa-tags"></i>Health Tips</li> -->
                                    </ul>
                                </div>
                            </div>
                            <div class="blog-content">
                                <p>{{\Str::words($blog->blog_body, 200, '...')}}</p>
                                <a href="{{ url('/blog',$blog->slug) }}" class="read-more">Read More</a>
                            </div>
                        </div>
                        @empty
                          Blog not found

                          @endforelse
                        <!-- /Blog Post -->

                        <!-- Blog Post -->
                       
                        <!-- /Blog Post -->

                        <!-- Blog Pagination -->
                        <!-- <div class="row">
                            <div class="col-md-12">
                                <div class="blog-pagination">
                                    <nav>
                                        <ul class="pagination justify-content-center">
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#" tabindex="-1"><i
                                                        class="fas fa-angle-double-left"></i></a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link" href="#">1</a>
                                            </li>
                                            <li class="page-item active">
                                                <a class="page-link" href="#">2 <span
                                                        class="sr-only">(current)</span></a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link" href="#">3</a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link" href="#"><i
                                                        class="fas fa-angle-double-right"></i></a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div> -->
                        <!-- /Blog Pagination -->
                        {{ $blogs->links() }}

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
                                                <a href="{{ url('/blog',$blog->slug) }}">{{$blog->blog_title}}</a>
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

