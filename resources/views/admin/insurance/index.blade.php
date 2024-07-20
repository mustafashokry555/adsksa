@extends('layout.mainlayout_admin')
@section('title', 'Insurance')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-12 d-flex justify-content-end">
                        <div class="doc-badge me-3"> {{ __('admin.insurance.insurances') }}<span
                                class="ms-1">{{ count($insurance) }}</span>
                        </div>
                        <a href="{{ route('insurances.create') }}" class="btn btn-primary btn-add"><i
                                class="feather-plus-square me-1"></i> {{ __('admin.speciality.add_new') }}</a>
                    </div>
                </div>
            </div>
            @if (session()->has('flash'))
                <x-alert>{{ session('flash')['message'] }}</x-alert>
            @endif
            <!-- Specialities -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header border-bottom-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="card-title">{{ __('admin.insurance.insurances') }}</h5>
                                </div>
                                <div class="col-auto d-flex flex-wrap">
                                    <div class="form-custom me-2">
                                        <div id="tableSearch" class="dataTables_wrapper"></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="datatable table table-borderless hover-table" id="data-table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>{{ __('admin.insurance.id') }}</th>
                                            <th>{{ __('admin.insurance.name_en') }}</th>
                                            <th>{{ __('admin.insurance.name_ar') }}</th>
                                            <th>{{ __('admin.insurance.email') }}</th>
                                            <th>{{ __('admin.insurance.phone1') }}</th>
                                            <th>{{ __('admin.insurance.phone2') }}</th>
                                            <th>{{ __('admin.insurance.city') }},{{ __('admin.insurance.state') }},{{ __('admin.insurance.address') }}
                                            </th>
                                            <th> {{ __('admin.insurance.created_at') }}</th>
                                            <th>{{ __('admin.insurance.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($insurance as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>
                                                    <h2 class="table-avatar">

                                                        <span>{{ $item->name_en }}</span>
                                                    </h2>
                                                </td>
                                                <td>
                                                    <h2 class="table-avatar">

                                                        <span>{{ $item->name_ar }}</span>
                                                    </h2>
                                                </td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->phone1 }}</td>
                                                <td>{{ $item->phone2 }}</td>
                                                <td>{{ $item->city }},{{ $item->state }},{{ $item->address }}</td>

                                                <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                                <td class="text-end">
                                                    <div class="actions">
                                                        <a class="text-black" href="{{ route('insurances.edit', $item) }}">
                                                            <i class="feather-edit-3 me-1"></i> Edit
                                                        </a>
                                                        <a class="text-danger" href="javascript:void(0);"
                                                            onclick="if (window.confirm('Are you sure you want to delete this speciality < {{ $item->name }} >')){ document.getElementById( 'delete{{ $item->id }}').submit(); }">
                                                            <i class="feather-trash-2 me-1"></i> Delete
                                                        </a>
                                                    </div>
                                                </td>
                                                <form method="POST" id="delete{{ $item->id }}"
                                                    action="{{ route('insurances.destroy', $item) }}">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                            </tr>
                                        @empty
                                            <tr class="col-span-3">
                                                <td>No Specialities available</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="tablepagination" class="dataTables_wrapper">
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
