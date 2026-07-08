@extends('layout.dashboard')
@section('dashboards')
@php
use App\Models\User;
use App\Models\Subjects;
use App\Models\TeacherGrade;
use App\Models\TeacherFee;
use App\Models\TeacherShift;
use App\Models\TeacherBoard;
use App\Models\TeacherArea;
use App\Models\ReportAbuse;
@endphp
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="card-body">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Student</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('student.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Report Teacher</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="col-7">
                <div class="card">
                    <div class="card-body">
                        @if(count($reportTeachers) > 0)
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                    @foreach($reportTeachers as $teacher)
                                    @php
                                    $report = ReportAbuse::where('teacher_id',$teacher->id)->where('student_id', Auth::user()->id)->first();
                                    @endphp
                                    <tr>
                                        <td><img src="{{ (!empty($teacher->photo)) ? url('uploads/profileimages/'.$teacher->photo) :  url('/noprofile/no-profile.jpg') }}" alt="Profile Image" id="" class="rounded-circle me-4 bg-primary" width="150">{{$teacher->fullname}}</td>
                                        <td style="vertical-align: middle; text-align: start">
                                            @if($report && $report->status == '1')
                                            <button disabled class="btn btn-danger">Reported</button>
                                            @else
                                            <a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="{{'#reportModal'.$teacher->id}}">Report Abuse</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="alert alert-danger">No Teachers Found</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@foreach($reportTeachers as $teacher)
<div class="modal fade" id="{{'reportModal'.$teacher->id}}" tabindex="-1" aria-labelledby="reportModal" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{route('student.report.abuse')}}" method="POST">
            @csrf
            <input type="hidden" name="teacher_id" value="{{$teacher->id}}">
            <input type="hidden" name="student_id" value="{{Auth::user()->id}}">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="reportModal">Report Abuse</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <label for="std_phone" class="form-label ">Phone Number</label>
                        <input type="number" name="std_phone" class="form-control @error('std_phone') is-invalid @enderror" placeholder="Enter your phone number" value="{{old('std_phone')}}">
                        @error('std_phone')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-12 mt-4">
                        <label for="message" class="form-label mb-3">Why are you reporting this teacher?</label>
                        <textarea name="message" id="message" rows="5" class="form-control @error('message') is-invalid @enderror" placeholder="Write your reason here...."></textarea>
                        @error('message')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary px-3">Send</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach
<!--end page wrapper -->
@endsection
