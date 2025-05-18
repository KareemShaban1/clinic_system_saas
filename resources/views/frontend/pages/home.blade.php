@extends('frontend.layouts.mester')

@section('content')

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


@endsection
