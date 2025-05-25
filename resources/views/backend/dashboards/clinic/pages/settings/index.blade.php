@extends('backend.dashboards.clinic.layouts.master')
@section('css')

@section('title')
    {{ trans('backend/settings_trans.Settings') }}
@stop

@endsection
@section('page-header')

<h4 class="page-title"> {{ trans('backend/settings_trans.Settings') }}</h4>

@endsection
@section('content')

<div class="row">
    <div class="col-md-3">
        <div class="settings-container">
            <a href="{{ Route('clinic.settings.clinicSettings.index') }}">
                {{ trans('backend/settings_trans.Clinic Settings') }}
            </a>
        </div>
    </div>

    <div class="col-md-3">
        <div class="settings-container">
            <a href="{{ Route('clinic.settings.reservationSettings.index') }}">
                {{ trans('backend/settings_trans.Reservation Settings') }}
            </a>
        </div>
    </div>

    <div class="col-md-3">
        <div class="settings-container">
            <a href="{{ Route('clinic.settings.zoomSettings.index') }}">
                {{ trans('backend/settings_trans.Zoom Settings') }}
            </a>
        </div>
    </div>


</div>
@endsection
