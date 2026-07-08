@extends('layout.dashboard')
@section('dashboards')
@php
use Carbon\Carbon;
use App\Models\User;
@endphp
<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col">
                <div class="card radius-10 border-start border-0  border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Students</p>
                                <h4 class="my-1 text-info">{{$totalStudents->count()}}</h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i class='bx bxs-cart'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col">
                <div class="card radius-10 border-start border-0  border-danger">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Revenue</p>
                                <h4 class="my-1 text-danger">$84,245</h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i class='bx bxs-wallet'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0  border-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Bounce Rate</p>
                                <h4 class="my-1 text-success">34.6%</h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class='bx bxs-bar-chart-alt-2'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0  border-warning">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Customers</p>
                                <h4 class="my-1 text-warning">8.4K</h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i class='bx bxs-group'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        <!--end row-->
        <div class="row">
            <div class="col-12 col-lg-12 d-flex">
                <div class="card radius-10 w-100">
                    @if($profile && $profile->approval == 'active')
                    <div class="card-header">
                        <div class="d-flex flex-wrap align-items-center gap-5">
                            <div>
                                <h6 class="mb-0">Student details</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($bookings->count() > 0)
                        <div class="table-responsive">
                            <table id="studentDetails" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr class="text-center">
                                        <th>Name</th>
                                        <th>Age</th>
                                        <th>Class</th>
                                        <th>Timing</th>
                                        <th>Subjects</th>
                                        <th>Details</th>
                                        <th>Session</th>
                                        <th>Payment</th>
                                        <th>Admin Approval</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bookings as $detail)
                                    <tr class="text-center">
                                        <td style="vertical-align: middle">{{ $detail->std_name }}</td>
                                        <td style="vertical-align: middle">{{ Carbon::parse($detail->std_dob)->age }} Years old</td>
                                        <td style="vertical-align: middle">{{ $detail->std_class }}</td>
                                        <td style="vertical-align: middle">{{ $detail->std_shift }}</td>
                                        <td style="vertical-align: middle">@foreach(json_decode($detail->std_subject) as $index => $subject){{ $subject }} @if($index == count(json_decode($detail->std_subject)) - 1). @else, @endif @endforeach</td>
                                        <td style="vertical-align: middle"><a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="{{'#exampleModal'.$detail->id}}">More Details</a></td>
                                        @if($detail->session == 1)
                                        @if($detail->approval == 1 && $detail->paid == 1)
                                        <td style="vertical-align: middle"><a href="{{route('teacher.session.end',$detail->id)}}" class="btn btn-danger">End Session</a></td>
                                        @elseif($detail->approval == 0)
                                        <td style="vertical-align: middle"><button class="btn btn-danger" disabled>Rejected</button></td>
                                        @else
                                        <td style="vertical-align: middle"><button class="btn btn-warning" disabled>Pending</button></td>
                                        @endif
                                        @else
                                        <td style="vertical-align: middle"><button class="btn btn-danger" disabled>Session Ended</button></td>
                                        @endif
                                        @if($detail->paid == 0)
                                        <td style="vertical-align: middle"><button class="btn btn-success" disabled>UnPaid</button></td>
                                        @else
                                        <td style="vertical-align: middle"><button class="btn btn-success" disabled>Paid</button></td>
                                        @endif
                                        <td style="vertical-align: middle">
                                            @if($detail->admin_approval == 2)
                                            <button class="btn btn-warning" disabled>Pending</button>
                                            @elseif($detail->admin_approval == 1)
                                            <button class="btn btn-success" disabled>Approved</button>
                                            @else
                                            <button class="btn btn-danger" disabled>Rejected</button>
                                            @endif
                                        </td>
                                        <td style="vertical-align: middle">
                                            @if($detail->approval == 2)
                                            <a href="{{route('teacher.approval',$detail->id)}}" class="btn btn-success me-2">Approve</a>
                                            <a href="{{route('teacher.reject',$detail->id)}}" class="btn btn-danger px-4">Reject</a>
                                            @elseif($detail->approval == 1)
                                            <button class="btn btn-success" disabled>Approved</button>
                                            @else
                                            <button class="btn btn-danger" disabled>Rejected</button>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <p>No record found</p>
                        @endif
                    </div>
                    @elseif($profile && $profile->approval == 'deactive')
                    <div class="alert alert-danger">Your Approval has been rejected. Please contact to Admin.</div>
                    @endif
                </div>
            </div>
        </div>
        <!--end row-->

    </div>
</div>
@if($profile && $profile->approval == 'active')
@foreach ($bookings as $detail)
@php
$student = User::find($detail->student_id);
@endphp
<div class="modal fade" id="{{'exampleModal'.$detail->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Other Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex gap-3 mb-4 align-items-center"><img src="{{ (!empty($student->photo)) ? url('uploads/profileimages/'.$student->photo) :  url('/noprofile/no-profile.jpg') }}" alt="Profile Image" id="" class="rounded-circle me-4 bg-primary" width="150">
                    <h2>{{$detail->std_name}}</h2>
                </div>
                <div class="d-flex flex-column ">
                    <p><strong>School :</strong> {{ $detail->std_school }}</p>
                    <p><strong>Area :</strong> {{ $detail->std_area }}</p>
                    @if($detail->paid == 1 && $detail->session == '1')
                    <p><strong>Email :</strong> {{ $detail->std_email }}</p>
                    <p><strong>Phone No :</strong> {{ $detail->std_phone }}</p>
                    <p><strong>Address :</strong> {{ $detail->std_address }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endif
@endsection
