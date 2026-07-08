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
                        <li class="breadcrumb-item"><a href="{{route('admin.service')}}" class="text-decoration-none">Service</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                                <form method="POST" action="{{route('admin.service.update',$service->id)}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-12 mb-3">
                                        <label for="serviceimg" class="form-label mb-2">Service Image</label>
                                        <input type="file" name="serviceimg" id="serviceimg" class="form-control @error('serviceimg') is-invalid @enderror">
                                        <span class="text-danger">{{ $errors->first('serviceimg') }}</span>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="servicehead" class="form-label mb-2">Service Heading</label>
                                        <input type="text" name="servicehead" id="servicehead" class="form-control @error('servicehead') is-invalid @enderror" value="{{$service->servicehead}}">
                                        <span class="text-danger">{{ $errors->first('servicehead') }}</span>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="servicepara" class="form-label mb-2">Service Paragraph</label>
                                        <input type="text" name="servicepara" id="servicepara" class="form-control @error('servicepara') is-invalid @enderror" value="{{$service->servicepara}}">
                                        <span class="text-danger">{{ $errors->first('servicepara') }}</span>
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
@endsection
