@extends('frontend.body.master')
@section('content')
@php
use App\Models\User;
use App\Models\TeacherProfile;
use App\Models\TeacherGrade;
use App\Models\StdPricing;
@endphp
<!-- Breadcrumb End -->
<div class="el-breadcrumb-wrapper">
    <div class="container">
        <div class="el-breadcrmb-inner">
            <h1>{{$subjectname->subject}}</h1>
        </div>
    </div>
</div>
<!-- Breadcrumb Start -->

<!-- Blog Single Start -->
<div class="el-course-wrapper">
    <div class="container">
        <div class="el-course-heading text-center">
            <h2 class="el-main-heading">Teachers for {{$subjectname->subject}}</h2>
        </div>
        <div class="el-tab-parent mt-4">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="courses" role="tabpanel" aria-labelledby="all-courses-tab">
                    @if($allSubjects->count() > 0)
                    <div class="el-tab-slider-parent swiper">
                        <div class="swiper-wrapper">
                            @foreach($allSubjects as $idx => $subject)
                            @php
                            $subjectTeacher = TeacherProfile::where('role_id',$subject->role_id)->where('approval','active')->where('status','active')->first();
                            $user = [];
                            $teacher_classes = [];
                            if ($subjectTeacher) {
                            $user = User::where('id',$subjectTeacher->role_id)->first();
                            $teacher_classes = TeacherGrade::where('role_id',$subject->role_id)->get();
                            }
                            $popteachIdx = ($idx % 3) + 1;
                            @endphp
                            @if($subjectTeacher)
                            @if(Auth::user()->role == 'student')
                            @if(($admin_pricing != null && $student->package == $admin_pricing->name && $student->count < $admin_pricing->click) || ($student->package == 'free' && $student->count < 8)) <div class="swiper-slide">
                                    <div class="el-tab-content-box {{'el-tab-content-box'.$popteachIdx}}">
                                        <div class="el-tab-img">
                                            <img src="{{ (!empty($user->photo)) ? url('./uploads/profileimages/'.$user->photo) :  url('/noprofile/no-profile.jpg') }}" class=" rounded-circle" alt="ui/ux">
                                        </div>
                                        <div class="el-tab-inner">
                                            <h4>{{$subjectTeacher->fullname}}</h4>
                                            <p class="p-0">{{$subjectTeacher->qualification}} <br>
                                                {{$subjectTeacher->experience}} years of Experience</p>
                                            <p class="p-0">@foreach($teacher_classes as $index => $grade){{$grade->class}}@if($index == count($teacher_classes) - 1). @else, @endif @endforeach</p>
                                            {{-- <img src="{{ asset('/frontend/assets/images/all-instructor/review.png') }}" alt="rating"> --}}
                                            <a href="{{route('teacher.details',$subjectTeacher->role_id)}}">See Profile <img src="{{ asset('/frontend/assets/images/all-instructor/arrow-icon.png') }}" alt="arrow right"></a>
                                        </div>
                                    </div>
                        </div>
                        @else
                        <div class="swiper-slide">
                            <div class="el-tab-content-box {{'el-tab-content-box'.$popteachIdx}}">
                                <div class="el-tab-img">
                                    <img src="{{ (!empty($user->photo)) ? url('./uploads/profileimages/'.$user->photo) :  url('/noprofile/no-profile.jpg') }}" class=" rounded-circle" alt="ui/ux">
                                </div>
                                <div class="el-tab-inner">
                                    <h4>{{$subjectTeacher->fullname}}</h4>
                                    <p class="p-0">{{$subjectTeacher->qualification}} <br>
                                        {{$subjectTeacher->experience}} years of Experience</p>
                                    <p class="p-0">@foreach($teacher_classes as $index => $grade){{$grade->class}}@if($index == count($teacher_classes) - 1). @else, @endif @endforeach</p>
                                    {{-- <img src="{{ asset('/frontend/assets/images/all-instructor/review.png') }}" alt="rating"> --}}
                                    <button disabled class="btn btn-danger mt-2">Package Expired</button>
                                </div>
                            </div>
                        </div>
                        @endif
                        @else
                        <div class="swiper-slide">
                            <div class="el-tab-content-box {{'el-tab-content-box'.$popteachIdx}}">
                                <div class="el-tab-img">
                                    <img src="{{ (!empty($user->photo)) ? url('./uploads/profileimages/'.$user->photo) :  url('/noprofile/no-profile.jpg') }}" class=" rounded-circle" alt="ui/ux">
                                </div>
                                <div class="el-tab-inner">
                                    <h4>{{$subjectTeacher->fullname}}</h4>
                                    <p class="p-0">{{$subjectTeacher->qualification}} <br>
                                        {{$subjectTeacher->experience}} years of Experience</p>
                                    <p class="p-0">@foreach($teacher_classes as $index => $grade){{$grade->class}}@if($index == count($teacher_classes) - 1). @else, @endif @endforeach</p>
                                    @if(Auth::user()->role == 'admin')
                                    <button disabled class="btn btn-primary mt-2">Admin can't access</button>
                                    @elseif(Auth::user()->role == 'teacher')
                                    <button disabled class="btn btn-primary mt-2">Teacher can't access</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                        @endif
                        @endforeach
                    </div>
                </div>
                @else
                <h3>No Instructor found.</h3>
                @endif
                <div class="swiper-button-prev swiper-button-disabled">
                    <svg width="7" height="12" viewBox="0 0 7 12" fill="none">
                        <path d="M6.46068 0.875485C6.18697 0.596953 5.74568 0.596953 5.47196 0.875485L0.830026 5.59917C0.778242 5.65176 0.737158 5.71423 0.709127 5.78299C0.681096 5.85176 0.666667 5.92547 0.666667 5.99992C0.666667 6.07437 0.681096 6.14808 0.709127 6.21685C0.737158 6.28561 0.778242 6.34808 0.830026 6.40067L5.47196 11.1244C5.74567 11.4029 6.18697 11.4029 6.46068 11.1244C6.73439 10.8458 6.73439 10.3968 6.46068 10.1182L2.41644 5.99708L6.46627 1.87593C6.73439 1.60308 6.73439 1.14833 6.46068 0.875485Z" />
                    </svg>
                </div>
                <div class="swiper-button-next">
                    <svg width="7" height="12" viewBox="0 0 7 12" fill="none">
                        <path d="M0.539362 11.1245C0.813074 11.403 1.25437 11.403 1.52808 11.1245L6.17002 6.40083C6.2218 6.34824 6.26288 6.28578 6.29091 6.21701C6.31894 6.14824 6.33337 6.07453 6.33337 6.00008C6.33337 5.92563 6.31894 5.85192 6.29091 5.78315C6.26288 5.71439 6.2218 5.65192 6.17002 5.59934L1.52808 0.875648C1.25437 0.597115 0.813074 0.597115 0.539362 0.875648C0.26565 1.15418 0.26565 1.60324 0.539362 1.88178L4.5836 6.00292L0.533776 10.1241C0.26565 10.3969 0.26565 10.8517 0.539362 11.1245Z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

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
                            <a href="{{route('teacher.details',$teacher->role_id)}}">
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
<!-- Blog Single End -->
@endsection
