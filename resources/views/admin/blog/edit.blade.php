@extends('layout.dashboard')
@section('dashboards')
<!-- Trumbowyg CSS -->
<link href='https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css' rel='stylesheet' type='text/css' />
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Admin</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.blog.index')}}" class="text-decoration-none">Blog</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Blog</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-lg-12">
                <div class="border border-3 p-4 rounded">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <!-- Restaurant Name -->
                                <form method="POST" action="{{route('admin.blog.update',$blog->id)}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-12 mb-3">
                                        <label for="blog_img" class="form-label mb-2">Blog Image</label>
                                        <input type="file" name="blog_img" id="blog_img" class="form-control @error('blog_img') is-invalid @enderror">
                                        <span class="text-danger">{{ $errors->first('blog_img') }}</span>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="img_title" class="form-label mb-2">Image Title</label>
                                        <input type="text" name="img_title" id="img_title" class="form-control @error('img_title') is-invalid @enderror" value="{{$blog->img_title}}" placeholder="eg: Online Learning">
                                        <span class="text-danger">{{ $errors->first('img_title') }}</span>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="blog_title" class="form-label mb-2">Blog Title</label>
                                        <input type="text" name="blog_title" id="blog_title" class="form-control @error('blog_title') is-invalid @enderror" value="{{$blog->blog_title}}" placeholder="Blog Title here..">
                                        <span class="text-danger">{{ $errors->first('blog_title') }}</span>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="blog_para" class="form-label mb-2">Blog Paragraph</label>
                                        <textarea name="blog_para" id="blog_para" rows="5" class="form-control @error('blog_para') is-invalid @enderror" placeholder="Blog Paragraph here..">{{$blog->blog_para}}</textarea>
                                        <span class="text-danger">{{ $errors->first('blog_para') }}</span>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="d-md-flex d-grid align-items-center gap-3">
                                            <button type="submit" class="btn btn-primary px-4">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery (keep it first) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js'></script>
<script>
    // init Froala Editor
    new FroalaEditor('#blog_para');

</script>

@endsection
