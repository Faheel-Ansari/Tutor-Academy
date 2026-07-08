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
                            <li class="breadcrumb-item active" aria-current="page">Sponsor Teacher</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if(count($allTeachers) > 0)
                        <div class="table-responsive">
                            <table id="studentDetails" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr class="text-center">
                                        <th>Profile</th>
                                        <th>Name</th>
                                        <th>Phone.No</th>
                                        <th>Email</th>
                                        <th>CNIC</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allTeachers as $teacher)
                                    <tr class="text-center">
                                        <td style="vertical-align: middle;"><img src="{{ (!empty($teacher->photo)) ? url('uploads/profileimages/'.$teacher->photo) :  url('/noprofile/no-profile.jpg') }}" alt="Profile Image" id="" class="rounded-circle me-4 bg-primary" width="150"></td>
                                        <td style="vertical-align: middle;">{{ $teacher->fullname }}</td>
                                        <td style="vertical-align: middle">{{ $teacher->phone_no }}</td>
                                        <td style="vertical-align: middle">{{ $teacher->email }}</td>
                                        <td style="vertical-align: middle">{{ $teacher->cnic }}</td>
                                        <td style="vertical-align: middle"><a href="{{route('admin.store.sponsor.teacher',$teacher->id)}}" class="btn btn-primary">Add to Sponsor</a></td>
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
@endsection