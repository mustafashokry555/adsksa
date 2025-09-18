@extends('layout.mainlayout_admin')
@section('title', 'Settings')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="page-title">{{ __('admin.settings.settings') }}</h3>
                    </div>
                </div>
            </div>

            <div class="settings-menu-links">
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="nav-item active">
                        <a class="nav-link" data-bs-toggle="tab"
                            href="{{ url('#general_settings') }}">{{ __('admin.settings.general_settings') }}</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="{{ url('#localization') }}">Localization</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="{{ url('#payment_settings') }}">Payment
                            settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="{{ url('#email_settings') }}">Email Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="{{ url('#social_media_login') }}">Social Media
                            Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="{{ url('#social_links') }}">Social links</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="{{ url('#seo_settings') }}">SEO Sttings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="{{ url('#others') }}">Others</a>
                    </li> --}}
                </ul>
            </div>

            {{-- general setting --}}
            <div class="tab-content pt-8">
                <div role="tabpanel" id="general_settings" class=" tab-pane fade show active">
                    <div class="d-flex gap-3 justify-content-between">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body pt-0">
                                    <div class="card-header">
                                        <h5 class="card-title">{{ __('admin.settings.website_basic_details') }}</h5>
                                    </div>
                                    <form method="POST" action="{{ route('store_settings') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="settings-form">
                                            <div class="form-group">
                                                <label for="website_name">{{ __('admin.settings.website_name') }} <span
                                                        class="star-red">*</span></label>
                                                <input type="text" name="website_name" class="form-control"
                                                    value="{{ $setting->website_name }}"
                                                    placeholder="{{ __('admin.settings.enter_website_name') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Tax Number <span class="star-red">*</span></label>
                                                <input type="text" name="tax_number" class="form-control"
                                                    value="{{ $setting->tax_number }}" placeholder="Tax Number">
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Vat Percentage <span class="star-red">*</span></label>
                                                <input type="vat" name="vat" class="form-control"
                                                    value="{{ $setting->vat }}" placeholder="Vat Percentage">
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">{{ __('admin.settings.website_phone') }} <span
                                                        class="star-red">*</span></label>
                                                <input type="tel" name="phone" class="form-control"
                                                    value="{{ $setting->phone }}"
                                                    placeholder="{{ __('admin.settings.enter_administrator_phone') }} ">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">{{ __('admin.settings.website_email') }} <span
                                                        class="star-red">*</span></label>
                                                <input type="email" name="email" class="form-control"
                                                    value="{{ $setting->email }}"
                                                    placeholder="{{ __('admin.settings.enter_administrator_email') }} ">
                                            </div>
                                            <div class="form-group">
                                                <label for="privacy_policy_en">Privacy Policy (EN) <span
                                                        class="star-red">*</span></label>
                                                <textarea id="privacy_policy_en" name="privacy_policy_en" class="form-control">{{ $setting->privacy_policy_en }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="privacy_policy_ar">Privacy Policy (AR) <span
                                                        class="star-red">*</span></label>
                                                <textarea id="privacy_policy_ar" name="privacy_policy_ar" class="form-control">{{ $setting->privacy_policy_ar }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <p class="settings-label">{{ __('admin.settings.logo') }} <span
                                                        class="star-red">*</span></p>
                                                <div class="settings-btn">
                                                    <input type="file" accept="image/*" name="logo" id="logo"
                                                        onchange="loadFile(event)" class="hide-input">
                                                    <label for="logo" class="upload">
                                                        <i class="feather-upload"></i>
                                                    </label>
                                                </div>
                                                <h6 class="settings-size">
                                                    {{ __('admin.settings.recommended_image_size_is') }}
                                                    <span>{{ __('admin.settings.150px_x_150px') }}</span>
                                                </h6>
                                            </div>

                                            <div class="form-group">
                                                <p class="settings-label">Icon <span class="star-red">*</span></p>
                                                <div class="settings-btn">
                                                    <input type="file" accept="image/*" name="favicon" id="favicon"
                                                        onchange="loadFile(event)" class="hide-input">
                                                    <label for="favicon" class="upload">
                                                        <i class="feather-upload"></i>
                                                    </label>
                                                </div>
                                                {{-- <h6 class="settings-size">{{ __('admin.settings.recommended_image_size_is')  }}
                                                    <span>{{ __('admin.settings.150px_x_150px')  }}</span>
                                                </h6> --}}
                                            </div>

                                            {{-- favicon --}}
                                            {{-- <div class="form-group">
                                                <p class="settings-label">Favicon <span class="star-red">*</span></p>
                                                <div class="settings-btn">
                                                    <input type="file" accept="image/*" name="favicon" id="favicon"
                                                        onchange="loadFile(event)" class="hide-input">
                                                    <label for="favicon" class="upload">
                                                        <i class="feather-upload"></i>
                                                    </label>
                                                </div>
                                                <h6 class="settings-size">
                                                    Recommended image size is <span>16px x 16px or 32px x 32px</span>
                                                </h6>
                                            </div> --}}

                                            <div class="form-group mb-0">
                                                <div class="settings-btns">
                                                    <button type="submit"
                                                        class="btn btn-primary btn-add">{{ __('admin.settings.update') }}
                                                    </button>
                                                    <button type="submit"
                                                        class="btn btn-danger btn-cancel">{{ __('admin.settings.cancel') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body pt-0">
                                    <div class="card-header">
                                        <h5 class="card-title">{{ __('admin.settings.address_details') }}</h5>
                                    </div>
                                    <form method="POST" action="{{ route('store_settings') }}">
                                        @csrf
                                        <div class="settings-form">
                                            <div class="form-group">
                                                <label>{{ __('admin.settings.address_line_1') }} <span
                                                        class="star-red">*</span></label>
                                                <input type="text" class="form-control" name="address_line_1"
                                                    placeholder="{{ __('admin.settings.enter_address_line_1') }}"
                                                    value="{{ $setting->address_line_1 }}">
                                            </div>
                                            <div class="form-group">
                                                <label>{{ __('admin.settings.address_line_2') }} <span
                                                        class="star-red">*</span></label>
                                                <input type="text" class="form-control" name="address_line_2"
                                                    placeholder="{{ __('admin.settings.enter_address_line_2') }}"
                                                    value="{{ $setting->address_line_2 }}">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{ __('admin.settings.city') }} <span
                                                                class="star-red">*</span></label>
                                                        <input type="text" name="city" class="form-control"
                                                            placeholder="{{ __('admin.settings.enter_city') }}"
                                                            value="{{ $setting->city }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <!-- <label>State/Province <span class="star-red">*</span></label>
                                                                <select
                                                                    class="select form-control select2-hidden-accessible form-select select"
                                                                    data-select2-id="1" tabindex="-1" aria-hidden="true" name="state">
                                                                    <option selected="selected" data-select2-id="3">Select</option>
                                                                    <option>California</option>
                                                                    <option>Tasmania</option>
                                                                    <option>Auckland</option>
                                                                </select> -->


                                                        {{-- <span class="select2 select2-container select2-container--default"
                                                            dir="ltr" data-select2-id="2" style="width: 100%;"><span
                                                                class="selection"><span
                                                                    class="select2-selection select2-selection--single"
                                                                    role="combobox" aria-haspopup="true"
                                                                    aria-expanded="false" tabindex="0"
                                                                    aria-disabled="false"
                                                                    aria-labelledby="select2-jn3r-container"><span
                                                                        class="select2-selection__rendered"
                                                                        id="select2-jn3r-container" role="textbox"
                                                                        aria-readonly="true"
                                                                        title="Select">Select</span><span
                                                                        class="select2-selection__arrow"
                                                                        role="presentation"><b
                                                                            role="presentation"></b></span></span></span><span
                                                                class="dropdown-wrapper" aria-hidden="true"></span></span> --}}
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{ __('admin.settings.zip/postal_code') }} <span
                                                                class="star-red">*</span></label>
                                                        <input type="text" class="form-control"
                                                            placeholder="{{ __('admin.settings.enter_zip/postal_code') }}"
                                                            name="zip_code" value="{{ $setting->zip_code }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <!-- <label>Country <span class="star-red">*</span></label>
                                                                <select class="select form-control select2-hidden-accessible"
                                                                    data-select2-id="4" tabindex="-1" aria-hidden="true" name="country">
                                                                    <option selected="selected" data-select2-id="6">Select
                                                                    </option>
                                                                    <option>India</option>
                                                                    <option>London</option>
                                                                    <option>France</option>
                                                                    <option>USA</option>
                                                                </select> -->

                                                        {{-- <span class="select2 select2-container select2-container--default"
                                                            dir="ltr" data-select2-id="5" style="width: 100%;"><span
                                                                class="selection"><span
                                                                    class="select2-selection select2-selection--single"
                                                                    role="combobox" aria-haspopup="true"
                                                                    aria-expanded="false" tabindex="0"
                                                                    aria-disabled="false"
                                                                    aria-labelledby="select2-ny18-container"><span
                                                                        class="select2-selection__rendered"
                                                                        id="select2-ny18-container" role="textbox"
                                                                        aria-readonly="true"
                                                                        title="Select">Select</span><span
                                                                        class="select2-selection__arrow"
                                                                        role="presentation"><b
                                                                            role="presentation"></b></span></span></span><span
                                                                class="dropdown-wrapper" aria-hidden="true"></span></span> --}}

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-0">
                                                <div class="settings-btns">
                                                    <button type="submit"
                                                        class="btn btn-primary btn-add">{{ __('admin.settings.update') }}
                                                    </button>
                                                    <button type="submit"
                                                        class="btn btn-danger">{{ __('admin.settings.cancel') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Social Links --}}
                <div class="card">
                    <div class="card-body pt-0">
                        <div class="card-header">
                            <h5 class="card-title">{{ __('admin.settings.social_links') }}</h5>
                        </div>
                        <form method="POST" action="{{ route('store_settings') }}">
                            @csrf
                            <div class="settings-form">
                                <div class="form-group">
                                    <label>{{ __('admin.settings.facebook') }} <span class="star-red">*</span></label>
                                    <input type="text" class="form-control" name="facebook"
                                        value="{{ $setting->facebook }}"
                                        placeholder="{{ __('admin.settings.enter_facebook_address') }}">
                                </div>
                                <div class="form-group">
                                    <label>{{ __('admin.settings.twitter') }} <span class="star-red">*</span></label>
                                    <input type="text" class="form-control" name="twitter"
                                        value="{{ $setting->twitter }}"
                                        placeholder="{{ __('admin.settings.enter_twitter_address') }}">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('admin.settings.linkedin') }} <span
                                                    class="star-red">*</span></label>
                                            <input type="text" name="linkedin" value="{{ $setting->linkedin }}"
                                                class="form-control"
                                                placeholder="{{ __('admin.settings.enter_linkedIn_address') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('admin.settings.instagram') }} <span
                                                    class="star-red">*</span></label>
                                            <input type="text" name="instagram" value="{{ $setting->instagram }}"
                                                class="form-control"
                                                placeholder="{{ __('admin.settings.enter_instagram_address') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('admin.settings.youtube') }}<span
                                                    class="star-red">*</span></label>
                                            <input type="text" name="youtube" value="{{ $setting->youtube }}"
                                                class="form-control"
                                                placeholder="{{ __('admin.settings.enter_youtube_address') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="settings-btns">
                                        <button type="submit"
                                            class="btn btn-primary btn-add">{{ __('admin.settings.update') }}
                                        </button>
                                        <button type="submit"
                                            class="btn btn-danger">{{ __('admin.settings.cancel') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>Logo

    {{-- localization --}}
    <div role="tabpanel" id="localization" class="tab-pane fade">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body pt-0">
                        <div class="card-header">
                            <h5 class="card-title">Localization Details</h5>
                        </div>
                        <form>
                            <div class="settings-form">
                                <div class="form-group">
                                    <label>Time Zone</label>
                                    <select class="select form-control select2-hidden-accessible" data-select2-id="1"
                                        tabindex="-1" aria-hidden="true">
                                        <option selected="selected" data-select2-id="3">(UTC +5:30)
                                            Antarctica/Palmer
                                        </option>
                                        <option>(UTC+05:30) India</option>
                                    </select><span class="select2 select2-container select2-container--default"
                                        dir="ltr" data-select2-id="2" style="width: 100%;"><span
                                            class="selection"><span class="select2-selection select2-selection--single"
                                                role="combobox" aria-haspopup="true" aria-expanded="false"
                                                tabindex="0" aria-disabled="false"
                                                aria-labelledby="select2-1nrc-container"><span
                                                    class="select2-selection__rendered" id="select2-1nrc-container"
                                                    role="textbox" aria-readonly="true"
                                                    title="(UTC +5:30) Antarctica/Palmer">(UTC +5:30)
                                                    Antarctica/Palmer</span><span class="select2-selection__arrow"
                                                    role="presentation"><b
                                                        role="presentation"></b></span></span></span><span
                                            class="dropdown-wrapper" aria-hidden="true"></span></span>
                                </div>
                                <div class="form-group">
                                    <label>Date Format</label>
                                    <select class="select form-control select2-hidden-accessible" data-select2-id="4"
                                        tabindex="-1" aria-hidden="true">
                                        <option selected="selected" data-select2-id="6">15 May 2016</option>
                                        <option>15/05/2016</option>
                                        <option>15.05.2016</option>
                                        <option>15-05-2016</option>
                                        <option>05/15/2016</option>
                                        <option>2016/05/15</option>
                                        <option>2016-05-15</option>
                                    </select><span class="select2 select2-container select2-container--default"
                                        dir="ltr" data-select2-id="5" style="width: 100%;"><span
                                            class="selection"><span class="select2-selection select2-selection--single"
                                                role="combobox" aria-haspopup="true" aria-expanded="false"
                                                tabindex="0" aria-disabled="false"
                                                aria-labelledby="select2-zg41-container"><span
                                                    class="select2-selection__rendered" id="select2-zg41-container"
                                                    role="textbox" aria-readonly="true" title="15 May 2016">15 May
                                                    2016</span><span class="select2-selection__arrow"
                                                    role="presentation"><b
                                                        role="presentation"></b></span></span></span><span
                                            class="dropdown-wrapper" aria-hidden="true"></span></span>
                                </div>
                                <div class="form-group">
                                    <label>Time Format</label>
                                    <select class="select form-control select2-hidden-accessible" data-select2-id="7"
                                        tabindex="-1" aria-hidden="true">
                                        <option selected="selected" data-select2-id="9">12 Hours</option>
                                        <option>24 Hours</option>
                                        <option>36 Hours</option>
                                        <option>48 Hours</option>
                                        <option>60 Hours</option>
                                    </select><span
                                        class="select2 select2-container select2-container--default select2-container--focus"
                                        dir="ltr" data-select2-id="8" style="width: 100%;"><span
                                            class="selection"><span class="select2-selection select2-selection--single"
                                                role="combobox" aria-haspopup="true" aria-expanded="false"
                                                tabindex="0" aria-disabled="false"
                                                aria-labelledby="select2-0qad-container"><span
                                                    class="select2-selection__rendered" id="select2-0qad-container"
                                                    role="textbox" aria-readonly="true" title="12 Hours">12
                                                    Hours</span><span class="select2-selection__arrow"
                                                    role="presentation"><b
                                                        role="presentation"></b></span></span></span><span
                                            class="dropdown-wrapper" aria-hidden="true"></span></span>
                                </div>
                                <div class="form-group">
                                    <label>Currency Symbol</label>
                                    <select class="select form-control select2-hidden-accessible" data-select2-id="10"
                                        tabindex="-1" aria-hidden="true">
                                        <option selected="selected" data-select2-id="12">$</option>
                                        <option>₹</option>
                                        <option>£</option>
                                        <option>€</option>
                                    </select><span class="select2 select2-container select2-container--default"
                                        dir="ltr" data-select2-id="11" style="width: 100%;"><span
                                            class="selection"><span class="select2-selection select2-selection--single"
                                                role="combobox" aria-haspopup="true" aria-expanded="false"
                                                tabindex="0" aria-disabled="false"
                                                aria-labelledby="select2-xsj4-container"><span
                                                    class="select2-selection__rendered" id="select2-xsj4-container"
                                                    role="textbox" aria-readonly="true" title="$">$</span><span
                                                    class="select2-selection__arrow" role="presentation"><b
                                                        role="presentation"></b></span></span></span><span
                                            class="dropdown-wrapper" aria-hidden="true"></span></span>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="settings-btns">
                                        <button type="submit" class="btn btn-primary btn-add">Update
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div role="tabpanel" id="payment_settings" class="tab-pane fade">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body pt-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Paypal</h5>
                            <div class="status-toggle d-flex justify-content-between align-items-center">
                                <input type="checkbox" id="status_1" class="check">
                                <label for="status_1" class="checktoggle">checkbox</label>
                            </div>
                        </div>
                        <form>
                            <div class="settings-form">
                                <div class="form-group">
                                    <p class="pay-cont">Paypal Option</p>
                                    <label class="custom_radio me-4">
                                        <input type="radio" name="budget" value="Yes" checked="">
                                        <span class="checkmark"></span> Sandbox
                                    </label>
                                    <label class="custom_radio">
                                        <input type="radio" name="budget" value="Yes">
                                        <span class="checkmark"></span> Live
                                    </label>
                                </div>
                                <div class="form-group form-placeholder">
                                    <label>Braintree Tokenization key <span class="star-red">*</span></label>
                                    <input type="text" class="form-control"
                                        placeholder="sandbox_pgjcppvs_pd6gznv7zbrx9hb8">
                                </div>
                                <div class="form-group form-placeholder">
                                    <label>Braintree Merchant ID <span class="star-red">*</span></label>
                                    <input type="text" class="form-control" placeholder="pd6gznv7zbrx9hb8">
                                </div>
                                <div class="form-group form-placeholder">
                                    <label>Braintree Public key <span class="star-red">*</span></label>
                                    <input type="text" class="form-control" placeholder="h8bydrz7gcjkp7d4">
                                </div>
                                <div class="form-group form-placeholder">
                                    <label>Braintree Private key <span class="star-red">*</span></label>
                                    <input type="text" class="form-control"Time
                                        placeholder="sandbox_pgjcppvs_pd6gznv7zbrx9hb8">
                                </div>
                                <div class="form-group form-placeholder">
                                    <label>Paypal APP ID <span class="star-red">*</span></label>
                                    <input type="text" class="form-control" placeholder="pd6gznv7zbrx9hb8">
                                </div>
                                <div class="form-group form-placeholder">
                                    <label>Paypal Secret Key <span class="star-red">*</span></label>
                                    <input type="text" class="form-control" placeholder="h8bydrz7gcjkp7d4">
                                </div>
                                <div class="form-group mb-0">
                                    <div class="settings-btns">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <button type="submit" class="btn btn-danger">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body pt-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Stripe</h5>
                            <div class="status-toggle d-flex justify-content-between align-items-center">
                                <input type="checkbox" id="status_2" class="check" checked="">
                                <label for="status_2" class="checktoggle">checkbox</label>
                            </div>
                        </div>
                        <form>
                            <div class="settings-form">
                                <div class="form-group">
                                    <p class="pay-cont">Stripe Option</p>
                                    <label class="custom_radio me-4">
                                        <input type="radio" name="budget" value="Yes" checked="">
                                        <span class="checkmark"></span> Sandbox
                                    </label>
                                    <label class="custom_radio">
                                        <input type="radio" name="budget" value="Yes">
                                        <span class="checkmark"></span> Live
                                    </label>
                                </div>
                                <div class="form-group form-placeholder">
                                    <label>Gateway Name <span class="star-red">*</span></label>
                                    <input type="text" class="form-control" placeholder="Stripe">
                                </div>
                                <div class="form-group form-placeholder">
                                    <label>API Key <span class="star-red">*</span></label>
                                    <input type="text" class="form-control"
                                        placeholder="pk_test_AealxxOygZz84AruCGadWvUV00mJQZdLvr">
                                </div>
                                <div class="form-group form-placeholder">
                                    <label>Rest Key <span class="star-red">*</span></label>
                                    <input type="text" class="form-control"
                                        placeholder="sk_test_8HwqAWwBd4C4E77bgAO1jUgk00hDlERgn3">
                                </div>
                                <div class="form-group mb-0">
                                    <div class="settings-btns">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <button type="submit" class="btn btn-danger">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div role="tabpanel" id="email_settings" class="tab-pane fade">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body pt-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title">PHP Mail</h5>
                            <div class="status-toggle d-flex justify-content-between align-items-center">
                                <input type="checkbox" id="status_1" class="check">
                                <label for="status_1" class="checktoggle">checkbox</label>
                            </div>
                        </div>
                        <form>
                            <div class="settings-form">
                                <div class="form-group form-placeholder">
                                    <label>Email From Address <span class="star-red">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group form-placeholder">
                                    <label>Email Password <span class="star-red">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group form-placeholder">
                                    <label>Emails From Name <span class="star-red">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group mb-0">
                                    <div class="settings-btns">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="submit" class="btn btn-danger">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body pt-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title">SMTP</h5>
                            <div class="status-toggle d-flex justify-content-between align-items-center">
                                <input type="checkbox" id="status_2" class="check" checked="">
                                <label for="status_2" class="checktoggle">checkbox</label>
                            </div>
                        </div>
                        <form>
                            <div class="settings-form">
                                <div class="form-group form-placeholder">
                                    <label>Email From Address <span class="star-red">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group form-placeholder">
                                    <label>Email Password <span class="star-red">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group form-placeholder">
                                    <label>Email Host <span class="star-red">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group form-placeholder">
                                    <label>Email Port <span class="star-red">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group mb-0">
                                    <div class="settings-btns">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="submit" class="btn btn-danger">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div role="tabpanel" id="social_media_login" class="tab-pane fade">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body pt-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Google Login Credential</h5>
                            <div class="status-toggle d-flex justify-content-between align-items-center">
                                <input type="checkbox" id="status_1" class="check" checked="">
                                <label for="status_1" class="checktoggle">checkbox</label>
                            </div>
                        </div>
                        <form>
                            <div class="settings-form">
                                <div class="form-group form-placeholder">
                                    <label>Client ID <span class="star-red">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group form-placeholder">
                                    <label>Client Secret <span class="star-red">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group mb-0">
                                    <div class="settings-btns">
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body pt-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Facebook</h5>
                            <div class="status-toggle d-flex justify-content-between align-items-center">
                                <input type="checkbox" id="status_2" class="check" checked="">
                                <label for="status_2" class="checktoggle">checkbox</label>
                            </div>
                        </div>
                        <form>
                            <div class="settings-form">
                                <div class="form-group form-placeholder">
                                    <label>App ID <span class="star-red">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group form-placeholder">
                                    <label>App Secret <span class="star-red">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group mb-0">
                                    <div class="settings-btns">
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body pt-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Twiter Login Credential</h5>
                            <div class="status-toggle d-flex justify-content-between align-items-center">
                                <input type="checkbox" id="status_3" class="check">
                                <label for="status_3" class="checktoggle">checkbox</label>
                            </div>
                        </div>
                        <form>
                            <div class="settings-form">
                                <div class="form-group form-placeholder">
                                    <label>Client ID <span class="star-red">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group form-placeholder">
                                    <label>Client Secret <span class="star-red">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group mb-0">
                                    <div class="settings-btns">
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div role="tabpanel" id="social_links" class="tab-pane fade">
        <div class="row">
            <div class="col-lg-6 col-md-8">
                <div class="card">
                    <div class="card-body pt-0">
                        <div class="card-header">
                            <h5 class="card-title">Social Link Settings</h5>
                        </div>
                        <form method="POST" action="{{ route('store_settings') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="settings-form pt-4">
                                <div class="links-info">
                                    <div class="row form-row links-cont">
                                        <div class="col-12 col-md-11">
                                            <div class="form-group form-placeholder d-flex">
                                                <button class="btn social-icon">
                                                    <i class="feather-facebook"></i>
                                                </button>
                                                <input type="text" id="facebook" name="facebook"
                                                    class="form-control" placeholder="https://www.facebook.com">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="links-info">
                                    <div class="row form-row links-cont">
                                        <div class="col-12 col-md-11">
                                            <div class="form-group form-placeholder d-flex">
                                                <button class="btn social-icon">
                                                    <i class="feather-twitter"></i>
                                                </button>
                                                <input type="text" id="twitter" name="twitter" class="form-control"
                                                    placeholder="https://www.twitter.com">
                                            </div>
                                        </div>
                                        {{-- <div class="col-12 col-md-1"> --}}
                                        {{-- <a href="#" class="btn trash"> --}}
                                        {{--                                                            <i class="feather-trash-2"></i> --}}
                                        {{--                                                        </a> --}}
                                        {{--                                                    </div> --}}
                                    </div>
                                </div>
                                <div class="links-info">
                                    <div class="row form-row links-cont">
                                        <div class="col-12 col-md-11">
                                            <div class="form-group form-placeholder d-flex">
                                                <button class="btn social-icon">
                                                    <i class="feather-youtube"></i>
                                                </button>
                                                <input type="text" class="form-control" id="youtube" name="youtube"
                                                    placeholder="https://www.youtube.com">
                                            </div>
                                        </div>
                                        {{--                                                    <div class="col-12 col-md-1"> --}}
                                        {{--                                                        <a href="#" class="btn trash"> --}}
                                        {{--                                                            <i class="feather-trash-2"></i> --}}
                                        {{--                                                        </a> --}}
                                        {{--                                                    </div> --}}
                                    </div>
                                </div>
                                <div class="links-info">
                                    <div class="row form-row links-cont">
                                        <div class="col-12 col-md-11">
                                            <div class="form-group form-placeholder d-flex">
                                                <button class="btn social-icon">
                                                    <i class="feather-linkedin"></i>
                                                </button>
                                                <input type="text" class="form-control" id="linkedin"
                                                    name="linkedin" placeholder="https://www.linkedin.com">
                                            </div>
                                        </div>
                                        {{--                                                    <div class="col-12 col-md-1"> --}}
                                        {{--                                                        <a href="#" class="btn trash"> --}}
                                        {{--                                                            <i class="feather-trash-2"></i> --}}
                                        {{--                                                        </a> --}}
                                        {{--                                                    </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="settings-btns">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="submit" class="btn btn-success">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div role="tabpanel" id="seo_settings" class="tab-pane fade">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body pt-0">
                        <div class="card-header">
                            <h5 class="card-title">SEO Settings</h5>
                        </div>
                        <form>
                            <div class="settings-form">
                                <div class="form-group form-placeholder">
                                    <label>Meta Title <span class="star-red">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Meta Keywords <span class="star-red">*</span></label>
                                    <div class="bootstrap-tagsinput"><span class="tag badge badge-info">Lorem<span
                                                data-role="remove"></span></span> <span
                                            class="tag badge badge-info">Ipsum<span data-role="remove"></span></span>
                                        <input type="text" placeholder="Meta Keywords">
                                    </div>
                                    <input type="text" data-role="tagsinput" class="input-tags form-control"
                                        placeholder="Meta Keywords" name="services" value="Lorem,Ipsum" id="services"
                                        style="display: none;">
                                </div>
                                <div class="form-group">
                                    <label>Meta Description <span class="star-red">*</span></label>
                                    <textarea class="form-control"></textarea>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="settings-btns">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="submit" class="btn btn-danger">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div role="tabpanel" id="others" class="tab-pane fade">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body pt-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Enable Google Analytics</h5>
                            <div class="status-toggle d-flex justify-content-between align-items-center">
                                <input type="checkbox" id="status_1" class="check" checked="">
                                <label for="status_1" class="checktoggle">checkbox</label>
                            </div>
                        </div>
                        <form>
                            <div class="settings-form">
                                <div class="form-group">
                                    <label>Google Analytics <span class="star-red">*</span></label>
                                    <textarea class="form-control" placeholder="Google Analytics"></textarea>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="settings-btns">
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body pt-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Enable Google Adsense Code</h5>
                            <div class="status-toggle d-flex justify-content-between align-items-center">
                                <input type="checkbox" id="status_2" class="check" checked="">
                                <label for="status_2" class="checktoggle">checkbox</label>
                            </div>
                        </div>
                        <form>
                            <div class="settings-form">
                                <div class="form-group">
                                    <label>Google Adsense Code <span class="star-red">*</span></label>
                                    <textarea class="form-control" placeholder="Google Adsense Code"></textarea>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="settings-btns">
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body pt-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Display Facebook Messenger</h5>
                            <div class="status-toggle d-flex justify-content-between align-items-center">
                                <input type="checkbox" id="status_3" class="check" checked="">
                                <label for="status_3" class="checktoggle">checkbox</label>
                            </div>
                        </div>
                        <form>
                            <div class="settings-form">
                                <div class="form-group">
                                    <label>Facebook Messenger <span class="star-red">*</span></label>
                                    <textarea class="form-control" placeholder="Facebook Messenger"></textarea>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="settings-btns">
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body pt-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Display Facebook Pixel</h5>
                            <div class="status-toggle d-flex justify-content-between align-items-center">
                                <input type="checkbox" id="status_4" class="check" checked="">
                                <label for="status_4" class="checktoggle">checkbox</label>
                            </div>
                        </div>
                        <form>
                            <div class="settings-form">
                                <div class="form-group">
                                    <label>Google Adsense Code <span class="star-red">*</span></label>
                                    <textarea class="form-control" placeholder="Google Adsense Code"></textarea>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="settings-btns">
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex">
                <div class="card w-100">
                    <div class="card-body pt-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Display Google Recaptcha</h5>
                            <div class="status-toggle d-flex justify-content-between align-items-center">
                                <input type="checkbox" id="status_5" class="check" checked="">
                                <label for="status_5" class="checktoggle">checkbox</label>
                            </div>
                        </div>
                        <form>
                            <div class="settings-form">
                                <div class="form-group form-placeholder">
                                    <label>Google Rechaptcha Site Key <span class="star-red">*</span></label>
                                    <input type="text" class="form-control"
                                        placeholder="6LcnPoEaAAAAAF6QhKPZ8V4744yiEnr41li3SYDn">
                                </div>
                                <div class="form-group form-placeholder">
                                    <label>Google Rechaptcha Secret Key <span class="star-red">*</span></label>
                                    <input type="text" class="form-control"
                                        placeholder="6LcnPoEaAAAAACV_xC4jdPqumaYKBnxz9Sj6y0zk">
                                </div>
                                <div class="form-group mb-0">
                                    <div class="settings-btns">
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex">
                <div class="card w-100">
                    <div class="card-body pt-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Cookies Agreement</h5>
                            <div class="status-toggle d-flex justify-content-between align-items-center">
                                <input type="checkbox" id="status_6" class="check" checked="">
                                <label for="status_6" class="checktoggle">checkbox</label>
                            </div>
                        </div>
                        <form>
                            <div class="settings-form">
                                <div class="form-group">
                                    <label>Cookies Agreement Text <span class="star-red">*</span></label>
                                    <div id="editor" style="display: none;"></div>
                                    <div class="ck ck-reset ck-editor ck-rounded-corners" role="application"
                                        dir="ltr" lang="en"
                                        aria-labelledby="ck-editor__label_e37cfed4bf341b0acccfbc2b92f5d3ce6">
                                        <label class="ck ck-label ck-voice-label"
                                            id="ck-editor__label_e37cfed4bf341b0acccfbc2b92f5d3ce6">Rich
                                            Text Editor</label>
                                        <div class="ck ck-editor__top ck-reset_all" role="presentation">
                                            <div class="ck ck-sticky-panel">
                                                <div class="ck ck-sticky-panel__placeholder" style="display: none;"></div>
                                                <div class="ck ck-sticky-panel__content">
                                                    <div class="ck ck-toolbar ck-toolbar_grouping" role="toolbar"
                                                        aria-label="Editor toolbar">
                                                        <div class="ck ck-toolbar__items">
                                                            <button class="ck ck-button ck-off" type="button"
                                                                tabindex="-1"
                                                                aria-labelledby="ck-editor__aria-label_e65c9003323ac0cb19395f321fc2499b4"
                                                                aria-pressed="false">
                                                                <svg class="ck ck-icon ck-button__icon"
                                                                    viewBox="0 0 20 20">
                                                                    <path
                                                                        d="M10.187 17H5.773c-.637 0-1.092-.138-1.364-.415-.273-.277-.409-.718-.409-1.323V4.738c0-.617.14-1.062.419-1.332.279-.27.73-.406 1.354-.406h4.68c.69 0 1.288.041 1.793.124.506.083.96.242 1.36.478.341.197.644.447.906.75a3.262 3.262 0 0 1 .808 2.162c0 1.401-.722 2.426-2.167 3.075C15.05 10.175 16 11.315 16 13.01a3.756 3.756 0 0 1-2.296 3.504 6.1 6.1 0 0 1-1.517.377c-.571.073-1.238.11-2 .11zm-.217-6.217H7v4.087h3.069c1.977 0 2.965-.69 2.965-2.072 0-.707-.256-1.22-.768-1.537-.512-.319-1.277-.478-2.296-.478zM7 5.13v3.619h2.606c.729 0 1.292-.067 1.69-.2a1.6 1.6 0 0 0 .91-.765c.165-.267.247-.566.247-.897 0-.707-.26-1.176-.778-1.409-.519-.232-1.31-.348-2.375-.348H7z">
                                                                    </path>
                                                                </svg>
                                                                <span class="ck ck-tooltip ck-tooltip_s"><span
                                                                        class="ck ck-tooltip__text">Bold
                                                                        (⌘B)</span></span><span class="ck ck-button__label"
                                                                    id="ck-editor__aria-label_e65c9003323ac0cb19395f321fc2499b4">Bold</span>
                                                            </button>
                                                            <button class="ck ck-button ck-off" type="button"
                                                                tabindex="-1"
                                                                aria-labelledby="ck-editor__aria-label_e616e568ab420b761484b2ca9754f5fa3"
                                                                aria-pressed="false">
                                                                <svg class="ck ck-icon ck-button__icon"
                                                                    viewBox="0 0 20 20">
                                                                    <path
                                                                        d="m9.586 14.633.021.004c-.036.335.095.655.393.962.082.083.173.15.274.201h1.474a.6.6 0 1 1 0 1.2H5.304a.6.6 0 0 1 0-1.2h1.15c.474-.07.809-.182 1.005-.334.157-.122.291-.32.404-.597l2.416-9.55a1.053 1.053 0 0 0-.281-.823 1.12 1.12 0 0 0-.442-.296H8.15a.6.6 0 0 1 0-1.2h6.443a.6.6 0 1 1 0 1.2h-1.195c-.376.056-.65.155-.823.296-.215.175-.423.439-.623.79l-2.366 9.347z">
                                                                    </path>
                                                                </svg>
                                                                <span class="ck ck-tooltip ck-tooltip_s"><span
                                                                        class="ck ck-tooltip__text">Italic
                                                                        (⌘I)</span></span><span class="ck ck-button__label"
                                                                    id="ck-editor__aria-label_e616e568ab420b761484b2ca9754f5fa3">Italic</span>
                                                            </button>
                                                            <button class="ck ck-button ck-off" type="button"
                                                                tabindex="-1"
                                                                aria-labelledby="ck-editor__aria-label_ef369f5f673db290b0929ce601ce6288f"
                                                                aria-pressed="false">
                                                                <svg class="ck ck-icon ck-button__icon"
                                                                    viewBox="0 0 20 20">
                                                                    <path
                                                                        d="m11.077 15 .991-1.416a.75.75 0 1 1 1.229.86l-1.148 1.64a.748.748 0 0 1-.217.206 5.251 5.251 0 0 1-8.503-5.955.741.741 0 0 1 .12-.274l1.147-1.639a.75.75 0 1 1 1.228.86L4.933 10.7l.006.003a3.75 3.75 0 0 0 6.132 4.294l.006.004zm5.494-5.335a.748.748 0 0 1-.12.274l-1.147 1.639a.75.75 0 1 1-1.228-.86l.86-1.23a3.75 3.75 0 0 0-6.144-4.301l-.86 1.229a.75.75 0 0 1-1.229-.86l1.148-1.64a.748.748 0 0 1 .217-.206 5.251 5.251 0 0 1 8.503 5.955zm-4.563-2.532a.75.75 0 0 1 .184 1.045l-3.155 4.505a.75.75 0 1 1-1.229-.86l3.155-4.506a.75.75 0 0 1 1.045-.184z">
                                                                    </path>
                                                                </svg>
                                                                <span class="ck ck-tooltip ck-tooltip_s"><span
                                                                        class="ck ck-tooltip__text">Link
                                                                        (⌘K)</span></span><span class="ck ck-button__label"
                                                                    id="ck-editor__aria-label_ef369f5f673db290b0929ce601ce6288f">Link</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ck ck-editor__main" role="presentation">
                                            <div class="ck-blurred ck ck-content ck-editor__editable ck-rounded-corners ck-editor__editable_inline"
                                                lang="en" dir="ltr" role="textbox"
                                                aria-label="Rich Text Editor, main" contenteditable="true">
                                                <p><br data-cke-filler="true"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="settings-btns">
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    </div>
    </div>
    <!-- /Page Wrapper -->
    </div>
    <!-- /Main Wrapper -->
@endsection
{{-- CKEditor 5 --}}
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        ClassicEditor
            .create(document.querySelector('#privacy_policy_en'))
            .catch(error => console.error(error));

        ClassicEditor
            .create(document.querySelector('#privacy_policy_ar'))
            .catch(error => console.error(error));
    });
</script>

