@extends('layout.mainlayout_hospital')
@section('title', 'Blogs')
@section('content')
    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="page-header p-8 m-2">
            <div class="row align-items-center">
                <div class="col-md-12 d-flex justify-content-end">
                    <div class="doc-badge me-3">{{ __('hospital.blogs.blogs')  }} <span class="ms-1">{{ count($blogs) }}</span></div>
                    <a href="{{ route('create_blog') }}" class="btn btn-primary btn-add"><i
                            class="feather-plus-square me-1"></i> {{ __('hospital.blogs.add_new')  }}</a>
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
                                            <th>{{ __('hospital.blogs.id')  }}</th>
                                                <th>{{ __('hospital.blogs.title')  }}</th>
                                                <th>{{ __('hospital.blogs.hospital')  }}</th>
                                                <th>{{ __('hospital.blogs.created')  }}</th>
                                                <th>{{ __('hospital.blogs.updated')  }}</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($blogs as $blog)

                                                <tr>
                                                <td>{{$blog->id}}</td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a class="avatar avatar-sm me-2">
                                                                @if($blog->blog_image ?? '')
                                                                    <img class="avatar-img rounded-circle"
                                                                         src="{{ asset('images/' . $blog->blog_image) }}"
                                                                         alt="User Image">
                                                                @else
                                                                    <img class="avatar-img rounded-circle"
                                                                         src="{{ URL::asset('/assets/img/patients/patient.jpg')}}"
                                                                         alt="User Image">
                                                                @endif
                                                            </a>

                                                            <a>{{ $blog->blog_title }}</a>
                                                        </h2>
                                                    </td>
                                                    <td>{{ $doctor->name }}</td>
                                                    <td>{{ $blog->created_at->diffForHumans() }}</td>
                                                    <td>{{ $blog->updated_at->diffForHumans() }}</td>
                                                    <td class="text-end">
                                                        <div class="table-action">
                                                            <a href="{{ route('show_blog', $blog) }}"
                                                               class="btn btn-sm bg-success-light">
                                                                <i class="fas fa-eye"></i> {{ __('hospital.blogs.view')  }}
                                                            </a>
                                                            <a href="{{ route('edit_blog', $blog) }}"
                                                               class="btn btn-sm bg-success-light">
                                                                <i class="fas fa-edit"></i> {{ __('hospital.blogs.edit')  }}
                                                            </a>
                                                            <a href="javascript:void(0);"
                                                               onclick="if (window.confirm('Are you sure you want to delete this blog')){ document.getElementById( 'delete{{ $blog->id }}').submit(); }"
                                                               class="btn btn-sm bg-danger-light">
                                                                <i class="fas fa-trash"></i> {{ __('hospital.blogs.delete')  }}
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <form method="POST" id="delete{{ $blog->id }}"
                                                          action="{{ route('delete_blog', $blog) }}">
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
