@extends('layout.dashboard')
@section('dashboards')
@php
use App\Models\User;
use App\Models\TeacherProfile;
@endphp
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
                            <li class="breadcrumb-item active" aria-current="page">Teacher Videos</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="col-7">
                {{-- <div class="d-flex justify-content-start align-items-center mb-4 gap-3">
                    <a href="{{ route('admin.subject.create') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="fa-solid fa-plus fs-5"></i>Add More</a>
            </div> --}}
            <div class="card">
                <div class="card-body">
                    @if($videos->count() > 0)
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <tbody>
                                @foreach($videos as $video)
                                @php
                                $user = User::where('id',$video->role_id)->first();
                                $teacher = TeacherProfile::where('role_id',$video->role_id)->first();
                                @endphp
                                <tr>
                                    <td class="d-flex flex-column align-items-center gap-2 me-5">
                                        <img src="{{ (!empty($user->photo)) ? url('uploads/profileimages/'.$user->photo) : url('/noprofile/no-profile.jpg') }}" alt="Profile Image" id="" class="rounded-circle bg-primary" width="150">
                                        <h4>{{$teacher->fullname}}</h4>
                                        <div class="d-flex flex-column align-items-center gap-2">
                                            @if($video->approval == '1')
                                            <button class="btn btn-success" disabled>Approved</button>
                                            <a href="{{route('admin.teacher.reject.video',$video->id)}}" class="btn btn-danger px-4">Reject</a>
                                            @endif
                                        </div>
                                    </td>
                                    <td style="vertical-align: middle; text-align: start"><video width="500" controls src="{{asset('/uploads/teacher_videos/'.$video->video)}}"></video></td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="alert alert-danger">No Videos Found</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
