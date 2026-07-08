@extends('frontend.body.master')
@section('content')
@php
use App\Models\User;
use App\Models\TeacherBooking;
use App\Models\StdPricing;
use App\Models\AdminSubject;
if ($student != '') {
if ($student->package == 'free') {
$admin_pricing = '';
}else{
foreach ($pricings as $pricing) {
$admin_pricing = StdPricing::where('name',$student->package)->first();
}
}
}else{
$admin_pricing = '';
}
@endphp
<!-- Banner End -->
<div class="el-banner-wrapper">
    @if(session()->has('isloggedin') && session('isloggedin') == '1')
    <h4 class="login-alert text-center  bg-danger p-4" id="login-message">Please <a href="{{route('login')}}" class="text-decoration-underline text-white">Login</a> or <a href="{{route('register')}}" class="text-decoration-underline text-white">Register</a> to continue</h4>
    <script>
        setTimeout(function() {
            document.getElementById('login-message').style.display = 'none';
        }, 10000);

    </script>
    @endif
    <div class="container">
        <div class="el-banner-parent">
            <div class="el-banner-flex">
                <div class="el-banner-left">
                    <h1>Get Started With <br> <span>Manal Tutors</span> Academy</h1>
                    <p class="el-para">We help students reach their life goals faster and more efficiently. Growing online learning. From this side you read and buy online courses anywhere, any time.</p>
                    <div class="el-banner-btns">
                        <a href="#pricingContainer" class="el-btn">get started</a>
                        {{-- <div class="el-banner-play-icon">
                            <a class="video-popup" href="https://youtube/D0UnqGm_miA?si=M-FnoMWqNdepVQqz">
                                <span>
                                    <svg width="16" height="19" viewBox="0 0 16 19">
                                        <path d="M15.5467 8.67162L1.32444 0.121637C1.18929 0.040615 1.03668 -0.00130209 0.881723 3.08244e-05C0.726761 0.00136374 0.574808 0.0459005 0.440889 0.129237C0.306634 0.212869 0.195261 0.332685 0.117894 0.476718C0.0405275 0.62075 -0.000123954 0.783957 2.83917e-07 0.950036V18.05C-0.000123954 18.2161 0.0405275 18.3793 0.117894 18.5233C0.195261 18.6674 0.306634 18.7872 0.440889 18.8708C0.577033 18.9551 0.731537 18.9997 0.888889 19C1.03822 19 1.18933 18.9601 1.32444 18.8784L15.5467 10.3284C15.8258 10.1593 16 9.84392 16 9.50002C16 9.15612 15.8258 8.84072 15.5467 8.67162Z" />
                                    </svg>
                                </span>
                                play video
                            </a>
                        </div> --}}
                    </div>
                    <div class="el-banner-box">
                        <h1 class="mb-3 text-danger">Find a Tutor
                            @if($package && $package->status == 2)
                            <span class="text-danger fs-5">Verifying payment. Wait for admin approval.</span>
                            @elseif($package && $package->status == 0)
                            <span class="text-danger fs-5">Payment Denied</span>
                            @elseif($package && $package->status == 1)
                            <span class="text-success fs-5" id="pay_approve">Package Activated</span>
                            <script>
                                setTimeout(function() {
                                    document.getElementById('pay_approve').style.display = 'none';
                                }, 6000);

                            </script>
                            @else
                            @if($student != '')
                            @if(($admin_pricing != '' && $student->package == $admin_pricing->name && $student->count >= $admin_pricing->click) || ($student->package == 'free' && $student->count >= 8))
                            <span class="text-danger fs-5">Package expired. Please <a href="#pricingContainer">Upgrade</a> your package</span>
                            @elseif($student->package == 'free' && $student->count < 1) <span class="text-danger fs-5">You have <a href="#pricingContainer" class="text-decoration-underline">Free Trial</a> activated by default.</span>
                                @endif
                                @endif
                                @endif
                        </h1>
                        <img src="{{ asset('/frontend/assets/images/all-instructor/banner-arrow2.svg') }}" alt="Arrow Shape">
                        <form action="{{route('teacher.search')}}" name="search" method="GET">
                            <div class="el-banner-form-flex gap-2">
                                <div class="el-banner-form-info">
                                    <label for="area">Select your area</label>
                                    <select class="mySelect" id="area" name="area" class="@error('area') is-invalid @enderror">
                                        <option disabled selected>Please Select</option>
                                        @foreach($areas as $area)
                                        <option value="{{$area->area}}">{{$area->area}}</option>
                                        @endforeach
                                    </select>
                                    @error('area')<small class="text-center text-danger">{{$message}}</small>@enderror
                                </div>
                                <div class="el-banner-form-info">
                                    <label for="">Search</label>
                                    <div class="el-header-search">
                                        <input type="search" name="search" id="search" class="@error('search') is-invalid @enderror" placeholder="Search by, subject or name">
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/search.svg') }}" alt="search">
                                    </div>
                                    @error('search')<small class="text-center text-danger">{{$message}}</small>@enderror
                                </div>
                                <div class="el-banner-form-btn ms-3">
                                    <button type="submit" class="el-btn">
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/arrow-right.svg') }}" alt="Right Arrow">
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{-- <div class="el-video-box">
                        <img src="{{ asset('/frontend/assets/images/all-instructor/video-icon.png') }}" alt="Icon">
                    <div class="el-video-content">
                        <h4>2k</h4>
                        <p>video courses</p>
                    </div>
                </div> --}}
                <img src="{{ asset('/frontend/assets/images/all-instructor/banner-arrow1.svg') }}" class="el-arrow1" alt="Arrow Left">
            </div>
            <div class="el-banner-right">
                {{-- <div class="el-banner-reslt-box">
                        <img src="{{ asset('/frontend/assets/images/all-instructor/star-smile.png') }}" class="el-star-smile" alt="star">
                <h4>Brilliant Results</h4>
                <div class="el-reslt-flex">
                    <img src="https://dummyimage.com/50x50" alt="student image">
                    <div class="el-reslt-info">
                        <h4>John Deo</h4>
                        <p>M.Sc. Students</p>
                    </div>
                    <div class="el-reslt-grade">
                        <span>A+</span>
                    </div>
                </div>
                <div class="el-reslt-flex">
                    <img src="https://dummyimage.com/50x50" alt="student image">
                    <div class="el-reslt-info">
                        <h4>Emma Score</h4>
                        <p>MBA Students</p>
                    </div>
                    <div class="el-reslt-grade">
                        <span>A+</span>
                    </div>
                </div>
                <div class="el-reslt-flex">
                    <img src="https://dummyimage.com/50x50" alt="student image">
                    <div class="el-reslt-info">
                        <h4>Charlie Burns</h4>
                        <p>CA Students</p>
                    </div>
                    <div class="el-reslt-grade">
                        <span>A+</span>
                    </div>
                </div>
            </div> --}}
            <div class="el-banner-img">
                <img src="{{asset('/frontend/assets/images/allimages/banner-right.png')}}" alt="banner girl">
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- Banner Start -->

