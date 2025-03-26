@extends('layout.mainlayout_admin')
@section('title', 'Hospitals')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-12 d-flex justify-content-end">
                        <div class="doc-badge me-3">{{ __('admin.hospital.hospitals') }} <span
                                class="ms-1">{{ count($hospitals) }}</span></div>
                        <a href="{{ route('hospital.create') }}" class="btn btn-primary btn-add"><i
                                class="feather-plus-square me-1"></i> {{ __('admin.speciality.add_new') }}</a>
                    </div>
                </div>
            </div>
            @if (session()->has('flash'))
                <x-alert>{{ session('flash')['message'] }}</x-alert>
            @endif


            <!-- Hospitals -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header border-bottom-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="card-title">{{ __('admin.hospital.hospitals') }} </h5>
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
                                            <form action="{{ route('hospital.index') }}">
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
                                            <th>{{ __('admin.hospital.id') }}</th>
                                            <th>{{ __('admin.hospital.image') }}</th>
                                            <th>{{ __('admin.hospital.name_en') }}</th>
                                            <th>{{ __('admin.hospital.name_ar') }}</th>
                                            <th>{{ __('admin.hospital.email') }}</th>
                                            <th>{{ __('admin.hospital.location') }}</th>
                                            <th>{{ __('admin.hospital.insurance') }}</th>
                                            <th>{{ __('admin.hospital.created_at') }}</th>
                                            <th>{{ __('admin.hospital.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($hospitals as $hospital)
                                            <tr>
                                                <td>{{ $hospital->id }}</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ route('hospital.edit', $hospital) }}" class="spl-img">
                                                            <img src="{{ asset($hospital->image) }}" class="img-fluid" alt="User Image">
                                                            </a>
                                                    </h2>
                                                </td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ route('hospital.edit', $hospital) }}">
                                                            <span>{{ $hospital->hospital_name_en }}</span>
                                                        </a>
                                                    </h2>
                                                </td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ route('hospital.edit', $hospital) }}">
                                                            <span>{{ $hospital->hospital_name_ar }}</span>
                                                        </a>
                                                    </h2>
                                                </td>
                                                @if ($hospital->hospitalAdmin)
                                                    <td>{{ $hospital->hospitalAdmin->email }}</td>
                                                @else
                                                    <td> No Admin </td>
                                                @endif
                                                <td>
                                                    <span class="user-name">{{ $hospital->address }} </span>
                                                    <span class="d-block">{{ $hospital->country ? $hospital->country->name : null }}</span>
                                                    <span class="d-block">{{ $hospital->state ? $hospital->state->name : null  }}</span>
                                                    <span class="d-block">{{ $hospital->city ? $hospital->city->name : null   }}</span>

                                                </td>
                                                <td>
                                                    @forelse($hospital?->insurances as $insurance)
                                                        {{ $insurance->name }},
                                                    @empty
                                                        N/A
                                                    @endforelse

                                                </td>
                                                <td>{{ $hospital->created_at->format('Y-m-d') }}</td>
                                                <td class="text-end">
                                                    <div class="actions">
                                                        <a class="text-black"
                                                            href="{{ route('hospital_patients', $hospital) }}">
                                                            <i class="feather-show-3 me-1"></i> See Patients
                                                        </a>
                                                        <a class="text-black"
                                                            href="{{ route('hospital.show', $hospital) }}">
                                                            <i class="feather-show-3 me-1"></i> See doctors
                                                        </a>
                                                        <a class="text-black"
                                                            href="{{ route('hospital.edit', $hospital) }}">
                                                            <i class="feather-edit-3 me-1"></i> Edit
                                                        </a>
                                                        <a class="text-danger" href="javascript:void(0);"
                                                            onclick="if (window.confirm('Are you sure you want to delete this hospital <{{ $hospital->name }} >')){ document.getElementById( 'delete{{ $hospital->id }}').submit(); }">
                                                            <i class="feather-trash-2 me-1"></i> Delete
                                                        </a>
                                                    </div>
                                                </td>
                                                <form method="POST" id="delete{{ $hospital->id }}"
                                                    action="{{ route('hospital.destroy', $hospital) }}">
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
            <!-- /Hospital -->
        </div>
    </div>
    <!-- /Page Wrapper -->
    </div>
    <!-- /Main Wrapper -->
    @component('admin.components.modal-popup')
    @endcomponent

@endsection
