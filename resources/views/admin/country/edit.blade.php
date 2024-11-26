@extends('layout.mainlayout_admin')
@section('title', 'Edit Country')
@section('content')
    <div class="page-wrapper">

        <!-- Country -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Edit Country</h5>
                    </div>
                    <div class="card-body">
                        @if (session()->has('flash'))
                            <x-alert>{{ session('flash')['message'] }}</x-alert>
                        @endif
                        <form method="POST" action="{{ route('countries.update', $country) }}" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <!-- Name -->
                            <div class="form-group row">
                                <label for="name_en"
                                    class="col-form-label col-md-2">Name EN</label>
                                <div class="col-md-10">
                                    <input id="name_en" name="name_en" type="text"
                                        value="{{ old('name_en', $country->name_en) }}" class="form-control"
                                        placeholder="Enter Name EN" required>
                                    @error('name_en')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name_ar"
                                    class="col-form-label col-md-2">Name AR</label>
                                <div class="col-md-10">
                                    <input id="name_ar" name="name_ar" type="text"
                                        value="{{ old('name_ar', $country->name_ar) }}" class="form-control"
                                        placeholder="Enter Name AR" required>
                                    @error('name_ar')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="code"
                                    class="col-form-label col-md-2">Country Code</label>
                                <div class="col-md-10">
                                    <input id="code" name="code" type="text"
                                        value="{{ old('code', $country->code) }}" class="form-control"
                                        placeholder="Enter Country Code" required>
                                    @error('code')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-primary btn-add"><i
                                    class="feather-plus-square me-1"></i>Update Country Details</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Country -->
    </div>
    </div>
    <!-- /Page Wrapper -->
    </div>
    <!-- /Main Wrapper -->

@endsection