<!-- Counter Start -->
<div class="el-counter-wrapper">
    <div class="container">
        <div class="el-counter-parent">
            {{-- <img src="{{ asset('/frontend/assets/images/all-instructor/students.png') }}" alt="students"> --}}
            <div class="el-count">
                <div class="el-counting" data-to="22000">0</div>
                <div class="el-count-heading">
                    <h5>Success Stories</h5>
                </div>
            </div>
            <div class="el-count">
                <div class="el-counting" data-to="6500">0</div>
                <div class="el-count-heading">
                    <h5>Expert Instructor</h5>
                </div>
            </div>
            <div class="el-count">
                <div class="el-counting" data-to="5000">0</div>
                <div class="el-count-heading">
                    <h5>Active Student</h5>
                </div>
            </div>
            <div class="el-count">
                <div class="el-counting" data-to="2000">0</div>
                <div class="el-count-heading">
                    <h5>Hours Video Classes</h5>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Counter End -->

<!-- About Section Start -->
<div class="el-about-wrapper">
    <div class="container">
        <div class="row gy-4 align-items-center">
            <div class="col-lg-6">
                <div class="el-about-img">
                    {{-- <div class="el-banner-reslt-box">
                        <h4>Brilliant Results</h4>
                        <div class="el-reslt-flex">
                            <img src="https://dummyimage.com/50x50" alt="student image">
                            <div class="el-reslt-info">
                                <h4>John Deo</h4>
                                <p>M.Sc. Students</p>
                            </div>
                            <div class="el-reslt-grade">
                                <span>A+</span>
                            </div>
                        </div>
                        <div class="el-reslt-flex">
                            <img src="https://dummyimage.com/50x50" alt="student image">
                            <div class="el-reslt-info">
                                <h4>Emma Score</h4>
                                <p>MBA Students</p>
                            </div>
                            <div class="el-reslt-grade">
                                <span>A+</span>
                            </div>
                        </div>
                        <div class="el-reslt-flex">
                            <img src="https://dummyimage.com/50x50" alt="student image">
                            <div class="el-reslt-info">
                                <h4>Charlie Burns</h4>
                                <p>CA Students</p>
                            </div>
                            <div class="el-reslt-grade">
                                <span>A+</span>
                            </div>
                        </div>
                    </div> --}}
                    <img src="@if($about){{ asset('/uploads/adminimages/'.$about->aboutimg)}}@endif" alt="About Image">
                    {{-- <img src="{{ asset('/frontend/assets/images/all-instructor/about-review.png') }}" alt="Review" class="el-abt-review"> --}}
                    <img src="{{ asset('/frontend/assets/images/all-instructor/about-video-icon.png') }}" alt="Video Icon" class="el-abt-videoIcon">
                    {{-- <img src="{{ asset('/frontend/assets/images/all-instructor/star-smile.png') }}" alt="Video Icon" class="el-smile-star"> --}}
                </div>
            </div>
            <div class="col-lg-6">
                <div class="el-about-content">
                    <h4 class="el-top-heading">about us</h4>
                    <h2 class="el-main-heading">@if($about){{$about->abouthead}}@endif</h2>
                    <p class="el-para">@if($about){{$about->aboutpara}}@endif</p>
                    <ul>
                        <li class="el-para">
                            <img src="{{ asset('/frontend/assets/images/all-instructor/checked.png') }}" alt="Checked Icon">
                            Offline Courses - Video Courses
                        </li>
                        <li class="el-para">
                            <img src="{{ asset('/frontend/assets/images/all-instructor/checked.png') }}" alt="Checked Icon">
                            Online Courses - Video Courses
                        </li>
                        <li class="el-para">
                            <img src="{{ asset('/frontend/assets/images/all-instructor/checked.png') }}" alt="Checked Icon">
                            Diploma - Video Courses
                        </li>
                        <li class="el-para">
                            <img src="{{ asset('/frontend/assets/images/all-instructor/checked.png') }}" alt="Checked Icon">
                            Certification - Video Courses
                        </li>
                        <li class="el-para">
                            <img src="{{ asset('/frontend/assets/images/all-instructor/checked.png') }}" alt="Checked Icon">
                            App Support - Video Courses
                        </li>
                    </ul>
                    {{-- <a href="javascript:;" class="el-btn">read more</a> --}}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About Section End -->

