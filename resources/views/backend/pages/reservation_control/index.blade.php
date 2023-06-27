@extends('backend.layouts.master')
@section('css')

@section('title')
    {{ trans('backend/reservation_control_trans.Settings') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('backend/reservation_control_trans.Settings') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#"
                        class="default-color">{{ trans('backend/reservation_control_trans.Edit_Settings') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('backend/reservation_control_trans.Settings') }}</li>

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

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="post" enctype="multipart/form-data"
                    action="{{ Route('backend.reservation_control.update') }}" autocomplete="off">

                    @csrf






                    <div class="row mb-4">

                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <h5> {{ trans('backend/reservation_control_trans.Show_Ray') }} <span class="text-danger">*</span>
                            </h5>
                        </div>
                        <div class="col-lg-3 col-md-8 col-sm-6 col-6">
                            <select class="custom-select mr-sm-2" name="show_ray" value="{{ $setting['show_ray'] }}">
                                <option selected disabled>{{ trans('backend/reservation_control_trans.Choose') }}</option>
                                <option @if ($setting['show_ray'] == 1) selected @endif value="1">
                                    {{ trans('backend/reservation_control_trans.Show') }}</option>
                                <option @if ($setting['show_ray'] == 0) selected @endif value="0">
                                    {{ trans('backend/reservation_control_trans.Hide') }}</option>
                            </select>
                        </div>
                        {{-- </div> --}}
                        {{-- <div class="row mb-4"> --}}

                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <h5> {{ trans('backend/reservation_control_trans.Show_Chronic_Diseases') }} <span
                                    class="text-danger">*</span></h5>
                        </div>
                        <div class="col-lg-3 col-md-8 col-sm-6 col-6">
                            <select class="custom-select mr-sm-2" name="show_chronic_diseases"
                                value="{{ $setting['show_chronic_diseases'] }}">
                                <option selected disabled>{{ trans('backend/reservation_control_trans.Choose') }}</option>
                                <option @if ($setting['show_chronic_diseases'] == 1) selected @endif value="1">
                                    {{ trans('backend/reservation_control_trans.Show') }}</option>
                                <option @if ($setting['show_chronic_diseases'] == 0) selected @endif value="0">
                                    {{ trans('backend/reservation_control_trans.Hide') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <h5> {{ trans('backend/reservation_control_trans.Show_Glasses_Distance') }} <span
                                    class="text-danger">*</span></h5>
                        </div>
                        <div class="col-lg-3 col-md-8 col-sm-6 col-6">
                            <select class="custom-select mr-sm-2" name="show_glasses_distance"
                                value="{{ $setting['show_glasses_distance'] }}">
                                <option selected disabled>{{ trans('backend/reservation_control_trans.Choose') }}</option>
                                <option @if ($setting['show_glasses_distance'] == 1) selected @endif value="1">
                                    {{ trans('backend/reservation_control_trans.Show') }}</option>
                                <option @if ($setting['show_glasses_distance'] == 0) selected @endif value="0">
                                    {{ trans('backend/reservation_control_trans.Hide') }}</option>
                            </select>
                        </div>

                        {{-- </div> --}}
                        {{-- <div class="row mb-4"> --}}

                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <h5> {{ trans('backend/reservation_control_trans.Show_Prescription') }} <span
                                    class="text-danger">*</span></h5>
                        </div>
                        <div class="col-lg-3 col-md-8 col-sm-6 col-6">
                            <select class="custom-select mr-sm-2" name="show_prescription"
                                value="{{ $setting['show_prescription'] }}">
                                <option selected disabled>{{ trans('backend/reservation_control_trans.Choose') }}</option>
                                <option @if ($setting['show_prescription'] == 1) selected @endif value="1">
                                    {{ trans('backend/reservation_control_trans.Show') }}</option>
                                <option @if ($setting['show_prescription'] == 0) selected @endif value="0">
                                    {{ trans('backend/reservation_control_trans.Hide') }}</option>
                            </select>
                        </div>
                       
                    </div>

                    
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>

                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <h5> {{ trans('backend/reservation_control_trans.Show_Reservation_Slots') }} <span
                                    class="text-danger">*</span></h5>
                        </div>
                        <div class="col-lg-3 col-md-8 col-sm-6 col-6">
                            <select class="custom-select mr-sm-2" name="reservation_slots"
                                value="{{ $setting['reservation_slots'] }}">
                                <option selected disabled>{{ trans('backend/reservation_control_trans.Choose') }}</option>
                                <option @if ($setting['reservation_slots'] == 1) selected @endif value="1">
                                    {{ trans('backend/reservation_control_trans.Show') }}</option>
                                <option @if ($setting['reservation_slots'] == 0) selected @endif value="0">
                                    {{ trans('backend/reservation_control_trans.Hide') }}</option>
                            </select>
                        </div>
                    </div>

                    <br>
                    <br>
                    <br>
                    <br>
                    <br>

                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <h5> {{ trans('backend/reservation_control_trans.Show_Events') }} <span
                                    class="text-danger">*</span></h5>
                        </div>
                        <div class="col-lg-3 col-md-8 col-sm-6 col-6">
                            <select class="custom-select mr-sm-2" name="show_events"
                                value="{{ $setting['show_prescription'] }}">
                                <option selected disabled>{{ trans('backend/reservation_control_trans.Choose') }}</option>
                                <option @if ($setting['show_events'] == 1) selected @endif value="1">
                                    {{ trans('backend/reservation_control_trans.Show') }}</option>
                                <option @if ($setting['show_events'] == 0) selected @endif value="0">
                                    {{ trans('backend/reservation_control_trans.Hide') }}</option>
                            </select>
                        </div>

                        {{-- </div> --}}
                        {{-- <div class="row mb-4"> --}}

                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <h5> {{ trans('backend/reservation_control_trans.Show_Patients') }} <span
                                    class="text-danger">*</span></h5>
                        </div>
                        <div class="col-lg-3 col-md-8 col-sm-6 col-6">
                            <select class="custom-select mr-sm-2" name="show_patients"
                                value="{{ $setting['show_prescription'] }}">
                                <option selected disabled>{{ trans('backend/reservation_control_trans.Choose') }}</option>
                                <option @if ($setting['show_patients'] == 1) selected @endif value="1">
                                    {{ trans('backend/reservation_control_trans.Show') }}</option>
                                <option @if ($setting['show_patients'] == 0) selected @endif value="0">
                                    {{ trans('backend/reservation_control_trans.Hide') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <h5> {{ trans('backend/reservation_control_trans.Show_Reservations') }} <span
                                    class="text-danger">*</span></h5>
                        </div>
                        <div class="col-lg-3 col-md-8 col-sm-6 col-6">
                            <select class="custom-select mr-sm-2" name="show_reservations"
                                value="{{ $setting['show_prescription'] }}">
                                <option selected disabled>{{ trans('backend/reservation_control_trans.Choose') }}</option>
                                <option @if ($setting['show_reservations'] == 1) selected @endif value="1">
                                    {{ trans('backend/reservation_control_trans.Show') }}</option>
                                <option @if ($setting['show_reservations'] == 0) selected @endif value="0">
                                    {{ trans('backend/reservation_control_trans.Hide') }}</option>
                            </select>
                        </div>

                        {{-- </div> --}}
                        {{-- <div class="row mb-4"> --}}

                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <h5> {{ trans('backend/reservation_control_trans.Show_Online_Reservations') }} <span
                                    class="text-danger">*</span></h5>
                        </div>
                        <div class="col-lg-3 col-md-8 col-sm-6 col-6">
                            <select class="custom-select mr-sm-2" name="show_online_reservations"
                                value="{{ $setting['show_prescription'] }}">
                                <option selected disabled>{{ trans('backend/reservation_control_trans.Choose') }}</option>
                                <option @if ($setting['show_online_reservations'] == 1) selected @endif value="1">
                                    {{ trans('backend/reservation_control_trans.Show') }}</option>
                                <option @if ($setting['show_online_reservations'] == 0) selected @endif value="0">
                                    {{ trans('backend/reservation_control_trans.Hide') }}</option>
                            </select>
                        </div>
                    </div>


                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <h5> {{ trans('backend/reservation_control_trans.Show_Medicines') }} <span
                                    class="text-danger">*</span></h5>
                        </div>
                        <div class="col-lg-3 col-md-8 col-sm-6 col-6">
                            <select class="custom-select mr-sm-2" name="show_medicines"
                                value="{{ $setting['show_prescription'] }}">
                                <option selected disabled>{{ trans('backend/reservation_control_trans.Choose') }}</option>
                                <option @if ($setting['show_medicines'] == 1) selected @endif value="1">
                                    {{ trans('backend/reservation_control_trans.Show') }}</option>
                                <option @if ($setting['show_medicines'] == 0) selected @endif value="0">
                                    {{ trans('backend/reservation_control_trans.Hide') }}</option>
                            </select>
                        </div>

                        {{-- </div> --}}
                        {{-- <div class="row mb-4"> --}}

                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <h5> {{ trans('backend/reservation_control_trans.Show_Number_of_Reservations') }} <span
                                    class="text-danger">*</span></h5>
                        </div>
                        <div class="col-lg-3 col-md-8 col-sm-6 col-6">
                            <select class="custom-select mr-sm-2" name="show_num_of_res"
                                value="{{ $setting['show_prescription'] }}">
                                <option selected disabled>{{ trans('backend/reservation_control_trans.Choose') }}</option>
                                <option @if ($setting['show_num_of_res'] == 1) selected @endif value="1">
                                    {{ trans('backend/reservation_control_trans.Show') }}</option>
                                <option @if ($setting['show_num_of_res'] == 0) selected @endif value="0">
                                    {{ trans('backend/reservation_control_trans.Hide') }}</option>
                            </select>
                        </div>
                    </div>


                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <h5> {{ trans('backend/reservation_control_trans.Show_Drugs') }} <span
                                    class="text-danger">*</span></h5>
                        </div>
                        <div class="col-lg-3 col-md-8 col-sm-6 col-6">
                            <select class="custom-select mr-sm-2" name="show_drugs"
                                value="{{ $setting['show_prescription'] }}">
                                <option selected disabled>{{ trans('backend/reservation_control_trans.Choose') }}</option>
                                <option @if ($setting['show_drugs'] == 1) selected @endif value="1">
                                    {{ trans('backend/reservation_control_trans.Show') }}</option>
                                <option @if ($setting['show_drugs'] == 0) selected @endif value="0">
                                    {{ trans('backend/reservation_control_trans.Hide') }}</option>
                            </select>
                        </div>

                        {{-- </div> --}}
                        {{-- <div class="row mb-4"> --}}

                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <h5> {{ trans('backend/reservation_control_trans.Show_Fees') }} <span class="text-danger">*</span>
                            </h5>
                        </div>
                        <div class="col-lg-3 col-md-8 col-sm-6 col-6">
                            <select class="custom-select mr-sm-2" name="show_fees"
                                value="{{ $setting['show_prescription'] }}">
                                <option selected disabled>{{ trans('backend/reservation_control_trans.Choose') }}</option>
                                <option @if ($setting['show_fees'] == 1) selected @endif value="1">
                                    {{ trans('backend/reservation_control_trans.Show') }}</option>
                                <option @if ($setting['show_fees'] == 0) selected @endif value="0">
                                    {{ trans('backend/reservation_control_trans.Hide') }}</option>
                            </select>
                        </div>
                    </div>


                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <h5> {{ trans('backend/reservation_control_trans.Show_Users') }} <span
                                    class="text-danger">*</span></h5>
                        </div>
                        <div class="col-lg-3 col-md-8 col-sm-6 col-6">
                            <select class="custom-select mr-sm-2" name="show_users"
                                value="{{ $setting['show_prescription'] }}">
                                <option selected disabled>{{ trans('backend/reservation_control_trans.Choose') }}</option>
                                <option @if ($setting['show_users'] == 1) selected @endif value="1">
                                    {{ trans('backend/reservation_control_trans.Show') }}</option>
                                <option @if ($setting['show_users'] == 0) selected @endif value="0">
                                    {{ trans('backend/reservation_control_trans.Hide') }}</option>
                            </select>
                        </div>

                        {{-- </div> --}}
                        {{-- <div class="row mb-4"> --}}

                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <h5> {{ trans('backend/reservation_control_trans.Show_Settings') }} <span
                                    class="text-danger">*</span></h5>
                        </div>
                        <div class="col-lg-3 col-md-8 col-sm-6 col-6">
                            <select class="custom-select mr-sm-2" name="show_settings"
                                value="{{ $setting['show_prescription'] }}">
                                <option selected disabled>{{ trans('backend/reservation_control_trans.Choose') }}</option>
                                <option @if ($setting['show_settings'] == 1) selected @endif value="1">
                                    {{ trans('backend/reservation_control_trans.Show') }}</option>
                                <option @if ($setting['show_settings'] == 0) selected @endif value="0">
                                    {{ trans('backend/reservation_control_trans.Hide') }}</option>
                            </select>
                        </div>
                    </div>






                    <button type="submit"
                        class="btn btn-success btn-md nextBtn btn-lg ">{{ trans('backend/reservation_control_trans.Save') }}</button>


                </form>


            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
