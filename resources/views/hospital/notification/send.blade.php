@extends('layout.mainlayout_hospital')
@section('title', 'Notifications')



@section('content')
    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Send Notifications</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('notifications.store') }}" enctype="multipart/form-data">
                            @csrf

                            {{-- Title --}}
                            <div class="form-group row">
                                <label for="title_en" class="col-form-label col-md-2">Title EN</label>
                                <div class="col-md-10">
                                    <input id="title_en" name="title_en" value="{{ old('title_en') }}" type="text"
                                        class="form-control" placeholder="Title EN" required>
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
                                    <input id="title_ar" value="{{ old('title_ar') }}" name="title_ar" type="text"
                                        class="form-control" placeholder="Titel AR" required>
                                    @error('title_ar')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Message --}}
                            <div class="form-group row">
                                <label for="message_en" class="col-form-label col-md-2">Message EN</label>
                                <div class="col-md-10">
                                    <textarea id="message_en" name="message_en" type="text" class="form-control" placeholder="Message EN"></textarea>
                                    @error('message_en')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group row">
                                <label for="message_ar" class="col-form-label col-md-2">Message AR</label>
                                <div class="col-md-10">
                                    <textarea id="message_ar" name="message_ar" type="text" class="form-control" placeholder="Message AR"></textarea>
                                    @error('message_ar')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Users --}}
                            <div class="form-group row">
                                <label for="users_ids" class="col-form-label col-md-2">Users</label>
                                <div class="col-md-10">
                                    <select id="users_ids" name="users_ids[]" type="text"
                                        class="form-control js-example-basic-multiple" placeholder="select doctor"
                                        multiple="multiple" required>
                                        <option disabled>-- Select Users --</option>
                                        <option value="all">All Users</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('users_ids')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Offers --}}
                            {{-- <div class="form-group row">
                                <label for="offer_id" class="col-form-label col-md-2">Offers</label>
                                <div class="col-md-10">
                                    <select id="offer_id" name="offer_id" class="form-select select">
                                        <option value="">-- Select Offer --</option>
                                        @foreach ($offers as $offer)
                                            <option value="{{ $offer->id }}">{{ $offer->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('offer_id')
                                        <div class="text-danger pt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div> --}}

                            <button class="btn btn-primary btn-add"><i class="feather-plus-square me-1"></i>Send</button>
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
<script src="{{ asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('assets/js/ckeditor.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        console.log('hello1');
        $('.js-example-basic-multiple').select2();
    });
</script>
