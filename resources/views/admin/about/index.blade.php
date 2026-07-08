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
                            <li class="breadcrumb-item active" aria-current="page">About Us</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="col-3">

                @if($about == null)
                <div class="d-flex justify-content-start align-items-center mb-4 gap-3">
                    <a href="{{ route('admin.about.create') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="fa-solid fa-plus fs-5"></i>Add About Detials</a>
                </div>
                <div class="alert alert-danger">Please add About Details</div>
                @else
                <div class="d-flex justify-content-start align-items-center mb-4 gap-3">
                    <a href="{{ route('admin.about.edit',$about->id) }}" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="fa-solid fa-pen-to-square fs-5"></i>Edit</a>
                    <a href="{{ route('admin.about.destroy',$about->id) }}" class="btn btn-danger radius-30 mt-2 mt-lg-0"><i class="fa-solid fa-trash fs-5"></i>Delete</a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <img src="{{asset('/uploads/adminimages/'.$about->aboutimg)}}" width="300">
                        <h2>{{$about->abouthead}}</h2>
                        <p>{{$about->aboutpara}}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!--end page wrapper -->
@endsection
