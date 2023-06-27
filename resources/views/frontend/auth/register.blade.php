<!DOCTYPE html>
<html lang="en">

<head>
    <title>أنشاء حساب مريض</title>
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
            <div class="wrap-register100">
                {{-- <div class="login100-pic js-tilt" data-tilt>
					<img src="{{asset('frontend/auth/images/img-01.png')}}" alt="IMG">
				</div> --}}

                {{-- <form > --}}
                <form method="post" class="col-md-12" enctype="multipart/form-data" action="{{ Route('register') }}"
                    autocomplete="off">

                    @csrf
                    <span class="login100-form-title">
                        أنشاء حساب مريض
                    </span>



                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>أسم المريض<span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label> السن </label>
                                <input class="form-control" name="age" type="number">
                                @error('age')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>العنوان <span class="text-danger">*</span></label>
                                <input type="text" name="address" class="form-control">
                                @error('address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>



                        <div class="col-md-6">
                            <div class="form-group">
                                <label> رقم الهاتف <span class="text-danger">*</span></label>
                                <input class="form-control" name="phone" type="phone">
                                @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> البريد الألكترونى <span class="text-danger">*</span></label>
                                <input class="form-control" name="email" type="email">
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label> كلمة المرور <span class="text-danger">*</span></label>
                                <input class="form-control" name="password" type="password">
                                @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="gender"> نوع المريض<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-6">

                                    <select class="custom-select mr-sm-2" name="gender" style="width: 360px;">
                                        <option selected disabled>أختار من القائمة</option>
                                        <option value="male">ذكر</option>
                                        <option value="female">أنثى</option>
                                    </select>
                                    @error('gender')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="blood_group"> فصيلة الدم </label>
                                </div>

                                <div class="col-md-6">
                                    <select class="custom-select mr-sm-2" name="blood_group" style="width: 360px;">
                                        <option selected disabled>أختار من القائمة</option>
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                        <option value="AB+">AB+</option>
                                        <option value="AB-">AB-</option>
                                    </select>
                                    @error('blood_group')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>



                        </div>
                    </div>

                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                            أنشاء الحساب
                        </button>
                    </div>


                    <div class="text-center p-t-30">
                        <a class="txt2" href="{{ Route('login') }}">
                            بالفعل لدى حساب
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
        })
    </script>
    <!--===============================================================================================-->
    <script src="{{ asset('frontend/auth/js/main.js') }}"></script>

</body>

</html>
