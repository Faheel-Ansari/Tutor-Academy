@extends('layout.dashboard')
@section('dashboards')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Admin</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.about')}}" class="text-decoration-none">About Us</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-lg-6">
                <div class="border border-3 p-4 rounded">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <!-- Restaurant Name -->
                                <form method="POST" action="{{route('admin.about.store')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-12 mb-3">
                                        <label for="aboutimg" class="form-label mb-2">About Image</label>
                                        <input type="file" name="aboutimg" id="aboutimg" class="form-control @error('aboutimg') is-invalid @enderror">
                                        <span class="text-danger">{{ $errors->first('aboutimg') }}</span>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="abouthead" class="form-label mb-2">About Heading</label>
                                        <input type="text" name="abouthead" id="abouthead" class="form-control @error('abouthead') is-invalid @enderror" value="{{old('abouthead')}}">
                                        <span class="text-danger">{{ $errors->first('abouthead') }}</span>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="aboutpara" class="form-label mb-2">About Paragraph</label>
                                        <textarea rows="5" name="aboutpara" id="aboutpara" class="form-control @error('aboutpara') is-invalid @enderror">{{old('aboutpara')}}</textarea>
                                        <span class="text-danger">{{ $errors->first('aboutpara') }}</span>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="d-md-flex d-grid align-items-center gap-3">
                                            <button type="submit" class="btn btn-primary px-4">Add</button>
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
@endsection
