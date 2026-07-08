@extends('layout.dashboard')
@section('dashboards')
@php
use Carbon\Carbon;
use App\Models\TeacherProfile;
use App\Models\User;
use App\Models\ReportAbuse;
@endphp
<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col">
                <div class="card radius-10 border-start border-0  border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Teachers</p>
                                <h4 class="my-1 text-info">{{$bookings->count()}}</h4>
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
                                <p class="mb-0 font-13">+5.4% from last week</p>
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
                                <p class="mb-0 font-13">-4.5% from last week</p>
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
                                <p class="mb-0 font-13">+8.4% from last week</p>
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
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Booking Details</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($bookings != null && !$bookings->isEmpty())
                        <div class="table-responsive">
                            <table id="studentDetails" class="table mb-0">
                                <thead>
                                    <tr class="text-center">
                                        <th>Teacher</th>
                                        <th>Class</th>
                                        <th>Timing</th>
                                        <th>Subjects</th>
                                        <th>Details</th>
                                        <th>Payment</th>
                                        <th>Session</th>
                                        <th>Teacher Approval</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bookings as $detail)
                                    @php
                                    $teacher = TeacherProfile::where('role_id',$detail->teacher_id)->first();
                                    @endphp
                                    <tr class="text-center">
                                        <td style="vertical-align: middle">{{ $teacher->fullname }}</td>
                                        <td style="vertical-align: middle">{{ $detail->std_class }}</td>
                                        <td style="vertical-align: middle">{{ $detail->std_shift }}</td>
                                        <td style="vertical-align: middle">@foreach(json_decode($detail->std_subject) as $index => $subject){{ $subject }} @if($index == count(json_decode($detail->std_subject)) - 1). @else, @endif @endforeach</td>
                                        <td style="vertical-align: middle">
                                            @if($detail->paid == 1 && $detail->session == 1 && $detail->pay_approval == 1)
                                            <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="{{'#exampleModal'.$detail->id}}">Teacher Details</a></td>
                                        @else
                                        <button class="btn btn-primary" disabled>Teacher Details</button>
                                        @endif
                                        </td>
                                        <td style="vertical-align: middle">
                                            @if($detail->approval == 1 && $detail->admin_approval == 1)
                                            @if($detail->paid == 0)
                                            <a href="{{route('student.teacher.payment.page',$detail->id)}}" class="btn btn-danger">Pay Now</a>
                                            @elseif($detail->pay_approval == 0)
                                            <button class="btn btn-warning" disabled>Verifying Payment</button>
                                            @else
                                            <button class="btn btn-success" disabled>Paid</button>
                                            @endif
                                            @elseif($detail->approval == 0)
                                            <button class="btn btn-danger" disabled>Rejected</button>
                                            @elseif($detail->approval == 2)
                                            <button class="btn btn-warning" disabled>Pending</button>
                                            @else
                                            <button class="btn btn-warning" disabled>Admin Approval Pending</button>
                                            @endif
                                        </td>
                                        <td style="vertical-align: middle">
                                            @if($detail->session == 1)
                                            @if($detail->approval == 1 && $detail->paid == 1 && $detail->pay_approval == 1)
                                            <button class="btn btn-success" disabled>Active</button>
                                            @elseif($detail->approval == 0)
                                            <button class="btn btn-danger" disabled>Rejected</button>
                                            @else
                                            <button class="btn btn-warning" disabled>Pending</button>
                                            @endif
                                            @else
                                            <button class="btn btn-danger" disabled>Ended</button>
                                            @endif
                                        </td>
                                        <td style="vertical-align: middle">
                                            @if($detail->approval == 1)
                                            <button class="btn btn-success" disabled>Approved</button>
                                            @elseif($detail->approval == 0)
                                            <button class="btn btn-danger" disabled>Rejected</button>
                                            @else
                                            <button class="btn btn-warning" disabled>Pending</button>
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
                </div>
            </div>
        </div>
        <!--end row-->
    </div>
</div>
@foreach ($bookings as $detail)
@php
$teacher = TeacherProfile::where('role_id',$detail->teacher_id)->first();
$user = User::where('id',$detail->teacher_id)->first();
@endphp
<div class="modal fade" id="{{'exampleModal'.$detail->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Teacher Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                 <div class="d-flex gap-3 mb-4 align-items-center"><img src="{{ (!empty($user->photo)) ? url('uploads/profileimages/'.$user->photo) :  url('/noprofile/no-profile.jpg') }}" alt="Profile Image" id="" class="rounded-circle me-4 bg-primary" width="150">
                    <h2>{{$teacher->fullname}}</h2>
                </div>
                <div class="d-flex flex-column ">
                    <p><strong>Email :</strong> {{$teacher->email}}</p>
                    <p><strong>Phone :</strong> {{$teacher->phone_no}}</p>
                    <p><strong>CNIC :</strong> {{$teacher->cnic}}</p>
                    <p><strong>Experience :</strong> {{$teacher->experience}} Years of Experience</p>
                    <p><strong>Qualification :</strong> {{$teacher->qualification}}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endforeach
@endsection
