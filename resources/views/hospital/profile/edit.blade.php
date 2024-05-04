@extends('layout.mainlayout_hospital')
@section('title', 'Edit Profile')
@section('content')
    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="container">
            <!-- Profile Information -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm">
                        <form method="POST" action="{{ route('profile.update', $hospital_admin) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <!-- Basic -->
                            <div class="col-md-12">
                                <div class="pro-title d-flex justify-content-between">
                                    <h6>{{ __('hospital.profile.personal_information')  }}</h6>
                                </div>
                            </div>
                            <div class="form-row row">
                                <div class="col-md-4 mb-3">
                                    <label for="name">{{ __('hospital.profile.name')  }}</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="{{ __('hospital.profile.name')  }}" value="{{ $hospital_admin->name }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="email">{{ __('hospital.profile.email')  }}</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="{{ __('hospital.profile.email')  }}" value="{{ $hospital_admin->email }}" required readonly>
                                </div>
                                @if ($hospital_admin->username ?? '')
                                    <div class="col-md-4 mb-3">
                                        <label for="username">{{ __('hospital.profile.username')  }}</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="username">@</span>
                                            <input type="text" readonly class="form-control" id="username"
                                                name="username" placeholder="{{ __('hospital.profile.username')  }}"
                                                value="{{ $hospital_admin->username }}" required>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-4 mb-3">
                                        <label for="username">{{ __('hospital.profile.username')  }}</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="username">@</span>
                                            <input type="text" class="form-control" id="username" name="username"
                                                placeholder="{{ __('hospital.profile.username')  }}">
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-4 mb-3">
                                    <label for="mobile">{{ __('hospital.profile.mobile')  }}</label>
                                    <input type="tel" class="form-control" id="mobile" name="mobile"
                                        placeholder="+12345678" value="{{ $hospital_admin->mobile }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="profile_image">{{ __('hospital.profile.profile_image')  }}</label>
                                    <input id="profile_image" name="profile_image" class="form-control" type="file">
                                </div>
                            </div>
                            <!-- Description -->
                            <div class="form-row row">
                                <label for="description" class="col-form-label col-md-2">{{ __('hospital.profile.description')  }}</label>
                                <div class="col-md-12 mb-3">
                                    <textarea rows="5" cols="5" id="description" name="description" class="form-control" placeholder="{{ __('hospital.profile.description')  }}" required>{{ $hospital_admin->description }}</textarea>
                                </div>
                            </div>
                            <!-- Personal Info -->
                            <!-- <div class="form-row row">
                                <div class="col-md-4 mb-3">
                                    <label for="date_of_birth">Date of birth</label>
                                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                        placeholder="date_of_birth" value="{{ $hospital_admin->date_of_birth }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="gender">Gender</label>
                                    <div class="col-md-10">
                                        <select id="gender" name="gender" class="form-select select" required>
                                            <option>-- Select Gender --</option>
                                            <option value="M" {{ $hospital_admin->gender == 'M' ? 'selected' : '' }}>
                                                Male
                                            </option>
                                            <option value="F" {{ $hospital_admin->gender == 'F' ? 'selected' : '' }}>
                                                Female
                                            </option>
                                            <option value="O" {{ $hospital_admin->gender == 'O' ? 'selected' : '' }}>
                                                Others
                                            </option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="age">Age</label>
                                    <input type="number" class="form-control" id="age" name="age"
                                        placeholder="Enter you age" value="{{ $hospital_admin->age }}" required>
                                </div>
                            </div> -->
                            <!-- Address -->
                            <div class="form-row row">
                                <div class="col-md-12 mb-3">
                                    <label for="address">{{ __('hospital.profile.address')  }}</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="{{ __('hospital.profile.address')  }}" value="{{ $hospital_admin->address }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="country">{{ __('hospital.profile.country')  }}</label>
                                    <input type="text" class="form-control" id="country" placeholder="{{ __('hospital.profile.country')  }}"
                                        name="country" value="{{ $hospital_admin->country }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="state">{{ __('hospital.profile.state')  }}</label>
                                    <input type="text" class="form-control" id="state" name="state"
                                        placeholder="{{ __('hospital.profile.state')  }}" value="{{ $hospital_admin->state }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="zip_code">{{ __('hospital.profile.zip_code')  }}</label>
                                    <input type="text" class="form-control" id="zip_code" name="zip_code"
                                        placeholder="{{ __('hospital.profile.zip_code')  }}" value="{{ $hospital_admin->zip_code }}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="pro-title">
                                    <h6>{{ __('hospital.profile.social_links')  }}</h6>
                                    <p>{{ __('hospital.profile.accessible')  }}.</p>
                                </div>
                            </div>
                            <div class="form-row row">
                                <div class="col-md-4 mb-3">
                                    <label for="twitter">{{ __('hospital.profile.twitter_profile_link')  }}</label>
                                    <input type="url" class="form-control" id="twitter" name="twitter"
                                        placeholder="https://www.twitter.com/" value="{{ $hospital_admin->twitter }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="facebook">{{ __('hospital.profile.facebook_profile_link')  }}</label>
                                    <input type="url" class="form-control" id="facebook" name="facebook"
                                        placeholder="https://www.facebook.com/" value="{{ $hospital_admin->facebook }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="linkedin">{{ __('hospital.profile.linkedin_profile_link')  }}</label>
                                    <input type="url" class="form-control" id="linkedin" name="linkedin"
                                        placeholder="https://www.linkedn.com/" value="{{ $hospital_admin->linkedin }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="instagram">{{ __('hospital.profile.instagram_profile_link')  }}</label>
                                    <input type="url" class="form-control" id="instagram" name="instagram"
                                        placeholder="https://www.instagram.com/"
                                        value="{{ $hospital_admin->instagram }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="youtube">{{ __('hospital.profile.youtube_link')  }}</label>
                                    <input type="url" class="form-control" id="youtube" name="youtube"
                                        placeholder="https://www.youbute.com/" value="{{ $hospital_admin->youtube }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="pinterest">{{ __('hospital.profile.pinterest_link')  }}</label>
                                    <input type="url" class="form-control" id="pinterest" name="pinterest"
                                        placeholder="https://www.pinterest.com/"
                                        value="{{ $hospital_admin->pinterest }}">
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">{{ __('hospital.profile.update_profile')  }}</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /Profile Information -->
        </div>
    </div>
    </div>

    </div>

    </div>
    <!-- /Page Content -->
    </div>
@endsection
