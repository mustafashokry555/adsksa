@extends('layout.mainlayout_hospital')
@section('title', 'Edit Offers')

@section('content')
    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Edit Offer</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('offers.update', $offer) }}" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            {{-- Title --}}
                            <div class="form-group row">
                                <label for="title_en" class="col-form-label col-md-2">Title EN</label>
                                <div class="col-md-10">
                                    <input id="title_en" name="title_en" value="{{ $offer->title_en ?? old('title_en') }}"
                                        type="text" class="form-control" placeholder="Title EN" required>
                                    @error('title_en')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="title_ar" class="col-form-label col-md-2">Title AR</label>
                                <div class="col-md-10">
                                    <input id="title_ar" value="{{ $offer->title_ar ?? old('title_ar') }}" name="title_ar"
                                        type="text" class="form-control" placeholder="Titel AR" required>
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
                                    <textarea id="content_en" name="content_en" type="text" class="form-control" placeholder="Content EN">{{ $offer->content_en }}</textarea>
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
                                    <textarea id="content_ar" name="content_ar" type="text" class="form-control" placeholder="Content AR">{{ $offer->content_ar }}</textarea>
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
                                        <input id="start_date" value="{{ old('start_date', $offer->start_date) }}" name="start_date" type="date" class="form-control" required>
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
                                        <input id="end_date" value="{{ old('end_date', $offer->end_date) }}" name="end_date" type="date" class="form-control" required>
                                        @error('end_date')
                                            <div class="text-danger pt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            {{-- type --}}
                            <div class="form-group row">
                                <label for="hopital_id" class="col-form-label col-md-2">Type</label>
                                <div class="col-md-10">
                                    <select id="type" name="type" class="form-control" required>
                                        <option value="" disabled selected>Select Type</option>
                                        <option value="image"
                                            {{ old('type', $offer->type) == 'image' ? 'selected' : '' }}>
                                            Image</option>
                                        <option value="video"
                                            {{ old('type', $offer->type) == 'video' ? 'selected' : '' }}>
                                            Video</option>
                                    </select>
                                    @error('type')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- is Active --}}
                            {{-- <div class="form-group row">
                                <label for="is_active" class="col-form-label col-md-2">Status</label>
                                <div class="col-md-10">
                                    <select id="is_active" name="is_active" class="form-control" required>
                                        <option value="" disabled selected>Offer Status</option>
                                        <option value="0"
                                            {{ old('is_active', $offer->is_active) == false ? 'selected' : '' }}>
                                            Not Active</option>
                                        <option value="1"
                                            {{ old('is_active', $offer->is_active) == true ? 'selected' : '' }}>
                                            Active</option>
                                    </select>
                                    @error('type')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div> --}}

                            <!-- videolink -->
                            <div class="form-group row">
                                <label for="facebook" class="col-form-label col-md-2">Video Link</label>
                                <div class="col-md-10">
                                    <input id="video_link" name="video_link"
                                        value="{{ $offer->video_link ?? old('video_link') }}" type="text"
                                        class="form-control" placeholder="Video Link">
                                    @error('video_link')
                                        <div class="text-danger pt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Display existing images -->
                            <div class="form-group row">
                                <label for="existing_images" class="col-form-label col-md-2">Offer Images</label>
                                <div class="col-md-10">
                                    @if ($offer->images)
                                        @foreach ($offer->images as $index => $image)
                                            <div class="d-inline-block position-relative" id="image-{{ $index }}">
                                                <img src="{{ $offer->images[$index] }}" alt="Profile Image"
                                                    class="img-thumbnail"
                                                    style="width: 150px; height: 150px; margin-right: 10px;">
                                                <button type="button"
                                                    class="btn btn-danger btn-sm position-absolute top-0 end-0"
                                                    onclick="removeImage({{ $index }}, '{{ $image }}')">X</button>
                                            </div>
                                        @endforeach
                                    @else
                                        <p>No Images Found</p>
                                    @endif
                                </div>
                            </div>
                            <!-- JavaScript for removing images -->
                            <script>
                                function removeImage(index, image) {
                                    if (confirm("Are you sure you want to delete this image?")) {
                                        // Add the image to the hidden field for deletion
                                        document.getElementById('deletedImages').value += image + ',';

                                        // Remove the image from the DOM
                                        var imageElement = document.getElementById('image-' + index);
                                        if (imageElement) {
                                            imageElement.remove();
                                        }
                                    }
                                }
                            </script>
                            <input type="hidden" id="deletedImages" name="deletedImages" value="">
                            <!-- Upload new images -->
                            <div class="form-group row">
                                <label for="profile_images" class="col-form-label col-md-2">Images</label>
                                <div class="col-md-10">
                                    <input id="profile_images" name="images[]" class="form-control" type="file"
                                        multiple>
                                    @error('profile_images')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <button class="btn btn-primary btn-add"><i class="feather-plus-square me-1"></i>
                                Update Offer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>

    </div>

    </div>
    <!-- /Page Content -->
    </div>
@endsection
