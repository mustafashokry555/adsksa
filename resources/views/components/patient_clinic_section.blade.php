
<div>
    <section class="clinic-section-four">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header-four text-center aos" data-aos="fade-up">
                        <h2>{{ __('patient.Clinic &') }} <span class="color-primary">{{ __('patient.Specialities') }}</span></h2>
                        <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
            @forelse($specialities as $speciality)
                <div class="col-lg-3 col-md-6 d-flex aos" data-aos="fade-up">
                    <div class="clinic-grid-four w-100">

                        <div class="clinic-img">
                            <img src="{{$speciality->image? URL::asset($speciality->image): URL::asset('/assets/img/clinic/clinic-11.jpg')}}"
                                 class="img-fluid clinic-image" alt="">
                            <div class="clinic-content">
                                <h4>{{$speciality->name}}</h4>
                            </div>
                            <div class="clinic-icon-inner">
                                <div class="clinic-box-img">
                                    <img src="{{ URL::asset($speciality->image)}}" class="img-fluid"
                                         alt="">
                                </div>
                            </div>
                        </div>

                        <div class="overlay">
                            <div class="clinic-cricle">
                                <div class="clinic-round">
                                    <img src="{{ URL::asset($speciality->image)}}" class="img-fluid"
                                         alt="">
                                </div>
                            </div>
                            <h4>{{$speciality->name}}</h4>
                        </div>
                    </div>
                </div>
                @empty
                @endforelse

            </div>
        </div>
    </section>
</div>
