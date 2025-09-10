@extends('layout.mainlayout_hospital')
@section('title', 'Hospital Offers')

@section('content')
    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="page-header p-8 m-2">
            <div class="row align-items-center">
                <div class="col-md-12 d-flex justify-content-end">
                    <div class="doc-badge me-3">Hospital Offers<span class="ms-1">{{ count($offers) ?? 0 }}</span></div>
                    <a href="{{ route('offers.create') }}" class="btn btn-primary btn-add"><i
                            class="feather-plus-square me-1"></i> Add New </a>
                </div>
            </div>
        </div>

        @if (session()->has('flash'))
            <x-alert>{{ session('flash')['message'] }}</x-alert>
        @endif
        <div class="row">
            <div class="col-md-12">

                <div>
                    <div class="tab-content">

                        <!-- Offers List -->
                        <div>
                            <div class="card card-table mb-0">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-center mb-0" id="datatable1">
                                            <thead class="thead-light">

                                                <tr>
                                                    {{-- <th>{{ __('admin.hospital.id') }}</th> --}}
                                                    {{-- <th>Hospital</th> --}}
                                                    <th>ID</th>
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
                                                                <a href="#"><span>{{ $offer->title_ar }}</span></a>
                                                            </h2>
                                                        </td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="#"><span>{{ $offer->title_en }}</span></a>
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
                                                            <div class="table-action">
                                                                <a href="{{ route('offers.edit', $offer->id) }}"
                                                                    class="btn btn-sm bg-success-light">
                                                                    <i class="fas fa-edit"></i>
                                                                    {{ __('hospital.doctor.edit') }}
                                                                </a>
                                                                <a href="javascript:void(0);"
                                                                    onclick="if (window.confirm('Are you sure you want to delete this offer <{{ $offer->title }} >')){ document.getElementById( 'delete{{ $offer->id }}').submit(); }"
                                                                    class="btn btn-sm bg-danger-light">
                                                                    <i class="fas fa-trash"></i>
                                                                    {{ __('hospital.doctor.delete') }}
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
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Offers List -->

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
