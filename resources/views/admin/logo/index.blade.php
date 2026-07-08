@extends('layout.dashboard')
@section('dashboards')
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
                            <li class="breadcrumb-item active" aria-current="page">Logo</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="col-3">

                @if($logo == null)
                <div class="d-flex justify-content-start align-items-center mb-4 gap-3">
                    <a href="{{ route('admin.logo.create') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="fa-solid fa-plus fs-5"></i>Add Logo</a>
                </div>
                <div class="alert alert-danger">Please add Logo</div>
                @else
                <div class="d-flex justify-content-start align-items-center mb-4 gap-3">
                    <a href="{{ route('admin.logo.edit',$logo->id) }}" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="fa-solid fa-pen-to-square fs-5"></i>Edit</a>
                    <a href="{{ route('admin.logo.destroy',$logo->id) }}" class="btn btn-danger radius-30 mt-2 mt-lg-0"><i class="fa-solid fa-trash fs-5"></i>Delete</a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <img src="{{asset('/uploads/logo/'.$logo->logo)}}" width="300">
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!--end page wrapper -->
@endsection
