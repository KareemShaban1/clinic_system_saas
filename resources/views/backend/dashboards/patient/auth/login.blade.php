<!DOCTYPE html>
<html lang="en">

<head>
    <title>تسجيل دخول</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('frontend/auth/images/icons/favicon.ico') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/auth/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('frontend/auth/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/auth/vendor/animate/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/auth/vendor/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/auth/vendor/select2/select2.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/auth/css/util.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('frontend/auth/css/main.css')}}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/auth/css/rtl_main.css') }}">

    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                {{-- <div class="login100-pic js-tilt" data-tilt>
                    <img src="{{ asset('frontend/auth/images/img-01.png') }}" alt="IMG">
                </div> --}}

                <form method="POST" action="{{ Route('login') }}">
                    @csrf
                    <span class="login100-form-title">
                        {{ trans('frontend/auth_trans.Log In') }}
                    </span>

                    <div class="row">
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label> البريد الألكترونى </label>
                                <input class="form-control" name="email" type="email">
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label> كلمة المرور </label>
                                <input class="form-control" name="password" type="password">
                                @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>



                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                            تسجيل دخول
                        </button>
                    </div>



                    <div class="text-center p-t-100">
                        <a class="txt2" href="{{ Route('register') }}">
                            أنشاء حساب جديد
                            <i class="fa fa-long-arrow-left m-l-5" aria-hidden="true"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <!--===============================================================================================-->
    <script src="{{ asset('frontend/auth/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('frontend/auth/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('frontend/auth/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('frontend/auth/vendor/select2/select2.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('frontend/auth/vendor/tilt/tilt.jquery.min.js') }}"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        });
    </script>
    <!--===============================================================================================-->
    <script src="{{ asset('frontend/auth/js/main.js') }}"></script>
</body>

</html>
