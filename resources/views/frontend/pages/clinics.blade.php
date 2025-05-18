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

<section class="icons-container">
    @foreach ($clinics as $clinic)

    <div class="icons">
        <i class="fas fa-user-md"></i>
        <h3>1</h3>
        <p>{{ trans('frontend/home.Numbers_Of_Doctors') }}</p>
    </div>

    @endforeach


</section>




@endsection