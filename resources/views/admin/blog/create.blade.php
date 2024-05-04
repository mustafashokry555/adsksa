@extends('layout.mainlayout_admin')
@section('title', 'Blogs')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Blog Edit -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">{{ __('admin.blogs.add_blog')  }}</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ url('/store-blog') }}"
                                  enctype="multipart/form-data">

                                @csrf
                                <!-- Name -->
                                <div class="form-group row">
                                    <label for="blog_title" class="col-form-label col-md-2">{{ __('admin.blogs.title')  }}</label>
                                    <div class="col-md-10">
                                        <input id="blog_title" name="blog_title" type="text" class="form-control"
                                               value="{{old('blog_title')}}" required>
                                        @error('blog_title')
                                        <div class="text-danger pt-2">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Email -->
                                <div class="form-group row">
                                    <label for="blog_body" class="col-form-label col-md-2">{{ __('admin.blogs.body')  }}</label>
                                    <div class="col-md-10">
                                    <textarea id="blog_body" name="blog_body" type="text" class="form-control"
                                              required>{{old('blog_body')}}</textarea>
                                        @error('blog_body')
                                        <div class="text-danger pt-2">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Profile Image -->
                                <div class="form-group row">
                                    <label for="blog_image" class="col-form-label col-md-2">{{ __('admin.blogs.image')  }}</label>
                                    <div class="col-md-10">
                                        <input id="blog_image" name="blog_image" class="form-control" type="file">
                                        @error('blog_image')
                                        <div class="text-danger pt-2">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-add"><i class="feather-plus-square me-1"></i>
                                    {{ __('admin.blogs.blogs')  }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Blog Edit -->
        </div>
    </div>
    <!-- /Page Wrapper -->
    </div>
    <!-- /Main Wrapper -->
@endsection
