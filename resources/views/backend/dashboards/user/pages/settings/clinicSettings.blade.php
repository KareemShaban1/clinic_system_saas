@extends('backend.dashboards.user.layouts.master')
@section('css')

@section('title')
    {{ trans('backend/settings_trans.Settings') }}
@stop

@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('backend/settings_trans.Settings') }}</h4>
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

                <x-backend.alert />



                <form method="post" enctype="multipart/form-data"
                    action="{{ Route('backend.settings.clinicSettings.update') }}" autocomplete="off">
                    @csrf
                    {{-- @method('PUT') --}}
                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-5">
                            <h5 class="setting-title">{{ trans('backend/settings_trans.Doctor_Name') }}<span
                                    class="text-danger">*</span></h5>
                        </div>
                        <div class="col-lg-6 col-md-8 col-sm-6 col-7"><input type="text" name="doctor_name"
                                value="{{ $settings['doctor_name'] }}" class="form-control"></div>
                    </div>



                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-5">
                            <h5> {{ trans('backend/settings_trans.Doctor_Address') }} <span class="text-danger">*</span>
                            </h5>
                        </div>
                        <div class="col-lg-6 col-md-8 col-sm-6 col-7">
                            <input class="form-control" name="doctor_address" value="{{ $settings['doctor_address'] }}"
                                type="text">
                        </div>


                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-5">
                            <h5> {{ trans('backend/settings_trans.Clinic_Name') }} <span class="text-danger">*</span>
                            </h5>
                        </div>
                        <div class="col-lg-6 col-md-8 col-sm-6 col-7">

                            <input class="form-control" name="clinic_name"
                                value="{{ $settings['clinic_name'] }}"type="text">
                        </div>


                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-5">
                            <h5> {{ trans('backend/settings_trans.Clinic_Type') }} <span class="text-danger">*</span>
                            </h5>
                        </div>
                        <div class="col-lg-6 col-md-8 col-sm-6 col-7">
                            <select name="clinic_type" class="custom-select mr-sm-2"
                                value="{{ $settings['clinic_type'] }}">
                                <option value="" @selected($settings['clinic_type'] == '')> </option>
                                <option value="عيون" @selected($settings['clinic_type'] == 'عيون')> عيون</option>
                                <option value="أسنان" @selected($settings['clinic_type'] == 'أسنان')> أسنان</option>
                                <option value="جلدية" @selected($settings['clinic_type'] == 'جلدية')> جلدية</option>
                            </select>
                        </div>


                    </div>

                    <div class="row mb-4">

                        <div class="col-lg-3 col-md-4 col-sm-6 col-5">
                            <h5> {{ trans('backend/settings_trans.Clinic_Address') }} <span
                                    class="text-danger">*</span></h5>
                        </div>
                        <div class="col-lg-6 col-md-8 col-sm-6 col-7">
                            <input class="form-control" name="clinic_address" value="{{ $settings['clinic_address'] }}"
                                type="text">
                        </div>

                    </div>

                    <div class="row mb-4">

                        <div class="col-lg-3 col-md-4 col-sm-6 col-5">
                            <h5> {{ trans('backend/settings_trans.Specifications') }} <span
                                    class="text-danger">*</span></h5>
                        </div>
                        <div class="col-lg-6 col-md-8 col-sm-6 col-7">
                            <input class="form-control" name="specifications" value="{{ $settings['specifications'] }}"
                                type="text">
                        </div>

                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-5">
                            <h5> {{ trans('backend/settings_trans.Qualifications') }} <span
                                    class="text-danger">*</span></h5>
                        </div>
                        <div class="col-lg-6 col-md-8 col-sm-6 col-7">
                            <textarea name="Qualifications" class="form-control" id="textAreaExample6" rows="3">
                                {{ $settings['qualifications'] }}
                            </textarea>
                        </div>


                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-5">
                            <h5> {{ trans('backend/settings_trans.Phone') }} <span class="text-danger">*</span></h5>
                        </div>
                        <div class="col-lg-6 col-md-8 col-sm-6 col-7">
                            <input class="form-control" name="phone" value="{{ $settings['phone'] }}" type="text">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-5">
                            <h5> {{ trans('backend/settings_trans.Email') }} <span class="text-danger">*</span></h5>
                        </div>
                        <div class="col-lg-6 col-md-8 col-sm-6 col-7">
                            <input class="form-control" name="email" value="{{ $settings['email'] }}" type="text">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-5">
                            <h5> {{ trans('backend/settings_trans.Website') }} <span class="text-danger">*</span></h5>
                        </div>
                        <div class="col-lg-6 col-md-8 col-sm-6 col-7">
                            <input class="form-control" name="website" value="{{ $settings['website'] }}"
                                type="text">
                        </div>
                    </div>


                    <button type="submit"
                        class="btn btn-success btn-md nextBtn btn-lg ">{{ trans('backend/settings_trans.Save') }}</button>


                </form>


            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
