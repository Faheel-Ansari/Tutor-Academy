<!DOCTYPE html>
<html lang="en">
<!-- Begin Head -->

<head>
    <!--=== Required meta tags ===-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--=== custom css ===-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/frontend/assets/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/frontend/assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/frontend/assets/css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('/frontend/assets/css/magnific-popup.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css') }}">
    <link rel="icon" type="image/ico" href="@if($logo){{ asset('/uploads/logo/'.$logo->logo) }}@endif" />
    <link rel="stylesheet" href="{{ asset('/frontend/assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('/frontend/assets/css/all-instructor-style.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <!--=== custom css ===-->
    <title>Education eLearning</title>
</head>
<body>
    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>
    @include('frontend.body.header')

    @yield('content')

    @include('frontend.body.footer')
    <a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="fa-solid fa-arrow-up"></i></a>
    <!--=== Optional JavaScript ===-->
    <script src="{{ asset('/frontend/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/frontend/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/frontend/assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('/frontend/assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('/frontend/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="{{ asset('/frontend/assets/js/SmoothScroll.min.js') }}"></script>
    <script src="{{ asset('/frontend/assets/js/all-instructor-custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!--=== Optional JavaScript ===-->
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
        window.addEventListener("pageshow", function(event) {
            if (event.persisted || performance.getEntriesByType("navigation")[0].type === "back_forward") {
                // Reload if coming from bfcache (Back button)
                window.location.reload();
            }
        });
    </script>
</body>
</html>
