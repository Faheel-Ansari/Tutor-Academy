<section class="what-looking-for pos-rel gradient-bg pt-145 pb-130 pt-md-95 pb-md-80 pt-xs-95 pb-xs-80">
    <div class="what-blur-shape-one"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title text-center mb-55">
                    <h5 class="bottom-line mb-25">Teachers & Students</h5>
                    <h2>What you Looking For?</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="what-box text-center mb-3">
                    <div class="what-box__icon mb-30">
                        <img src="{{asset('/frontend/assets/img/icon/phone-operator.svg')}}" alt="">
                    </div>
                    <h3>Do you want to teach here?</h3>
                    @if(Auth::check() && Auth::user()->role === 'teacher')
                    <a href="{{ url('teacher/dashboard') }}" class="theme_btn border_btn">Dashboard</a>
                    @elseif(Auth::check() && Auth::user()->role === 'student')
                    <p>You can't access</p>
                    @else
                    <a href="{{ route('teacherregister') }}" class="theme_btn border_btn">Register Now</a>
                    @endif
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="what-box text-center mb-3">
                    <div class="what-box__icon mb-30">
                        <img src="{{asset('/frontend/assets/img/icon/graduate.svg')}}" alt="">
                    </div>
                    <h3>Do you want to learn here?</h3>
                    @if(Auth::check() && Auth::user()->role === 'teacher')
                    <p>You can't access</p>
                    @elseif(Auth::check() && Auth::user()->role === 'student')
                    <a href="{{ url('student/dashboard') }}" class="theme_btn border_btn active">Dashboard</a>
                    @else
                    <a href="{{ route('register') }}" class="theme_btn border_btn active">Register Now</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
