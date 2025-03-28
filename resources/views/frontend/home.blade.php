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
            <a href="{{ route('register-clinic') }}">{{ trans('frontend/home.Register') }}</a>
            <a href="{{ URL::to('/patient/login') }}">{{ trans('frontend/home.Patient Login') }}</a>
            <a href="{{ URL::to('/clinic/login') }}">{{ trans('frontend/home.Clinic Login') }}</a>
            <!-- <a href="{{ URL::to('/admin/login') }}">{{ trans('frontend/home.Admin Login') }}</a> -->


        </nav>
        <div id="menu-btn" class="fas fa-bars"></div>
    </div>
    <!-- Header Section End -->

    <!-- Home Section starts -->
    <section class="home" id="home">
        <div class="image">
            <img src="{{ asset('frontend/home/image/home-img.svg') }}" alt="home-img.svg">
        </div>
        <div class="content">
            <h3>{{ trans('frontend/home.stay safe, stay healthy') }}</h3>
            {{-- <p>Lorem Ipsum Dolor Sit Amet Consectetur Adipisicing Elit. Rem Sed Autem Vero? Magnam, Est Laboriosam!</p> --}}
            <a href="#" class="btn">{{ trans('frontend/home.contact us') }} <span
                    class="fas fa-chevron-left"></span> </a>
        </div>
    </section>
    <!-- Home Section End -->

    <!-- icons section starts  -->
    <section class="icons-container">

        <div class="icons">
            <i class="fas fa-user-md"></i>
            <h3>1</h3>
            <p>{{ trans('frontend/home.Numbers_Of_Doctors') }}</p>
        </div>

        <div class="icons">
            <i class="fas fa-users"></i>
            <h3>{{ $patients }}</h3>
            <p>{{ trans('frontend/home.Numbers_Of_Patients') }}</p>
        </div>

        <div class="icons">
            <i class="fas fa-notes-medical"></i>
            <h3>{{ $reservations }}</h3>
            <p>{{ trans('frontend/home.Numbers_Of_Reservations') }}</p>
        </div>

    </section>
    <!-- icons section End  -->

 


    <!-- About section Starts  -->
    <section class="about" id="about">
        <h1 class="heading">
            <span> {{ trans('frontend/home.About_Us') }} </span>
        </h1>
        <div class="row">
            <div class="image">
                <img src="{{ asset('frontend/home/image/about-img.svg') }}" alt="">
            </div>
            <div class="content">
                <h3 style="font-size: 35px;">{{ trans('frontend/home.we take care of your healthy life') }}</h3>
                <p>{{ trans('frontend/home.about_clinic') }}</p>
            </div>
        </div>
    </section>
    <!-- About section End  -->


  

    <section class="blogs" id="blogs">
        <h1 class="heading"> {{ trans('frontend/home.Our_Blogs') }} </h1>
        <div id="animation-container"
            style="margin:0; padding:0; width:100%; height:50vh; display:flex; justify-content:center; align-items:center; font-size:50pt; font-family: 'Slabo 27px', serif;">
            <span id="animated-text"
                style="font-size:50pt; text-transform:none; font-family: 'Slabo 27px', serif; opacity: 0; text-align:center">
                {{ trans('frontend/home.Coming_Soon') }}
            </span>
        </div>
    </section>


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
