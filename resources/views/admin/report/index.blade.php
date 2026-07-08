@extends('layout.dashboard')
@section('dashboards')
@php
use App\Models\TeacherProfile;
use App\Models\User;
use App\Models\ReportAbuse;
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
                            <li class="breadcrumb-item active" aria-current="page">Abuse Reports</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="col-10">
                <div class="card">
                    <div class="card-body">
                        @if($reports->count() > 0)
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <th style="vertical-align: middle; text-align: start">Student Details</th>
                                        <th style="vertical-align: middle; text-align: start">Teacher Details</th>
                                        <th style="vertical-align: middle; text-align: start">Report Reason</th>
                                        <th style="vertical-align: middle; text-align: start">Suspend Teacher</th>
                                        <th style="vertical-align: middle; text-align: start">Suspend Student</th>
                                    </tr>
                                    @foreach($reports as $report)
                                    @php
                                    $teacher = TeacherProfile::join('users','teacher_profile.role_id','=','users.id')->where('teacher_profile.role_id',$report->teacher_id)->first();
                                    $student = User::where('id',$report->student_id)->first();
                                    @endphp
                                    <tr>
                                        <td style="vertical-align: middle; text-align: start"><a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="{{'#stdDetailsModal'.$report->id}}">Student Details</a></td>
                                        <td style="vertical-align: middle; text-align: start"><a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="{{'#teachDetailsModal'.$report->id}}">Teacher Details</a></td>
                                        <td style="vertical-align: middle; text-align: start"><a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="{{'#reasonModal'.$report->id}}">Report Reason</a></td>
                                        <td style="vertical-align: middle; text-align: start">
                                            @if($teacher->status == '1')
                                            <a href="{{route('admin.teacher.suspend',$teacher->role_id)}}" class="btn btn-danger px-4">Suspend Teacher</a>
                                            @else
                                            <button disabled class="btn btn-danger px-4">Teacher Suspended</button>
                                            @endif
                                        </td>
                                        <td style="vertical-align: middle; text-align: start">
                                            @if($student->status == '1')
                                            <a href="{{route('admin.student.suspend',$student->id)}}" class="btn btn-danger px-4">Suspend Student</a>
                                            @else
                                            <button disabled class="btn btn-danger px-4">Student Suspended</button>
                                            @endif
                                        </td>
                                        <td style="vertical-align: middle;">
                                            @if($report->read_no == 1)
                                            <button class="btn btn-secondary" disabled>Resolved</button>
                                            @else
                                            <a href="{{route('admin.report.seen',$report->id)}}" class="btn btn-warning">Pending</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="alert alert-danger">Please add report</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end page wrapper -->
@foreach($reports as $report)
@php
$teacher = TeacherProfile::join('users','teacher_profile.role_id','=','users.id')->where('teacher_profile.role_id',$report->teacher_id)->first();
$student = User::where('id',$report->student_id)->first();
@endphp
<div class="modal fade" id="{{'stdDetailsModal'.$report->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Student Detail</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex gap-3 mb-4 align-items-center"><img src="{{ (!empty($student->photo)) ? url('uploads/profileimages/'.$student->photo) :  url('/noprofile/no-profile.jpg') }}" alt="Profile Image" id="" class="rounded-circle me-4 bg-primary" width="150">
                    <h2>{{$student->name}}</h2>
                </div>
                <div class="d-flex flex-column ">
                    <p><strong>Email :</strong> {{$student->email}}</p>
                    <p><strong>Phone :</strong> {{$report->std_phone}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="{{'teachDetailsModal'.$report->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Teacher Detail</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex gap-3 mb-4 align-items-center"><img src="{{ (!empty($teacher->photo)) ? url('uploads/profileimages/'.$teacher->photo) :  url('/noprofile/no-profile.jpg') }}" alt="Profile Image" id="" class="rounded-circle me-4 bg-primary" width="150">
                    <h2>{{$teacher->fullname}}</h2>
                </div>
                <div class="d-flex flex-column ">
                    <p><strong>Email :</strong> {{$teacher->email}}</p>
                    <p><strong>Phone :</strong> {{$teacher->phone_no}}</p>
                    <p><strong>CNIC :</strong> {{$teacher->cnic}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="{{'reasonModal'.$report->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Report Reason</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>{{$report->message}}</p>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
