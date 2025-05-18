@extends('backend.dashboards.medicalLaboratory.layouts.master')

@section('css')
@section('title')
    {{ trans('backend/medicalAnalysis_trans.Edit_Analysis') }}
@stop
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('backend/medicalAnalysis_trans.Edit_Analysis') }} </h4>
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
                    action="{{ Route('medicalLaboratory.analysis.update', $analysis->id) }}" autocomplete="off">

                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label
                                    class="form-control-label">{{ trans('backend/medicalAnalysis_trans.id') }}</label>
                                <select name="id" class="custom-select mr-sm-2">

                                    <option value="{{ $analysis->id }}" selected>
                                        {{ $analysis->id }}
                                    </option>

                                </select>

                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label
                                    class="form-control-label">{{ trans('backend/medicalAnalysis_trans.Patient_Name') }}</label>
                                <select name="id" class="custom-select mr-sm-2">

                                    <option value="{{ $analysis->id }}" selected>{{ $analysis->patient->name }}
                                    </option>

                                </select>

                            </div>
                        </div>
                    </div>



                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label>{{ trans('backend/medicalAnalysis_trans.Analysis_Name') }}</label>
                                <input type="text" value="{{ old('analysis_name', $analysis->analysis_name) }}"
                                    name="analysis_name" class="form-control">

                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label>{{ trans('backend/medicalAnalysis_trans.Analysis_Type') }} </label>
                                <input type="text" name="analysis_type"
                                    value="{{ old('analysis_type', $analysis->analysis_type) }}" class="form-control">

                            </div>
                        </div>


                    </div>



                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label> {{ trans('backend/medicalAnalysis_trans.Analysis_Date') }}<span
                                        class="text-danger">*</span></label>
                                <input class="form-control" name="analysis_date"
                                    value="{{ old('analysis_date', $analysis->analysis_date) }}" id="datepicker-action"
                                    data-date-format="yyyy-mm-dd">
                            </div>
                        </div>


                    </div>


                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-outline mb-4">
                                <label class="form-label"
                                    for="textAreaExample6">{{ trans('backend/medicalAnalysis_trans.Report') }}</label>
                                <textarea name="notes" class="form-control" id="textAreaExample6" rows="3">
                            {{ old('report', $analysis->report) }}
                            </textarea>

                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-9 col-md-3 col-sm-12 col-12">
                            <div class="form-group">
                                <label> {{ trans('backend/medicalAnalysis_trans.Analysis_Image') }}<span
                                        class="text-danger">*</span></label>
                                <?php $images = explode('|', $analysis->images); ?>
                                <input class="form-control" value="{{ $analysis->image }}" name="images[]"
                                    type="file" accept="image/*" multiple="multiple">

                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                            <?php $images = explode('|', $analysis->images); ?>
                            @foreach ($images as $key => $value)
                                <img src="{{ URL::asset('storage/medical_analysis/' . $value) }}" width="200"
                                    height="200">
                            @endforeach
                        </div>

                    </div>



                    <button type="submit"
                        class="btn btn-success btn-md nextBtn btn-lg">{{ trans('backend/medicalAnalysis_trans.Edit') }}</button>


                </form>


            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
