@extends('backend.dashboards.patient.layouts.master')
@section('css')

    <style>
        /*======================
                404 page
            =======================*/


        .page_404 {
            padding: 40px 0;
            background: #fff;
            font-family: 'Arvo', serif;
        }

        .page_404 img {
            width: 100%;
        }

        .four_zero_four_bg {

            background-image: url(https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif);
            height: 400px;
            background-position: center;
            background-size: cover;
        }


        .four_zero_four_bg h1 {
            font-size: 80px;
        }

        .four_zero_four_bg h3 {
            font-size: 80px;
        }

        .link_404 {
            color: #fff !important;
            padding: 10px 20px;
            background: #39ac31;
            margin: 20px 0;
            display: inline-block;
        }

        .contant_box_404 {
            margin-top: -50px;
        }


        /* colors */

        html,
        body {
            height: 100%;
            margin: 0;
        }

        html {
            font-size: 62.5%;
        }

        body {
            font-family: "Lato", sans-serif;
            font-size: 1.5rem;
            color: #293b49;
        }

        a {
            text-decoration: none;
        }

        .center {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .error {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-content: center;
        }

        .number {
            font-weight: 900;
            font-size: 15rem;
            line-height: 1;
        }

        .illustration {
            position: relative;
            width: 12.2rem;
            margin: 0 2.1rem;
        }

        .circle {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 12.2rem;
            height: 11.4rem;
            border-radius: 50%;
            background-color: #293b49;
        }

        .clip {
            position: absolute;
            bottom: 0.3rem;
            left: 50%;
            transform: translateX(-50%);
            overflow: hidden;
            width: 12.5rem;
            height: 13rem;
            border-radius: 0 0 50% 50%;
        }

        .paper {
            position: absolute;
            bottom: -0.3rem;
            left: 50%;
            transform: translateX(-50%);
            width: 9.2rem;
            height: 12.4rem;
            border: 0.3rem solid #293b49;
            background-color: white;
            border-radius: 0.8rem;
        }

        .paper::before {
            content: "";
            position: absolute;
            top: -0.7rem;
            right: -0.7rem;
            width: 1.4rem;
            height: 1rem;
            background-color: white;
            border-bottom: 0.3rem solid #293b49;
            transform: rotate(45deg);
        }

        .face {
            position: relative;
            margin-top: 2.3rem;
        }

        .eyes {
            position: absolute;
            top: 0;
            left: 2.4rem;
            width: 4.6rem;
            height: 0.8rem;
        }

        .eye {
            position: absolute;
            bottom: 0;
            width: 0.8rem;
            height: 0.8rem;
            border-radius: 50%;
            background-color: #293b49;
            animation-name: eye;
            animation-duration: 4s;
            animation-iteration-count: infinite;
            animation-timing-function: ease-in-out;
        }

        .eye-left {
            left: 0;
        }

        .eye-right {
            right: 0;
        }

        @keyframes eye {
            0% {
                height: 0.8rem;
            }

            50% {
                height: 0.8rem;
            }

            52% {
                height: 0.1rem;
            }

            54% {
                height: 0.8rem;
            }

            100% {
                height: 0.8rem;
            }
        }

        .rosyCheeks {
            position: absolute;
            top: 1.6rem;
            width: 1rem;
            height: 0.2rem;
            border-radius: 50%;
            background-color: #fdabaf;
        }

        .rosyCheeks-left {
            left: 1.4rem;
        }

        .rosyCheeks-right {
            right: 1.4rem;
        }

        .mouth {
            position: absolute;
            top: 3.1rem;
            left: 50%;
            width: 1.6rem;
            height: 0.2rem;
            border-radius: 0.1rem;
            transform: translateX(-50%);
            background-color: #293b49;
        }

        .text {
            margin-top: 5rem;
            font-weight: 300;
            color: #293b49;
        }

        .button {
            margin-top: 4rem;
            padding: 1.2rem 3rem;
            color: white;
            background-color: #04cba0;
        }

        .button:hover {
            background-color: #01ac88;
        }

        .by {
            position: absolute;
            bottom: 0.5rem;
            left: 0.5rem;
            text-transform: uppercase;
            color: #293b49;
        }

        .byLink {
            color: #04cba0;
        }
    </style>

@section('title')
    {{ trans('frontend/chronic_diseases_trans.Chronic_Disease') }}
@stop
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('frontend/chronic_diseases_trans.Chronic_Disease') }}</h4>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">


                <div class="my-post-content pt-4">


                    @forelse ($chronic_diseases as $chronic_disease)
                        <h5 class="card-header">
                            <span class="badge badge-rounded badge-info ">
                                <h5 class="text-white">
                                    {{ trans('frontend/chronic_diseases_trans.Chronic_Disease_Number') }}
                                    {{ $loop->index + 1 }} </h5>
                            </span>



                        </h5>



                        <div class="card-body">

                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                    <h5 class="f-w-500">{{ trans('frontend/chronic_diseases_trans.Id') }} <span
                                            class="{{ trans('frontend/chronic_diseases_trans.pull') }}">:</span></h5>
                                </div>
                                <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                    <span>{{ $chronic_disease->reservation_id }}</span>
                                </div>
                            </div>


                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                    <h5 class="f-w-500">
                                        {{ trans('frontend/chronic_diseases_trans.Chronic_Disease_Name') }}<span
                                            class="{{ trans('frontend/chronic_diseases_trans.pull') }}">:</span></h5>
                                </div>
                                <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                    <span>{{ $chronic_disease->title }}</span>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                    <h5 class="f-w-500">
                                        {{ trans('frontend/chronic_diseases_trans.Chronic_Disease_Measure') }} <span
                                            class="{{ trans('frontend/chronic_diseases_trans.pull') }}">:</span></h5>
                                </div>
                                <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                    <span>{{ $chronic_disease->measure }}</span>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                    <h5 class="f-w-500">
                                        {{ trans('frontend/chronic_diseases_trans.Chronic_Disease_Date') }} <span
                                            class="{{ trans('frontend/chronic_diseases_trans.pull') }}">:</span></h5>
                                </div>
                                <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{ $chronic_disease->date }}</span>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                    <h5 class="f-w-500"> {{ trans('frontend/chronic_diseases_trans.Notes') }} <span
                                            class="{{ trans('frontend/chronic_diseases_trans.pull') }}">:</span></h5>
                                </div>
                                <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                    <span>{{ $chronic_disease->notes }}</span>
                                </div>
                            </div>





                        </div>

                    @empty
                        <section class="page_404">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-12 col-12">
                                        <div class="col-sm-10 col-sm-offset-1  text-center">
                                            <div class="four_zero_four_bg">
                                                <h1 class="text-center ">404</h1>

                                            </div>

                                            <div class="contant_box_404">
                                                <h3 class="h2">
                                                    لا توجد أمراض مزمنة
                                                </h3>

                                                {{-- <p>the page you are looking for not avaible!</p> --}}

                                                {{-- <a href="" class="link_404">Go to Home</a> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                    @endforelse
                </div>


            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
