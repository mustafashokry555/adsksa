@php
    $setting = \App\Models\Settings::query()->first();
@endphp
<!-- Footer Four -->
<footer class="footer footer-four">
    {{-- <div class="news-section-four">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center" id="news-letter" >
                @if(session()->has('success'))
                <x-alert>{{ session('success') }}</x-alert>
            @endif
                    <div class="news-info">
                        <h2>{{ __('patient.Subscribe to our Newsletter') }}</h2>
                        <p>{{ __('patient.Subscribe today for our exclusive offers, latest news and updates about health care programs.') }}</p>
                    </div>
                    <div class="footer-news-four">
                        <form action="{{url('/subscribe_newsletter')}}" method="post">
                            <div class="form-group mb-0">
                                @csrf
                                <input type="email" class="form-control" name="email" placeholder="{{ __('patient.Enter Your Email Address') }}" required>
                                <button type="submit" class="btn btn-one">{{ __('patient.Subscribe') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Footer Top -->
    <div class="footer-top aos" data-aos="fade-up">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <!-- Footer Widget -->
                    <div class="footer-widget footer-contact">
                        <h2 class="footer-title">{{ __('patient.Contact Us') }}</h2>
                        <div class="footer-contact-info">
                            <div class="footer-address"><span><i class="feather-map-pin"></i></span>
                                <p>{{ $setting?->address_line_1 ??'' }} {{ $setting?->address_line_2 ?? '' }}</p>
                                <p>{{ $setting?->city ?? '' }},
                                    <br>{{ $setting?->state ?? '' }}, {{ $setting?->country ?? '' }}
                                    <br>{{ $setting?->zip_code ?? '' }}
                                </p>
                            </div>
                            @if ($setting->phone ?? '')
                                <p><i class="feather-phone"></i>{{ $setting->phone }}</p>
                            @else
                                <p><i class="feather-phone"></i></p>
                            @endif
                            @if ($setting->email ?? '')
                                <p class="mb-0"><i class="feather-mail"></i>{{ $setting->email }}</p>
                            @else
                                <p class="mb-0"><i class="feather-mail"></i></p>
                            @endif
                        </div>
                    </div>
                    <!-- /Footer Widget -->
                </div>
                @auth
                    @if (\Auth::user()->is_patient())
                        <div class="col-lg-4 col-md-6">
                            <!-- Footer Widget -->
                            <div class="footer-widget footer-menu">
                                <h2 class="footer-title">{{ __('patient.For Patients') }}</h2>
                                <ul>
                                    <li>
                                        {{-- <a href="{{ route('search_doctor') }}">Search for Doctors</a> --}}
                                        <a href="#">{{ __('patient.Search for Doctors') }}</a>
                                    </li>
                                    @auth
                                        <li><a href="{{ route('profile.index') }}">{{ __('patient.My Profile') }}</a>
                                        </li>
                                    @else
                                        <li><a href="{{ route('login') }}">{{ __('patient.Login') }}</a>
                                        </li>
                                        <li><a href="{{ route('register') }}">{{ __('patient.Register') }}</a>
                                        </li>
                                    @endauth
                                    <li><a href="{{ route('patient_dashboard') }}">{{ __('patient.Patient Dashboard') }}</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /Footer Widget -->
                        </div>
                    @elseif(\Auth::user()->is_doctor())
                        <div class="col-lg-4 col-md-6">
                            <!-- Footer Widget -->
                            <div class="footer-widget footer-menu">
                                <h2 class="footer-title">{{ __('patient.For Doctors') }}</h2>
                                <ul>
                                    <li><a href="{{ url('appointments') }}">{{ __('patient.Appointments') }}</a>
                                    </li>
                                    <li><a href="{{ url('chat') }}">{{ __('patient.Chat') }}</a>
                                    </li>
                                    <li><a href="{{ url('doctor-dashboard') }}">{{ __('patient.Doctor Dashboard') }}</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /Footer Widget -->
                        </div>
                    @endif
                @else
                    <div class="col-lg-4 col-md-6">
                        <!-- Footer Widget -->
                        <div class="footer-widget footer-menu">
                            <h2 class="footer-title">{{ __('patient.For Patients') }}</h2>
                            <ul>
                                <li><a href="/">{{ __('patient.Search for Doctors') }}</a></li>
                                {{-- <a href="{{ route('search_doctor') }}">Search for Doctors</a> --}}
                                <li><a href="{{ route('login') }}">{{ __('patient.Login') }}</a>
                                </li>
                                <li><a href="{{ route('register') }}">{{ __('patient.Register') }}</a>
                                </li>
                                {{-- <li><a href="{{ route('patient_dashboard') }}">Patient Dashboard</a></li> --}}
                            </ul>
                        </div>
                        <!-- /Footer Widget -->
                    </div>
                @endauth

                <div class="col-lg-4 col-md-6">
                    <!-- Footer Widget -->
                    <div class="footer-widget footer-menu">
                        <h2 class="footer-title">{{ __('patient.Social Network') }}</h2>
                        <ul>
                            <li><a href="{{ $setting->facebook }}" target="_blank"><i class="fab fa-facebook me-2"></i>
                                {{ __('patient.Facebook') }}</a>
                            </li>
                            <li><a href="{{ $setting->twitter }}" target="_blank"><i class="fab fa-twitter me-2"></i>
                                {{ __('patient.Twitter') }}</a>
                            </li>
                            <li><a href="{{ $setting->linkedin }}" target="_blank"><i class="fab fa-linkedin me-2"></i>
                                {{ __('patient.Linkedin') }}</a>
                            </li>
                            <li><a href="{{ $setting->instagram }}" target="_blank"><i
                                        class="fab fa-instagram me-2"></i> {{ __('patient.Instagram') }}</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /Footer Widget -->
                </div>
            </div>
        </div>
    </div>
    <!-- /Footer Top -->

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <!-- Copyright -->
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="copyright-text">
                            <p class="mb-0">&copy; 2022 {{ $setting->website_name }}. All rights reserved.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <!-- Copyright Menu -->
                        <div class="copyright-menu">
                            <ul class="policy-menu">
                                <li><a href="{{ route('terms-conditions') }}">{{ __('patient.Terms and Conditions') }}</a>
                                </li>
                                <li><a href="{{ route('privacy') }}">{{ __('patient.Policy') }}</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /Copyright Menu -->
                    </div>
                </div>
            </div>
            <!-- /Copyright -->
        </div>
    </div>
    <!-- /Footer Bottom -->
</footer>
<!-- /Footer One-->

</div>
<!-- /Main Wrapper -->

