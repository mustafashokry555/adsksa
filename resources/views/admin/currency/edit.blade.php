@extends('layout.mainlayout_admin')
@section('title', 'Edit Currency')
@section('content')
    <div class="page-wrapper">

        <!-- Specialities -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Edit Currency</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('currency.update', $currency) }}" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <!-- Name -->
                            <div class="form-group row">
                                <label for="name_en"
                                    class="col-form-label col-md-2">Name (EN)</label>
                                <div class="col-md-10">
                                    <input id="name_en" name="name_en" type="text" value="{{ $currency->name_en }}"
                                        class="form-control" placeholder="Name EN"
                                        required>
                                    @error('name_en')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name_ar"
                                    class="col-form-label col-md-2">Name (AR)</label>
                                <div class="col-md-10">
                                    <input id="name_ar" name="name_ar" type="text" value="{{ $currency->name_ar }}"
                                        class="form-control" placeholder="Name AR"
                                        required>
                                    @error('name_ar')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Code -->
                            <div class="form-group row">
                                <label for="code_en"
                                    class="col-form-label col-md-2">Code (EN)</label>
                                <div class="col-md-10">
                                    <input id="code_en" name="code_en" type="text" value="{{ $currency->code_en }}"
                                        class="form-control" placeholder="Code EN"
                                        required>
                                    @error('code_en')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Code -->
                            <div class="form-group row">
                                <label for="code_ar"
                                    class="col-form-label col-md-2">Code (AR)</label>
                                <div class="col-md-10">
                                    <input id="code_ar" name="code_ar" type="text" value="{{ $currency->code_ar }}"
                                        class="form-control" placeholder="Code EN"
                                        required>
                                    @error('code_ar')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!--  Image -->
                            <div class="form-group row">
                                <label for="icon"
                                    class="col-form-label col-md-2">Icon</label>
                                <div class="col-md-10">
                                    <input id="icon" name="icon" class="form-control" type="file"
                                        >
                                    @error('icon')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <button class="btn btn-primary btn-add"><i class="feather-plus-square me-1"></i>
                                Update Currency
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
