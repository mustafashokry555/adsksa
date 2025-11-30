@extends('layout.mainlayout_admin')
@section('title', 'Edit Hospital')
@section('content')

    <div class="page-wrapper">

        <!-- Specialities -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Edit Offer</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('offers.update', $offer->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            {{-- Title --}}
                            <div class="form-group row">
                                <label for="title_en"
                                    class="col-form-label col-md-2">Title EN</label>
                                <div class="col-md-10">
                                    <input id="title_en" name="title_en" value="{{ $offer->title_en ?? old('title_en') }}" type="text" class="form-control"
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
                                    <input id="title_ar" value="{{ $offer->title_ar ??old('title_ar') }}" name="title_ar" type="text" class="form-control"
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

                            <div class="form-group row">
                                <label for="offer_type_id"
                                    class="col-form-label col-md-2">Offer Type</label>
                                <div class="col-md-10">
                                    <select id="offer_type_id" name="offer_type_id" class="form-select select" required>
                                        <option value="">-- Select Offer Type --</option>
                                        @foreach ($offerTypes as $type)
                                            <option value="{{ $type->id }}" {{ old('offer_type_id', $offer->offer_type_id) == $type->id ? 'selected' : '' }}>
                                                {{ $type->name_en }} < {{ $type->name_ar }} ></option>
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
                                    <input id="old_price" name="old_price" value="{{ old('old_price', $offer->old_price) }}"
                                        type="number" step="0.01" class="form-control" placeholder="Offer Old Price">
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
                                    <input id="price" name="price" value="{{ old('price', $offer->price) }}" type="number" step="0.01" class="form-control" placeholder="Offer Price" required>
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
                                                <option value="{{ $hospital->id }}"
                                                    {{ old('hospital_id', $offer->hospital_id) == $hospital->id ? 'selected' : '' }}>
                                                    {{ $hospital->hospital_name_en }} < {{ $hospital->hospital_name_ar }} ></option>
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
                            <div class="form-group row">
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
                            </div>

                            <!-- videolink -->
                            <div class="form-group row">
                                <label for="facebook" class="col-form-label col-md-2">Video Link</label>
                                <div class="col-md-10">
                                    <input id="video_link" name="video_link" value="{{ $offer->video_link ?? old('video_link') }}"
                                        type="text" class="form-control" placeholder="Video Link">
                                    @error('video_link')
                                        <div class="text-danger pt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Display existing images -->
                            <div class="form-group row">
                                <label for="existing_images" class="col-form-label col-md-2">Offer Images</label>
                                <div class="col-md-10">
                                    @if($offer->images)
                                        @foreach($offer->images as $index => $image)
                                            <div class="d-inline-block position-relative" id="image-{{ $index }}">
                                                <img src="{{ $offer->images[$index] }}" alt="Profile Image" class="img-thumbnail" style="width: 150px; height: 150px; margin-right: 10px;">
                                                <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0" onclick="removeImage({{ $index }}, '{{ $image }}')">X</button>
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
                                    <input id="profile_images" name="images[]" class="form-control" type="file" multiple>
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

            <div class="col-md-12">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="card-title">{{ __('admin.doctor.doctor_schedule') }}</h5>
                            </div>
                            <div class="col-auto d-flex">
                                <ul role="tablist" class="nav nav-pills card-header-pills float-end">
                                    <li class="nav-item" role="presentation">
                                        <a href="#regular-avail" data-bs-toggle="tab" class="nav-link active"
                                            aria-selected="true"
                                            role="tab">{{ __('admin.doctor.regular_availability') }}</a>
                                    </li>
                                    <!-- <li class="nav-item" role="presentation">
                                        <a href="#onetime-avail" data-bs-toggle="tab" class="nav-link" aria-selected="false" role="tab" tabindex="-1">One-time Availability</a>
                                    </li> -->
                                    <li class="nav-item" role="presentation">
                                        <a href="#unavail" data-bs-toggle="tab" class="nav-link" aria-selected="false"
                                            tabindex="-1" role="tab">{{ __('admin.doctor.unavailability') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content pt-0">
                            <div role="tabpanel" id="regular-avail" class="tab-pane fade active show">
                                <div class="profile-box">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card schedule-widget mb-0">

                                                <!-- Schedule Header -->
                                                <div class="schedule-header">

                                                    <!-- Schedule Nav -->
                                                    <div class="schedule-nav">
                                                        <ul class="nav nav-tabs nav-tabs-solid nav-justified"
                                                            role="tablist">
                                                            <li class="nav-item" role="presentation">
                                                                <a class="nav-link" data-bs-toggle="tab"
                                                                    href="#slot_sunday" aria-selected="false"
                                                                    tabindex="-1"
                                                                    role="tab">{{ __('admin.doctor.sunday') }}</a>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <a class="nav-link active" data-bs-toggle="tab"
                                                                    href="#slot_monday" aria-selected="true"
                                                                    role="tab">{{ __('admin.doctor.monday') }}</a>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <a class="nav-link" data-bs-toggle="tab"
                                                                    href="#slot_tuesday" aria-selected="false"
                                                                    tabindex="-1"
                                                                    role="tab">{{ __('admin.doctor.tuesday') }}</a>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <a class="nav-link" data-bs-toggle="tab"
                                                                    href="#slot_wednesday" aria-selected="false"
                                                                    tabindex="-1"
                                                                    role="tab">{{ __('admin.doctor.wednesday') }}</a>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <a class="nav-link" data-bs-toggle="tab"
                                                                    href="#slot_thursday" aria-selected="false"
                                                                    tabindex="-1"
                                                                    role="tab">{{ __('admin.doctor.thursday') }}</a>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <a class="nav-link" data-bs-toggle="tab"
                                                                    href="#slot_friday" aria-selected="false"
                                                                    tabindex="-1"
                                                                    role="tab">{{ __('admin.doctor.friday') }}</a>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <a class="nav-link" data-bs-toggle="tab"
                                                                    href="#slot_saturday" aria-selected="false"
                                                                    tabindex="-1"
                                                                    role="tab">{{ __('admin.doctor.saturday') }}</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- /Schedule Nav -->

                                                </div>
                                                <!-- /Schedule Header -->

                                                <!-- Schedule Content -->
                                                <div class="tab-content schedule-cont p-5">

                                                    <!-- Sunday Slot -->
                                                    <div id="slot_sunday" class="tab-pane fade" role="tabpanel">
                                                        @php
                                                            $sundaySlots = $offer->regularAvailabilities->firstWhere(
                                                                'week_day',
                                                                'sunday',
                                                            );
                                                        @endphp
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            <span>Time Slots</span>
                                                            <div>
                                                                @if ($sundaySlots)
                                                                    <a class="edit-link"
                                                                        href="{{ route('hospital.offer-schedule.regular.edit', ['offer' => $offer, 'week_day' => 'sunday']) }}">
                                                                        <i class="fa fa-edit me-1"></i>Edit
                                                                    </a>
                                                                    <a class="text-danger" href=""
                                                                        onclick="event.preventDefault();document.getElementById('clear_sun').submit();">
                                                                        <i class="fa fa-trash me-1"></i>Clear All
                                                                    </a>
                                                                    <form
                                                                        action="{{ route('hospital.offer-schedule.regular.destroy', ['offer' => $offer, 'week_day' => 'sunday']) }}"
                                                                        id="clear_sun" method="POST">@csrf</form>
                                                                @else
                                                                    <a class="edit-link"
                                                                        href="{{ route('hospital.offer-schedule.regular', ['offer' => $offer, 'week_day' => 'sunday']) }}">
                                                                        <i class="fa fa-plus-circle"></i> Add Slot
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </h4>
                                                        @if ($sundaySlots)
                                                            <!-- Slot List -->
                                                            <div class="doc-times">
                                                                @foreach ($sundaySlots->slots as $slot)
                                                                    <button type="button"
                                                                        class="btn mx-1 btn-sm btn-outline-secondary">{{ date('h:i A', strtotime($slot['start_time'])) }}
                                                                        -
                                                                        {{ date('h:i A', strtotime($slot['end_time'])) }}</button>
                                                                @endforeach
                                                            </div>
                                                            <!-- /Slot List -->
                                                        @else
                                                            <p class="text-muted mb-0">Not Available</p>
                                                        @endif
                                                    </div>
                                                    <!-- /Sunday Slot -->

                                                    <!-- Monday Slot -->
                                                    <div id="slot_monday" class="tab-pane fade show active"
                                                        role="tabpanel">
                                                        @php
                                                            $mondaySlots = $offer->regularAvailabilities->firstWhere(
                                                                'week_day',
                                                                'monday',
                                                            );
                                                        @endphp
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            <span>Time Slots</span>
                                                            <div>
                                                                @if ($mondaySlots)
                                                                    <a class="edit-link"
                                                                        href="{{ route('hospital.offer-schedule.regular.edit', ['offer' => $offer, 'week_day' => 'monday']) }}">
                                                                        <i class="fa fa-edit me-1"></i>Edit
                                                                    </a>
                                                                    <a class="text-danger" href=""
                                                                        onclick="event.preventDefault();document.getElementById('clear_mon').submit();">
                                                                        <i class="fa fa-trash me-1"></i>Clear All
                                                                    </a>
                                                                    <form
                                                                        action="{{ route('hospital.offer-schedule.regular.destroy', ['offer' => $offer, 'week_day' => 'monday']) }}"
                                                                        id="clear_mon" method="POST">@csrf</form>
                                                                @else
                                                                    <a class="edit-link"
                                                                        href="{{ route('hospital.offer-schedule.regular', ['offer' => $offer, 'week_day' => 'monday']) }}">
                                                                        <i class="fa fa-plus-circle"></i> Add Slot
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </h4>

                                                        @if ($mondaySlots)
                                                            <!-- Slot List -->
                                                            <div class="doc-times">
                                                                @foreach ($mondaySlots->slots as $slot)
                                                                    <button type="button"
                                                                        class="btn mx-1 btn-sm btn-outline-secondary">{{ date('h:i A', strtotime($slot['start_time'])) }}
                                                                        -
                                                                        {{ date('h:i A', strtotime($slot['end_time'])) }}</button>
                                                                @endforeach
                                                            </div>
                                                            <!-- /Slot List -->
                                                        @else
                                                            <p class="text-muted mb-0">Not Available</p>
                                                        @endif

                                                    </div>
                                                    <!-- /Monday Slot -->

                                                    <!-- Tuesday Slot -->
                                                    <div id="slot_tuesday" class="tab-pane fade" role="tabpanel">
                                                        @php
                                                            $tuesdaySlots = $offer->regularAvailabilities->firstWhere(
                                                                'week_day',
                                                                'tuesday',
                                                            );
                                                        @endphp
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            <span>Time Slots</span>
                                                            <div>
                                                                @if ($tuesdaySlots)
                                                                    <a class="edit-link"
                                                                        href="{{ route('hospital.offer-schedule.regular.edit', ['offer' => $offer, 'week_day' => 'tuesday']) }}">
                                                                        <i class="fa fa-edit me-1"></i>Edit
                                                                    </a>
                                                                    <a class="text-danger" href=""
                                                                        onclick="event.preventDefault();document.getElementById('clear_tues').submit();">
                                                                        <i class="fa fa-trash me-1"></i>Clear All
                                                                    </a>
                                                                    <form
                                                                        action="{{ route('hospital.offer-schedule.regular.destroy', ['offer' => $offer, 'week_day' => 'tuesday']) }}"
                                                                        id="clear_tues" method="POST">@csrf</form>
                                                                @else
                                                                    <a class="edit-link"
                                                                        href="{{ route('hospital.offer-schedule.regular', ['offer' => $offer, 'week_day' => 'tuesday']) }}">
                                                                        <i class="fa fa-plus-circle"></i> Add Slot
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </h4>
                                                        @if ($tuesdaySlots)
                                                            <!-- Slot List -->
                                                            <div class="doc-times">
                                                                @foreach ($tuesdaySlots->slots as $slot)
                                                                    <button type="button"
                                                                        class="btn mx-1 btn-sm btn-outline-secondary">{{ date('h:i A', strtotime($slot['start_time'])) }}
                                                                        -
                                                                        {{ date('h:i A', strtotime($slot['end_time'])) }}</button>
                                                                @endforeach
                                                            </div>
                                                            <!-- /Slot List -->
                                                        @else
                                                            <p class="text-muted mb-0">Not Available</p>
                                                        @endif
                                                    </div>
                                                    <!-- /Tuesday Slot -->

                                                    <!-- Wednesday Slot -->
                                                    <div id="slot_wednesday" class="tab-pane fade" role="tabpanel">
                                                        @php
                                                            $wednesdaySlots = $offer->regularAvailabilities->firstWhere(
                                                                'week_day',
                                                                'wednesday',
                                                            );
                                                        @endphp
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            <span>Time Slots</span>
                                                            <div>
                                                                @if ($wednesdaySlots)
                                                                    <a class="edit-link"
                                                                        href="{{ route('hospital.offer-schedule.regular.edit', ['offer' => $offer, 'week_day' => 'wednesday']) }}">
                                                                        <i class="fa fa-edit me-1"></i>Edit
                                                                    </a>
                                                                    <a class="text-danger" href=""
                                                                        onclick="event.preventDefault();document.getElementById('clear_wed').submit();">
                                                                        <i class="fa fa-trash me-1"></i>Clear All
                                                                    </a>
                                                                    <form
                                                                        action="{{ route('hospital.offer-schedule.regular.destroy', ['offer' => $offer, 'week_day' => 'wednesday']) }}"
                                                                        id="clear_wed" method="POST">@csrf</form>
                                                                @else
                                                                    <a class="edit-link"
                                                                        href="{{ route('hospital.offer-schedule.regular', ['offer' => $offer, 'week_day' => 'wednesday']) }}">
                                                                        <i class="fa fa-plus-circle"></i> Add Slot
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </h4>
                                                        @if ($wednesdaySlots)
                                                            <!-- Slot List -->
                                                            <div class="doc-times">
                                                                @foreach ($wednesdaySlots->slots as $slot)
                                                                    <button type="button"
                                                                        class="btn mx-1 btn-sm btn-outline-secondary">{{ date('h:i A', strtotime($slot['start_time'])) }}
                                                                        -
                                                                        {{ date('h:i A', strtotime($slot['end_time'])) }}</button>
                                                                @endforeach
                                                            </div>
                                                            <!-- /Slot List -->
                                                        @else
                                                            <p class="text-muted mb-0">Not Available</p>
                                                        @endif
                                                    </div>
                                                    <!-- /Wednesday Slot -->

                                                    <!-- Thursday Slot -->
                                                    <div id="slot_thursday" class="tab-pane fade" role="tabpanel">
                                                        @php
                                                            $thursdaySlots = $offer->regularAvailabilities->firstWhere(
                                                                'week_day',
                                                                'thursday',
                                                            );
                                                        @endphp
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            <span>Time Slots</span>
                                                            <div>
                                                                @if ($thursdaySlots)
                                                                    <a class="edit-link"
                                                                        href="{{ route('hospital.offer-schedule.regular.edit', ['offer' => $offer, 'week_day' => 'thursday']) }}">
                                                                        <i class="fa fa-edit me-1"></i>Edit
                                                                    </a>
                                                                    <a class="text-danger" href=""
                                                                        onclick="event.preventDefault();document.getElementById('clear_thurs').submit();">
                                                                        <i class="fa fa-trash me-1"></i>Clear All
                                                                    </a>
                                                                    <form
                                                                        action="{{ route('hospital.offer-schedule.regular.destroy', ['offer' => $offer, 'week_day' => 'thursday']) }}"
                                                                        id="clear_thurs" method="POST">@csrf</form>
                                                                @else
                                                                    <a class="edit-link"
                                                                        href="{{ route('hospital.offer-schedule.regular', ['offer' => $offer, 'week_day' => 'thursday']) }}">
                                                                        <i class="fa fa-plus-circle"></i> Add Slot
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </h4>
                                                        @if ($thursdaySlots)
                                                            <!-- Slot List -->
                                                            <div class="doc-times">
                                                                @foreach ($thursdaySlots->slots as $slot)
                                                                    <button type="button"
                                                                        class="btn mx-1 btn-sm btn-outline-secondary">{{ date('h:i A', strtotime($slot['start_time'])) }}
                                                                        -
                                                                        {{ date('h:i A', strtotime($slot['end_time'])) }}</button>
                                                                @endforeach
                                                            </div>
                                                            <!-- /Slot List -->
                                                        @else
                                                            <p class="text-muted mb-0">Not Available</p>
                                                        @endif
                                                    </div>
                                                    <!-- /Thursday Slot -->

                                                    <!-- Friday Slot -->
                                                    <div id="slot_friday" class="tab-pane fade" role="tabpanel">
                                                        @php
                                                            $fridaySlots = $offer->regularAvailabilities->firstWhere(
                                                                'week_day',
                                                                'friday',
                                                            );
                                                        @endphp
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            <span>Time Slots</span>
                                                            <div>
                                                                @if ($fridaySlots)
                                                                    <a class="edit-link"
                                                                        href="{{ route('hospital.offer-schedule.regular.edit', ['offer' => $offer, 'week_day' => 'friday']) }}">
                                                                        <i class="fa fa-edit me-1"></i>Edit
                                                                    </a>
                                                                    <a class="text-danger" href=""
                                                                        onclick="event.preventDefault();document.getElementById('clear_fri').submit();">
                                                                        <i class="fa fa-trash me-1"></i>Clear All
                                                                    </a>
                                                                    <form
                                                                        action="{{ route('hospital.offer-schedule.regular.destroy', ['offer' => $offer, 'week_day' => 'friday']) }}"
                                                                        id="clear_fri" method="POST">@csrf</form>
                                                                @else
                                                                    <a class="edit-link"
                                                                        href="{{ route('hospital.offer-schedule.regular', ['offer' => $offer, 'week_day' => 'friday']) }}">
                                                                        <i class="fa fa-plus-circle"></i> Add Slot
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </h4>
                                                        @if ($fridaySlots)
                                                            <!-- Slot List -->
                                                            <div class="doc-times">
                                                                @foreach ($fridaySlots->slots as $slot)
                                                                    <button type="button"
                                                                        class="btn mx-1 btn-sm btn-outline-secondary">{{ date('h:i A', strtotime($slot['start_time'])) }}
                                                                        -
                                                                        {{ date('h:i A', strtotime($slot['end_time'])) }}</button>
                                                                @endforeach
                                                            </div>
                                                            <!-- /Slot List -->
                                                        @else
                                                            <p class="text-muted mb-0">Not Available</p>
                                                        @endif
                                                    </div>
                                                    <!-- /Friday Slot -->

                                                    <!-- Saturday Slot -->
                                                    <div id="slot_saturday" class="tab-pane fade" role="tabpanel">
                                                        @php
                                                            $saturdaySlots = $offer->regularAvailabilities->firstWhere(
                                                                'week_day',
                                                                'saturday',
                                                            );
                                                        @endphp
                                                        <h4 class="card-title d-flex justify-content-between">
                                                            <span>Time Slots</span>
                                                            @if ($saturdaySlots)
                                                                <a class="edit-link"
                                                                    href="{{ route('hospital.offer-schedule.regular.edit', ['offer' => $offer, 'week_day' => 'saturday']) }}">
                                                                    <i class="fa fa-edit me-1"></i>Edit
                                                                </a>
                                                                <a class="text-danger" href=""
                                                                    onclick="event.preventDefault();document.getElementById('clear_sat').submit();">
                                                                    <i class="fa fa-trash me-1"></i>Clear All
                                                                </a>
                                                                <form
                                                                    action="{{ route('hospital.offer-schedule.regular.destroy', ['offer' => $offer, 'week_day' => 'saturday']) }}"
                                                                    id="clear_sat" method="POST">@csrf</form>
                                                            @else
                                                                <a class="edit-link"
                                                                    href="{{ route('hospital.offer-schedule.regular', ['offer' => $offer, 'week_day' => 'saturday']) }}">
                                                                    <i class="fa fa-plus-circle"></i> Add Slot
                                                                </a>
                                                            @endif
                                                        </h4>
                                                        @if ($saturdaySlots)
                                                            <!-- Slot List -->
                                                            <div class="doc-times">
                                                                @foreach ($saturdaySlots->slots as $slot)
                                                                    <button type="button"
                                                                        class="btn mx-1 btn-sm btn-outline-secondary">{{ date('h:i A', strtotime($slot['start_time'])) }}
                                                                        -
                                                                        {{ date('h:i A', strtotime($slot['end_time'])) }}</button>
                                                                @endforeach
                                                            </div>
                                                            <!-- /Slot List -->
                                                        @else
                                                            <p class="text-muted mb-0">Not Available</p>
                                                        @endif
                                                    </div>
                                                    <!-- /Saturday Slot -->

                                                </div>
                                                <!-- /Schedule Content -->

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div role="tabpanel" id="onetime-avail" class="tab-pane fade">
                                <div class="card">
                                    <div class="card-header border-bottom-0">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h5 class="card-title"></h5>
                                            </div>
                                            <div class="col-auto d-flex">
                                                <a class="edit-link"
                                                    href="{{ route('hospital.offer-schedule.onetime', ['offer' => $offer]) }}">
                                                    <i class="fa fa-plus-circle"></i> Add Availability
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-borderless hover-table">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>SR.</th>
                                                        <th>Date</th>
                                                        <th>Time Interval</th>
                                                        <th>Slots</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $items = $offer->oneTimeailabilities->sortBy('date')->values();
                                                    @endphp
                                                    @foreach ($items as $key => $item)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ date('d-m-Y', strtotime($item->date)) }}</td>
                                                            <td>{{ $item->time_interval }}</td>
                                                            <td class="doc-times">
                                                                @foreach ($item->slots as $slot)
                                                                    <div class="doc-slot-list">
                                                                        <small>{{ date('h:i A', strtotime($slot['start_time'])) }}
                                                                            -
                                                                            {{ date('h:i A', strtotime($slot['end_time'])) }}</small>
                                                                    </div>
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                <a class="text-black"
                                                                    href="{{ route('hospital.offer-schedule.onetime.edit', ['offer' => $offer, $item->date]) }}">
                                                                    <i class="feather-edit-3 me-1"></i> Edit
                                                                </a>
                                                                <a class="text-danger" href=""
                                                                    onclick="event.preventDefault();document.getElementById('delet_form_{{ $key }}').submit();">
                                                                    <i class="feather-trash-2 me-1"></i> Delete
                                                                </a>
                                                                <form class="d-inline"
                                                                    action="{{ route('hospital.offer-schedule.onetime.delete', ['offer' => $offer, $item->date]) }}"
                                                                    method="post" id="delet_form_{{ $key }}">
                                                                    @csrf</form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <div role="tabpanel" id="unavail" class="tab-pane fade">
                                <div class="card">
                                    <div class="card-header border-bottom-0">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h5 class="card-title"></h5>
                                            </div>
                                            <div class="col-auto d-flex">
                                                <a class="edit-link"
                                                    href="{{ route('hospital.offer-schedule.unavailability', ['offer' => $offer]) }}">
                                                    <i class="fa fa-plus-circle"></i> Add Unavailability
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-borderless hover-table">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>SR.</th>
                                                        <th>Date</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $items = $offer->unavailailities->sortBy('date')->values();
                                                    @endphp
                                                    @foreach ($items as $key => $item)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ date('d-m-Y', strtotime($item->date)) }}</td>
                                                            <td>
                                                                <a class="text-black"
                                                                    href="{{ route('hospital.offer-schedule.unavailability.edit', ['offer' => $offer, $item->date]) }}">
                                                                    <i class="feather-edit-3 me-1"></i> Edit
                                                                </a>
                                                                <a class="text-danger" href=""
                                                                    onclick="event.preventDefault();document.getElementById('delet_form_un{{ $key }}').submit();">
                                                                    <i class="feather-trash-2 me-1"></i> Delete
                                                                </a>
                                                                <form class="d-inline"
                                                                    action="{{ route('hospital.offer-schedule.unavailability.delete', ['offer' => $offer, $item->date]) }}"
                                                                    method="post"
                                                                    id="delet_form_un{{ $key }}">@csrf</form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
{{-- <script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
        mapboxgl.accessToken = 'pk.eyJ1IjoiZW0yMDAwMTExIiwiYSI6ImNsajRrcXlicjA0MjMza3F6YjI5eW5pN2IifQ.bY21DI8kEvlV7z97OKlJJA';
        initMap();
    });
    let map;
    let marker;
    let selectedLocation = null;

    function initMap() {
        const initialCoords = [
            {{ $hospital->long ?? 39.826288 }}, // Default longitude (e.g., Kaaba)
            {{ $hospital->lat ?? 21.422438 }}  // Default latitude (e.g., Kaaba)
        ];
        currentLat = {{ $hospital->lat ?? null }};
        currentLong = {{ $hospital->long ?? null }};
        currentLocation = "{{ $hospital->location ?? null }}";
        if (currentLat != null && currentLong != null && currentLocation != null ) {
            $('#latitude').val(currentLat);
            $('#longitude').val(currentLong);
            $('#addressLocation').val(currentLocation);
        }
        map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: initialCoords,
            zoom: 5
        });

        // Add navigation control (zoom in/out buttons)
        map.addControl(new mapboxgl.NavigationControl(), 'top-right');

        // Initialize marker
        marker = new mapboxgl.Marker({
            draggable: true
        })
        .setLngLat(initialCoords)
        .addTo(map);

        // Set the initial text under the map if the hospital's location exists
        const initialLocation = '{{ $hospital->location ?? "Please Select A Hospital Location" }}';
        document.getElementById('selectedLocation').textContent = `Selected Location: ${initialLocation}`;


        // Update selectedLocation when marker is dragged
        marker.on('dragend', onMarkerDragEnd);

        // Add click event to map
        map.on('click', onMapClick);

        // Initialize the geocoder
        const geocoder = new MapboxGeocoder({
            accessToken: mapboxgl.accessToken,
            mapboxgl: mapboxgl,
            marker: false
        });

        // Add the geocoder to the map
        document.getElementById('geocoder').appendChild(geocoder.onAdd(map));

        // Listen for the 'result' event from the geocoder
        geocoder.on('result', function(e) {
            const coords = e.result.center;
            updateMarkerPosition(coords);
        });
    }

    function onMapClick(e) {
        updateMarkerPosition([e.lngLat.lng, e.lngLat.lat]);
    }

    function onMarkerDragEnd() {
        const lngLat = marker.getLngLat();
        updateMarkerPosition([lngLat.lng, lngLat.lat]);
    }

    function updateMarkerPosition(coords) {
        marker.setLngLat(coords);
        console.log(coords);

        selectedLocation = {
            lng: coords[0],
            lat: coords[1]
        };
        getAddressFromCoordinates(coords);
    }
    function getAddressFromCoordinates(coords) {
        $('#latitude').val(coords[1]);
        $('#longitude').val(coords[0]);
        const url = `https://api.mapbox.com/geocoding/v5/mapbox.places/${coords[0]},${coords[1]}.json?access_token=${mapboxgl.accessToken}`;
        fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.features && data.features.length > 0) {
                const address = data.features[0].place_name;
                updateSelectedLocationText(address);
                $('#addressLocation').val(address);
                } else {
                    updateSelectedLocationText('Address not found');
                }
            })
            .catch(error => {
                console.error('Error fetching address:', error);
                updateSelectedLocationText('Error fetching address');
            });
    }
    function updateSelectedLocationText(address) {
        const locationDiv = document.getElementById('selectedLocation');
        if (selectedLocation) {
            locationDiv.textContent = `Selected Location: ${address}`;
        } else {
            locationDiv.textContent = '';
        }
    }

</script> --}}
