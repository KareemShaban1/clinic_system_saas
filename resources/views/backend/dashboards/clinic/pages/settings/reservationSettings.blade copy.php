@extends('backend.dashboards.clinic.layouts.master')
@section('css')

@section('title')
    {{ trans('backend/reservation_settings_trans.Reservation_Settings') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('backend/reservation_settings_trans.Reservation_Settings') }}</h4>
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
                    action="{{ Route('clinic.settings.reservationSettings.update') }}" autocomplete="off">

                    @csrf

                    <div class="row mb-4 ">


                        <div class="col-lg-3 col-md-4 col-sm-6 col-7">
                            <h5 class="setting-title"> {{ trans('backend/reservation_settings_trans.Show_Ray') }} <span
                                    class="text-danger">*</span>
                            </h5>
                        </div>
                        <div class="col-lg-3 col-md-8 col-sm-6 col-5  mb-2">
                            <select class="custom-select mr-sm-2" name="show_ray">
                                <option selected disabled>{{ trans('backend/reservation_settings_trans.Choose') }}
                                </option>
                                <option @if (isset($settings['show_ray']) && $settings['show_ray'] == 1) selected @endif value="1">
                                    {{ trans('backend/reservation_settings_trans.Show') }}</option>
                                <option @if (isset($settings['show_ray']) && $settings['show_ray'] == 0) selected @endif value="0">
                                    {{ trans('backend/reservation_settings_trans.Hide') }}</option>
                            </select>
                        </div>




                        <div class="col-lg-3 col-md-4 col-sm-6 col-7">
                            <h5 class="setting-title">
                                {{ trans('backend/reservation_settings_trans.Show_Chronic_Diseases') }} <span
                                    class="text-danger">*</span></h5>
                        </div>
                        <div class="col-lg-3 col-md-8 col-sm-6 col-5 mb-2">
                            <select class="custom-select mr-sm-2" name="show_chronic_diseases">
                                <option selected disabled>{{ trans('backend/reservation_settings_trans.Choose') }}
                                </option>
                                <option @if (isset($settings['show_chronic_diseases']) && $settings['show_chronic_diseases'] == 1) selected @endif value="1">
                                    {{ trans('backend/reservation_settings_trans.Show') }}</option>
                                <option @if (isset($settings['show_chronic_diseases']) && $settings['show_chronic_diseases'] == 0) selected @endif value="0">
                                    {{ trans('backend/reservation_settings_trans.Hide') }}</option>
                            </select>
                        </div>

                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-7">
                            <h5 class="setting-title">
                                {{ trans('backend/reservation_settings_trans.Show_Glasses_Distance') }} <span
                                    class="text-danger">*</span></h5>
                        </div>
                        <div class="col-lg-3 col-md-8 col-sm-6 col-5 mb-2">
                            <select class="custom-select mr-sm-2" name="show_glasses_distance">
                                <option selected disabled>{{ trans('backend/reservation_settings_trans.Choose') }}
                                </option>
                                <option @if (isset($settings['show_glasses_distance']) && $settings['show_glasses_distance'] == 1) selected @endif value="1">
                                    {{ trans('backend/reservation_settings_trans.Show') }}</option>
                                <option @if (isset($settings['show_glasses_distance']) && $settings['show_glasses_distance'] == 0) selected @endif value="0">
                                    {{ trans('backend/reservation_settings_trans.Hide') }}</option>
                            </select>
                        </div>



                        <div class="col-lg-3 col-md-4 col-sm-6 col-7">
                            <h5 class="setting-title">
                                {{ trans('backend/reservation_settings_trans.Show_Prescription') }} <span
                                    class="text-danger">*</span></h5>
                        </div>
                        <div class="col-lg-3 col-md-8 col-sm-6 col-5 mb-2">
                            <select class="custom-select mr-sm-2" name="show_prescription">
                                <option selected disabled>{{ trans('backend/reservation_settings_trans.Choose') }}
                                </option>
                                <option @if (isset($settings['show_prescription']) && $settings['show_prescription'] == 1) selected @endif value="1">
                                    {{ trans('backend/reservation_settings_trans.Show') }}</option>
                                <option @if (isset($settings['show_prescription']) && $settings['show_prescription'] == 0) selected @endif value="0">
                                    {{ trans('backend/reservation_settings_trans.Hide') }}</option>
                            </select>
                        </div>

                    </div>


                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-7">
                            <h5 class="setting-title">
                                {{ trans('backend/reservation_settings_trans.Show_Reservation_Slots') }} <span
                                    class="text-danger">*</span></h5>
                        </div>
                        <div class="col-lg-3 col-md-8 col-sm-6 col-5 mb-2">
                            <select class="custom-select mr-sm-2" name="reservation_slots">
                                <option selected disabled>{{ trans('backend/reservation_settings_trans.Choose') }}
                                </option>
                                <option @if (isset($settings['reservation_slots']) && $settings['reservation_slots'] == 1) selected @endif value="1">
                                    {{ trans('backend/reservation_settings_trans.Show') }}</option>
                                <option @if (isset($settings['reservation_slots']) && $settings['reservation_slots'] == 0) selected @endif value="0">
                                    {{ trans('backend/reservation_settings_trans.Hide') }}</option>
                            </select>
                        </div>
                    </div>


                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-7">
                            <h5 class="setting-title"> {{ trans('backend/reservation_settings_trans.Show_Events') }}
                                <span class="text-danger">*</span>
                            </h5>
                        </div>
                        <div class="col-lg-3 col-md-8 col-sm-6 col-5 mb-2">
                            <select class="custom-select mr-sm-2" name="show_events">
                                <option selected disabled>{{ trans('backend/reservation_settings_trans.Choose') }}
                                </option>
                                <option @if (isset($settings['show_events']) && $settings['show_events'] == 1) selected @endif value="1">
                                    {{ trans('backend/reservation_settings_trans.Show') }}</option>
                                <option @if (isset($settings['show_events']) && $settings['show_events'] == 0) selected @endif value="0">
                                    {{ trans('backend/reservation_settings_trans.Hide') }}</option>
                            </select>
                        </div>



                        <div class="col-lg-3 col-md-4 col-sm-6 col-7">
                            <h5 class="setting-title"> {{ trans('backend/reservation_settings_trans.Show_Patients') }}
                                <span class="text-danger">*</span>
                            </h5>
                        </div>
                        <div class="col-lg-3 col-md-8 col-sm-6 col-5 mb-2">
                            <select class="custom-select mr-sm-2" name="show_patients">
                                <option selected disabled>{{ trans('backend/reservation_settings_trans.Choose') }}
                                </option>
                                <option @if (isset($settings['show_patients']) && $settings['show_patients'] == 1) selected @endif value="1">
                                    {{ trans('backend/reservation_settings_trans.Show') }}</option>
                                <option @if (isset($settings['show_patients']) && $settings['show_patients'] == 0) selected @endif value="0">
                                    {{ trans('backend/reservation_settings_trans.Hide') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-7">
                            <h5 class="setting-title">
                                {{ trans('backend/reservation_settings_trans.Show_Reservations') }} <span
                                    class="text-danger">*</span></h5>
                        </div>
                        <div class="col-lg-3 col-md-8 col-sm-6 col-5 mb-2">
                            <select class="custom-select mr-sm-2" name="show_reservations">
                                <option selected disabled>{{ trans('backend/reservation_settings_trans.Choose') }}
                                </option>
                                <option @if (isset($settings['show_reservations']) && $settings['show_reservations'] == 1) selected @endif value="1">
                                    {{ trans('backend/reservation_settings_trans.Show') }}</option>
                                <option @if (isset($settings['show_reservations']) && $settings['show_reservations'] == 0) selected @endif value="0">
                                    {{ trans('backend/reservation_settings_trans.Hide') }}</option>
                            </select>
                        </div>



                        <div class="col-lg-3 col-md-4 col-sm-6 col-7">
                            <h5 class="setting-title">
                                {{ trans('backend/reservation_settings_trans.Show_Online_Reservations') }} <span
                                    class="text-danger">*</span></h5>
                        </div>
                        <div class="col-lg-3 col-md-8 col-sm-6 col-5 mb-2">
                            <select class="custom-select mr-sm-2" name="show_online_reservations">
                                <option selected disabled>{{ trans('backend/reservation_settings_trans.Choose') }}
                                </option>
                                <option @if (isset($settings['show_online_reservations']) && $settings['show_online_reservations'] == 1) selected @endif value="1">
                                    {{ trans('backend/reservation_settings_trans.Show') }}</option>
                                <option @if (isset($settings['show_online_reservations']) && $settings['show_online_reservations'] == 0) selected @endif value="0">
                                    {{ trans('backend/reservation_settings_trans.Hide') }}</option>
                            </select>
                        </div>
                    </div>


                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-7">
                            <h5 class="setting-title">
                                {{ trans('backend/reservation_settings_trans.Show_Medicines') }}
                                <span class="text-danger">*</span>
                            </h5>
                        </div>
                        <div class="col-lg-3 col-md-8 col-sm-6 col-5 mb-2">
                            <select class="custom-select mr-sm-2" name="show_medicines"
                                value="{{ $settings['show_prescription'] }}">
                                <option selected disabled>{{ trans('backend/reservation_settings_trans.Choose') }}
                                </option>
                                <option @if (isset($settings['show_medicines']) && $settings['show_medicines'] == 1) selected @endif value="1">
                                    {{ trans('backend/reservation_settings_trans.Show') }}</option>
                                <option @if (isset($settings['show_medicines']) && $settings['show_medicines'] == 0) selected @endif value="0">
                                    {{ trans('backend/reservation_settings_trans.Hide') }}</option>
                            </select>
                        </div>



                        <div class="col-lg-3 col-md-4 col-sm-6 col-7">
                            <h5 class="setting-title">
                                {{ trans('backend/reservation_settings_trans.Show_Number_of_Reservations') }} <span
                                    class="text-danger">*</span></h5>
                        </div>
                        <div class="col-lg-3 col-md-8 col-sm-6 col-5 mb-2">
                            <select class="custom-select mr-sm-2" name="show_num_of_res">
                                <option selected disabled>{{ trans('backend/reservation_settings_trans.Choose') }}
                                </option>
                                <option @if (isset($settings['show_num_of_res']) && $settings['show_num_of_res'] == 1) selected @endif value="1">
                                    {{ trans('backend/reservation_settings_trans.Show') }}</option>
                                <option @if (isset($settings['show_num_of_res']) && $settings['show_num_of_res'] == 0) selected @endif value="0">
                                    {{ trans('backend/reservation_settings_trans.Hide') }}</option>
                            </select>
                        </div>
                    </div>


                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-7">
                            <h5 class="setting-title"> {{ trans('backend/reservation_settings_trans.Show_Drugs') }}
                                <span class="text-danger">*</span>
                            </h5>
                        </div>
                        <div class="col-lg-3 col-md-8 col-sm-6 col-5 mb-2">
                            <select class="custom-select mr-sm-2" name="show_drugs">
                                <option selected disabled>{{ trans('backend/reservation_settings_trans.Choose') }}
                                </option>
                                <option @if (isset($settings['show_drugs']) && $settings['show_drugs'] == 1) selected @endif value="1">
                                    {{ trans('backend/reservation_settings_trans.Show') }}</option>
                                <option @if (isset($settings['show_drugs']) && $settings['show_drugs'] == 0) selected @endif value="0">
                                    {{ trans('backend/reservation_settings_trans.Hide') }}</option>
                            </select>
                        </div>



                        <div class="col-lg-3 col-md-4 col-sm-6 col-7">
                            <h5 class="setting-title"> {{ trans('backend/reservation_settings_trans.Show_Fees') }}
                                <span class="text-danger">*</span>
                            </h5>
                        </div>
                        <div class="col-lg-3 col-md-8 col-sm-6 col-5 mb-2">
                            <select class="custom-select mr-sm-2" name="show_fees">
                                <option selected disabled>{{ trans('backend/reservation_settings_trans.Choose') }}
                                </option>
                                <option @if (isset($settings['show_fees']) && $settings['show_fees'] == 1) selected @endif value="1">
                                    {{ trans('backend/reservation_settings_trans.Show') }}</option>
                                <option @if (isset($settings['show_fees']) && $settings['show_fees'] == 0) selected @endif value="0">
                                    {{ trans('backend/reservation_settings_trans.Hide') }}</option>
                            </select>
                        </div>
                    </div>


                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-7">
                            <h5 class="setting-title"> {{ trans('backend/reservation_settings_trans.Show_Users') }}
                                <span class="text-danger">*</span>
                            </h5>
                        </div>
                        <div class="col-lg-3 col-md-8 col-sm-6 col-5 mb-2">
                            <select class="custom-select mr-sm-2" name="show_users">
                                <option selected disabled>{{ trans('backend/reservation_settings_trans.Choose') }}
                                </option>
                                <option @if (isset($settings['show_users']) && $settings['show_users'] == 1) selected @endif value="1">
                                    {{ trans('backend/reservation_settings_trans.Show') }}</option>
                                <option @if (isset($settings['show_users']) && $settings['show_users'] == 0) selected @endif value="0">
                                    {{ trans('backend/reservation_settings_trans.Hide') }}</option>
                            </select>
                        </div>



                        <div class="col-lg-3 col-md-4 col-sm-6 col-7">
                            <h5 class="setting-title"> {{ trans('backend/reservation_settings_trans.Show_Settings') }}
                                <span class="text-danger">*</span>
                            </h5>
                        </div>
                        <div class="col-lg-3 col-md-8 col-sm-6 col-5 mb-2">
                            <select class="custom-select mr-sm-2" name="show_settings">
                                <option selected disabled>{{ trans('backend/reservation_settings_trans.Choose') }}
                                </option>
                                <option @if (isset($settings['show_settings']) && $settings['show_settings'] == 1) selected @endif value="1">
                                    {{ trans('backend/reservation_settings_trans.Show') }}</option>
                                <option @if (isset($settings['show_settings']) && $settings['show_settings'] == 0) selected @endif value="0">
                                    {{ trans('backend/reservation_settings_trans.Hide') }}</option>
                            </select>
                        </div>
                    </div>



                    <button type="submit"
                        class="btn btn-success btn-md nextBtn btn-lg ">{{ trans('backend/reservation_settings_trans.Save') }}</button>


                </form>


            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
