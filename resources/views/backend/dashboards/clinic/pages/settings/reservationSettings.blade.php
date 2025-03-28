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

                    @php
                    $settingsFields = [
                    'show_ray' => 'Show_Ray',
                    'show_chronic_diseases' => 'Show_Chronic_Diseases',
                    'show_glasses_distance' => 'Show_Glasses_Distance',
                    'show_prescription' => 'Show_Prescription',
                    'reservation_slots' => 'Show_Reservation_Slots',
                    'show_events' => 'Show_Events',
                    'show_patients' => 'Show_Patients',
                    'show_reservations' => 'Show_Reservations',
                    'show_online_reservations' => 'Show_Online_Reservations',
                    ];
                    @endphp

                    @foreach($settingsFields as $field => $label)
                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-7">
                            <h5 class="setting-title">
                                {{ trans("backend/reservation_settings_trans.$label") }} <span class="text-danger">*</span>
                            </h5>
                        </div>
                        <div class="col-lg-3 col-md-8 col-sm-6 col-5 mb-2">
                            <select class="custom-select mr-sm-2" name="{{ $field }}">
                                <option disabled {{ !isset($settings[$field]) ? 'selected' : '' }}>
                                    {{ trans('backend/reservation_settings_trans.Choose') }}
                                </option>
                                <option value="1" @if(isset($settings[$field]) && $settings[$field]==1) selected @endif>
                                    {{ trans('backend/reservation_settings_trans.Show') }}
                                </option>
                                <option value="0" @if(isset($settings[$field]) && $settings[$field]==0) selected @endif>
                                    {{ trans('backend/reservation_settings_trans.Hide') }}
                                </option>
                            </select>
                        </div>
                    </div>
                    @endforeach




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