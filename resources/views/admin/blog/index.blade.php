@extends('layout.dashboard')
@section('dashboards')
<style>
    .card-text {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

</style>
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="card-body">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Admin</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Blog</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            @if($blogs->count() > 0)
            <div class="d-flex justify-content-lg-start justify-content-center gap-3 flex-wrap">
                @foreach($blogs as $blog)
                <div class="card" style="width: 22rem;">
                    <img src="{{'/uploads/blogimages/'.$blog->blog_img}}" class="card-img-top" alt="...">
                    <div class="card-body d-flex flex-column gap-2 justify-content-between">
                        <div class="">
                            <p style="font-size: 12px" class="text-primary">{{$blog->img_title}}</p>
                            <h5 class="card-title ">{{$blog->blog_title}}</h5>
                            <a href="javascript:;" class="text-primary d-flex justify-content-center my-3" data-bs-toggle="modal" data-bs-target="{{'#blog_para'.$blog->id}}">View Blog Details</a>
                        </div>
                        <div class="d-flex justify-content-evenly gap-3">
                            <a href="{{ route('admin.blog.edit', $blog->id) }}" class="col-5 d-flex justify-content-center align-items-center btn btn-outline-secondary"><i class="fa-solid fa-pen-to-square fs-6"></i>Edit</a>
                            <a href="{{ route('admin.blog.destroy',$blog->id) }}" class="col-5 d-flex justify-content-center align-items-center btn btn-outline-danger"><i class="fa-solid fa-trash fs-6"></i>Delete</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="alert alert-warning">No blogs found</div>
            @endif
        </div>
    </div>
</div>
<!--end page wrapper -->
@foreach($blogs as $blog)
<div class="modal fade" id="{{'blog_para'.$blog->id}}" tabindex="-1" aria-labelledby="blog_paraLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Blog Paragraph</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>{!! strip_tags($blog->blog_para, '<h1><h2><h3><h4><h5><h6><p><ul><ol><li><strong><br><i><em><u><span>') !!}</p>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

