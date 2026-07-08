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
                        <li class="breadcrumb-item"><a href="{{route('admin.sociallink')}}" class="text-decoration-none">Social Links</a></li>
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
                                <form method="POST" action="{{route('admin.sociallink.store')}}">
                                    @csrf
                                    <div class="col-md-12 mb-3">
                                        <label for="name" class="form-label mb-2">Name</label>
                                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="link" class="form-label mb-2">Link</label>
                                        <input type="text" name="link" id="link" class="form-control @error('link') is-invalid @enderror" value="{{old('link')}}">
                                        <span class="text-danger">{{ $errors->first('link') }}</span>
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
