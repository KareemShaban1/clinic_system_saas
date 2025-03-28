<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    @include('backend.dashboards.clinic.layouts.head')
</head>

<body>

    <div class="wrapper">

        <!--=================================
 preloader -->

        <div id="pre-loader">
            <img src="{{ URL::asset('backend/assets/images/pre-loader/loader-02.svg') }}" alt="">
        </div>

        <!--=================================
 preloader -->

        @include('backend.dashboards.clinic.layouts.main-header')

        @include('backend.dashboards.clinic.layouts.main-sidebar')

        <!--================================= Main content -->
        <!-- main-content -->

        <div class="content-wrapper">

            <div class="row">
                <div class="col-md-12">
                    <div class="page-title-box">
                        @yield('page-header')
                    </div>
                </div>
            </div>


            @yield('content')



            {{-- @include('backend.layouts.footer') --}}

        </div>
    </div>
    </div>
    </div>

    <!--================================= footer -->

    @include('backend.dashboards.clinic.layouts.footer-scripts')

</body>

</html>