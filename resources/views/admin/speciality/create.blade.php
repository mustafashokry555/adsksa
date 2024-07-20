@extends('layout.mainlayout_admin')
@section('title', 'Specialities')
@section('content')
    <div class="page-wrapper">

        <!-- Specialities -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ __('admin.speciality.add_speciality') }}</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('speciality.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="name_en"
                                    class="col-form-label col-md-2">{{ __('admin.speciality.speciality_name_en') }}</label>
                                <div class="col-md-10">
                                    <input id="name_en" name="name_en" type="text" class="form-control"
                                        placeholder="{{ __('admin.speciality.enter_speciality_name_en') }}" required>
                                    @error('name_en')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name_ar"
                                    class="col-form-label col-md-2">{{ __('admin.speciality.speciality_name_ar') }}</label>
                                <div class="col-md-10">
                                    <input id="name_ar" name="name_ar" type="text" class="form-control"
                                        placeholder="{{ __('admin.speciality.enter_speciality_name_ar') }}" required>
                                    @error('name_ar')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="image"
                                    class="col-form-label col-md-2">{{ __('admin.speciality.image') }}</label>
                                <div class="col-md-10">
                                    <input id="image" name="image" class="form-control" type="file" required>
                                    @error('image')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-primary btn-add"><i
                                    class="feather-plus-square me-1"></i>{{ __('admin.speciality.add_speciality_btn') }}

                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Specialities -->
    </div>
    </div>
    <!-- /Page Wrapper -->
    </div>
    <!-- /Main Wrapper -->

@endsection
