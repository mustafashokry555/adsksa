<?php $page = 'index-13'; ?>
@extends('layout.mainlayout_index1')
@section('title', 'Delete Profile')
@section('content')
    <!-- Header -->
    @include('components.patient_header')
    <!-- /Header -->

    <div class="row align-items-center mt-4">

    </div>
    </div>
    </section>
    <!-- /Home Banner -->
    <section class="edit-profile">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @include('layout.partials.nav_patient')
                    <div class="col-md-7 col-lg-8 col-xl-9">
                        @if (session()->has('flash'))
                            <x-alert>{{ session('flash')['message'] }}</x-alert>
                        @endif
                        <div class="container">
                            <!-- Profile Information -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm">
                                        <form method="POST" action="{{ route('delete.account') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            {{-- @method('patch') --}}
                                            <!-- Basic -->
                                            <div class="col-md-12">
                                                <div class="pro-title d-flex justify-content-between">
                                                    <h6>Delete Profile</h6>
                                                </div>
                                            </div>
                                            {{-- <div class="form-row row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        placeholder="name" value="{{ $patient->name }}" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="email">Email</label>
                                                    <input type="text" class="form-control" id="email" name="email"
                                                        placeholder="email" value="{{ $patient->email }}" required>
                                                </div>
                                                @if ($patient->username ?? '')
                                                    <div class="col-md-4 mb-3">
                                                        <label for="username">Username</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text" id="username">@</span>
                                                            <input type="text" disabled class="form-control"
                                                                id="username" name="username" placeholder="Username"
                                                                value="{{ $patient->username }}" required>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="col-md-4 mb-3">
                                                        <label for="username">Username</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text" id="username">@</span>
                                                            <input type="text" class="form-control" id="username"
                                                                name="username" placeholder="Username">
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="col-md-4 mb-3">
                                                    <label for="mobile">Phone number</label>
                                                    <input type="tel" class="form-control" id="mobile" name="mobile"
                                                        placeholder="+12345678" value="{{ $patient->mobile }}" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="profile_image">Profile Image</label>
                                                    <input id="profile_image" name="profile_image" class="form-control"
                                                        type="file">
                                                </div>
                                            </div> --}}
                                            <!-- Description -->
                                            {{-- <div class="form-row row">
                                                <label for="description" class="col-form-label col-md-2">Description</label>
                                                <div class="col-md-12 mb-3">
                                                    <textarea rows="5" cols="5" id="description" name="description" class="form-control"
                                                        placeholder="Enter text here" value="{{ $patient->description }}" required>{{ $patient->description }}</textarea>
                                                </div>
                                            </div> --}}
                                            {{-- <!-- Personal Info -->
                                            <div class="form-row row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="date_of_birth">Date of birth</label>
                                                    <input type="date" class="form-control" id="date_of_birth"
                                                        name="date_of_birth" placeholder="date_of_birth"
                                                        value="{{ $patient->date_of_birth }}" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="gender">Gender</label>
                                                    <div class="col-md-10">
                                                        <select id="gender" name="gender" class="form-select select">
                                                            <option>-- Select Gender --</option>
                                                            <option value="M"
                                                                {{ $patient->gender == 'M' ? 'selected' : '' }}>
                                                                Male
                                                            </option>
                                                            <option value="F"
                                                                {{ $patient->gender == 'F' ? 'selected' : '' }}>
                                                                Female
                                                            </option>
                                                            <option value="O"
                                                                {{ $patient->gender == 'O' ? 'selected' : '' }}>
                                                                Others
                                                            </option>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="age">Age</label>
                                                    <input type="number" class="form-control" id="age"
                                                        name="age" placeholder="Enter you age"
                                                        value="{{ $patient->age }}" required>
                                                </div>
                                            </div>
                                            <!-- Address -->
                                            <div class="form-row row">
                                                <div class="col-md-12 mb-3">
                                                    <label for="address">Address</label>
                                                    <input type="text" class="form-control" id="address"
                                                        name="address" placeholder="Address"
                                                        value="{{ $patient->address }}" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="country">Country</label>
                                                    <input type="text" class="form-control" id="country"
                                                        placeholder="Country" name="country"
                                                        value="{{ $patient->country }}" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="state">State</label>
                                                    <input type="text" class="form-control" id="state"
                                                        name="state" placeholder="State" value="{{ $patient->state }}" 
                                                        required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="zip_code">Zip Code</label>
                                                    <input type="text" class="form-control" id="zip_code"
                                                        name="zip_code" placeholder="Zip Code"
                                                        value="{{ $patient->zip_code }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="pro-title">
                                                    <h6>Social media links</h6>
                                                    <p>Please provide correct links to make you accessible.</p>
                                                </div>
                                            </div>
                                            <div class="form-row row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="twitter">Twitter Profile Link</label>
                                                    <input type="url" class="form-control" id="twitter"
                                                        name="twitter" placeholder="https://www.twitter.com/"
                                                        value="{{ $patient->twitter }}">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="facebook">Facebook Profile link</label>
                                                    <input type="url" class="form-control" id="facebook"
                                                        name="facebook" placeholder="https://www.facebook.com/"
                                                        value="{{ $patient->facebook }}">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="linkedin">Linkedin Profile link</label>
                                                    <input type="url" class="form-control" id="linkedin"
                                                        name="linkedin" placeholder="https://www.linkedn.com/"
                                                        value="{{ $patient->linkedin }}">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="instagram">Instagram Profile link</label>
                                                    <input type="url" class="form-control" id="instagram"
                                                        name="instagram" placeholder="https://www.instagram.com/"
                                                        value="{{ $patient->instagram }}">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="youtube">Youtube link</label>
                                                    <input type="url" class="form-control" id="youtube"
                                                        name="youtube" placeholder="https://www.youbute.com/"
                                                        value="{{ $patient->youtube }}">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="pinterest">Pinterest link</label>
                                                    <input type="url" class="form-control" id="pinterest"
                                                        name="pinterest" placeholder="https://www.pinterest.com/"
                                                        value="{{ $patient->pinterest }}">
                                                </div>
                                            </div> --}}
                                            <div class="form-group form-focus">
                                                <input type="password" class="form-control floating" name="password" id="password">
                                                <label class="focus-label">Enter Password</label>
                                                <span class="fa fa-eye-slash toggle-password pt-4"></span>
                                                @error('password')
                                                    <div class="text-danger pt-2">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                            </div>
        
                                            <div class="form-group form-focus">
                                                <input type="text" class="form-control floating" name="confirmation" id="confirmation">
                                                <label class="focus-label">Type DELETE To Confirm</label>
                                                @error('confirmation')
                                                    <div class="text-danger pt-2">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                            </div>
                                            <button class="btn btn-danger" type="submit">Delete Profile</button>
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
    </section>
    <!-- /Page Content -->

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Password visibility toggle
        const togglePassword = document.querySelector('.toggle-password');
        const password = document.querySelector('#password');
        
        if (togglePassword && password) {
            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        }
    });
</script>