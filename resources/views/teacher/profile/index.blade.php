@extends('layout.dashboard')
@section('dashboards')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="card-body">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Teacher</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('teacher.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-body">
                        @if($teacherProfile != null )
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="m-2 mb-4">About Me</h3>
                            <div class=" mb-4 gap-3">
                                @if($teacherProfile != null )
                                @if($teacherProfile->approval == 'pending')
                                <p class="text-danger d-inline">Please enter all your details to get approved </p>
                                |
                                <button disabled class="btn btn-warning">Pending</button>
                                @elseif($teacherProfile->approval == 'active')
                                <button disabled class="btn btn-success">Approved</button>
                                <a href="{{ route('teacher.profile.edit',$teacherProfile->id) }}" class="btn btn-outline-primary "><i class="fa-solid fa-pen-to-square fs-5"></i>Edit</a>
                                {{-- <a href="{{ route('teacher.profile.destroy',$teacherProfile->id) }}" class="btn btn-outline-danger "><i class="fa-solid fa-trash fs-5"></i>Delete</a> --}}
                                @endif
                                @else
                                <a href="{{ route('teacher.profile.create') }}" class="btn btn-primary "><i class="fa-solid fa-plus fs-5"></i>Create</a>
                                @endif
                            </div>
                        </div>
                        <img src="{{ (!empty($user->photo)) ? url('uploads/profileimages/'.$user->photo) :  url('/noprofile/no-profile.jpg') }}" alt="Profile Image" id="" class="rounded-circle  bg-primary" width="150">
                        <div class="table-responsive mt-3">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <td style="vertical-align: middle"><b>Full Name</b> :</td>
                                        <td style="vertical-align: middle">{{ $teacherProfile->fullname }}</td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle"><b>Father Name</b> :</td>
                                        <td style="vertical-align: middle">{{ $teacherProfile->fname }}</td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle"><b>Phone Number</b> :</td>
                                        <td style="vertical-align: middle">{{ $teacherProfile->phone_no }}</td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle"><b>CNIC Number</b> :</td>
                                        <td style="vertical-align: middle">{{ $teacherProfile->cnic }}</td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle"><b>Qualification</b> :</td>
                                        <td style="vertical-align: middle">{{ $teacherProfile->qualification }}</td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle"><b>Experience</b> :</td>
                                        <td style="vertical-align: middle">{{ $teacherProfile->experience }} Years of Experience</td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle"><b>Email</b> :</td>
                                        <td style="vertical-align: middle">{{ $teacherProfile->email }}</td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle"><b>Address</b> :</td>
                                        <td style="vertical-align: middle">{{ $teacherProfile->address }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="alert alert-warning">Please add profile info</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end page wrapper -->
@endsection
