@extends('layout.mainlayout_admin')
@section('title', 'Add New Offer')
@section('content')
    <div class="page-wrapper">

        <!-- offer -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Add Offer</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('offers.store') }}" enctype="multipart/form-data">
                            @csrf

                            {{-- Title --}}
                            <div class="form-group row">
                                <label for="title_en"
                                    class="col-form-label col-md-2">Title EN</label>
                                <div class="col-md-10">
                                    <input id="title_en" name="title_en" value="{{ old('title_en') }}" type="text" class="form-control"
                                        placeholder="Title EN" required>
                                    @error('title_en')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="title_ar"
                                    class="col-form-label col-md-2">Title AR</label>
                                <div class="col-md-10">
                                    <input id="title_ar" value="{{ old('title_ar') }}" name="title_ar" type="text" class="form-control"
                                        placeholder="Titel AR" required>
                                    @error('title_ar')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Content --}}
                            <div class="form-group row">
                                <label for="content_en" class="col-form-label col-md-2">Content EN</label>
                                <div class="col-md-10">
                                    <textarea id="content_en" name="content_en" type="text" class="form-control" placeholder="Content EN"></textarea>
                                    @error('content_en')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group row">
                                <label for="content_ar" class="col-form-label col-md-2">Content AR</label>
                                <div class="col-md-10">
                                    <textarea id="content_ar" name="content_ar" type="text" class="form-control" placeholder="Content AR"></textarea>
                                    @error('content_ar')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>

                            {{-- start and end date --}}
                            <div class="row">
                                <div class="form-group col-md-6 row">
                                    <label for="start_date" class="col-form-label col-md-4">Sart Date</label>
                                    <div class="col-md-8">
                                        <input id="start_date" name="start_date" type="date" class="form-control" required>
                                        @error('start_date')
                                            <div class="text-danger pt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-6 row">
                                    <label for="end_date" class="col-form-label col-md-4">End Date</label>
                                    <div class="col-md-8">
                                        <input id="end_date" name="end_date" type="date" class="form-control" required>
                                        @error('end_date')
                                            <div class="text-danger pt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="offer_type_id"
                                    class="col-form-label col-md-2">Offer Type</label>
                                <div class="col-md-10">
                                    <select id="offer_type_id" name="offer_type_id" class="form-select select" required>
                                        <option value="">-- Select Offer Type --</option>
                                        @foreach ($offerTypes as $type)
                                            <option value="{{ $type->id }}">{{ $type->name_en }} < {{ $type->name_ar }} ></option>
                                        @endforeach
                                    </select>
                                    @error('offer_type_id')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- old price --}}
                            <div class="form-group row">
                                <label for="old_price" class="col-form-label col-md-2">Old Price</label>
                                <div class="col-md-10">
                                    <input id="old_price" name="old_price" value="{{ old('old_price') }}" type="number" step="0.01" class="form-control" placeholder="Offer Old Price">
                                    @error('old_price')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- price --}}
                            <div class="form-group row">
                                <label for="price" class="col-form-label col-md-2">Price</label>
                                <div class="col-md-10">
                                    <input id="price" name="price" value="{{ old('price') }}" type="number" step="0.01" class="form-control" placeholder="Offer Price" required>
                                    @error('price')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            {{-- hospital --}}
                            @if ($hospitals)
                                <div class="form-group row">
                                    <label for="hospital_id" class="col-form-label col-md-2">Hospital</label>
                                    <div class="col-md-10">
                                        <select id="hospital_id" name="hospital_id" class="form-control" required>
                                            <option value="" disabled selected>Select Hospital</option>
                                            @foreach ($hospitals as $hospital)
                                                <option value="{{ $hospital->id }}">{{ $hospital->hospital_name_en }} < {{ $hospital->hospital_name_ar }} ></option>
                                            @endforeach
                                        </select>
                                        @error('hopital_id')
                                            <div class="text-danger pt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            @endif

                            {{-- type --}}
                            <div class="form-group row">
                                <label for="hopital_id" class="col-form-label col-md-2">Type</label>
                                <div class="col-md-10">
                                    <select id="type" name="type" class="form-control" required>
                                        <option value="" disabled selected>Select Type</option>
                                        <option value="image">Image</option>
                                        <option value="video">Video</option>
                                    </select>
                                    @error('type')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- videolink -->
                            <div class="form-group row">
                                <label for="facebook" class="col-form-label col-md-2">Video Link</label>
                                <div class="col-md-10">
                                    <input id="video_link" name="video_link" value="{{ old('video_link') }}"
                                        type="text" class="form-control" placeholder="Video Link">
                                    @error('video_link')
                                        <div class="text-danger pt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- images -->
                            <div class="form-group row">
                                <label for="images" class="col-form-label col-md-2">Images</label>
                                <div class="col-md-10">
                                    <input id="images" name="images[]" class="form-control" type="file" multiple>
                                    @error('images')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <button class="btn btn-primary btn-add"><i
                                    class="feather-plus-square me-1"></i>Add Offer</button>
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


<script src="{{ asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
