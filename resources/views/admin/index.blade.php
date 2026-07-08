@extends('layout.dashboard');
@section('dashboards');
@php
    use Carbon\Carbon;
    use App\Models\TeacherProfile;
    use App\Models\TeacherBooking;
    use App\Models\User;
    $totalTeachers = TeacherProfile::get();
    $totalStudents = TeacherBooking::get();
@endphp
<div class="page-wrapper" style="height: auto !important; margin-top: auto;">
    <div class="page-content">
        <div class="row">
            <div class="col">
                <div class="card radius-10 border-start border-0  border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Teachers</p>
                                <h4 class="my-1 text-info">{{$totalTeachers->count()}}</h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i
                                    class='bx bxs-cart'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0  border-danger">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Students</p>
                                <h4 class="my-1 text-danger">{{$totalStudents->count()}}</h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i
                                    class='bx bxs-wallet'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col">
                <div class="card radius-10 border-start border-0  border-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Bounce Rate</p>
                                <h4 class="my-1 text-success">34.6%</h4>
                                <p class="mb-0 font-13">-4.5% from last week</p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i
                                    class='bx bxs-bar-chart-alt-2'></i>
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
                            <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i
                                    class='bx bxs-group'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div><!--end row-->

       <div class="row">
            <div class="col-12 col-lg-12 d-flex">
                <div class="card radius-10 w-100">
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
                                        <th>Student</th>
                                        <th>Student Details</th>
                                        <th>Teacher</th>
                                        <th>Teacher Details</th>
                                        <th>Session</th>
                                        <th>Payment</th>
                                        <th>Teacher Approval</th>
                                        <th>Payment Approval</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bookings as $detail)
                                    @php
                                        $teacher = TeacherProfile::where('role_id',$detail->teacher_id)->first()
                                    @endphp
                                    <tr class="text-center">
                                        <td style="vertical-align: middle">{{ $detail->std_name }}</td>
                                        {{-- <td style="vertical-align: middle">{{ Carbon::parse($detail->std_dob)->age }} Years old</td> --}}
                                        <td style="vertical-align: middle"><a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="{{'#studentModal'.$detail->id}}">Student Details</a></td>
                                        <td style="vertical-align: middle">{{ $teacher->fullname }}</td>
                                        <td style="vertical-align: middle"><a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="{{'#teacherModal'.$detail->id}}">Teacher Details</a></td>
                                        @if($detail->session == 1)
                                        @if($detail->approval == 1 && $detail->paid == 1)
                                        <td style="vertical-align: middle"><button class="btn btn-success" disabled>Active</button></td>
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
                                            @if($detail->approval == 2)
                                            <button class="btn btn-warning me-2" disabled>Pending</button>
                                            @elseif($detail->approval == 1)
                                            <button class="btn btn-success" disabled>Approved</button>
                                            @else
                                            <button class="btn btn-danger" disabled>Rejected</button>
                                            @endif
                                        </td>
                                        <td style="vertical-align: middle">
                                            @if($detail->approval == 2)
                                            <button disabled class="btn btn-warning me-2">Teacher Approval Pending</button>
                                            @else
                                            @if($detail->admin_approval == 2)
                                            <a href="{{route('admin.student.fees.approval',$detail->id)}}" class="btn btn-success me-2">Approve</a>
                                            <a href="{{route('admin.student.fees.reject',$detail->id)}}" class="btn btn-danger me-2">Reject</a>
                                            @elseif($detail->admin_approval == 1 && $detail->approval == 1)
                                            <button class="btn btn-success" disabled>Approved</button>
                                            @else
                                            <button class="btn btn-danger" disabled>Rejected</button>
                                            @endif
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
    </div>
</div>
@foreach ($bookings as $detail)
@php
$teacher = User::find($detail->teacher_id);
$student = User::find($detail->student_id);
$teacherProfile = TeacherProfile::where('role_id',$detail->teacher_id)->first();
@endphp
<div class="modal fade" id="{{'teacherModal'.$detail->id}}" tabindex="-1" aria-labelledby="teacherModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="teacherModalLabel">Teacher Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex gap-3 mb-4 align-items-center"><img src="{{ (!empty($teacher->photo)) ? url('uploads/profileimages/'.$teacher->photo) :  url('/noprofile/no-profile.jpg') }}" alt="Profile Image" id="" class="rounded-circle me-4 bg-primary" width="150">
                    <h2>{{$teacherProfile->fullname}}</h2>
                </div>
                <div class="d-flex flex-column ">
                    <p><strong>Email :</strong> {{ $teacherProfile->email }}</p>
                    <p><strong>Phone No :</strong> {{ $teacherProfile->phone_no }}</p>
                    <p><strong>CNIC :</strong> {{ $teacherProfile->cnic }}</p>
                    <p><strong>Qualification :</strong> {{ $teacherProfile->qualification }}</p>
                    <p><strong>Experience :</strong> {{ $teacherProfile->experience }} Years of experience</p>
                    <p><strong>Address :</strong> {{ $teacherProfile->address }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="{{'studentModal'.$detail->id}}" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="studentModalLabel">Student Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex gap-3 mb-4 align-items-center"><img src="{{ (!empty($student->photo)) ? url('uploads/profileimages/'.$student->photo) :  url('/noprofile/no-profile.jpg') }}" alt="Profile Image" id="" class="rounded-circle me-4 bg-primary" width="150">
                    <h2>{{$detail->std_name}}</h2>
                </div>
                <div class="d-flex flex-column ">
                    <p><strong>School :</strong> {{ $detail->std_school }}</p>
                    <p><strong>Email :</strong> {{ $detail->std_email }}</p>
                    <p><strong>Phone No :</strong> {{ $detail->std_phone }}</p>
                    <p><strong>Age :</strong> {{ Carbon::parse($detail->std_dob)->age }} Years old</p>
                    <p><strong>Address :</strong> {{ $detail->std_address }}</p>
                    <p><strong>Area :</strong> {{ $detail->std_area }}</p>
                    <p><strong>Class :</strong> {{ $detail->std_class }}</p>
                    <p><strong>Timing :</strong> {{ $detail->std_shift }}</p>
                    <p><strong>Subjects :</strong> @foreach(json_decode($detail->std_subject) as $index => $subject){{ $subject }} @if($index == count(json_decode($detail->std_subject)) - 1). @else, @endif @endforeach</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection;