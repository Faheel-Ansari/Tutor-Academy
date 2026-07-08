@extends('frontend.body.master')
@section('content')
<div class="el-breadcrumb-wrapper">
    <div class="container">
        <div class="el-breadcrmb-inner">
            <h1>About Manal Tutors Academy</h1>
            <ul>
                <li>
                    <a href="/">home</a>
                </li>
                <li>></li>
                <li>about us</li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb Start -->

<!-- About Section Start -->
<div class="el-about-wrapper">
	<div class="container">
		<div class="row gy-4 align-items-center">
			<div class="col-lg-6">
				<div class="el-about-img">
					{{-- <div class="el-banner-reslt-box">						
						<h4>Brilliant Results</h4>
						<div class="el-reslt-flex">
							<img src="https://dummyimage.com/50x50/" alt="student image">
							<div class="el-reslt-info">
								<h4>John Deo</h4>
								<p>M.Sc. Students</p>
							</div>
							<div class="el-reslt-grade">
								<span>A+</span>
							</div>
						</div>
						<div class="el-reslt-flex">
							<img src="https://dummyimage.com/50x50/" alt="student image">
							<div class="el-reslt-info">
								<h4>Emma Score</h4>
								<p>MBA Students</p>
							</div>
							<div class="el-reslt-grade">
								<span>A+</span>
							</div>
						</div>
						<div class="el-reslt-flex">
							<img src="https://dummyimage.com/50x50/" alt="student image">
							<div class="el-reslt-info">
								<h4>Charlie Burns</h4>
								<p>CA Students</p>
							</div>
							<div class="el-reslt-grade">
								<span>A+</span>
							</div>
						</div>
					</div> --}}
					<img src="@if($about){{asset('/uploads/adminimages/'.$about->aboutimg)}}@endif" alt="About Image">
					{{-- <img src="{{asset('/frontend/assets/images/all-instructor/about-review.png')}}" alt="Review" class="el-abt-review"> --}}
					<img src="{{asset('/frontend/assets/images/all-instructor/about-video-icon.png')}}" alt="Video Icon" class="el-abt-videoIcon">
					{{-- <img src="{{asset('/frontend/assets/images/all-instructor/star-smile.png')}}" alt="Video Icon" class="el-smile-star"> --}}
				</div>
			</div>
			<div class="col-lg-6">
				<div class="el-about-content">
					<h4 class="el-top-heading">about us</h4>
					<h2 class="el-main-heading">@if($about){{$about->abouthead}}@endif</h2>
					<p class="el-para">@if($about){{$about->aboutpara}}@endif</p>
					<ul>
						<li class="el-para">
							<img src="{{asset('/frontend/assets/images/all-instructor/checked.png')}}" alt="Checked Icon">
							Offline Courses - Video Courses
						</li>
						<li class="el-para">
							<img src="{{asset('/frontend/assets/images/all-instructor/checked.png')}}" alt="Checked Icon">
							Online Courses - Video Courses
						</li>
						<li class="el-para">
							<img src="{{asset('/frontend/assets/images/all-instructor/checked.png')}}" alt="Checked Icon">
							Diploma - Video Courses
						</li>
						<li class="el-para">
							<img src="{{asset('/frontend/assets/images/all-instructor/checked.png')}}" alt="Checked Icon">
							Certification - Video Courses
						</li>
						<li class="el-para">
							<img src="{{asset('/frontend/assets/images/all-instructor/checked.png')}}" alt="Checked Icon">
							App Support - Video Courses
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="el-feature-wrapper">
	<div class="container">
		<div class="el-team-heading text-center">
			<h4 class="el-top-heading-center">Features</h4>
			<h2 class="el-main-heading">Why Choose Us</h2>
			<p class="el-para">Get latest news in your inbox. Consectetur adipiscing elitadipiscing elitse <br>
				ddo eiusmod tempor incididunt ut labore et dolore.</p>
		</div>
		<div class="el-counter-parent">
			<div class="el-count el-count-1">
				<div class="el-counting" data-to="2600">0</div>
				<div class="el-count-heading">
					<h5>Students Graduated</h5>
					<p class="el-para">Throughout these year we have done amazing work with 250..</p>
				</div>
			</div>
			<div class="el-count el-count-2">
				<div class="el-counting" data-to="6500">0</div>
				<div class="el-count-heading">
					<h5>Competitions Won</h5>
					<p class="el-para">Only competitions were
						the ones in the back of
						the magazines you..</p>
				</div>
			</div>
			<div class="el-count el-count-3">
				<div class="el-counting" data-to="5000">0</div>
				<div class="el-count-heading">
					<h5>Classes Visited</h5>
					<p class="el-para">Can how you setup
						your classroom impact
						how students think...</p>
				</div>
			</div>
			<div class="el-count el-count-4">
				<div class="el-counting" data-to="2000">0</div>
				<div class="el-count-heading">
					<h5>Websites Trust</h5>
					<p class="el-para">Only competitions were
						the ones in the back of
						the magazines you..</p>
				</div>
			</div>
			<div class="el-count el-count-5">
				<div class="el-counting" data-to="2100">0</div>
				<div class="el-count-heading">
					<h5>Happy Customers</h5>
					<p class="el-para">Only competitions were
						the ones in the back of
						the magazines you..</p>
				</div>
			</div>
		</div>
	</div>
</div>
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
							<path
								d="M6.46068 0.875485C6.18697 0.596953 5.74568 0.596953 5.47196 0.875485L0.830026 5.59917C0.778242 5.65176 0.737158 5.71423 0.709127 5.78299C0.681096 5.85176 0.666667 5.92547 0.666667 5.99992C0.666667 6.07437 0.681096 6.14808 0.709127 6.21685C0.737158 6.28561 0.778242 6.34808 0.830026 6.40067L5.47196 11.1244C5.74567 11.4029 6.18697 11.4029 6.46068 11.1244C6.73439 10.8458 6.73439 10.3968 6.46068 10.1182L2.41644 5.99708L6.46627 1.87593C6.73439 1.60308 6.73439 1.14833 6.46068 0.875485Z" />
						</svg>
					</div>
					<div class="swiper-button-next">
						<svg width="7" height="12" viewBox="0 0 7 12" fill="none">
							<path
								d="M0.539362 11.1245C0.813074 11.403 1.25437 11.403 1.52808 11.1245L6.17002 6.40083C6.2218 6.34824 6.26288 6.28578 6.29091 6.21701C6.31894 6.14824 6.33337 6.07453 6.33337 6.00008C6.33337 5.92563 6.31894 5.85192 6.29091 5.78315C6.26288 5.71439 6.2218 5.65192 6.17002 5.59934L1.52808 0.875648C1.25437 0.597115 0.813074 0.597115 0.539362 0.875648C0.26565 1.15418 0.26565 1.60324 0.539362 1.88178L4.5836 6.00292L0.533776 10.1241C0.26565 10.3969 0.26565 10.8517 0.539362 11.1245Z" />
						</svg>
					</div>
					<div class="swiper el-testmnl-slider">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								<div class="el-tm-banner-media">
									<img src="https://dummyimage.com/250x388" alt="Client Image">
									<div class="el-tm-banner-media_content">
										<h6>John Deo</h6>
										<p class="el-para"><img src="{{asset('/frontend/assets/images/all-instructor/team-icon.png')}}"
												alt="icon"> 3D Animation</p>
									</div>
								</div>
							</div>
							<div class="swiper-slide">
								<div class="el-tm-banner-media">
									<img src="https://dummyimage.com/250x328" alt="Client Image">
									<div class="el-tm-banner-media_content">
										<h6>Charlie Burns</h6>
										<p class="el-para"><img src="{{asset('/frontend/assets/images/all-instructor/team-icon.png')}}"
												alt="icon"> 3D Animation</p>
									</div>
								</div>
							</div>
							<div class="swiper-slide">
								<div class="el-tm-banner-media">
									<img src="https://dummyimage.com/250x328" alt="Client Image">
									<div class="el-tm-banner-media_content">
										<h6>Nina Bennett</h6>
										<p class="el-para"><img src="{{asset('/frontend/assets/images/all-instructor/team-icon.png')}}"
												alt="icon"> 3D Animation</p>
									</div>
								</div>
							</div>
							<div class="swiper-slide">
								<div class="el-tm-banner-media">
									<img src="https://dummyimage.com/250x388" alt="Client Image">
									<div class="el-tm-banner-media_content">
										<h6>John Deo</h6>
										<p class="el-para"><img src="{{asset('/frontend/assets/images/all-instructor/team-icon.png')}}"
												alt="icon"> 3D Animation</p>
									</div>
								</div>
							</div>
							<div class="swiper-slide">
								<div class="el-tm-banner-media">
									<img src="https://dummyimage.com/250x328" alt="Client Image">
									<div class="el-tm-banner-media_content">
										<h6>Charlie Burns</h6>
										<p class="el-para"><img src="{{asset('/frontend/assets/images/all-instructor/team-icon.png')}}"
												alt="icon"> 3D Animation</p>
									</div>
								</div>
							</div>
							<div class="swiper-slide">
								<div class="el-tm-banner-media">
									<img src="https://dummyimage.com/250x328" alt="Client Image">
									<div class="el-tm-banner-media_content">
										<h6>Nina Bennett</h6>
										<p class="el-para"><img src="{{asset('/frontend/assets/images/all-instructor/team-icon.png')}}"
												alt="icon"> 3D Animation</p>
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
								<img src="{{asset('/frontend/assets/images/all-instructor/qoute.png')}}" alt="qoute image">
								<p class="el-para">Get latest news in your inbox. Consectetur adipiscing elitaedipisa
									cingelitseddo eisusmod tempor incididunt utlabore etdolore and
									magnaseded doeiusmod tempor incididunt ut labore et dolore a
									magna aliquasded elitadipiscing elitsed.</p>
								<div class="el-tesmnl-rating">
									<img src="{{asset('/frontend/assets/images/all-instructor/like-star.png')}}" alt="rating star">
									<span>4.0</span>
									<span class="el-temnl-rating">
										<img src="{{asset('/frontend/assets/images/all-instructor/star.png')}}" alt="start">
										<img src="{{asset('/frontend/assets/images/all-instructor/star.png')}}" alt="start">
										<img src="{{asset('/frontend/assets/images/all-instructor/star.png')}}" alt="start">
										<img src="{{asset('/frontend/assets/images/all-instructor/star.png')}}" alt="start">
										<img src="{{asset('/frontend/assets/images/all-instructor/star-grey.png')}}" alt="start">
									</span>
								</div>
							</div>
						</div>
						<div class="swiper-slide">
							<div class="el-temsl-text-slider">
								<img src="{{asset('/frontend/assets/images/all-instructor/qoute.png')}}" alt="qoute image">
								<p class="el-para">Get latest news in your inbox. Consectetur adipiscing elitaedipisa
									cingelitseddo eisusmod tempor incididunt utlabore etdolore and
									magnaseded doeiusmod tempor incididunt ut labore et dolore a
									magna aliquasded elitadipiscing elitsed.</p>
								<div class="el-tesmnl-rating">
									<img src="{{asset('/frontend/assets/images/all-instructor/like-star.png')}}" alt="rating star">
									<span>4.0</span>
									<span class="el-temnl-rating">
										<img src="{{asset('/frontend/assets/images/all-instructor/star.png')}}" alt="start">
										<img src="{{asset('/frontend/assets/images/all-instructor/star.png')}}" alt="start">
										<img src="{{asset('/frontend/assets/images/all-instructor/star.png')}}" alt="start">
										<img src="{{asset('/frontend/assets/images/all-instructor/star.png')}}" alt="start">
										<img src="{{asset('/frontend/assets/images/all-instructor/star-grey.png')}}" alt="start">
									</span>
								</div>
							</div>
						</div>
						<div class="swiper-slide">
							<div class="el-temsl-text-slider">
								<img src="{{asset('/frontend/assets/images/all-instructor/qoute.png')}}" alt="qoute image">
								<p class="el-para">Get latest news in your inbox. Consectetur adipiscing elitaedipisa
									cingelitseddo eisusmod tempor incididunt utlabore etdolore and
									magnaseded doeiusmod tempor incididunt ut labore et dolore a
									magna aliquasded elitadipiscing elitsed.</p>
								<div class="el-tesmnl-rating">
									<img src="{{asset('/frontend/assets/images/all-instructor/like-star.png')}}" alt="rating star">
									<span>4.0</span>
									<span class="el-temnl-rating">
										<img src="{{asset('/frontend/assets/images/all-instructor/star.png')}}" alt="start">
										<img src="{{asset('/frontend/assets/images/all-instructor/star.png')}}" alt="start">
										<img src="{{asset('/frontend/assets/images/all-instructor/star.png')}}" alt="start">
										<img src="{{asset('/frontend/assets/images/all-instructor/star.png')}}" alt="start">
										<img src="{{asset('/frontend/assets/images/all-instructor/star-grey.png')}}" alt="start">
									</span>
								</div>
							</div>
						</div>
						<div class="swiper-slide">
							<div class="el-temsl-text-slider">
								<img src="{{asset('/frontend/assets/images/all-instructor/qoute.png')}}" alt="qoute image">
								<p class="el-para">Get latest news in your inbox. Consectetur adipiscing elitaedipisa
									cingelitseddo eisusmod tempor incididunt utlabore etdolore and
									magnaseded doeiusmod tempor incididunt ut labore et dolore a
									magna aliquasded elitadipiscing elitsed.</p>
								<div class="el-tesmnl-rating">
									<img src="{{asset('/frontend/assets/images/all-instructor/like-star.png')}}" alt="rating star">
									<span>4.0</span>
									<span class="el-temnl-rating">
										<img src="{{asset('/frontend/assets/images/all-instructor/star.png')}}" alt="start">
										<img src="{{asset('/frontend/assets/images/all-instructor/star.png')}}" alt="start">
										<img src="{{asset('/frontend/assets/images/all-instructor/star.png')}}" alt="start">
										<img src="{{asset('/frontend/assets/images/all-instructor/star.png')}}" alt="start">
										<img src="{{asset('/frontend/assets/images/all-instructor/star-grey.png')}}" alt="start">
									</span>
								</div>
							</div>
						</div>
						<div class="swiper-slide">
							<div class="el-temsl-text-slider">
								<img src="{{asset('/frontend/assets/images/all-instructor/qoute.png')}}" alt="qoute image">
								<p class="el-para">Get latest news in your inbox. Consectetur adipiscing elitaedipisa
									cingelitseddo eisusmod tempor incididunt utlabore etdolore and
									magnaseded doeiusmod tempor incididunt ut labore et dolore a
									magna aliquasded elitadipiscing elitsed.</p>
								<div class="el-tesmnl-rating">
									<img src="{{asset('/frontend/assets/images/all-instructor/like-star.png')}}" alt="rating star">
									<span>4.0</span>
									<span class="el-temnl-rating">
										<img src="{{asset('/frontend/assets/images/all-instructor/star.png')}}" alt="start">
										<img src="{{asset('/frontend/assets/images/all-instructor/star.png')}}" alt="start">
										<img src="{{asset('/frontend/assets/images/all-instructor/star.png')}}" alt="start">
										<img src="{{asset('/frontend/assets/images/all-instructor/star.png')}}" alt="start">
										<img src="{{asset('/frontend/assets/images/all-instructor/star-grey.png')}}" alt="start">
									</span>
								</div>
							</div>
						</div>
						<div class="swiper-slide">
							<div class="el-temsl-text-slider">
								<img src="{{asset('/frontend/assets/images/all-instructor/qoute.png')}}" alt="qoute image">
								<p class="el-para">Get latest news in your inbox. Consectetur adipiscing elitaedipisa
									cingelitseddo eisusmod tempor incididunt utlabore etdolore and
									magnaseded doeiusmod tempor incididunt ut labore et dolore a
									magna aliquasded elitadipiscing elitsed.</p>
								<div class="el-tesmnl-rating">
									<img src="{{asset('/frontend/assets/images/all-instructor/like-star.png')}}" alt="rating star">
									<span>4.0</span>
									<span class="el-temnl-rating">
										<img src="{{asset('/frontend/assets/images/all-instructor/star.png')}}" alt="start">
										<img src="{{asset('/frontend/assets/images/all-instructor/star.png')}}" alt="start">
										<img src="{{asset('/frontend/assets/images/all-instructor/star.png')}}" alt="start">
										<img src="{{asset('/frontend/assets/images/all-instructor/star.png')}}" alt="start">
										<img src="{{asset('/frontend/assets/images/all-instructor/star-grey.png')}}" alt="start">
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
@endsection