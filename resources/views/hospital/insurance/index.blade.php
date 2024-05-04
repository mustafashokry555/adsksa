@extends('layout.mainlayout_hospital')
@section('title', 'Insurance')
@section('content')

    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="page-header p-8 m-2">
            <div class="row align-items-center">
                <div class="col-md-12 d-flex justify-content-end">
                    <div class="doc-badge me-3">{{ __('hospital.insurance.insurances')  }} <span class="ms-1">{{ count($insurance) }}</span></div>
                    <a href="{{ route('insurances.create') }}" class="btn btn-primary btn-add"><i
                            class="feather-plus-square me-1"></i> {{ __('hospital.insurance.add_insurance')  }}</a>
                </div>
            </div>
        </div>
        @if(session()->has('flash'))
            <x-alert>{{ session('flash')['message'] }}</x-alert>
        @endif
        <div class="row">
            <div class="col-md-12">

                <div>
                    <div class="tab-content">

                        <!-- Doctor List -->
                        <div>
                            <div class="card card-table mb-0">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-center mb-0" id="datatable1">
                                            <thead>
                                            <tr>
                                            <th>{{ __('hospital.insurance.id')  }}</th>
                                        <th>{{ __('hospital.insurance.name')  }}</th>
                                        <th>{{ __('hospital.insurance.email')  }}</th>
                                        <th>{{ __('hospital.insurance.phone1')  }}</th>
                                        <th>{{ __('hospital.insurance.phone2')  }}</th>
                                        <th>{{ __('hospital.insurance.city')  }},{{ __('hospital.insurance.state')  }},{{ __('hospital.insurance.address')  }}</th>
                                        <th>{{ __('hospital.insurance.created_at')  }}</th>
                                        <th>{{ __('hospital.insurance.action')  }}</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($insurance as $item)
                                                <tr>
                                                <td>{{ $item->id }}</td>
                                                    <td>
                                                        <h2 class="table-avatar">


                                                            <a>{{ $item->name }}</a>
                                                        </h2>
                                                    </td>
                                                    <td>{{ $item->email }}</td>
                                                    <td>{{ $item->phone1 }}</td>
                                                    <td>{{ $item->phone2 }}</td>
                                                    <td>{{ $item->city }},{{ $item->state }},{{ $item->address }}</td>
                                                    <td>{{ $item->created_at->diffForHumans() }}</td>
                                                    <!-- <td>{{ $item->updated_at->diffForHumans() }}</td> -->
                                                    <td class="text-end">
                                                        @if($item->user_id==auth()->user()->hospital_id)
                                                        <div class="table-action">

                                                            <a href="{{ route('insurances.edit', $item) }}"
                                                               class="btn btn-sm bg-success-light">
                                                                <i class="fas fa-edit"></i> {{ __('hospital.insurance.edit')  }}
                                                            </a>
                                                            <a href="javascript:void(0);"
                                                               onclick="if (window.confirm('Are you sure you want to delete this insurance')){ document.getElementById( 'delete{{ $item->id }}').submit(); }"
                                                               class="btn btn-sm bg-danger-light">
                                                                <i class="fas fa-trash"></i> {{ __('hospital.insurance.delete')  }}
                                                            </a>
                                                        </div>
                                                        @endif
                                                    </td>
                                                    <form method="POST" id="delete{{ $item->id }}"
                                                          action="{{ route('insurances.destroy', $item) }}">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                </tr>
                                            @empty
                                                <!-- <tr class="col-span-4">
                                                    <td class="col-span-4">No Blogs Available</td>
                                                </tr> -->
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Doctor List -->

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
