@extends('backend.dashboards.clinic.layouts.master')
@section('css')

@section('title')
    {{ trans('backend/rays_trans.Add_Rays') }}
@stop
@endsection
@section('page-header')

<h4 class="page-title"> {{ trans('backend/rays_trans.Add_Rays') }}</h4>

@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <x-backend.alert />

                <form method="post" enctype="multipart/form-data" action="{{ Route('clinic.rays.store') }}"
                    autocomplete="off">

                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="id"
                                    class="form-control-label">{{ trans('backend/rays_trans.id') }}</label>
                                <select name="id" id="id" class="custom-select mr-sm-2">

                                    <option value="{{ $reservation->id }}" selected>
                                        {{ $reservation->id }}</option>

                                </select>

                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="id"
                                    class="form-control-label">{{ trans('backend/rays_trans.Patient_Name') }}</label>
                                <select name="id" id="id" class="custom-select mr-sm-2">

                                    <option value="{{ $reservation->patient->id }}" selected>
                                        {{ $reservation->patient->name }}</option>

                                </select>

                            </div>
                        </div>
                    </div>



                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="ray_name">{{ trans('backend/rays_trans.Rays_Name') }}</label>
                                <input type="text" id="ray_name" name="ray_name" class="form-control">

                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="ray_type">{{ trans('backend/rays_trans.Rays_Type') }} </label>
                                <input type="text" name="ray_type" id="ray_type" class="form-control">

                            </div>
                        </div>


                    </div>



                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label> {{ trans('backend/rays_trans.Rays_Date') }}<span
                                        class="text-danger">*</span></label>
                                <input class="form-control" name="ray_date" id="datepicker-action"
                                    data-date-format="yyyy-mm-dd">

                            </div>
                        </div>


                    </div>


                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-outline mb-4">
                                <label class="form-label"
                                    for="notes">{{ trans('backend/rays_trans.Notes') }}</label>
                                <textarea name="notes" class="form-control" id="notes" rows="3"></textarea>

                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="images"> {{ trans('backend/rays_trans.Rays_Image') }}<span
                                        class="text-danger">*</span></label>
                                <input class="form-control" name="images[]" id="images" type="file"
                                    accept="image/*" multiple="multiple">

                            </div>
                        </div>
                    </div>


                    <button type="submit"
                        class="btn btn-success btn-md nextBtn btn-lg">{{ trans('backend/rays_trans.Add') }}</button>

                </form>


            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
