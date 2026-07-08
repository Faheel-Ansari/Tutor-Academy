@extends('frontend.body.master')
@section('content')
@php
use App\Models\User;
use App\Models\TeacherProfile;
use App\Models\TeacherGrade;
use App\Models\TeacherArea;
use App\Models\TeacherBooking;
use App\Models\TeacherFee;
@endphp
<style>
    .searchCard {
        height: 450px;
        width: 360px;
        display: flex;
        justify-content: center;
        align-items: start;
        border-radius: 10px;
        padding: 10px;
        transition: all ease-in-out 0.3s
    }

    .searchCard:hover {
        background-color: #1d7dc721;
    }

    .search__area {
        background-color: #EEF3F8;
        border-radius: 50px;
    }

    #select {
        width: 100%;
    }

    .filter-box {
        background-color: #EEF3F8;
        border-radius: 50px;
    }

    .search-wrapper {
        background-image: url(/frontend/assets/images/all-instructor/banner-bg.jpg);
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
    }

</style>
<!-- course-instructor start -->
<section class="course-instructor search-wrapper py-5">
    <div class="container d-flex justify-content-center mt-5 pt-5">
        <div class="w-lg-50">
            <form action="{{route('teacher.search')}}" name="search" method="GET">
                <ul class="search__area d-md-flex align-items-center justify-content-between mb-30">
                    <li>
                        <div class="d-flex align-items-center px-4">
                            <input type="text" name="search" placeholder="Search by, Subject, Teacher" value="{{($search) ? $search : ''}}">
                            <span class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                        </div>
                    </li>
                    <li>
                        <div class="px-4">
                            <select name="area" id="select" class="mySelect">
                                <option disabled selected>Select Area</option>
                                @foreach($areas as $area)
                                <option value="{{$area->area}}" @if($area->area == $selectedArea) selected @endif>{{$area->area}}</option>
                                @endforeach
                            </select>
                        </div>
                    </li>
                    <li class="d-flex justify-content-md-end justify-content-center">
                        <button type="submit" class="el-btn">Search Now</button>
                    </li>
                </ul>
            </form>
        </div>
    </div>
    <div class="container mt-4 d-flex flex-column align-items-center justify-content-center">
        <h4 class="mb-4">Filters</h4>
        <form action="{{route('teacher.search')}}" name="search" class="col-12 d-md-flex justify-content-center" method="GET">
            <input type="hidden" name="search" value="{{($search) ? $search : ''}}">
            <input type="hidden" name="area" value="{{($selectedArea) ? $selectedArea : ''}}">
            <div class="filter-box w-md-75 w-100 px-4 py-3 d-md-flex align-items-center gap-4">
                <div class="d-flex flex-column justify-content-center align-items-center w-md-50 w-100 h-10">
                    <label for="class">Select Your Class</label>
                    <select name="class" id="select" class="mySelect">
                        <option disabled selected>Select Class</option>
                        @foreach($classes as $idx => $class)
                        <option value="{{$class->grade}}" @if($class->grade == $selectedClass) selected @endif>{{$class->grade}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="d-flex flex-column justify-content-center align-items-center w-md-50 w-100 h-10">
                    <label for="board">Select Your Board</label>
                    <select name="board" id="select" class="mySelect">
                        <option disabled selected>Select Board</option>
                        @foreach($boards as $idx => $board)
                        <option value="{{$board->board_name}}" @if($board->board_name == $selectedBoard) selected @endif>{{$board->board_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class=" w-md-50 w-100 h-10">
                    <label for="">Choose fees : </label>
                    <output for="customRange4" id="rangeValue" aria-hidden="true">{{($selectedFees) ? $selectedFees : ''}}</output>
                    <input type="range" class="form-range h-10" step="500" name="fees" min="5000" max="50000" value="{{($selectedFees) ? $selectedFees : '0'}}" id="customRange4">
                </div>
                <div class="d-flex align-items-center justify-content-center">
                    <button type="submit" class="el-btn-signup">Apply Filter</button>
                </div>
            </div>
        </form>
    </div>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title text-center mb-4">
                    <h5 class="bottom-line ">Search Results</h5>
                </div>
                @if(($student->package == 'free' && $student->count == 8) || ($admin_pricing != null && $student->package == $admin_pricing->name && $student->count == $admin_pricing->click))
                <div class="alert alert-danger text-center" role="alert">
                    Package expired. Please <a href="{{ url('/#pricingContainer') }}">Upgrade</a> your package.
                </div>
                @endif
            </div>
        </div>
        <div class="row d-flex justify-content-center px-lg-5">
            @if($results->count() > 0)
            <div class="col-11 col-xl-12 d-flex justify-content-lg-start justify-content-center gap-3  flex-wrap text-center">
                @foreach($results as $result)
                @php
                $teacherProfile = TeacherProfile::where('role_id', $result->role_id)->where('approval','active')->where('status','active')->first();
                if ($teacherProfile) {
                $user = User::where('id',$result->role_id)->first();
                $teacher_classes = TeacherGrade::where('role_id',$result->role_id)->get();
                $teacher_area = TeacherArea::where('role_id',$result->role_id)->get();
                $teacher_fee = TeacherFee::where('role_id',$result->role_id)->first();
                $hired = TeacherBooking::where('teacher_id',$result->role_id)
                ->where('student_id',Auth::user()->id)
                ->where('paid','1')
                ->where('session','1')
                ->first();
                }
                @endphp
                @if($teacherProfile)
                @if(($admin_pricing != null && $student->package == $admin_pricing->name && $student->count < $admin_pricing->click) || ($student->package == 'free' && $student->count < 8)) <div class="searchCard border-dark border-1 border">
                        <a href="{{route('teacher.details',$result->role_id)}}" class="text-decoration-none position-relative w-md-100 no-bg h-100">
                            @if($hired)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                You Already Hired
                            </span>
                            @endif
                            <div class=" d-flex flex-column align-items-center justify-content-between h-100 pb-4 text-center">
                                <div class="z-instructors__thumb mb-15">
                                    <img src="{{ (!empty($user->photo)) ? url('./uploads/profileimages/'.$user->photo) :  url('/noprofile/no-profile.jpg') }}" class="rounded-circle" width="220" alt="">
                                </div>
                                <div class="z-instructors__content">
                                    <h4>{{$teacherProfile->fullname}}</h4>
                                    <p class="text-dark">{{$teacherProfile->experience}} years of Experience</p>
                                    <p class="text-dark text-wap">@foreach($teacher_classes as $index => $grade){{$grade->class}}@if($index == count($teacher_classes) - 1). @else, @endif @endforeach</p>
                                    <p class="text-dark">@foreach($teacher_area as $index => $area){{$area->area}}@if($index == count($teacher_area) - 1). @else, @endif @endforeach</p>
                                    <p class="text-bold">Fee : {{$teacher_fee->fee}}/-</p>
                                </div>
                            </div>
                        </a>
            </div>
            @else
            <div class="searchCard border-dark border-1 border">
                <button disabled class="text-decoration-none position-relative w-75 no-bg h-100">
                    @if($hired)
                    <span class="position-absolute top-0 start-100 translate-middle mt-2 badge rounded-pill bg-danger">
                        Already Hired
                    </span>
                    @endif
                    <div class=" d-flex flex-column align-items-center justify-content-between h-100 pb-4 text-center">
                        <div class="z-instructors__thumb mb-15">
                            <img src="{{ (!empty($user->photo)) ? url('./uploads/profileimages/'.$user->photo) :  url('/noprofile/no-profile.jpg') }}" class="rounded-circle" width="220" alt="">
                        </div>
                        <div class="z-instructors__content">
                            <h4>{{$teacherProfile->fullname}}</h4>
                            <p class="text-dark">{{$teacherProfile->experience}} years of Experience</p>
                            <p class="text-dark">@foreach($teacher_classes as $index => $grade){{$grade->class}}@if($index == count($teacher_classes) - 1). @else, @endif @endforeach</p>
                            <p class="text-dark">@foreach($teacher_area as $index => $area){{$area->area}}@if($index == count($teacher_area) - 1). @else, @endif @endforeach</p>
                            <p class="text-bold">Fee : {{$teacher_fee->fee}}/-</p>
                        </div>
                    </div>
                </button>
            </div>
            @endif
            @endif
            @endforeach
        </div>
        @else
        <h3 class="text-center col-md-10 p-0 m-0">No Search Result Found</h3>
        @endif
    </div>
    </div>
</section>
<div class="el-team-wrapper">
    <div class="container">
        <div class="el-team-heading text-center">
            <h4 class="el-top-heading-center">all subjects</h4>
            <h2 class="el-main-heading">Explore More Subjects</h2>
        </div>
        <div class="el-team-parent swiper">
            <div class="swiper-wrapper">
                @foreach($subjects as $subject)
                <div class="swiper-slide">
                    <div class="el-team-box">
                        <a href="{{route('subject.details',$subject->id)}}">
                            <div class="el-team-box-inner">
                                <div class="el-team-img">
                                    <img src="{{asset('/uploads/adminimages/'.$subject->sub_img)}}" width="100" alt="Team Member">
                                </div>
                                <div class="el-team-content">
                                    <h4>{{$subject->subject}}</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</div>
<div class="el-team-wrapper mb-5">
    <div class="container mb-5">
        <div class="el-team-heading text-center">
            <h4 class="el-top-heading-center">all instructors</h4>
            <h2 class="el-main-heading">Explore More Instructors</h2>
        </div>
        <div class="el-team-parent swiper">
            <div class="swiper-wrapper">
                @foreach($teachers as $teacher)
                @php
                $user = User::where('id',$teacher->role_id)->first();
                @endphp
                @if(Auth::user()->role == 'student')
                @if(($admin_pricing != null && $student->package == $admin_pricing->name && $student->count < $admin_pricing->click) || ($student->package == 'free' && $student->count < 8)) <div class="swiper-slide">
                        <div class="el-team-box">
                            <a href="{{route('teacher.details',$teacher->id)}}">
                                <div class="el-team-box-inner">
                                    <div class="el-team-img">
                                        <img src="{{ (!empty($user->photo)) ? url('./uploads/profileimages/'.$user->photo) :  url('/noprofile/no-profile.jpg') }}" width="100" alt="Team Member">
                                    </div>
                                    <div class="el-team-content d-flex flex-column align-items-center">
                                        <h4>{{$teacher->fullname}}</h4>
                                        <p class="el-para">{{$teacher->qualification}}</p>
                                        <p class="el-para"><img src="{{ asset('/frontend/assets/images/all-instructor/team-icon.png') }}" alt="icon"> {{$teacher->experience}} years of Experience</p>
                                    </div>
                                </div>
                            </a>
                        </div>
            </div>
            @else
            <div class="swiper-slide">
                <div class="el-team-box">
                    <div>
                        <div class="el-team-box-inner">
                            <div class="el-team-img">
                                <img src="{{ (!empty($user->photo)) ? url('./uploads/profileimages/'.$user->photo) :  url('/noprofile/no-profile.jpg') }}" width="100" alt="Team Member">
                            </div>
                            <div class="el-team-content d-flex gap-3 flex-column align-items-center">
                                <h4>{{$teacher->fullname}}</h4>
                                <button disabled class="btn btn-danger">Package Expired</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @else
            <div class="swiper-slide">
                <div class="el-team-box">
                    <div>
                        <div class="el-team-box-inner">
                            <div class="el-team-img">
                                <img src="{{ (!empty($user->photo)) ? url('./uploads/profileimages/'.$user->photo) :  url('/noprofile/no-profile.jpg') }}" width="100" alt="Team Member">
                            </div>
                            <div class="el-team-content d-flex gap-3 flex-column align-items-center">
                                <h4>{{$teacher->fullname}}</h4>
                                @if(Auth::user()->role == 'admin')
                                <button disabled class="btn btn-primary">Admin can't access</button>
                                @elseif(Auth::user()->role == 'teacher')
                                <button disabled class="btn btn-primary">Teacher can't access</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>
</div>
<!-- course-instructor end -->

<script>
    const range = document.getElementById('customRange4');
    const output = document.getElementById('rangeValue');

    // Show current value
    output.textContent = range.value;

    // Update output on slider change
    range.addEventListener('input', function() {
        output.textContent = this.value;
    });

</script>
@endsection
