<div>
    <section class="doctor-section-four">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header-four text-center aos aos-init aos-animate" data-aos="fade-up">
                        <h2 class="title-four">Book Our <span class="color-primary">Best Doctor</span></h2>
                        <p class="sub-title color-grey">Access to expert physicians and surgeons, advanced
                            technologies and top-quality surgery facilities right here.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 aos aos-init aos-animate" data-aos="fade-up">
                    <div class="best-doctors-slider slider slick-initialized slick-slider slick-dotted">
                        <button class="slick-prev slick-arrow" aria-label="Previous" type="button"
                                style="display: inline-block;">Previous
                        </button>
                        <div class="slick-list draggable">
                            <div class="slick-track"
                                 style="opacity: 1; width: 5184px; transform: translate3d(0px, 0px, 0px);">
                                @forelse($doctors as $doctor)
                                    <div class="slick-slide {{ $loop->first ? 'slick-current': '' }} slick-active"
                                         data-slick-index="{{ $loop->index }}"
                                         aria-hidden="false" role="tabpanel" id="slick-slide0{{ $loop->index }}"
                                         style="width: 324px;">
                                        <div>
                                            <div class="best-doctors-grid" style="width: 100%; display: inline-block;">
                                                <div class="best-doctors-img">
                                                    <a href="{{ route('doctor_profile', $doctor->id) }}"
                                                       tabindex="{{ $loop->index }}">
                                                        @if($doctor->profile_image ?? '')
                                                            <img
                                                                src="{{ asset($doctor->profile_image) }}"
                                                                alt="" class="img-fluid object-fit"
                                                                style="height: 291px;">
                                                        @else
                                                            <img
                                                                src="http://127.0.0.1:8000/assets/img/doctors/book-doctor-09.jpg"
                                                                alt="" class="img-fluid">
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="best-doctors-info">
                                                    <h3><a href="{{ route('doctor_profile', $doctor->id) }}"
                                                           tabindex="{{ $loop->index }}">Dr.
                                                            {{ $doctor->name }}</a></h3>
                                                    @if($doctor->speciality ?? '')
                                                    <p class="doctor-posting">{{ $doctor->speciality->name }}</p>
                                                    @else
                                                    <p class="doctor-posting">No Speciality Found</p>
                                                    @endif
                                                    @if($doctor->pricing == 0)
                                                    <h5 class="doctors-amount">FREE</h5>
                                                    @else
                                                    <h5 class="doctors-amount">SAR {{ $doctor->pricing }}</h5>
                                                    @endif
                                                    
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
                                                    <div class="booking-btn">
                                                        <a href="{{ route('create_appointment', $doctor->id) }}" class="btn"
                                                           tabindex="{{ $loop->index }}">
											<span>
												Book Appointment <i class="fas fa-arrow-right ms-2"></i>
											</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="slick-slide slick-active" data-slick-index="1" aria-hidden="false"
                                         role="tabpanel" id="slick-slide01" style="width: 324px;">
                                        <div>
                                            <div class="best-doctors-grid"
                                                 style="width: 100%; display: inline-block;">
                                                <div class="best-doctors-img">
                                                    <a href="http://127.0.0.1:8000/doctor-profile" tabindex="0">
                                                        <img
                                                            src="http://127.0.0.1:8000/assets/img/doctors/book-doctor-10.jpg"
                                                            alt="" class="img-fluid">
                                                    </a>
                                                </div>
                                                <div class="best-doctors-info">
                                                    <h3><a href="http://127.0.0.1:8000/doctor-profile" tabindex="0">Dr.
                                                            Darren Elder</a></h3>
                                                    <p class="doctor-posting">MBBS, MD - General Medicine, DNB</p>
                                                    <h5 class="doctors-amount">$30 - $70</h5>
                                                    <div class="rating">
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star"></i>
                                                        <span
                                                            class="d-inline-block average-rating">4.9 ( 82 )</span>
                                                    </div>
                                                    <div class="booking-btn">
                                                        <a href="http://127.0.0.1:8000/booking" class="btn"
                                                           tabindex="0">
											<span>
												Book Appointment <i class="fas fa-arrow-right ms-2"></i>
											</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        <button class="slick-next slick-arrow" aria-label="Next" type="button"
                                style="display: inline;">Next
                        </button>
                        <ul class="slick-dots" style="" role="tablist">
                            <li class="slick-active" role="presentation">
                                <button type="button" role="tab" id="slick-slide-control00"
                                        aria-controls="slick-slide00" aria-label="1 of 2" tabindex="0"
                                        aria-selected="true">1
                                </button>
                            </li>
                            <li role="presentation">
                                <button type="button" role="tab" id="slick-slide-control01"
                                        aria-controls="slick-slide01" aria-label="2 of 2" tabindex="1">2
                                </button>
                            </li>
                            <li role="presentation">
                                <button type="button" role="tab" id="slick-slide-control02"
                                        aria-controls="slick-slide02" aria-label="3 of 2" tabindex="2">3
                                </button>
                            </li>
                            <li role="presentation">
                                <button type="button" role="tab" id="slick-slide-control03"
                                        aria-controls="slick-slide03" aria-label="4 of 2" tabindex="3">4
                                </button>
                            </li>
                            <li role="presentation">
                                <button type="button" role="tab" id="slick-slide-control04"
                                        aria-controls="slick-slide04" aria-label="5 of 2" tabindex="4">5
                                </button>
                            </li>
                            <li role="presentation">
                                <button type="button" role="tab" id="slick-slide-control05"
                                        aria-controls="slick-slide05" aria-label="6 of 2" tabindex="5">6
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
