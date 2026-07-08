<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--favicon-->
    @if($logo)
    <link rel="icon" href="{{ asset('/uploads/logo/'.$logo->logo) }}" />@endif
    <!--plugins-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css" integrity="sha512-kJlvECunwXftkPwyvHbclArO8wszgBGisiLeuDFwNM8ws+wKIw0sv1os3ClWZOcrEB2eRXULYUsm8OVRGJKwGA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('/backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet" />
    <link href="{{ asset('/backend/assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
    <link href="{{ asset('/backend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
    <link href="{{ asset('/backend/assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('/backend/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- loader-->
    <link href="{{ asset('/backend/assets/css/pace.min.css')}}" rel="stylesheet" />
    <script src="{{ asset('/backend/assets/js/pace.min.js')}}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('/backend/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('/backend/assets/css/bootstrap-extended.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('/backend/assets/css/app.css')}}" rel="stylesheet">
    <link href="{{ asset('/backend/assets/css/icons.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset('/backend/assets/css/dark-theme.css')}}" />
    <link rel="stylesheet" href="{{ asset('/backend/assets/css/semi-dark.css')}}" />
    <link rel="stylesheet" href="{{ asset('/backend/assets/css/header-colors.css')}}" />
    <title>Manal Tutors Academy</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        @include('backend.body.sidebar')
        <!--end sidebar wrapper -->
        <!--start header -->
        @include('backend.body.header')
        <!--end header -->
        <!--start page wrapper -->
        @yield('dashboards')
        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--footer start-->
        @include('backend.body.footer')
        <!--footer end-->


    </div>





    <!--start switcher-->

    <!--end switcher-->
    <!-- Bootstrap JS -->
    <script src="{{ asset('/backend/assets/js/bootstrap.bundle.min.js')}}"></script>
    <!--plugins-->
    <script src="{{ asset('/backend/assets/js/jquery.min.js')}}"></script>
    <script src="{{ asset('/backend/assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
    <script src="{{ asset('/backend/assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
    <script src="{{ asset('/backend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
    <script src="{{ asset('/backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
    <script src="{{ asset('/backend/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <script src="{{ asset('/backend/assets/plugins/chartjs/js/chart.js')}}"></script>
    <script src="{{ asset('/backend/assets/js/index.js')}}"></script>
    <script src="{{ asset('/backend/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/backend/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!--app JS-->
    <script src="{{ asset('/backend/assets/js/app.js')}}"></script>
    <script>
        new PerfectScrollbar(".app-container")
    </script>
    <script>
        $(document).ready(function() {
            $('#studentDetails').DataTable();
        });

    </script>
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
</body>

</html>
