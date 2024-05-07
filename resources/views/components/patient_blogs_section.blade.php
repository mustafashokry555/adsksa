<div>

    <section class="blog-section-four">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header-four text-center aos" data-aos="fade-up">
                        <h2 class="title-four">{{ __('patient.Our Latest') }} <span class="color-primary">{{ __('patient.Blogs') }} </span></h2>
                        <p class="sub-title color-grey">It is a long established fact that a reader will be
                            distracted by the readable content of a page when looking at its layout.</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
               @forelse($blogs as $blog)
                <div class="col-lg-4 col-md-6 d-flex aos" data-aos="fade-up">
                    <div class="grid-blog-four w-100">
                        <div class="grid-blog-image">
                            <a href="{{ url('/blog',$blog->slug) }}">
                                <img class="img-fluid" src="{{URL::asset('images/'.$blog->blog_image)}}"
                                     alt="News Image">
                            </a>

                            <div class="blog-date-four">
                                <a href="#">
                                    <i class="feather-calendar me-2"></i>
                                    <span>{{$blog->created_at->format('j M Y')}}</span>
                                </a>
                            </div>
                        </div>
                        <div class="blog-info-four">
                            <a href="{{ url('/blog',$blog->slug) }}">{{$blog->blog_title}}</a>
                        </div>
                        <div class="blog-doctors-four">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <a href="#">
                                        <img src="{{ URL::asset($blog->user->profile_image)}}" alt=""
                                             class="me-2"><span>{{$blog->user->user_type=='D'?'Dr.':''}} {{$blog->user->name}}</span>
                                    </a>
                                </div>
                                <div>
                                    <p>{{$blog?->user?->speciality?->name}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="blog-four-content">
                            <p>{{\Str::words($blog->blog_body, 75, '...')}}</p>
                        </div>
                        <div class="blog-four-arrow">
                            <a href="{{ url('/blog',$blog->slug) }}">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                @empty

                @endforelse
                <!-- <div class="col-lg-4 col-md-6 d-flex aos" data-aos="fade-up">
                    <div class="grid-blog-four w-100">
                        <div class="grid-blog-image">
                            <a href="{{url('blog-details')}}">
                                <img class="img-fluid" src="{{ URL::asset('/assets/img/blog/blog-02.jpg')}}"
                                     alt="News Image">
                            </a>
                            <div class="blog-title-four">
                                <a href="{{url('blog-details')}}" class="btn">General</a>
                            </div>
                            <div class="blog-date-four">
                                <a href="#">
                                    <i class="feather-calendar me-2"></i>
                                    <span>13 Feb 2022</span>
                                </a>
                            </div>
                        </div>
                        <div class="blog-info-four">
                            <a href="{{url('blog-details')}}">Doccure – Making your clinic painless visit?</a>
                        </div>
                        <div class="blog-doctors-four">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <a href="#">
                                        <img src="{{ URL::asset('/assets/img/doctors/doctor-thumb-02.jpg')}}" alt=""
                                             class="me-2"><span>Dr. Darren Elder</span>
                                    </a>
                                </div>
                                <div>
                                    <p>Surgery</p>
                                </div>
                            </div>
                        </div>
                        <div class="blog-four-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                        <div class="blog-four-arrow">
                            <a href="{{url('blog-details')}}">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 d-flex aos" data-aos="fade-up">
                    <div class="grid-blog-four w-100">
                        <div class="grid-blog-image">
                            <a href="{{url('blog-details')}}">
                                <img class="img-fluid" src="{{ URL::asset('/assets/img/blog/blog-04.jpg')}}"
                                     alt="News Image">
                            </a>
                            <div class="blog-title-four">
                                <a href="{{url('blog-details')}}" class="btn">Neurology</a>
                            </div>
                            <div class="blog-date-four">
                                <a href="#">
                                    <i class="feather-calendar me-2"></i>
                                    <span>26 Mar 2022</span>
                                </a>
                            </div>
                        </div>
                        <div class="blog-info-four">
                            <a href="{{url('blog-details')}}">Benefits of consulting with an Online Doctor</a>
                        </div>
                        <div class="blog-doctors-four">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <a href="#">
                                        <img src="{{ URL::asset('/assets/img/doctors/doctor-thumb-03.jpg')}}" alt=""
                                             class="me-2"> <span>Dr. Angel</span>
                                    </a>
                                </div>
                                <div>
                                    <p>Cardiology</p>
                                </div>
                            </div>
                        </div>
                        <div class="blog-four-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                        <div class="blog-four-arrow">
                            <a href="{{url('blog-details')}}">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="text-center">
                <a href="{{ route('blog-list') }}" class="btn btn-one">{{ __('patient.View More') }}</a>
            </div>
        </div>
    </section>
</div>
