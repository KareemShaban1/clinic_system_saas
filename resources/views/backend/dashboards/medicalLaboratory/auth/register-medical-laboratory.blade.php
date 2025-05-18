<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('login/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('login/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('login/fonts/iconic/css/material-design-iconic-font.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('login/vendor/animate/animate.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('login/vendor/css-hamburgers/hamburgers.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('login/vendor/animsition/css/animsition.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('login/vendor/select2/select2.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('login/vendor/daterangepicker/daterangepicker.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('login/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('login/css/main.css')}}">
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-register100">
                <form class="login100-form validate-form" method="POST" action="{{ Route('register-medical-laboratory') }}">
                    @csrf
                    <span class="login100-form-title p-b-26">

                        {{ __('Register Medical Laboratory') }}
                    </span>


                    <div id="stepper">
                        <!-- Step 1: Medical Laboratory Details -->
                        <div class="step step-1">
                            <h4>{{ __('Step 1: Medical Laboratory Information') }}</h4>
                            <div class="form-group">
                                <label class="form-label">{{ __('Medical Laboratory Name')}} </label>
                                <input type="text" name="medical_laboratory_name" class="form-control" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6">

                                </div>
                                <div class="col-md-6">

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Start Date') }}</label>
                                        <input type="date" name="start_date" class="form-control" required>
                                    </div>

                                </div>
                                <!-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Speciality') }}</label>
                                        <select name="speciality_id" class="form-control">
                                            <option value="">{{ __('Choose From List') }}</option>
                                            @foreach (App\Models\Speciality::all() as $speciality)
                                            <option value="{{ $speciality->id }}">{{ $speciality->name_en }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> -->
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Governorate') }}</label>
                                        <select name="governorate_id" class="form-control">
                                            <option value="">{{ __('Choose From List') }}</option>
                                            @foreach (App\Models\Governorate::all() as $governorate)
                                            <option value="{{ $governorate->id }}">{{ $governorate->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('City') }}</label>
                                        <select name="city_id" class="form-control">
                                            <option value="">{{ __('Choose From List') }}</option>

                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Area') }}</label>
                                        <select name="area_id" class="form-control">
                                            <option value="">{{ __('Choose From List') }}</option>

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">{{ __('Address') }}</label>
                                <input type="text" name="address" class="form-control" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Phone') }}</label>
                                        <input type="text" name="phone" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Email') }}</label>
                                        <input type="email" name="medical_laboratory_email" class="form-control" required>
                                    </div>
                                </div>
                            </div>




                            <button type="button" class="btn btn-primary next-step">{{ __('Next') }}</button>
                        </div>

                        <!-- Step 2: User Details -->
                        <div class="step step-2 d-none">
                            <h4>{{ __('Step 2: User Information') }}</h4>
                            <div class="form-group">
                                <label class="form-label">{{ __('User Name') }}</label>
                                <input type="text" name="user_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{ __('User Email') }}</label>
                                <input type="email" name="user_email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{ __('Password') }}</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{ __('Confirm Password') }}</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                            <button type="button" class="btn btn-secondary prev-step">{{ __('Back') }}</button>
                            <button type="submit" class="btn btn-success">{{ __('Register') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="{{asset('login/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
    <!--===============================================================================================-->
    <!-- <script src="{{asset('login/vendor/animsition/js/animsition.min.js')}}"></script> -->
    <!--===============================================================================================-->
    <!-- <script src="{{asset('login/vendor/bootstrap/js/popper.js')}}"></script> -->
    <script src="vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{asset('login/vendor/select2/select2.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{asset('login/vendor/daterangepicker/moment.min.js')}}"></script>
    <script src="{{asset('login/vendor/daterangepicker/daterangepicker.js')}}"></script>
    <!--===============================================================================================-->
    <!-- <script src="{{asset('login/vendor/countdowntime/countdowntime.js')}}"></script> -->
    <!--===============================================================================================-->
    <script src="{{asset('login/js/main.js')}}"></script>

    <script>
        $(document).ready(function() {
            $(".next-step").click(function() {
                $(".step-1").addClass("d-none");
                $(".step-2").removeClass("d-none");
            });

            $(".prev-step").click(function() {
                $(".step-2").addClass("d-none");
                $(".step-1").removeClass("d-none");
            });

            // Fetch cities based on selected governorate
            $('select[name="governorate_id"]').change(function() {
                let governorateId = $(this).val();
                if (governorateId) {
                    $.ajax({
                        url: "{{ route('cities.by-governorate') }}",
                        type: 'GET',
                        data: {
                            governorate_id: governorateId
                        },
                        success: function(data) {
                            let citySelect = $('select[name="city_id"]');
                            citySelect.empty().append('<option value="">{{ __("Choose From List") }}</option>');
                            $.each(data.data, function(key, value) {
                                citySelect.append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        }
                    });
                }
            });

            // Fetch areas based on selected city
            $('select[name="city_id"]').change(function() {
                let cityId = $(this).val();
                if (cityId) {
                    $.ajax({
                        url: "{{ route('areas.by-city') }}",
                        type: 'GET',
                        data: {
                            city_id: cityId
                        },
                        success: function(data) {
                            let areaSelect = $('select[name="area_id"]');
                            areaSelect.empty().append('<option value="">{{ __("Choose From List") }}</option>');
                            $.each(data.data, function(key, value) {
                                areaSelect.append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        }
                    });
                }
            });
        });
    </script>


</body>

</html>