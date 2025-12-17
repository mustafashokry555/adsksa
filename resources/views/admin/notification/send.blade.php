@extends('layout.mainlayout_admin')
@section('title', 'Notifications')
@section('content')
    <div class="page-wrapper">

        <!-- offer -->
        <div class="row">
            <div class="col-lg-12">
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
                            <div class="form-group row">
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
                            </div>

                            <button class="btn btn-primary btn-add"><i class="feather-plus-square me-1"></i>Send</button>
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

<script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('assets/js/ckeditor.js') }}"></script>

<script>
    function getDoctors(hospitalId) {
        // Cities
        $.ajax({
            url: '{{ route('get.doctors') }}', // Define this route in Laravel
            type: 'GET',
            data: {
                hospital_id: hospitalId
            },
            success: function(data) {
                console.log('hello4');

                $('#doctor_ids').empty(); // Clear the cities dropdown
                $.each(data, function(key, doctor) {
                    $('#doctor_ids').append('<option value="' + doctor.id + '">' + doctor.name_en +
                        ' < ' + doctor.name_ar + ' > ' + '</option>');
                });
            },
            error: function() {
                alert('Error Loading Doctores');
            }
        });
    }
    document.addEventListener("DOMContentLoaded", function() {
        console.log('hello1');
        $('.js-example-basic-multiple').select2();
        $('#hospital_id').on('change', function() {
            console.log('hello2');
            var hospital_id = $(this).val();
            console.log(hospital_id);
            if (hospital_id) {
                console.log('hello3');

                getDoctors(hospital_id);
            } else {
                $('#doctor_ids').empty(); // Clear the Doctores dropdown if no country is selected
                $('#doctor_ids').append('<option disabled>Select Hospital first</option>');
            }
        });
        ClassicEditor
            .create(document.querySelector('#content_en'))
            .catch(error => console.error(error));

        ClassicEditor
            .create(document.querySelector('#content_ar'))
            .catch(error => console.error(error));
    });
</script>
