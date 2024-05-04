@extends('layout.mainlayout_hospital')
@section('title', 'Edit Blog')
@section('content')
    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title"> {{ __('hospital.blogs.edit_blog')  }}</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('update_blog', $blog) }}" enctype="multipart/form-data">
                            @method('patch')
                            @csrf
                            <!-- Name -->
                            <div class="form-group row">
                                <label for="blog_title" class="col-form-label col-md-2"> {{ __('hospital.blogs.title')  }}</label>
                                <div class="col-md-10">
                                    <input id="blog_title" name="blog_title" type="text" class="form-control"
                                           value="{{ $blog->blog_title }}" required>
                                </div>
                            </div>
                            <!-- Email -->
                            <div class="form-group row">
                                <label for="blog_body" class="col-form-label col-md-2"> {{ __('hospital.blogs.body')  }}</label>
                                <div class="col-md-10">
                                    <textarea id="blog_body" name="blog_body" type="text" class="form-control"
                                              required>{{ $blog->blog_body }}</textarea>
                                </div>
                            </div>
                            <!-- Profile Image -->
                            <div class="form-group row">
                                <label for="blog_image" class="col-form-label col-md-2"> {{ __('hospital.blogs.image')  }}</label>
                                <div class="col-md-10">
                                    <input id="blog_image" name="blog_image" class="form-control" type="file">
                                </div>
                            </div>
                            <button class="btn btn-primary btn-add"><i class="feather-plus-square me-1"></i>  {{ __('hospital.blogs.update_blog')  }}
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
