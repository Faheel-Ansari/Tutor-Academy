<!-- Footer Start -->
@php
use App\Models\Sociallink;
use App\Models\Footer;
use App\Models\Logo;
$sociallinks = Sociallink::get();
$footer = Footer::first();
$logo = Logo::first();
@endphp
<div class="el-footer-wrapper">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6">
                <div class="el-footer-info">
                    <a href="/"><img src="@if($logo){{ asset('/uploads/logo/'.$logo->logo) }}@endif" width="150" alt="logo"></a>
                    <p class="el-para">@if($footer){{$footer->footerpara}}@endif</p>
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
            {{-- <div class="col-lg-2 col-md-6">
                <div class="el-footer-menu">
                    <h4>Product</h4>
                    <ul>
                        <li><a href="javascript:;">Landing Page</a></li>
                        <li><a href="javascript:;">Features</a></li>
                        <li><a href="javascript:;">Documentation</a></li>
                        <li><a href="javascript:;">Referral Program</a></li>
                        <li><a href="javascript:;">Pricing</a></li>
                    </ul>
                </div>
            </div> --}}
            <div class="col-lg-2 col-md-6">
                <div class="el-footer-menu">
                    <h4>Services</h4>
                    <ul>
                        <li><a href="javascript:;">Documentation</a></li>
                        <li><a href="javascript:;">Design</a></li>
                        <li><a href="javascript:;">Themes</a></li>
                        <li><a href="javascript:;">Illustrations</a></li>
                        <li><a href="javascript:;">UI Kit</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="el-footer-menu">
                    <h4>Support</h4>
                    <ul>
                        <li><a href="javascript:;">Profile</a></li>
                        <li><a href="javascript:;">Contact</a></li>
                        <li><a href="javascript:;">Help Center</a></li>
                        <li><a href="javascript:;">Refund</a></li>
                        <li><a href="javascript:;">Return Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="el-footer-menu">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="javascript:;">About</a></li>
                        <li><a href="javascript:;">Terms</a></li>
                        <li><a href="javascript:;">Privacy Policy</a></li>
                        <li><a href="javascript:;">Careers</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="el-copyright-parent text-center">
            <p>Copyright © 2025. Powered by <a href="https://www.webdevelopersacademy.com/" target="_blank" class=" text-decoration-underline">Web Developers Acedemy</a></p>
        </div>
    </div>
</div>
<!-- Footer End -->
