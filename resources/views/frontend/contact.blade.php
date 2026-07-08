@extends('frontend.body.master')
@section('content')
<div class="el-breadcrumb-wrapper">
    <div class="container">
        <div class="el-breadcrmb-inner">
            <h1>contact manal tutors academy</h1>
            <ul>
                <li>
                    <a href="/">home</a>
                </li>
                <li>></li>
                <li>contact us</li>
            </ul>
        </div>
    </div>
</div>
<div class="el-contact-page-wrapper ">
    <div class="container">
        <div class="el-contact-page-box">
            <div class="el-cntact-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3618.0762777328!2d67.09026497617454!3d24.929471277884268!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb33f28afc9b061%3A0x6cb991010a415dfc!2sWeb%20Developers%20Academy!5e0!3m2!1sen!2s!4v1755340101633!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="el-contact-page-info">
                <div class="el-team-heading el-contact-page-head">
                    <h2 class="el-main-heading">get in touch with us</h2>
                    <p class="el-para">Get latest news in your inbox. Consectetur adipiscing elitadipiscing elitse <br>
                        ddo eiusmod tempor incididunt ut labore et dolore.</p>
                </div>
                <form action="{{route('contactus.message')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="el-input-field">
                                <input type="text" name="fname" value="{{old('fname')}}" class="@error('fname') is-invalid @enderror" placeholder="First Name">
                                @error('fname')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="el-input-field">
                                <input type="text" name="lname" value="{{old('lname')}}" class="@error('lname') is-invalid @enderror" placeholder="Last Name">
                                @error('lname')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="el-input-field">
                                <input type="text" name="email" value="{{old('email')}}" class="@error('email') is-invalid @enderror" placeholder="Your Email">
                                @error('email')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="el-input-field">
                                <input type="text" name="subject" value="{{old('subject')}}" class="@error('subject') is-invalid @enderror" placeholder="Subject">
                                @error('subject')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="el-input-field">
                                <textarea placeholder="Message" name="message" class="@error('message') is-invalid @enderror">{{old('message')}}</textarea>
                                @error('message')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <button type="submit" class="el-btn">send message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
