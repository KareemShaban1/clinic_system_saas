@extends('backend.layouts.master')
@section('css')

@section('title')
    {{ trans('backend/medicalAnalysis_trans.Add_Analysis') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('backend/medicalAnalysis_trans.Add_Analysis') }} </h4>
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

                <form method="post" enctype="multipart/form-data" action="{{ Route('backend.analysis.store') }}"
                    autocomplete="off">

                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="reservation_id"
                                    class="form-control-label">{{ trans('backend/medicalAnalysis_trans.Reservation_Id') }}</label>
                                <select name="reservation_id" id="reservation_id" class="custom-select mr-sm-2">

                                    <option value="{{ $reservation->reservation_id }}" selected>
                                        {{ $reservation->reservation_id }}</option>

                                </select>

                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="patient_id"
                                    class="form-control-label">{{ trans('backend/medicalAnalysis_trans.Patient_Name') }}</label>
                                <select name="patient_id" id="patient_id" class="custom-select mr-sm-2">

                                    <option value="{{ $reservation->patient->patient_id }}" selected>
                                        {{ $reservation->patient->name }}</option>

                                </select>

                            </div>
                        </div>
                    </div>



                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label
                                    for="analysis_name">{{ trans('backend/medicalAnalysis_trans.Analysis_Name') }}</label>
                                <input type="text" id="analysis_name" name="analysis_name" class="form-control">

                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="analysis_type">{{ trans('backend/medicalAnalysis_trans.Analysis_Type') }}
                                </label>
                                <input type="text" name="analysis_type" id="analysis_type" class="form-control">

                            </div>
                        </div>


                    </div>



                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label> {{ trans('backend/medicalAnalysis_trans.Analysis_Date') }}<span
                                        class="text-danger">*</span></label>
                                <input class="form-control" name="analysis_date" id="datepicker-action"
                                    data-date-format="yyyy-mm-dd">

                            </div>
                        </div>


                    </div>


                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-outline mb-4">
                                <label class="form-label"
                                    for="report">{{ trans('backend/medicalAnalysis_trans.Report') }}</label>
                                <textarea name="report" class="form-control" id="report" rows="3"></textarea>

                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="images"> {{ trans('backend/medicalAnalysis_trans.Analysis_Image') }}<span
                                        class="text-danger">*</span></label>
                                <input class="form-control" name="images[]" id="images" type="file"
                                    accept="image/*" multiple="multiple">

                            </div>
                        </div>
                    </div>


                    <button type="submit"
                        class="btn btn-success btn-md nextBtn btn-lg">{{ trans('backend/medicalAnalysis_trans.Add') }}</button>

                </form>


            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
