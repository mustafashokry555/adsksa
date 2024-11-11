@extends('layout.mainlayout_admin')
@section('title', 'Edit Banner')
@section('content')
    <div class="page-wrapper">

        <!-- Banner -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Edit Banner</h5>
                    </div>
                    <div class="card-body">
                        @if (session()->has('flash'))
                            <x-alert>{{ session('flash')['message'] }}</x-alert>
                        @endif
                        <form method="POST" action="{{ route('banner.update', $banner) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <!-- Subject -->
                            <div class="form-group row">
                                <label for="subject_en" class="col-form-label col-md-2">Subject EN</label>
                                <div class="col-md-10">
                                    <input id="subject_en" name="subject_en" type="text" class="form-control"
                                        placeholder="Subject" value="{{ $banner->subject_en }}" required>
                                    @error('subject_en')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="subject_ar" class="col-form-label col-md-2">Subject AR</label>
                                <div class="col-md-10">
                                    <input id="subject_ar" name="subject_ar" type="text" class="form-control"
                                        placeholder="Subject" value="{{ $banner->subject_ar }}" required>
                                    @error('subject_ar')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- hospital -->
                            <div class="form-group row">
                                <label for="hospital_id"
                                    class="col-form-label col-md-2">{{ __('admin.doctor.hospital') }}</label>
                                <div class="col-md-10">
                                    <select id="hospital_id" name="hospital_id" class="form-select select" required>
                                        <option value="">-- Select Hospital --</option>
                                        @foreach ($hospitals as $hospital)
                                            <option value="{{ $hospital->id }}"
                                                {{ old('hospital_id', $banner->hospital_id) == $hospital->id ? 'selected' : '' }}>
                                                {{ $hospital->hospital_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('hospital_id')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <!-- Active Status -->
                                <div class="form-group col-md-6 row">
                                    <label for="is_active" class="col-form-label col-md-4">Active Status</label>
                                    <div class="col-md-8">
                                        <select id="is_active" name="is_active" class="form-select" required>
                                            <option value="">-- Select Gender --</option>
                                            <option value="1" {{ old('is_active', $banner->is_active) == '1' ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="0" {{ old('is_active', $banner->is_active) == '0' ? 'selected' : '' }}>
                                                In Active
                                            </option>
                                        </select>
                                        @error('is_active')
                                            <div class="text-danger pt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Expire Date -->
                                <div class="form-group col-md-6 row">
                                    <label for="expired_at" class="col-form-label col-md-4">Expire Date</label>
                                    <div class="col-md-8">
                                        <input id="expired_at" 
                                            value="{{ \Carbon\Carbon::parse($banner->expired_at)->format('Y-m-d') }}"
                                            name="expired_at" type="date" class="form-control" required>
                                        @error('expired_at')
                                            <div class="text-danger pt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- Banner Image -->
                            <div class="form-group row">
                                <label for="image"
                                    class="col-form-label col-md-2">Banner Image</label>
                                <div class="col-md-10">
                                    <input id="image" name="image" class="form-control" type="file">
                                    @error('image')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-primary btn-add"><i class="feather-plus-square me-1"></i>
                                Add Banner
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Banner -->
    </div>
    </div>
    <!-- /Page Wrapper -->
    </div>
    <!-- /Main Wrapper -->

@endsection
