@extends('layout.dashboard')
@section('dashboards')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Teacher</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('teacher.dashboard')}}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{route('teacher.profile.index')}}" class="text-decoration-none">Profile</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
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
                                <form method="POST" action="{{route('teacher.profile.update',$teacherProfile->id)}}">
                                    @csrf
                                    <div class="col-md-12 mb-3">
                                        <label for="fullname" class="form-label mb-2">Full Name</label>
                                        <input type="text" name="fullname" id="fullname" class="form-control" value="{{$teacherProfile->fullname}}" placeholder="Enter Full Name">
                                        <span class="text-danger">{{ $errors->first('fullname') }}</span>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="fname" class="form-label mb-2">Father Name</label>
                                        <input type="text" name="fname" id="fname" class="form-control" value="{{$teacherProfile->fname}}" placeholder="Enter Father Name">
                                        <span class="text-danger">{{ $errors->first('fname') }}</span>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="email" class="form-label mb-2">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" value="{{$teacherProfile->email}}" placeholder="Example@gmail.com">
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="phone_no" class="form-label mb-2">Phone Number</label>
                                        <input type="tel" name="phone_no" id="phone_no" class="form-control" value="{{$teacherProfile->phone_no}}" placeholder="Enter Phone Number">
                                        <span class="text-danger">{{ $errors->first('phone_no') }}</span>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="cnic" class="form-label mb-2">CNIC Number</label>
                                        <input type="text" name="cnic" id="cnic" class="form-control" value="{{$teacherProfile->cnic}}" placeholder="Enter CNIC Number">
                                        <span class="text-danger">{{ $errors->first('cnic') }}</span>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="qualification" class="form-label mb-2">Qualification</label>
                                        <input type="text" name="qualification" id="qualification" class="form-control" value="{{$teacherProfile->qualification}}" placeholder="Enter Your Qualification">
                                        <span class="text-danger">{{ $errors->first('qualification') }}</span>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="experience" class="form-label mb-2">Experience in years</label>
                                        <input type="number" name="experience" id="experience" class="form-control" value="{{$teacherProfile->experience}}" placeholder="Enter Your Experience">
                                        <span class="text-danger">{{ $errors->first('experience') }}</span>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="address" class="form-label mb-2">Current Address</label>
                                        <input type="text" name="address" id="address" class="form-control" value="{{$teacherProfile->address}}" placeholder="Enter Your Current Address">
                                        <span class="text-danger">{{ $errors->first('address') }}</span>
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
