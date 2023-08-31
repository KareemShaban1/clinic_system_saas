@extends('backend.layouts.master')
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
                    action="{{ Route('backend.settings.zoomSettings.update') }}" autocomplete="off">
                    @csrf

                    {{-- @method('PUT') --}}
                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-5">
                            <h5 class="setting-title">{{ trans('backend/settings_trans.Zoom_Api_Key') }}<span
                                    class="text-danger">*</span></h5>
                        </div>
                        <div class="col-lg-6 col-md-8 col-sm-6 col-7"><input type="text" name="zoom_api_key"
                                value="{{ $zoomSettings['zoom_api_key'] }}" class="form-control"></div>
                    </div>



                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-5">
                            <h5 class="setting-title">{{ trans('backend/settings_trans.Zoom_Api_Secret') }}<span
                                    class="text-danger">*</span></h5>
                        </div>
                        <div class="col-lg-6 col-md-8 col-sm-6 col-7"><input type="text" name="zoom_api_secret"
                                value="{{ $zoomSettings['zoom_api_secret'] }}" class="form-control"></div>
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
