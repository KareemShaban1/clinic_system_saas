@extends('frontend.layouts.master')
@section('css')
    <style>
        * {
            box-sizing: border-box;
        }

        .img-magnifier-container {
            position: relative;
            border: #000 1px solid;
            border-radius: 10px;
            margin: 10px 20px;
            padding: 10px;
        }

        .img-magnifier-glass {
            position: absolute;
            border: 3px solid #000;
            border-radius: 50%;
            cursor: none;
            /*Set the size of the magnifier glass:*/
            width: 130px;
            height: 130px;
        }
    </style>

    <script>
        function magnify(imgID, zoom) {
            var img, glass, w, h, bw;
            img = document.getElementById(imgID);
            /*create magnifier glass:*/
            glass = document.createElement("DIV");
            glass.setAttribute("class", "img-magnifier-glass");
            /*insert magnifier glass:*/
            img.parentElement.insertBefore(glass, img);
            /*set background properties for the magnifier glass:*/
            glass.style.backgroundImage = "url('" + img.src + "')";
            glass.style.backgroundRepeat = "no-repeat";
            glass.style.backgroundSize = (img.width * zoom) + "px " + (img.height * zoom) + "px";
            bw = 2;
            w = glass.offsetWidth / 2;
            h = glass.offsetHeight / 2;
            /*execute a function when someone moves the magnifier glass over the image:*/
            glass.addEventListener("mousemove", moveMagnifier);
            img.addEventListener("mousemove", moveMagnifier);
            /*and also for touch screens:*/
            glass.addEventListener("touchmove", moveMagnifier);
            img.addEventListener("touchmove", moveMagnifier);

            function moveMagnifier(e) {
                var pos, x, y;
                /*prevent any other actions that may occur when moving over the image*/
                e.preventDefault();
                /*get the cursor's x and y positions:*/
                pos = getCursorPos(e);
                x = pos.x;
                y = pos.y;
                /*prevent the magnifier glass from being positioned outside the image:*/
                if (x > img.width - (w / zoom)) {
                    x = img.width - (w / zoom);
                }
                if (x < w / zoom) {
                    x = w / zoom;
                }
                if (y > img.height - (h / zoom)) {
                    y = img.height - (h / zoom);
                }
                if (y < h / zoom) {
                    y = h / zoom;
                }
                /*set the position of the magnifier glass:*/
                glass.style.left = (x - w) + "px";
                glass.style.top = (y - h) + "px";
                /*display what the magnifier glass "sees":*/
                glass.style.backgroundPosition = "-" + ((x * zoom) - w + bw) + "px -" + ((y * zoom) - h + bw) + "px";
            }

            function getCursorPos(e) {
                var a, x = 0,
                    y = 0;
                e = e || window.event;
                /*get the x and y positions of the image:*/
                a = img.getBoundingClientRect();
                /*calculate the cursor's x and y coordinates, relative to the image:*/
                x = e.pageX - a.left;
                y = e.pageY - a.top;
                /*consider any page scrolling:*/
                x = x - window.pageXOffset;
                y = y - window.pageYOffset;
                return {
                    x: x,
                    y: y
                };
            }
        }
        /* Initiate Magnify Function
        with the id of the image, and the strength of the magnifier glass:*/
    </script>

@section('title')
    {{ trans('rays_trans.Rays') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('rays_trans.Rays') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ Route('backend.reservations.index') }}"
                        class="default-color">{{ trans('reservations_trans.Reservations') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('rays_trans.Rays') }}</li>
            </ol>
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
                            <h5 class="text-white"> {{ trans('chronic_diseases_trans.Chronic_Disease_Number') }}
                                {{ $loop->index + 1 }} </h5>
                        </span>
                    </h5>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                <h5 class="f-w-500">{{ trans('chronic_diseases_trans.Id') }} <span
                                        class="{{ trans('chronic_diseases_trans.pull') }}">:</span></h5>
                            </div>
                            <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                <span>{{ $chronic_disease->reservation_id }}</span>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                <h5 class="f-w-500"> {{ trans('chronic_diseases_trans.Disease_Name') }}<span
                                        class="{{ trans('chronic_diseases_trans.pull') }}">:</span></h5>
                            </div>
                            <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                <span>{{ $chronic_disease->title }}</span>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                <h5 class="f-w-500"> {{ trans('chronic_diseases_trans.Disease_Measure') }} <span
                                        class="{{ trans('chronic_diseases_trans.pull') }}">:</span></h5>
                            </div>
                            <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                <span>{{ $chronic_disease->measure }}</span>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                <h5 class="f-w-500"> {{ trans('chronic_diseases_trans.Disease_Date') }} <span
                                        class="{{ trans('chronic_diseases_trans.pull') }}">:</span></h5>
                            </div>
                            <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{ $chronic_disease->date }}</span>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                <h5 class="f-w-500"> {{ trans('chronic_diseases_trans.Notes') }} <span
                                        class="{{ trans('chronic_diseases_trans.pull') }}">:</span></h5>
                            </div>
                            <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                <span>{{ $chronic_disease->notes }}</span>
                            </div>
                        </div>

                        <!-- Other rows omitted for brevity -->

                    </div>
                @empty
                        <div>لا توجد أشعة لهذا الحجز بعد </div>
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



{{-- @extends('frontend.layouts.master')

@section('css')
@endsection

@section('title')
    {{ trans('chronic_diseases_trans.Chronic_Disease') }}
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{ trans('chronic_diseases_trans.Chronic_Disease') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                    <li class="breadcrumb-item"><a href="#"
                            class="default-color">{{ trans('chronic_diseases_trans.Show_Chronic_Disease') }}</a></li>
                    <li class="breadcrumb-item active">{{ trans('chronic_diseases_trans.Chronic_Diseases') }}</li>
                </ol>
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
                                    <h5 class="text-white"> {{ trans('chronic_diseases_trans.Chronic_Disease_Number') }}
                                        {{ $loop->index + 1 }} </h5>
                                </span>
                            </h5>
                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                        <h5 class="f-w-500">{{ trans('chronic_diseases_trans.Id') }} <span
                                                class="{{ trans('chronic_diseases_trans.pull') }}">:</span></h5>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                        <span>{{ $chronic_disease->reservation_id }}</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                        <h5 class="f-w-500"> {{ trans('chronic_diseases_trans.Disease_Name') }}<span
                                                class="{{ trans('chronic_diseases_trans.pull') }}">:</span></h5>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                        <span>{{ $chronic_disease->title }}</span>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                        <h5 class="f-w-500"> {{ trans('chronic_diseases_trans.Disease_Measure') }} <span
                                                class="{{ trans('chronic_diseases_trans.pull') }}">:</span></h5>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                        <span>{{ $chronic_disease->measure }}</span>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                        <h5 class="f-w-500"> {{ trans('chronic_diseases_trans.Disease_Date') }} <span
                                                class="{{ trans('chronic_diseases_trans.pull') }}">:</span></h5>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{ $chronic_disease->date }}</span>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                        <h5 class="f-w-500"> {{ trans('chronic_diseases_trans.Notes') }} <span
                                                class="{{ trans('chronic_diseases_trans.pull') }}">:</span></h5>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                        <span>{{ $chronic_disease->notes }}</span>
                                    </div>
                                </div>

                                <!-- Other rows omitted for brevity -->

                            </div>
                        @empty
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="alert alert-info">
                                        {{ trans('chronic_diseases_trans.No_Data_Available') }}
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection

@section('js')
@endsection --}}
