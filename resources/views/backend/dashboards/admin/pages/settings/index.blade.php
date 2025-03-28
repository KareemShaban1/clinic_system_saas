@extends('backend.dashboards.admin.layouts.master')
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

<div class="row">
    <div class="col-md-3">
        <div class="settings-container">
            <a href="{{ Route('backend.settings.clinic.Settings.index') }}">
                Clinic Settings
            </a>
        </div>
    </div>

    <div class="col-md-3">
        <div class="settings-container">
            <a href="{{ Route('backend.settings.reservationSettings.index') }}">
                Reservation Settings
            </a>
        </div>
    </div>

    <div class="col-md-3">
        <div class="settings-container">
            <a href="{{ Route('backend.settings.zoomSettings.index') }}">
                Zoom Settings
            </a>
        </div>
    </div>

    <div class="col-md-3">
        <div class="settings-container">
            <a href="{{ Route('backend.backups.index') }}">
                Backups
            </a>
        </div>
    </div>

</div>
@endsection
