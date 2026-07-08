<!-- Top Bar Start -->
@php
    use App\Models\Sociallink;
    use App\Models\Footer;
    use App\Models\Logo;
    $sociallinks = Sociallink::get();
    $footer = Footer::first();
    $logo = Logo::first();
@endphp
<div class="el-top-header-bar">
    <div class="container">
        <div class="el-top-bar-flex">
            <div class="el-top-header-left">
                <p>Welcome To Our New Session Of Education</p>
            </div>
            <div class="el-top-header-right">
                <p>
                    <img src="{{ asset('/frontend/assets/images/all-instructor/phone.svg') }}" alt="phone icon">
                    For any question call us at | <span>@if($footer) {{$footer->contact}}@endif</span>
                </p>
                <div class="el-social-icons">
                    <ul>
                        @foreach($sociallinks as $link)
                        <li>
                            <a href="{{$link->link}}" class="text-white">
                                <i class="{{$link->real_name}}"></i>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Top Bar End -->
{{-- <!-- Search Box -->
<div class="searchBox">
    <div class="searchBoxContainer">
        <a href="javascript:void(0);" class="closeBtn">
            <svg viewBox="0 0 413.348 413.348" xmlns="http://www.w3.org/2000/svg">
                <path d="m413.348 24.354-24.354-24.354-182.32 182.32-182.32-182.32-24.354 24.354 182.32 182.32-182.32 182.32 24.354 24.354 182.32-182.32 182.32 182.32 24.354-24.354-182.32-182.32z"></path>
            </svg>
        </a>
        <div class="search-bar-inner">
            <input type="text" placeholder="Enter Your keywords" />
            <button type="submit">
                <img src="{{ asset('/frontend/assets/images/all-instructor/search.svg') }}" alt="icon">
</button>
</div>
</div>
</div>
<!-- Search Box --> --}}
<!-- Header Start -->
<header class="el-header-wrapper">
    <div class="container">
        <div class="el-header-parent">
            <div class="el-logo">
                <a href="/"><img src="@if($logo){{ asset('/uploads/logo/'.$logo->logo) }}@endif" width="100" alt="Logo"></a>
            </div>
            <div class="el-header-right">
                <div class="el-nav-menu">
                    <ul>
                        <li class="{{ Route::currentRouteName() === 'home' ? 'active' : '' }}"><a href="/">Home</a></li>
                        <li class="{{ Route::currentRouteName() === 'aboutus' ? 'active' : '' }}"><a href="{{route('aboutus')}}">About Us </a></li>
                        {{-- <li class="el-has-menu"><a href="javascript:;">blogs <svg version="1.1" x="0" y="0" viewBox="0 0 491.996 491.996" style="enable-background:new 0 0 512 512">
                                    <g>
                                        <path d="m484.132 124.986-16.116-16.228c-5.072-5.068-11.82-7.86-19.032-7.86-7.208 0-13.964 2.792-19.036 7.86l-183.84 183.848L62.056 108.554c-5.064-5.068-11.82-7.856-19.028-7.856s-13.968 2.788-19.036 7.856l-16.12 16.128c-10.496 10.488-10.496 27.572 0 38.06l219.136 219.924c5.064 5.064 11.812 8.632 19.084 8.632h.084c7.212 0 13.96-3.572 19.024-8.632l218.932-219.328c5.072-5.064 7.856-12.016 7.864-19.224 0-7.212-2.792-14.068-7.864-19.128z" opacity="1" />
                                    </g>
                                </svg></a>
                            <ul class="el-sub-menu">
                                <li><a href="blog-single.html">blog single</a></li>
                                <li><a href="blog-medium.html">blog medium</a></li>
                            </ul>
                        </li> --}}
                        {{-- <li class="el-has-menu"><a href="javascript:;">events
                                <svg version="1.1" x="0" y="0" viewBox="0 0 491.996 491.996" style="enable-background:new 0 0 512 512">
                                    <g>
                                        <path d="m484.132 124.986-16.116-16.228c-5.072-5.068-11.82-7.86-19.032-7.86-7.208 0-13.964 2.792-19.036 7.86l-183.84 183.848L62.056 108.554c-5.064-5.068-11.82-7.856-19.028-7.856s-13.968 2.788-19.036 7.856l-16.12 16.128c-10.496 10.488-10.496 27.572 0 38.06l219.136 219.924c5.064 5.064 11.812 8.632 19.084 8.632h.084c7.212 0 13.96-3.572 19.024-8.632l218.932-219.328c5.072-5.064 7.856-12.016 7.864-19.224 0-7.212-2.792-14.068-7.864-19.128z" opacity="1" />
                                    </g>
                                </svg></a>
                            <ul class="el-sub-menu">
                                <li><a href="event.html">all events</a></li>
                                <li><a href="event-single.html">events-single</a></li>
                            </ul>
                        </li> --}}
                        {{-- <li class="el-has-menu"><a href="javascript:;">courses
                                <svg version="1.1" x="0" y="0" viewBox="0 0 491.996 491.996" style="enable-background:new 0 0 512 512">
                                    <g>
                                        <path d="m484.132 124.986-16.116-16.228c-5.072-5.068-11.82-7.86-19.032-7.86-7.208 0-13.964 2.792-19.036 7.86l-183.84 183.848L62.056 108.554c-5.064-5.068-11.82-7.856-19.028-7.856s-13.968 2.788-19.036 7.856l-16.12 16.128c-10.496 10.488-10.496 27.572 0 38.06l219.136 219.924c5.064 5.064 11.812 8.632 19.084 8.632h.084c7.212 0 13.96-3.572 19.024-8.632l218.932-219.328c5.072-5.064 7.856-12.016 7.864-19.224 0-7.212-2.792-14.068-7.864-19.128z" opacity="1" />
                                    </g>
                                </svg></a>
                            <ul class="el-sub-menu">
                                <li><a href="courses.html">all courses</a></li>
                                <li><a href="course-sidebar.html">course-sidebar</a></li>
                            </ul>
                        </li> --}}
                        {{-- <li class="el-has-menu"><a href="javascript:;">pages
                                <svg version="1.1" x="0" y="0" viewBox="0 0 491.996 491.996" style="enable-background:new 0 0 512 512">
                                    <g>
                                        <path d="m484.132 124.986-16.116-16.228c-5.072-5.068-11.82-7.86-19.032-7.86-7.208 0-13.964 2.792-19.036 7.86l-183.84 183.848L62.056 108.554c-5.064-5.068-11.82-7.856-19.028-7.856s-13.968 2.788-19.036 7.856l-16.12 16.128c-10.496 10.488-10.496 27.572 0 38.06l219.136 219.924c5.064 5.064 11.812 8.632 19.084 8.632h.084c7.212 0 13.96-3.572 19.024-8.632l218.932-219.328c5.072-5.064 7.856-12.016 7.864-19.224 0-7.212-2.792-14.068-7.864-19.128z" opacity="1" />
                                    </g>
                                </svg></a>
                            <ul class="el-sub-menu">
                                <li><a href="instructors.html">all instructors</a></li>
                                <li><a href="pricing.html">pricing table</a></li>
                                <li><a href="cart.html">cart</a></li>
                                <li><a href="checkout.html">checkout</a></li>
                                <li><a href="404.html">404 error</a></li>
                            </ul>
                        </li> --}}
                        <li class="{{ Route::currentRouteName() === 'contactus' ? 'active' : '' }}"><a href="{{route('contactus')}}">Contact Us</a></li>
                        @if(Auth::check() && Auth::user()->role === 'teacher')
                        <li><a href="{{route('teacher.dashboard')}}" class="el-btn d-flex align-items-center text-white">Dashboard</a></li>
                        @elseif(Auth::check() && Auth::user()->role === 'student')
                        <li><a href="{{route('student.dashboard')}}" class="el-btn d-flex align-items-center text-white">Dashboard</a></li>
                        @elseif(Auth::check() && Auth::user()->role === 'admin')
                        <li><a href="{{route('admin.dashboard')}}" class="el-btn d-flex align-items-center text-white">Dashboard</a></li>
                        @else
                        <li><a href="{{route('teacherregister')}}">Become a Teacher</a></li>
                        <li><a href="{{route('login')}}" class="el-btn d-flex align-items-center text-white">Login</a></li>
                        <li><a href="{{route('register')}}" class="el-btn-signup d-flex align-items-center">Sign-Up</a></li>
                        @endif
                    </ul>
                </div>
                {{-- <div class="el-header-search">
                    <input type="search" placeholder="Search">
                    <img src="{{ asset('/frontend/assets/images/all-instructor/search.svg') }}" alt="search">
            </div> --}}
            <div class="el_toggle_btn">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    </div>
</header>
<!-- Header End -->
