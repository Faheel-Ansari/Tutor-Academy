@extends('frontend.body.master')
@section('content')
<style>
    .profile-list {
        display: flex;
        flex-wrap: wrap;
        gap: 60px
    }

    .profile-list li {
        color: #1C7DC6;
        display: flex;
        align-items: center; 
        justify-content: start
    }

    .profile-list span {
        color: #000
    }

</style>
@php
use App\Models\User;
@endphp
<!-- Breadcrumb End -->
<div class="el-breadcrumb-wrapper">
    <div class="container">
        <div class="el-breadcrmb-inner">
            <h1>{{$teacherData->fullname}}</h1>
        </div>
    </div>
</div>
<!-- Breadcrumb Start -->

<!-- Blog Single Start -->
<div class="el-blog-single-wrapper el-event-wrapper">
    <div class="container ">
        <div class="row gy-4">
            <div class="col-lg-12 ">
                <div class="el-blog-box el-blog-box-1">
                    <div class="el-blog-img">
                        <video width="800" controls src="{{asset('/uploads/teacher_videos/'.$teacherData->video)}}"></video>
                    </div>
                    <div class="el-blog-content">
                        <div class="d-flex flex-lg-row flex-column align-items-center justify-content-lg-start justify-content-center gap-lg-5 mb-5">
                            <div class="teacher-profile d-flex justify-content-center"><img src="{{ (!empty($user->photo)) ? url('./uploads/profileimages/'.$user->photo) :  url('/noprofile/no-profile.jpg') }}" width="300" class="rounded-circle" alt="Team Member"></div>
                            <h2 class="text-center">{{$teacherData->fullname}}</h2>
                             @if(!(($admin_pricing != null && $student->package == $admin_pricing->name && $student->count <= $admin_pricing->click) || ($student->package == 'free' && $student->count <= 8)))
                            <button disabled class="btn btn-outline-danger">Package Expired</button>
                            @endif
                        </div>
                        <ul class="profile-list px-4">
                            <li>Qualification : <span>{{$teacherData->qualification}}</span></li>
                            <li>Experience : <span>{{$teacherData->experience}} Years of Experience</span></li>
                            <li>Available classes : <span>@foreach($teacherGrades as $index => $grade){{$grade->class}}@if($index == count($teacherGrades) - 1). @else, @endif @endforeach</span></li>
                            <li>Subjects : <span>@foreach($teacherSubjects as $index => $subject){{$subject->subjectname}}@if($index == count($teacherSubjects) - 1). @else, @endif @endforeach</span></li>
                            <li>Education Boards : <span>@foreach($teacherBoards as $index => $board){{$board->board_name}}@if($index == count($teacherBoards) - 1). @else, @endif @endforeach</span></li>
                            <li>Timings : <span>@foreach($teacherShifts as $index => $shift)@if($shift->status == '0')<span class="text-danger text-decoration-line-through">{{$shift->shift_name}}</span> @else {{$shift->shift_name}} @endif @if($index == count($teacherShifts) - 1). @else, @endif @endforeach</span></li>
                            <li>Preferred Areas : <span>@foreach($teacherAreas as $index => $area){{$area->area}} @if($index == count($teacherAreas) - 1). @else, @endif @endforeach</span></li>
                            <li>Fees : <span>{{$teacherFee->fee}} /-</span></li>
                            <li>
                                @if(($admin_pricing != null && $student->package == $admin_pricing->name && $student->count <= $admin_pricing->click) || ($student->package == 'free' && $student->count <= 8))
                                <a class="el-btn text-white " data-bs-toggle="modal" data-bs-target="{{'#exampleModal'.$teacherData->id}}">Apply Now</a>
                                @else
                                <a href="{{ url('/#pricingContainer') }}" class="btn btn-secondary text-white rounded-5 py-3 px-4">Upgrade Package</a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal fade" id="{{'exampleModal'.$teacherData->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Apply Form</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{route('teacher.booking')}}" method="post">
                                <div class="modal-body d-flex justify-content-between flex-wrap px-5">
                                    @csrf
                                    <input type="hidden" value="{{$teacherData->role_id}}" name="teacher_id">
                                    <div class="col-6 d-flex flex-column mb-3">
                                        <label for="name" class="form-label mb-2">Name</label>
                                        <input type="text" name="name" id="name" class="px-3 @error('name') is-invalid @enderror">
                                        @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                    <div class="col-5 d-flex flex-column mb-3">
                                        <label for="dob" class="form-label mb-2">Date of Birth</label>
                                        <input type="date" name="dob" id="dob" class="px-3 @error('dob') is-invalid @enderror">
                                        @error('dob')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                    <div class="col-6 d-flex flex-column mb-3">
                                        <label for="email" class="form-label mb-2">Email</label>
                                        <input type="email" name="email" id="email" class="px-3 @error('email') is-invalid @enderror">
                                        @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                    <div class="col-5 d-flex flex-column mb-3">
                                        <label for="phone" class="form-label mb-2">Phone</label>
                                        <input type="number" name="phone" id="phone" class="px-3 @error('phone') is-invalid @enderror">
                                        @error('phone')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                    <div class="col-7 d-flex flex-column mb-3">
                                        <label for="school" class="form-label mb-2">School</label>
                                        <input type="text" name="school" id="school" class="px-3 @error('school') is-invalid @enderror">
                                        @error('school')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                    <div class="col-4 d-flex flex-column mb-3">
                                        <label for="area" class="form-label mb-2">Area</label>
                                        <input type="text" name="area" id="area" class="px-3 @error('area') is-invalid @enderror">
                                        @error('area')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                    <div class="col-12 d-flex flex-column mb-3">
                                        <label for="address" class="form-label mb-2">Address</label>
                                        <input type="text" name="address" id="address" class="px-3 @error('address') is-invalid @enderror">
                                        @error('address')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                    <div class="col-5 d-flex flex-column mb-3">
                                        <label for="class" class="form-label mb-2">Select Class</label>
                                        <select name="class" id="class" class="px-4">
                                            <option selected disabled value="">~~ Please Select ~~</option>
                                            @foreach($teacherGrades as $grade)
                                            <option value="{{$grade->class}}">{{$grade->class}}</option>
                                            @endforeach
                                        </select>
                                        @error('class')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                    <div class="col-5 d-flex flex-column mb-3">
                                        <label for="shift" class="form-label mb-2">Select Timing</label>
                                        <select name="shift" id="shift" class="px-4">
                                            <option selected disabled value="">~~ Please Select ~~</option>
                                            @foreach($teacherShifts as $shift)
                                            @if($shift->status == '1')
                                            <option value="{{$shift->shift_name}}">{{$shift->shift_name}}</option>
                                            @else
                                            <option disabled class="text-danger text-decoration-line-through" value="{{$shift->shift_name}}">{{$shift->shift_name}} </option>
                                            @endif
                                            @endforeach
                                        </select>
                                        @error('shift')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                    <div class="col-12 d-flex flex-column mb-3">
                                        <label for="subject" class="form-label mb-2">Select your Subjects</label>
                                        <div class="d-flex gap-4">
                                            @foreach($teacherSubjects as $index => $subject)
                                            <span class="d-flex align-items-center gap-2">
                                                <label for="{{'subject'.$index}}" class="">{{$subject->subjectname}}</label>
                                                <input type="checkbox" name="subject[]" value="{{$subject->subjectname}}" id="{{'subject'.$index}}" class="@error('subject') is-invalid @enderror">
                                            </span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="el-btn text-white">Submit</button>
                                </div>
                            </form>
                        </div>
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
                        <a href="{{route('subject.details',$subject->id)}}}">
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
                @if(($admin_pricing != null && $student->package == $admin_pricing->name && $student->count < $admin_pricing->click) || ($student->package == 'free' && $student->count < 8))
                <div class="swiper-slide">
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
                                <div class="el-team-content d-flex flex-column gap-3 align-items-center">
                                    <h4>{{$teacher->fullname}}</h4>
                                    <button disabled class="btn btn-danger">Package Expired</button>
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
