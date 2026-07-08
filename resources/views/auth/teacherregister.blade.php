<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    @if($logo)
    <link rel="icon" href="{{ asset('/uploads/logo/'.$logo->logo) }}" type="image/png" />@endif
    <!--plugins-->
    <link href="{{ asset('/backend/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('/backend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('/backend/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <!-- loader-->
    <link href="{{ asset('/backend/assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('/backend/assets/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('/backend/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/backend/assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('/backend/assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/backend/assets/css/icons.css') }}" rel="stylesheet">
    <title>Teacher Registration</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-cover">
            <div class="">
                <div class="row g-0">
                    <div class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex">
                        <div class="card shadow-none bg-transparent shadow-none rounded-0 mb-0">
                            <div class="card-body">
                                <img src="{{ asset('/backend/assets/images/login-images/login-cover.svg') }}" class="img-fluid auth-img-cover-login" width="650" alt="" />
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
                        <div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
                            <div class="card-body p-sm-5">
                                <div class="">
                                    <div class="mb-3 text-center">
                                        <a href="/">
                                            <img src="@if($logo){{ asset('/uploads/logo/'.$logo->logo) }}@endif" width="120" alt="">
                                        </a>
                                    </div>
                                    <div class="text-center mb-4">
                                        <h5 class="">Sign-Up teacher</h5>
                                        <p class="mb-0">Please log in to your account</p>
                                    </div>
                                    <div class="form-body">
                                        <form class="row g-3" name="" id="" method="POST" action="{{ route('teacherregister') }}">
                                            @csrf

                                            <div class="col-12">
                                                <label for="fname" class="form-label">Full Name</label>
                                                <input type="text" value="{{old('fname')}}" class="form-control @error('fname') is-invalid @enderror" name="fname" id="fname" placeholder="Enter Full name">
                                            </div>
                                            <div class="col-12">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="example@gmail.com">
                                                @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <label for="password" class="form-label">Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" class="form-control border-end-0 @error('password') is-invalid @enderror" name="password" id="password" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class="bx bx-hide"></i></a>
                                                </div>
                                                @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                                <div class="input-group" id="show_hide_password_confirmation">
                                                    <input type="password" class="form-control border-end-0" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-6 text-end">	<a href="authentication-forgot-password.html">Forgot Password ?</a>
											</div> --}}
                                            <div class="col-12">
                                                <div class="d-grid gap-2">
                                                    <button type="submit" class="btn btn-primary">Sign-Up</button>
                                                    <a href="/" class="btn btn-outline-primary">Goto Main Website</a>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src="{{ asset('/backend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('/backend/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/backend/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('/backend/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('/backend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type','info') }}"
        switch (type) {
            case 'info':
                toastr.info(" {{ Session::get('message') }} ");
                break;
            case 'success':
                toastr.success(" {{ Session::get('message') }} ");
                break;
            case 'warning':
                toastr.warning(" {{ Session::get('message') }} ");
                break;
            case 'error':
                toastr.error(" {{ Session::get('message') }} ");
                break;
        }
        @endif

    </script>
    <!--Password show & hide js -->
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });

    </script>
    <!--app JS-->
    <script src="{{ asset('/backend/assets/js/app.js') }}"></script>
</body>

</html>