<!-- Course Section Start -->
<div class="el-course-wrapper">
    <div class="container">
        <div class="el-course-heading text-center">
            <h4 class="el-top-heading-center">Popular teachers</h4>
            <h2 class="el-main-heading">We Bring The Good Education To Life</h2>
        </div>
        <div class="el-tab-parent mt-4">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="courses" role="tabpanel" aria-labelledby="all-courses-tab">
                    <div class="el-tab-slider-parent swiper">
                        <div class="swiper-wrapper">
                            @foreach($sponsorTeachers as $idx => $teacher)
                            @php
                            $user = User::where('id',$teacher->role_id)->first();
                            $std_id = '';
                            if (Auth::check()) {
                            $std_id = Auth::user()->id;
                            }
                            $hired = TeacherBooking::where('teacher_id',$teacher->role_id)
                            ->where('student_id',$std_id)
                            ->where('paid','1')
                            ->where('session','1')
                            ->first();
                            $popteachIdx = ($idx % 3) + 1;
                            @endphp
                            @if($student != '')
                            @if(($admin_pricing != null && $student->package == $admin_pricing->name && $student->count < $admin_pricing->click) || ($student->package == 'free' && $student->count < 8)) <div class="swiper-slide">
                                    <div class="el-tab-content-box position-relative {{'el-tab-content-box'.$popteachIdx}}">
                                        @if($hired)
                                        <span class="position-absolute top-0 end-0 translate-middle-x mt-2 badge rounded-pill bg-danger">
                                            You Already Hired
                                        </span>
                                        @endif
                                        <div class="el-tab-img">
                                            <img src="{{ (!empty($user->photo)) ? url('./uploads/profileimages/'.$user->photo) :  url('/noprofile/no-profile.jpg') }}" class=" rounded-circle" alt="ui/ux">
                                        </div>
                                        <div class="el-tab-inner ">
                                            <h4>{{$teacher->fullname}}</h4>
                                            <p>{{$teacher->qualification}} <br>
                                                {{$teacher->experience}} years of Experience</p>
                                            <a href="{{route('teacher.details',$teacher->role_id)}}">See Profile <img src="{{ asset('/frontend/assets/images/all-instructor/arrow-icon.png') }}" alt="arrow right"></a>
                                        </div>
                                    </div>
                        </div>
                        @else
                        <div class="swiper-slide">
                            <div class="el-tab-content-box position-relative {{'el-tab-content-box'.$popteachIdx}}">
                                <div class="el-tab-img">
                                    <img src="{{ (!empty($user->photo)) ? url('./uploads/profileimages/'.$user->photo) :  url('/noprofile/no-profile.jpg') }}" class=" rounded-circle" alt="ui/ux">
                                </div>
                                <div class="el-tab-inner ">
                                    <h4>{{$teacher->fullname}}</h4>
                                    <p>{{$teacher->qualification}} <br>
                                        {{$teacher->experience}} years of Experience</p>
                                    <button disabled class="btn btn-danger text-white font-bold btn-disable">Package Expired</button>
                                </div>
                            </div>
                        </div>
                        @endif
                        @elseif($not_avail)
                        <div class="swiper-slide">
                            <div class="el-tab-content-box position-relative {{'el-tab-content-box'.$popteachIdx}}">
                                <div class="el-tab-img">
                                    <img src="{{ (!empty($user->photo)) ? url('./uploads/profileimages/'.$user->photo) :  url('/noprofile/no-profile.jpg') }}" class=" rounded-circle" alt="ui/ux">
                                </div>
                                <div class="el-tab-inner ">
                                    <h4>{{$teacher->fullname}}</h4>
                                    <p>{{$teacher->qualification}} <br>
                                        {{$teacher->experience}} years of Experience</p>
                                    @if(Auth::check() && Auth::user()->role == 'teacher')
                                    <button class="btn btn-primary text-white font-bold" disabled>Teacher can't access</button>
                                    @elseif(Auth::check() && Auth::user()->role == 'admin')
                                    <button disabled class="btn btn-primary text-white font-bold">Admin can't access</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="swiper-slide">
                            <div class="el-tab-content-box position-relative {{'el-tab-content-box'.$popteachIdx}}">
                                <div class="el-tab-img">
                                    <img src="{{ (!empty($user->photo)) ? url('./uploads/profileimages/'.$user->photo) :  url('/noprofile/no-profile.jpg') }}" class=" rounded-circle" alt="ui/ux">
                                </div>
                                <div class="el-tab-inner ">
                                    <h4>{{$teacher->fullname}}</h4>
                                    <p>{{$teacher->qualification}} <br>
                                        {{$teacher->experience}} years of Experience</p>
                                    <a href="#pricingContainer" class="btn btn-primary text-white font-bold">Start Free Trial</a>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
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
<!-- Course Section End -->
<!-- Service Section Start -->
<div class="el-service-wrapper">
    <div class="container">
        <div class="row gy-4 align-items-center">
            <div class="col-lg-6">
                <div class="el-service-left">
                    <div class="el-service-heading">
                        <h4 class="el-top-heading">Our Services</h4>
                        <h2 class="el-main-heading">@if($service){{$service->servicehead}}@endif</h2>
                        <p class="el-para">@if($service){{$service->servicepara}}@endif</p>
                    </div>
                    <div class="el-service-left-content">
                        <ul>
                            <li>
                                <img src="{{ asset('/frontend/assets/images/all-instructor/s-icon1.png') }}" alt="icon">
                                Expert Instructions
                            </li>
                            <li>
                                <img src="{{ asset('/frontend/assets/images/all-instructor/s-icon2.png') }}" alt="icon">
                                Student Scholarship
                            </li>
                            <li>
                                <img src="{{ asset('/frontend/assets/images/all-instructor/s-icon3.png') }}" alt="icon">
                                Recorded Sessions
                            </li>
                            <li>
                                <img src="{{ asset('/frontend/assets/images/all-instructor/s-icon4.png') }}" alt="icon">
                                Practical Learning
                            </li>
                        </ul>
                        {{-- <a href="javascript:;" class="el-btn">Enroll Now</a> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="el-service-right">
                    <img src="@if($service){{ asset('/uploads/adminimages/'.$service->serviceimg)}}@endif" alt="service image">
                    {{-- <img src="{{ asset('/frontend/assets/images/all-instructor/about-review.png') }}" alt="Review" class="el-abt-review"> --}}
                    <img src="{{ asset('/frontend/assets/images/all-instructor/about-video-icon.png') }}" alt="Video Icon" class="el-abt-videoIcon">
                    {{-- <img src="{{ asset('/frontend/assets/images/all-instructor/star-smile.png') }}" alt="Video Icon" class="el-smile-star"> --}}
                    {{-- <div class="el-service-counter">
                        <div class="el-count">
                            <div class="el-counting" data-to="23000">0</div>
                            <div class="el-count-heading">
                                <h5>Students</h5>
                            </div>
                        </div>
                        <div class="el-count">
                            <div class="el-counting" data-to="7000">0</div>
                            <div class="el-count-heading">
                                <h5>Courses</h5>
                            </div>
                        </div>
                        <div class="el-count">
                            <div class="el-counting" data-to="6000">0</div>
                            <div class="el-count-heading">
                                <h5>Instructors</h5>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Service Section End -->
<!-- Course Section Start -->
<div class="el-course-wrapper">
    <div class="container">
        <div class="el-course-heading text-center">
            <h4 class="el-top-heading-center">Browse Subjects</h4>
            <h2 class="el-main-heading">Explore Our Popular Subjects</h2>
        </div>
        <div class="el-tab-parent">
            <ul class="nav nav-tabs" id="myTab" role="tablist">

                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="all-subjects-tab" data-bs-toggle="tab" data-bs-target="#subjects" type="button" role="tab" aria-controls="subjects" aria-selected="false">All Subjects</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="quran-tab" data-bs-toggle="tab" data-bs-target="#quran" type="button" role="tab" aria-controls="quran" aria-selected="false">Quran</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="development-tab" data-bs-toggle="tab" data-bs-target="#development" type="button" role="tab" aria-controls="development" aria-selected="false">development</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="cyber-security-tab" data-bs-toggle="tab" data-bs-target="#security" type="button" role="tab" aria-controls="security" aria-selected="false">cyber security</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="subjects" role="tabpanel" aria-labelledby="all-subjects-tab">
                    <div class="el-tab-slider-parent swiper">
                        <div class="swiper-wrapper">
                            @foreach($subjects as $idx => $subject)
                            @php
                            $cycledIdx = ($idx % 3) + 1;
                            @endphp
                            <div class="swiper-slide">
                                <div class="el-tab-content-box {{'el-tab-content-box'.$cycledIdx}}">
                                    <div class="el-tab-img">
                                        <img src="{{asset('/uploads/adminimages/'.$subject->sub_img)}}" class="rounded-circle" width="200" alt="ui/ux">
                                    </div>
                                    <div class="el-tab-inner">
                                        <h4>{{$subject->subject}}</h4>
                                        <a href="{{route('subject.details',$subject->id)}}">See Instructors <img src="{{ asset('/frontend/assets/images/all-instructor/arrow-icon.png') }}" alt="arrow right"></a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
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
                <div class="tab-pane fade" id="quran" role="tabpanel" aria-labelledby="quran-tab">
                    <div class="el-tab-slider-parent swiper">
                        <div class="swiper-wrapper">
                            @php
                            $qurans = AdminSubject::where('subject','LIKE','%Quran%')->get();
                            @endphp
                            @foreach($qurans as $idx => $quran)
                            @php
                            $cycled2Idx = ($idx % 3) + 1;
                            @endphp
                            <div class="swiper-slide">
                                <div class="el-tab-content-box {{'el-tab-content-box'.$cycled2Idx}}">
                                    <div class="el-tab-img">
                                        <img src="{{asset('/uploads/adminimages/'.$quran->sub_img)}}" class="rounded-circle" width="200" alt="ui/ux">
                                    </div>
                                    <div class="el-tab-inner">
                                        <h4>{{$quran->subject}}</h4>
                                        <a href="{{route('subject.details',$quran->id)}}">See Instructors <img src="{{ asset('/frontend/assets/images/all-instructor/arrow-icon.png') }}" alt="arrow right"></a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
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
                <div class="tab-pane fade" id="development" role="tabpanel" aria-labelledby="development-tab">
                    <div class="el-tab-slider-parent swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="el-tab-content-box el-tab-content-box1">
                                    <div class="el-tab-img">
                                        <img src="https://dummyimage.com/246x193" alt="ui/ux">
                                    </div>
                                    <div class="el-tab-inner">
                                        <h4>Web Development</h4>
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/review.png') }}" alt="rating">
                                        <a href="javascript:;">Enroll Now <img src="{{ asset('/frontend/assets/images/all-instructor/arrow-icon.png') }}" alt="arrow right"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="el-tab-content-box el-tab-content-box2">
                                    <div class="el-tab-img">
                                        <img src="https://dummyimage.com/246x193" alt="development">
                                    </div>
                                    <div class="el-tab-inner">
                                        <h4>App Development</h4>
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/review.png') }}" alt="rating">
                                        <a href="javascript:;">Enroll Now <img src="{{ asset('/frontend/assets/images/all-instructor/arrow-icon.png') }}" alt="arrow right"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="el-tab-content-box el-tab-content-box3">
                                    <div class="el-tab-img">
                                        <img src="https://dummyimage.com/246x193" alt="graphic-design">
                                    </div>
                                    <div class="el-tab-inner">
                                        <h4>Android Development</h4>
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/review.png') }}" alt="rating">
                                        <a href="javascript:;">Enroll Now <img src="{{ asset('/frontend/assets/images/all-instructor/arrow-icon.png') }}" alt="arrow right"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="el-tab-content-box el-tab-content-box1">
                                    <div class="el-tab-img">
                                        <img src="https://dummyimage.com/246x193" alt="ui/ux">
                                    </div>
                                    <div class="el-tab-inner">
                                        <h4>IOS </h4>
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/review.png') }}" alt="rating">
                                        <a href="javascript:;">Enroll Now <img src="{{ asset('/frontend/assets/images/all-instructor/arrow-icon.png') }}" alt="arrow right"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="el-tab-content-box el-tab-content-box2">
                                    <div class="el-tab-img">
                                        <img src="https://dummyimage.com/246x193" alt="development">
                                    </div>
                                    <div class="el-tab-inner">
                                        <h4>App Development</h4>
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/review.png') }}" alt="rating">
                                        <a href="javascript:;">Enroll Now <img src="{{ asset('/frontend/assets/images/all-instructor/arrow-icon.png') }}" alt="arrow right"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="cyber-security-tab">
                    <div class="el-tab-slider-parent swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="el-tab-content-box el-tab-content-box1">
                                    <div class="el-tab-img">
                                        <img src="https://dummyimage.com/246x193" alt="ui/ux">
                                    </div>
                                    <div class="el-tab-inner">
                                        <h4>Web Development</h4>
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/review.png') }}" alt="rating">
                                        <a href="javascript:;">Enroll Now <img src="{{ asset('/frontend/assets/images/all-instructor/arrow-icon.png') }}" alt="arrow right"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="el-tab-content-box el-tab-content-box2">
                                    <div class="el-tab-img">
                                        <img src="https://dummyimage.com/246x193" alt="development">
                                    </div>
                                    <div class="el-tab-inner">
                                        <h4>App Development</h4>
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/review.png') }}" alt="rating">
                                        <a href="javascript:;">Enroll Now <img src="{{ asset('/frontend/assets/images/all-instructor/arrow-icon.png') }}" alt="arrow right"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="el-tab-content-box el-tab-content-box3">
                                    <div class="el-tab-img">
                                        <img src="https://dummyimage.com/246x193" alt="graphic-design">
                                    </div>
                                    <div class="el-tab-inner">
                                        <h4>Android Development</h4>
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/review.png') }}" alt="rating">
                                        <a href="javascript:;">Enroll Now <img src="{{ asset('/frontend/assets/images/all-instructor/arrow-icon.png') }}" alt="arrow right"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="el-tab-content-box el-tab-content-box1">
                                    <div class="el-tab-img">
                                        <img src="https://dummyimage.com/246x193" alt="ui/ux">
                                    </div>
                                    <div class="el-tab-inner">
                                        <h4>IOS </h4>
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/review.png') }}" alt="rating">
                                        <a href="javascript:;">Enroll Now <img src="{{ asset('/frontend/assets/images/all-instructor/arrow-icon.png') }}" alt="arrow right"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="el-tab-content-box el-tab-content-box3">
                                    <div class="el-tab-img">
                                        <img src="https://dummyimage.com/246x193" alt="graphic-design">
                                    </div>
                                    <div class="el-tab-inner">
                                        <h4>Android Development</h4>
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/review.png') }}" alt="rating">
                                        <a href="javascript:;">Enroll Now <img src="{{ asset('/frontend/assets/images/all-instructor/arrow-icon.png') }}" alt="arrow right"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
<!-- Course Section End -->
<!-- Team Section Start -->
<div class="el-team-wrapper">
    <div class="container">
        <div class="el-team-heading text-center">
            <h4 class="el-top-heading-center">Our instructors</h4>
            <h2 class="el-main-heading">Classes Taught By Real Creators</h2>
        </div>
        <div class="el-team-parent swiper">
            <div class="swiper-wrapper">
                @foreach($teachers as $teacher)
                @php
                $user = User::where('id',$teacher->role_id)->first();
                @endphp
                @if($student != '')
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
            @elseif($not_avail)
            <div class="swiper-slide">
                <div class="el-team-box">
                    <div>
                        <div class="el-team-box-inner">
                            <div class="el-team-img">
                                <img src="{{ (!empty($user->photo)) ? url('./uploads/profileimages/'.$user->photo) :  url('/noprofile/no-profile.jpg') }}" width="100" alt="Team Member">
                            </div>
                            <div class="el-team-content d-flex gap-3 flex-column align-items-center">
                                <h4>{{$teacher->fullname}}</h4>
                                @if(Auth::user()->role == 'teacher')
                                <button class="btn btn-primary text-white font-bold" disabled>Teacher can't access</button>
                                @elseif(Auth::user()->role == 'admin')
                                <button class="btn btn-primary text-white font-bold" disabled>Admin can't access</button>
                                @endif
                            </div>
                        </div>
                    </div>
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
                                <a href="#pricingContainer" class="btn btn-primary text-white font-bold">Start Free Trial</a>
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
<!-- Team Section End -->

<!-- Contact Section Start -->
<div class="el-contact-wrapper">
    <div class="container">
        <div class="el-contact-flex">
            <div class="el-contact-left-flex">
                <div class="el-contact-left-image">
                    <img src="{{asset('/frontend/assets/images/allimages/contact-image.png')}}" alt="Image" class="el-contact-image">
                    {{-- <img src="{{ asset('/frontend/assets/images/all-instructor/contact-review.png') }}" alt="image" class="el-contact-review"> --}}
                    {{-- <img src="{{ asset('/frontend/assets/images/all-instructor/students.png') }}" alt="image" class="el-contact-student"> --}}
                    <img src="{{ asset('/frontend/assets/images/all-instructor/banner-arrow2.svg') }}" alt="Arrow Shape" class="el-contact-arrow">
                    {{-- <img src="{{ asset('/frontend/assets/images/all-instructor/star-smile.png') }}" alt="star smile" class="el-contact-star"> --}}
                </div>
                <div class="el-contact-left-form">
                    <img src="{{ asset('/frontend/assets/images/all-instructor/about-video-icon.png') }}" alt="video icon">
                    <div class="el-contact-form-box">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="el-contact-form-head">
                                <h4>register now</h4>
                                <p class="el-para">Get details in your inbox right now</p>
                            </div>
                            <div class="el-input-field">
                                <input type="text" value="{{old('fname')}}" class="@error('fname') is-invalid @enderror" name="fname" id="fname" placeholder="Full Name">
                                @error('fname')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="el-input-field">
                                <input type="email" value="{{old('email')}}" name="email" id="email" class=" @error('email') is-invalid @enderror" placeholder="Email">
                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="el-input-field">
                                <input type="password" name="password" id="password" placeholder="Password">
                                @error('password')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="el-input-field">
                                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
                            </div>
                            <div class="el-contact-form-btn">
                                <button type="submit" class="el-btn">Create Account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="el-contact-right">
                <div class="el-about-content">
                    <h4 class="el-top-heading">Enroll Now</h4>
                    <h2 class="el-main-heading">Register Now! Secure <br>
                        Your Seat!</h2>
                    <p class="el-para">Get latest news in your inbox. Consectet adipiscing elitadipiscing elitseddo eiusmod tempor incididunt ut laboreet dolore magnased doeiusmod tempor in cididunt utlaboreet dolore magna aliqua. Quis ipsu suspendisse ultrices gravida.</p>
                    <p class="el-para">Get latest news in your inbox. Consectetur adipisce enng elitadipiscing elitseddo eiusmod tempor incid dunt ut labore et dolore.</p>
                    {{-- <a href="javascript:;" class="el-btn">enroll now</a> --}}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact Section End -->

<!-- Work Section Start -->
<div class="el-work-wrapper">
    <div class="container">
        <div class="el-work-heading text-center">
            <h4 class="el-top-heading-center">JOIN US</h4>
            <h2 class="el-main-heading">How It Work? Get Your Certificate Now</h2>
            <p class="el-para">Get latest news in your inbox. Consectetur adipiscing elitadipiscing elitse <br>
                ddo eiusmod tempor incididunt ut labore et dolore.</p>
        </div>
        <div class="row gy-4">
            <div class="col-lg-3 col-md-6">
                <div class="el-work-box el-work-box-1">
                    <div class="el-work-box-inner">
                        <div class="el-work-step">
                            <h4>step 01</h4>
                        </div>
                        <div class="el-work-img">
                            <img src="{{ asset('/frontend/assets/images/all-instructor/w1.png') }}" alt="work icon">
                        </div>
                        <div class="el-work-content">
                            <h4>Set Your Plan</h4>
                            <p class="el-para">Get latest news in your inbox. Consectet adipiscing elitadipiscing elitseddo.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="el-work-box el-work-box-2">
                    <div class="el-work-box-inner">
                        <div class="el-work-step">
                            <h4>step 02</h4>
                        </div>
                        <div class="el-work-img">
                            <img src="{{ asset('/frontend/assets/images/all-instructor/w2.png') }}" alt="work icon">
                        </div>
                        <div class="el-work-content">
                            <h4>Find Your Course</h4>
                            <p class="el-para">Get latest news in your inbox. Consectet adipiscing elitadipiscing elitseddo.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="el-work-box el-work-box-3">
                    <div class="el-work-box-inner">
                        <div class="el-work-step">
                            <h4>step 03</h4>
                        </div>
                        <div class="el-work-img">
                            <img src="{{ asset('/frontend/assets/images/all-instructor/w3.png') }}" alt="work icon">
                        </div>
                        <div class="el-work-content">
                            <h4>Book Your Teacher</h4>
                            <p class="el-para">Get latest news in your
                                inbox. Consectet adipiscing
                                elitadipiscing elitseddo.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="el-work-box el-work-box-4">
                    <div class="el-work-box-inner">
                        <div class="el-work-step">
                            <h4>step 04</h4>
                        </div>
                        <div class="el-work-img">
                            <img src="{{ asset('/frontend/assets/images/all-instructor/w4.png') }}" alt="work icon">
                        </div>
                        <div class="el-work-content">
                            <h4>Get Certificate</h4>
                            <p class="el-para">Get latest news in your
                                inbox. Consectet adipiscing
                                elitadipiscing elitseddo.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Work Section End -->

<!-- Testimonial Section Start -->
<div class="el-testmnl-wrapper">
    <div class="container">
        <div class="el-team-heading text-center">
            <h4 class="el-top-heading-center">Testimonials</h4>
            <h2 class="el-main-heading">What Our Students Say About Us</h2>
            <p class="el-para">Get latest news in your inbox. Consectetur adipiscing elitadipiscing elitse <br>
                ddo eiusmod tempor incididunt ut labore et dolore.</p>
        </div>
        <div class="row align-items-center">
            <div class="col-xl-7 col-lg-12">
                <div class="el-tesml-main-parent">
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
                    <div class="swiper el-testmnl-slider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="el-tm-banner-media">
                                    <img src="https://dummyimage.com/250x388" alt="Client Image">
                                    <div class="el-tm-banner-media_content">
                                        <h6>John Deo</h6>
                                        <p class="el-para"><img src="{{ asset('/frontend/assets/images/all-instructor/team-icon.png') }}" alt="icon"> 3D Animation</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="el-tm-banner-media">
                                    <img src="https://dummyimage.com/250x328" alt="Client Image">
                                    <div class="el-tm-banner-media_content">
                                        <h6>Charlie Burns</h6>
                                        <p class="el-para"><img src="{{ asset('/frontend/assets/images/all-instructor/team-icon.png') }}" alt="icon"> 3D Animation</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="el-tm-banner-media">
                                    <img src="https://dummyimage.com/250x328" alt="Client Image">
                                    <div class="el-tm-banner-media_content">
                                        <h6>Nina Bennett</h6>
                                        <p class="el-para"><img src="{{ asset('/frontend/assets/images/all-instructor/team-icon.png') }}" alt="icon"> 3D Animation</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="el-tm-banner-media">
                                    <img src="https://dummyimage.com/250x388" alt="Client Image">
                                    <div class="el-tm-banner-media_content">
                                        <h6>John Deo</h6>
                                        <p class="el-para"><img src="{{ asset('/frontend/assets/images/all-instructor/team-icon.png') }}" alt="icon"> 3D Animation</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="el-tm-banner-media">
                                    <img src="https://dummyimage.com/250x328" alt="Client Image">
                                    <div class="el-tm-banner-media_content">
                                        <h6>Charlie Burns</h6>
                                        <p class="el-para"><img src="{{ asset('/frontend/assets/images/all-instructor/team-icon.png') }}" alt="icon"> 3D Animation</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="el-tm-banner-media">
                                    <img src="https://dummyimage.com/250x328" alt="Client Image">
                                    <div class="el-tm-banner-media_content">
                                        <h6>Nina Bennett</h6>
                                        <p class="el-para"><img src="{{ asset('/frontend/assets/images/all-instructor/team-icon.png') }}" alt="icon"> 3D Animation</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-lg-12">
                <div class="swiper el-temnl-text-slider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="el-temsl-text-slider">
                                <img src="{{ asset('/frontend/assets/images/all-instructor/qoute.png') }}" alt="qoute image">
                                <p class="el-para">Get latest news in your inbox. Consectetur adipiscing elitaedipisa cingelitseddo eisusmod tempor incididunt utlabore etdolore and magnaseded doeiusmod tempor incididunt ut labore et dolore a magna aliquasded elitadipiscing elitsed.</p>
                                <div class="el-tesmnl-rating">
                                    <img src="{{ asset('/frontend/assets/images/all-instructor/like-star.png') }}" alt="rating star">
                                    <span>4.0</span>
                                    <span class="el-temnl-rating">
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/star.png') }}" alt="start">
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/star.png') }}" alt="start">
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/star.png') }}" alt="start">
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/star.png') }}" alt="start">
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/star-grey.png') }}" alt="start">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="el-temsl-text-slider">
                                <img src="{{ asset('/frontend/assets/images/all-instructor/qoute.png') }}" alt="qoute image">
                                <p class="el-para">Get latest news in your inbox. Consectetur adipiscing elitaedipisa cingelitseddo eisusmod tempor incididunt utlabore etdolore and magnaseded doeiusmod tempor incididunt ut labore et dolore a magna aliquasded elitadipiscing elitsed.</p>
                                <div class="el-tesmnl-rating">
                                    <img src="{{ asset('/frontend/assets/images/all-instructor/like-star.png') }}" alt="rating star">
                                    <span>4.0</span>
                                    <span class="el-temnl-rating">
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/star.png') }}" alt="start">
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/star.png') }}" alt="start">
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/star.png') }}" alt="start">
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/star.png') }}" alt="start">
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/star-grey.png') }}" alt="start">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="el-temsl-text-slider">
                                <img src="{{ asset('/frontend/assets/images/all-instructor/qoute.png') }}" alt="qoute image">
                                <p class="el-para">Get latest news in your inbox. Consectetur adipiscing elitaedipisa cingelitseddo eisusmod tempor incididunt utlabore etdolore and magnaseded doeiusmod tempor incididunt ut labore et dolore a magna aliquasded elitadipiscing elitsed.</p>
                                <div class="el-tesmnl-rating">
                                    <img src="{{ asset('/frontend/assets/images/all-instructor/like-star.png') }}" alt="rating star">
                                    <span>4.0</span>
                                    <span class="el-temnl-rating">
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/star.png') }}" alt="start">
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/star.png') }}" alt="start">
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/star.png') }}" alt="start">
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/star.png') }}" alt="start">
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/star-grey.png') }}" alt="start">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="el-temsl-text-slider">
                                <img src="{{ asset('/frontend/assets/images/all-instructor/qoute.png') }}" alt="qoute image">
                                <p class="el-para">Get latest news in your inbox. Consectetur adipiscing elitaedipisa cingelitseddo eisusmod tempor incididunt utlabore etdolore and magnaseded doeiusmod tempor incididunt ut labore et dolore a magna aliquasded elitadipiscing elitsed.</p>
                                <div class="el-tesmnl-rating">
                                    <img src="{{ asset('/frontend/assets/images/all-instructor/like-star.png') }}" alt="rating star">
                                    <span>4.0</span>
                                    <span class="el-temnl-rating">
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/star.png') }}" alt="start">
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/star.png') }}" alt="start">
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/star.png') }}" alt="start">
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/star.png') }}" alt="start">
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/star-grey.png') }}" alt="start">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="el-temsl-text-slider">
                                <img src="{{ asset('/frontend/assets/images/all-instructor/qoute.png') }}" alt="qoute image">
                                <p class="el-para">Get latest news in your inbox. Consectetur adipiscing elitaedipisa cingelitseddo eisusmod tempor incididunt utlabore etdolore and magnaseded doeiusmod tempor incididunt ut labore et dolore a magna aliquasded elitadipiscing elitsed.</p>
                                <div class="el-tesmnl-rating">
                                    <img src="{{ asset('/frontend/assets/images/all-instructor/like-star.png') }}" alt="rating star">
                                    <span>4.0</span>
                                    <span class="el-temnl-rating">
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/star.png') }}" alt="start">
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/star.png') }}" alt="start">
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/star.png') }}" alt="start">
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/star.png') }}" alt="start">
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/star-grey.png') }}" alt="start">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="el-temsl-text-slider">
                                <img src="{{ asset('/frontend/assets/images/all-instructor/qoute.png') }}" alt="qoute image">
                                <p class="el-para">Get latest news in your inbox. Consectetur adipiscing elitaedipisa cingelitseddo eisusmod tempor incididunt utlabore etdolore and magnaseded doeiusmod tempor incididunt ut labore et dolore a magna aliquasded elitadipiscing elitsed.</p>
                                <div class="el-tesmnl-rating">
                                    <img src="{{ asset('/frontend/assets/images/all-instructor/like-star.png') }}" alt="rating star">
                                    <span>4.0</span>
                                    <span class="el-temnl-rating">
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/star.png') }}" alt="start">
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/star.png') }}" alt="start">
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/star.png') }}" alt="start">
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/star.png') }}" alt="start">
                                        <img src="{{ asset('/frontend/assets/images/all-instructor/star-grey.png') }}" alt="start">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Testimonial Section End -->

<!-- Pricing Section Start -->
<div class="el-pricing-wrapper" id="pricingContainer">
    <div class="container">
        <div class="el-team-heading text-center">
            <h4 class="el-top-heading-center">Pricing Plans</h4>
            <h2 class="el-main-heading">Transparent And Simple Pricing</h2>
            <p class="el-para">Get latest news in your inbox. Consectetur adipiscing elitadipiscing elitse <br> ddo eiusmod tempor incididunt ut labore et dolore.</p>
        </div>
        <div class="el-pricing-main-parent">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="monthly" role="tabpanel" aria-labelledby="monthly-tab">
                    <div class="row gy-4">
                        <div class="col-lg-3 col-md-6">
                            <div class="el-price-box {{($student && $student->package == 'free' && $student->count < 8) ? 'border border-2 border-success rounded-4' : ''}}">
                                <div class="el-price-inner">
                                    <div class="el-price-head">
                                        <div class="el-price-img">
                                            <img src="{{ asset('/frontend/assets/images/all-instructor/free.png') }}" width="50" alt="Icon">
                                        </div>
                                        <h4>Free trial</h4>
                                        <p class="el-para">For an individual and begineer</p>
                                        <h1>0<span>PKR</span></h1>
                                        @if($student != '')
                                        @if($student->package == 'free' && $student->count < 8) <button disabled class="btn btn-success py-3 rounded-5 w-100">Trial Activated</button>
                                            @elseif($student != '' && ($student->package == 'free' && $student->count == 8))
                                            <button disabled class="btn btn-danger rounded-5 py-3 w-100">Trial Ended</button>
                                            @else
                                            <button disabled class="btn btn-danger rounded-5 py-3 w-100">Trial Ended</button>
                                            @endif
                                            @elseif($not_avail)
                                            @if(Auth::user()->role == 'teacher')
                                            <button class="el-btn" disabled>Teacher can't access</button>
                                            @elseif(Auth::user()->role == 'admin')
                                            <button class="el-btn" disabled>Admin can't access</button>
                                            @endif
                                            @else
                                            <a href="{{route('register')}}" class="el-btn">Get Started Now</a>
                                            @endif
                                    </div>
                                    <div class="el-pricing-list">
                                        <ul>
                                            <li class="el-para">
                                                <img src="{{ asset('/frontend/assets/images/all-instructor/checked.png') }}" alt="icon">
                                                One time access
                                            </li>
                                            <li class="el-para">
                                                <img src="{{ asset('/frontend/assets/images/all-instructor/checked.png') }}" alt="icon">
                                                You can visit 8 teacher's profile
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach($pricings as $pricing)
                        {{-- @php
                            $admin_pricing = StdPricing::where('name',$pricing->)
                        @endphp --}}
                        <div class="col-lg-3 col-md-6">
                            <div class="el-price-box {{($student && $student->package == $pricing->name && $student->count < $pricing->click) ? 'border border-2 border-success rounded-4' : ''}}">
                                <div class="el-price-inner">
                                    <div class="el-price-head">
                                        <div class="el-price-img">
                                            <img src="{{ asset('/frontend/assets/images/all-instructor/'.strtolower($pricing->name).'-icon.png') }}" alt="Icon">
                                        </div>
                                        <h4>{{$pricing->name}}</h4>
                                        <p class="el-para">For an individual and begineer</p>
                                        <h1>{{$pricing->price}}<span>PKR</span></h1>
                                        @if($student != '')
                                        @if($student->package == $pricing->name && $student->count < $pricing->click) <button disabled class="btn btn-success rounded-5 w-100 py-3">Activated</button>
                                            @elseif($student != '' && ($student->package == $pricing->name && $student->count >= $pricing->click))
                                            <a href="{{route('package.payment',$pricing->id)}}" class="el-btn">Buy Again</a>
                                            @else
                                            <a href="{{route('package.payment',$pricing->id)}}" class="el-btn">Get Started Now</a>
                                            @endif
                                            @elseif($not_avail)
                                            @if(Auth::user()->role == 'teacher')
                                            <button disabled class="el-btn">Teacher can't access</button>
                                            @elseif(Auth::user()->role == 'admin')
                                            <button disabled class="el-btn">Admin can't access</button>
                                            @endif
                                            @else
                                            <a href="{{route('register')}}" class="el-btn">Sign Up</a>
                                            @endif
                                    </div>
                                    <div class="el-pricing-list">
                                        <ul>
                                            <li class="el-para">
                                                <img src="{{ asset('/frontend/assets/images/all-instructor/checked.png') }}" alt="icon">
                                                Premium access
                                            </li>
                                            <li class="el-para">
                                                <img src="{{ asset('/frontend/assets/images/all-instructor/checked.png') }}" alt="icon">
                                                You can visit {{$pricing->click}} teacher's profile
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Pricing Section End -->

<!-- Blog Section Start -->
{{-- <div class="el-blog-wrapper">
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
    <div class="container">
        <div class="el-team-heading text-center">
            <h4 class="el-top-heading-center">Our Blogs</h4>
            <h2 class="el-main-heading">News, Tips, Blogs & Insights</h2>
            <p class="el-para">Get latest news in your inbox. Consectetur adipiscing elitadipiscing elitse <br> ddo eiusmod tempor incididunt ut labore et dolore.</p>
        </div>
        <div class="swiper el-blog-slider-parent">
            <div class="swiper-wrapper">
                @foreach($blogs as $key => $blog)
                @php
                $blogIdx = ($key % 3) + 1;
                @endphp
                <div class="swiper-slide">
                    <div class="el-blog-box {{'el-blog-box-'.$blogIdx}}">
                        <div class="el-blog-img">
                            <img src="{{'/uploads/blogimages/'.$blog->blog_img}}" width="100%" alt="Blog Image">
                            <h4 class="ps-4">{{$blog->img_title}}</h4>
                        </div>
                        <div class="el-blog-content">
                            <h4>{{$blog->blog_title}}</h4>
                            <a href="{{route('blog.single',$blog->id)}}" class="el-btn text-white mt-4">read more</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div> --}}
<!-- Blog Section End -->

<!-- Newsletter Section Start -->
<div class="el-newsletter-wrapper">
    <div class="container">
        <div class="el-newsltr-flex">
            <div class="el-nesltr-left">
                <h4>Subscribe Our Newsletter</h4>
                <p class="el-para">Subscribed to our newsletter to get regular update about our courses. <br>
                    Get latest news in your inbox.</p>
            </div>
            <div class="el-nesltr-right">
                <form action="{{route('newsletter.subscribe')}}" method="POST">
                    @csrf
                    <div class="el-input-field">
                        <input type="email" name="newsletterEmail" value="{{old('newsletterEmail')}}" placeholder="Your email here...">
                        <button type="submit" class="el-btn">Subscribe</button>
                    </div>
                    @error('newsletterEmail')
                    <span class="text-white ms-4">{{$message}}</span>
                    @enderror
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Newsletter Section End -->
@endsection
