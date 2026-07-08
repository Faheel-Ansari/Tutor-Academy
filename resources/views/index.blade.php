<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Welcome to Your Website</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        /* General Reset and Body Styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(135deg, #ff6f91, #f3a183); /* Soft vibrant gradient */
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            animation: bgAnimation 10s ease-in-out infinite;
        }

        /* Keyframes for background animation */
        @keyframes bgAnimation {
            0% {
                background:  -webkit-linear-gradient(135deg, hsl(346, 100%, 75%), #ffa382);
            }
            50% {
                background:-webkit-linear-gradient(135deg, #ffe922, #fa63ff);
            }
            100% {
                background:-webkit-linear-gradient(135deg, #38ff9c, #ff5f5f);
            }
        }

        /* Container Styling */
        .container {
            text-align: center;
            padding: 50px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.9); /* Light background with opacity */
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            max-width: 750px;
            width: 100%;
            animation: slideIn 1s ease-out;
        }

        /* Heading Styling */
        h1 {
            font-size: 3.5rem;
            margin-bottom: 30px;
            color: #333;
            font-weight: bold;
            letter-spacing: 1px;
            text-shadow: 0 5px 20px rgba(0, 0, 0, 0.25);
            animation: fadeIn 2s ease-out;
        }

        /* Updated Colors for New Subheadings */
        h2 {
            font-size: 2.5rem;
            color: #f1f1f1;
            margin-top: 30px;
            text-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
        }

        h3, h4, h5, h6 {
            font-size: 1.5rem;
            font-weight: 500;
            color: #009688;  /* Dark Teal for better contrast */
            margin-bottom: 20px;
        }

        /* Buttons Styling */
        .top-links a {
            padding: 18px 50px;
            margin: 15px;
            font-weight: 600;
            color: #fff;
            background-color: #6200ea;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.3s ease-in-out;
            display: inline-block;
            font-size: 1.3rem;
            letter-spacing: 1px;
        }

        .top-links a:hover {
            background-color: #3700b3;
            transform: translateY(-5px);
            box-shadow: 0 6px 30px rgba(0, 0, 0, 0.3);
        }

        .top-links a:active {
            transform: translateY(0);
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            h1 {
                font-size: 2.5rem;
            }

            h2 {
                font-size: 1.8rem;
            }

            h3, h4, h5, h6 {
                font-size: 1.3rem;
            }

            .top-links a {
                font-size: 1rem;
                padding: 12px 30px;
            }
        }

        /* Fade-in Animation */
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Slide-in Animation */
        @keyframes slideIn {
            0% {
                opacity: 0;
                transform: translateY(-50px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Tutor Academy</h1>
        {{--  <h2>We're glad you're here. Let's get started!</h2>  --}}

        @if (Route::has(name: 'login'))
            <div class="top-links">
                @auth
                @if(Auth::user()->role === 'admin')
                <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                @elseif(Auth::user()->role === 'teacher')
                <a href="{{ url('teacher/dashboard') }}">Dashboard</a>
                @else
                <a href="{{ url('student/dashboard') }}">Dashboard  </a>
                @endif
                @else
                    <a href="{{ route('login') }}">Log in</a>
                    <a href="{{ route('register') }}">Sign up</a>
                    <a href="{{ route('teacherregister') }}">Sign up as Teacher</a>
                @endauth
            </div>
        @endif
    </div>

    <!-- Optional JavaScript; can add here if needed -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
