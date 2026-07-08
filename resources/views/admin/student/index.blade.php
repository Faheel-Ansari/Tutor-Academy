@extends('layout.dashboard')
@section('dashboards')
@php
use App\Models\User;
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
                            <li class="breadcrumb-item active" aria-current="page">Students</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        @if(count($students) > 0)
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <th>Profile</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                </thead>
                                <tbody>
                                    @foreach($students as $student)
                                    <tr>
                                        <td><img src="{{ (!empty($student->photo)) ? url('uploads/profileimages/'.$student->photo) :  url('/noprofile/no-profile.jpg') }}" alt="Profile Image" id="" class="rounded-circle me-4 bg-primary" width="150"></td>
                                        <td style="vertical-align: middle">
                                            {{$student->name}}
                                        </td>
                                        <td style="vertical-align: middle">
                                            @if($student->status == '1')
                                            <a href="{{route('admin.student.status',$student->id)}}" class="btn btn-success px-4">Suspend</a>
                                            @else
                                            <a href="{{route('admin.student.status',$student->id)}}" class="btn btn-danger px-4">Un-Suspend</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="alert alert-danger">No students Found</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @foreach($allstudents as $student)
<div class="modal fade" id="{{'details'.$teacher->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">More Details</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body d-flex justify-content-between flex-wrap px-5">
            <div class="table-responsive">
                <table class="table mb-0">
                    <tbody class="d-flex flex-column align-items-start">
                        @php
                        $user = User::where('id',$teacher->role_id)->first();
                        $subjects = Subjects::where('role_id',$teacher->role_id)->get();
                        $classes = TeacherGrade::where('role_id',$teacher->role_id)->get();
                        $fees = TeacherFee::where('role_id',$teacher->role_id)->first();
                        $timings = TeacherShift::where('role_id',$teacher->role_id)->get();
                        $boards = TeacherBoard::where('role_id',$teacher->role_id)->get();
                        $areas = TeacherArea::where('role_id',$teacher->role_id)->get();
                        @endphp
                        <tr>
                            <th style="vertical-align: middle; text-align: start">Full Name : </th>
                            <td style="vertical-align: middle; text-align: start">{{$teacher->fullname}}</td>
                        </tr>
                        <tr>
                            <th style="vertical-align: middle; text-align: start">Father's Name : </th>
                            <td style="vertical-align: middle; text-align: start">{{$teacher->fname}}</td>
                        </tr>
                        <tr>
                            <th style="vertical-align: middle; text-align: start">Phone No : </th>
                            <td style="vertical-align: middle; text-align: start">{{$teacher->phone_no}}</td>
                        </tr>
                        <tr>
                            <th style="vertical-align: middle; text-align: start">CNIC : </th>
                            <td style="vertical-align: middle; text-align: start">{{$teacher->cnic}}</td>
                        </tr>
                        <tr>
                            <th style="vertical-align: middle; text-align: start">Qualification : </th>
                            <td style="vertical-align: middle; text-align: start">{{$teacher->qualification}}</td>
                        </tr>
                        <tr>
                            <th style="vertical-align: middle; text-align: start">Email : </th>
                            <td style="vertical-align: middle; text-align: start">{{$teacher->email}}</td>
                        </tr>
                        <tr>
                            <th style="vertical-align: middle; text-align: start">Experience : </th>
                            <td style="vertical-align: middle; text-align: start">{{$teacher->experience}} years of experience</td>
                        </tr>
                        <tr>
                            <th style="vertical-align: middle; text-align: start">Address : </th>
                            <td style="vertical-align: middle; text-align: start" class="text-wrap">{{$teacher->address}}</td>
                        </tr>
                        <tr>
                            <th style="vertical-align: middle; text-align: start">Fees : </th>
                            <td style="vertical-align: middle; text-align: start" class="text-wrap text-danger">{{$fees->fee}}/-</td>
                        </tr>
                        <tr>
                            <td>
                                <h3>Subjects</h3>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: middle; text-align: end" class="text-wrap">@foreach($subjects as $index => $subject){{$subject->subjectname}} @if($index == count($subjects) - 1). @else, @endif @endforeach</td>
                        </tr>
                        <tr>
                            <td>
                                <h3>Classes</h3>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: middle; text-align: end" class="text-wrap">@foreach($classes as $index => $class){{$class->class}} @if($index == count($classes) - 1). @else, @endif @endforeach</td>
                        </tr>
                        <tr>
                            <td>
                                <h3>Timings</h3>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: middle; text-align: end" class="text-wrap">@foreach($timings as $index => $timing)@if($timing->status == '0')<span class="text-danger text-decoration-line-through">{{$timing->shift_name}}</span> @else {{$timing->shift_name}} @endif @if($index == count($timings) - 1). @else, @endif @endforeach</td>
                        </tr>
                        <tr>
                            <td>
                                <h3>Boards</h3>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: middle; text-align: end" class="text-wrap">@foreach($boards as $index => $board)@if($board->status == '0')<span class="text-danger text-decoration-line-through">{{$board->board_name}}</span> @else {{$board->board_name}} @endif @if($index == count($boards) - 1). @else, @endif @endforeach</td>
                        </tr>
                        <tr>
                            <td>
                                <h3>Preferred Areas</h3>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: middle; text-align: end" class="text-wrap">@foreach($areas as $index => $area)@if($area->status == '0')<span class="text-danger text-decoration-line-through">{{$area->area}}</span> @else {{$area->area}} @endif @if($index == count($areas) - 1). @else, @endif @endforeach</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endforeach --}}
<!--end page wrapper -->
@endsection
