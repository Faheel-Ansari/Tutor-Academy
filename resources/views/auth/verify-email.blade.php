{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
</div>

@if (session('status') == 'verification-link-sent')
<div class="mb-4 font-medium text-sm text-green-600">
    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
</div>
@endif

<div class="mt-4 flex items-center justify-between">
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf

        <div>
            <x-primary-button>
                {{ __('Resend Verification Email') }}
            </x-primary-button>
        </div>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            {{ __('Log Out') }}
        </button>
    </form>
</div>
</x-guest-layout> --}}

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
    <title>User Email Verification</title>
</head>

<body class="">
    <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-cover">
            <div class="">
                <div class="row g-0">

                    <div class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex">

                        <div class="card shadow-none text-center bg-transparent shadow-none rounded-0 mb-0">
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
                                        <p class="mb-0">Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.</p>
                                    </div>
                                    @if (session('status') == 'verification-link-sent')
                                    <div class="text-center mb-4 text-success">
                                        <p>A new verification link has been sent to the email address you provided during registration.</p>
                                    </div>
                                    @endif
                                    <div class="form-body d-flex flex-column gap-2">
                                        <form class="row g-3" name="" id="" method="POST" action="{{ route('verification.send') }}">
                                            @csrf
                                            <div class="col-12">
                                                <div class="d-grid gap-2">
                                                    <button type="submit" class="btn btn-primary">Resend Verification Email</button>
                                                </div>
                                            </div>
                                        </form>
                                        <form class="row g-3" name="" id="" method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <div class="col-12">
                                                <div class="d-grid gap-2">
                                                    <button type="submit" class="btn btn-outline-primary">Logout</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    {{-- <div class="login-separater text-center mb-5"> <span>OR SIGN IN WITH</span>
										<hr>
									</div> --}}
                                    {{-- <div class="list-inline contacts-social text-center">
										<a href="javascript:;" class="list-inline-item bg-facebook text-white border-0 rounded-3"><i class="bx bxl-facebook"></i></a>
										<a href="javascript:;" class="list-inline-item bg-twitter text-white border-0 rounded-3"><i class="bx bxl-twitter"></i></a>
										<a href="javascript:;" class="list-inline-item bg-google text-white border-0 rounded-3"><i class="bx bxl-google"></i></a>
										<a href="javascript:;" class="list-inline-item bg-linkedin text-white border-0 rounded-3"><i class="bx bxl-linkedin"></i></a>
									</div> --}}

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
