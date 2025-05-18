<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kari care </title>
    <!-- Page Icon -->
    <link rel="shortcut icon" href="{{ asset('frontend/assets/img/heartbeat-solid.svg') }}" type="image/x-icon">
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <!-- Custom Css File Link -->
    @if (App::getLocale() == 'en' || App::getLocale() == 'it')
    <link rel="stylesheet" href="{{ asset('frontend/home/css/style.css') }}">
    @else
    <link rel="stylesheet" href="{{ asset('frontend/home/css/rtl_style.css') }}">
    @endif

    <style>
        @keyframes fade-in-out {
            0% {
                opacity: 0;
            }

            50% {
                opacity: 1;
            }

            100% {
                opacity: 0;
            }
        }

        #animated-text {
            animation: fade-in-out 3s infinite;
            animation-delay: 1s;
            transition: opacity 0.5s;
        }

        .navbar {
            display: flex;
            gap: 15px;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropbtn {
            background-color: transparent;
            border: none;
            cursor: pointer;
            font-size: 2em;
            padding: 0;
            color: inherit;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            top: 20px;
            left: -40px;
            background-color: white;
            min-width: 160px;
            z-index: 1;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .dropdown-content a {
            color: black;
            padding: 10px 15px;
            text-decoration: none;
            display: block;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
</head>

<body>
    <!-- Header Section Starts -->
    <div class="header">
        <a href="#" class="logo"><i class="fas fa-heartbeat"></i> Kari care </a>
        <nav class="navbar">
            <a href="#home">{{ trans('frontend/home.Home') }}</a>
            {{-- <a href="#services">{{ trans('frontend/home.Services') }}</a> --}}
            <a href="#about">{{ trans('frontend/home.About Us') }}</a>
            {{-- <a href="#doctors">{{ trans('frontend/home.Doctors') }}</a> --}}
            <a href="#blogs">{{ trans('frontend/home.Our_Blogs') }}</a>
            <div class="dropdown">
                <button class="dropbtn">{{ trans('frontend/home.Clinics') }} ▾</button>
                <div class="dropdown-content">
                    <a href="{{ route('clinics') }}">{{ trans('frontend/home.All Clinics') }}</a>
                    <a href="{{ route('register-clinic') }}">{{ trans('frontend/home.Register Clinic') }}</a>
                </div>
            </div>

            <!-- <div class="dropdown">
                <button class="dropbtn">{{ trans('frontend/home.Radiology Center') }} ▾</button>
                <div class="dropdown-content">
                <a>{{ trans('frontend/home.All Radiology Center') }}</a>
                <a>{{ trans('frontend/home.Register Radiology Center') }}</a>
                </div>
            </div> -->

            <div class="dropdown">
                <button class="dropbtn">{{ trans('frontend/home.Medical Laboratory') }} ▾</button>
                <div class="dropdown-content">
                    <a>{{ trans('frontend/home.All Medical Laboratory') }}</a>
                    <a href="{{ route('register-medical-laboratory') }}">{{ trans('frontend/home.Register Medical Laboratory') }}</a>
                </div>
            </div>


            <!-- <a href="{{ route('register-clinic') }}">{{ trans('frontend/home.Register Clinic') }}</a>
            <a href="{{ route('register-patient') }}">{{ trans('frontend/home.Register Patient') }}</a>
            <a href="{{ URL::to('/patient/login') }}">{{ trans('frontend/home.Patient Login') }}</a>
            <a href="{{ URL::to('/clinic/login') }}">{{ trans('frontend/home.Clinic Login') }}</a> -->

            <!-- <a href="{{ URL::to('/admin/login') }}">{{ trans('frontend/home.Admin Login') }}</a> -->


        </nav>
        <div id="menu-btn" class="fas fa-bars"></div>
    </div>
    <!-- Header Section End -->


    <div class="container">
        @yield('content')
    </div>

    <!-- Footer section Starts  -->
    <section class="footer">
        <div class="box-container">
            <div class="box">
                <h3>{{ trans('frontend/home.Quick_Links') }}</h3>
                <a href="#"> <i class="fas fa-chevron-left"></i> {{ trans('frontend/home.Home') }}</a>
                <a href="#"> <i class="fas fa-chevron-left"></i> {{ trans('frontend/home.About Us') }}</a>
                <a href="#"> <i class="fas fa-chevron-left"></i> {{ trans('frontend/home.Blogs') }}</a>
            </div>
            <div class="box">
                <h3>{{ trans('frontend/home.Our_Services') }}</h3>
                <a href="#"> <i class="fas fa-chevron-left"></i> {{ trans('frontend/home.Analysis') }}</a>
                <a href="#"> <i class="fas fa-chevron-left"></i> {{ trans('frontend/home.Rays') }}</a>
                {{-- <a href="#"> <i class="fas fa-chevron-left"></i> cardioloty</a>
                <a href="#"> <i class="fas fa-chevron-left"></i> diagnosis</a>
                <a href="#"> <i class="fas fa-chevron-left"></i> ambulance service</a> --}}
            </div>
            <div class="box">
                <h3>{{ trans('frontend/home.Contact_Info') }}</h3>
                <a href="#"> <i class="fas fa-phone"></i> 01111111111</a>
                <a href="#"> <i class="fas fa-envelope"></i> clinic.@gmail.com</a>
                <a href="#"> <i class="fas fa-map-marker-alt"></i> Egypt</a>
            </div>
            <div class="box">
                <h3>{{ trans('frontend/home.Follow_Us') }}</h3>

                <a href="#"> <i class="fab fa-facebook-f"></i> facebook</a>
                <a href="#"> <i class="fab fa-twitter"></i> twitter</a>
                <a href="#"> <i class="fab fa-linkedin"></i> linkedin</a>
                <a href="#"> <i class="fab fa-instagram"></i> instagram</a>
                {{-- <a href="#"> <i class="fab fa-youtube"></i> youtube</a> --}}
                {{-- <a href="#"> <i class="fab fa-pinterest"></i> pinterest</a> --}}
            </div>
        </div>
    </section>
    <!-- Footer section End  -->











    <!-- custom js file link  -->
    <script src="{{ asset('frontend/home/js/script.js') }}"></script>
</body>

</html>