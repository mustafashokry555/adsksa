@extends('layout.mainlayout_admin')
@section('title', 'Offers')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-12 d-flex justify-content-end">
                        <div class="doc-badge me-3">Offers <span
                                class="ms-1">{{ count($offers) }}</span></div>
                        <a href="{{ route('offers.create') }}" class="btn btn-primary btn-add"><i
                                class="feather-plus-square me-1"></i> {{ __('admin.speciality.add_new') }}</a>
                    </div>
                </div>
            </div>
            @if (session()->has('flash'))
                <x-alert>{{ session('flash')['message'] }}</x-alert>
            @endif


            <!-- Offers -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header border-bottom-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="card-title">Offers </h5>
                                </div>
                                <div class="col-auto d-flex flex-wrap">
                                    <div class="form-custom me-2">
                                        <div id="tableSearch" class="dataTables_wrapper"></div>
                                    </div>
                                    <div class="SortBy">
                                        <div class="selectBoxes order-by">
                                            <p class="mb-0"><img src="{{ URL::asset('/assets_admin/img/icon/sort.png') }}"
                                                    class="me-2" alt="icon"> Order by </p>
                                            <span class="down-icon"><i class="feather-chevron-down"></i></span>
                                        </div>
                                        @php
                                            $orderBy = request()->order ?? 'id';
                                            $order = request()->sort ?? 'desc';

                                        @endphp
                                        <div id="checkBox">
                                            <form action="{{ route('offers.index') }}">
                                                <p class="lab-title">Order By </p>
                                                <label class="custom_radio w-100">
                                                    <input type="radio" name="order" value="id"
                                                        {{ $orderBy == 'id' ? 'checked' : '' }}>
                                                    <span class="checkmark"></span> ID
                                                </label>
                                                <label class="custom_radio w-100 mb-4">
                                                    <input type="radio" name="order" value="updated_at"
                                                        {{ $orderBy == 'updated_at' ? 'checked' : '' }}>
                                                    <span class="checkmark"></span> Date Modified
                                                </label>
                                                <p class="lab-title">Sort By</p>
                                                <label class="custom_radio w-100">
                                                    <input type="radio" name="sort" value="asc"
                                                        {{ $order == 'asc' ? 'checked' : '' }}>
                                                    <span class="checkmark"></span> Ascending
                                                </label>
                                                <label class="custom_radio w-100 mb-4">
                                                    <input type="radio" name="sort" value="desc"
                                                        {{ $order == 'desc' ? 'checked' : '' }}>
                                                    <span class="checkmark"></span> Descending
                                                </label>
                                                <button type="submit" class="btn w-100 btn-primary">Apply</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="datatable table table-borderless hover-table" id="data-table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Hospital</th>
                                            <th>Title AR</th>
                                            <th>Title EN</th>
                                            <th>Media Type</th>
                                            <th>Status</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>{{ __('admin.hospital.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($offers as $offer)
                                            <tr>
                                                <td>{{ $offer->id }}</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="#" class="spl-img"><img
                                                                src="{{ asset($offer->hospital->image) }}" class="img-fluid"
                                                                alt="User Image"></a> {{ $offer->hospital->hospital_name }}
                                                    </h2>
                                                </td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a
                                                            href="#"><span>{{ $offer->title_ar }}</span></a>
                                                    </h2>
                                                </td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a
                                                            href="#"><span>{{ $offer->title_en }}</span></a>
                                                    </h2>
                                                </td>
                                                <td>{{ $offer->type }}</td>
                                                @if ($offer->is_active)
                                                    <td>
                                                        <span class="badge rounded-pill bg-success-light">
                                                            Avtive
                                                        </span>
                                                    </td>
                                                @else
                                                    <td>
                                                        <span class="badge rounded-pill bg-danger-light">
                                                            Not Avtive
                                                        </span>
                                                    </td>
                                                @endif
                                                {{-- <td>{{ $offer->is_active }}</td> --}}
                                                <td>{{ $offer->start_date }}</td>
                                                <td>{{ $offer->end_date }}</td>
                                                <td class="text-end">
                                                    <div class="actions">
                                                        <a class="text-black"
                                                            href="{{ route('offers.edit', $offer) }}">
                                                            <i class="feather-edit-3 me-1"></i> Edit
                                                        </a>
                                                        <a class="text-danger" href="javascript:void(0);"
                                                            onclick="if (window.confirm('Are you sure you want to delete this offer <{{ $offer->title }} >')){ document.getElementById( 'delete{{ $offer->id }}').submit(); }">
                                                            <i class="feather-trash-2 me-1"></i> Delete
                                                        </a>
                                                    </div>
                                                </td>
                                                <form method="POST" id="delete{{ $offer->id }}"
                                                    action="{{ route('offers.destroy', $offer->id) }}">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td></td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="tablepagination" class="dataTables_wrapper"></div>
                </div>
            </div>
            <!-- /offers -->
        </div>
    </div>
    <!-- /Page Wrapper -->
    </div>
    <!-- /Main Wrapper -->
    @component('admin.components.modal-popup')
    @endcomponent

@endsection
