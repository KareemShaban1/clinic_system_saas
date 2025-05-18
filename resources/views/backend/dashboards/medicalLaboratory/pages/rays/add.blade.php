@extends('backend.dashboards.medicalLaboratory.layouts.master')
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

                <form method="post" enctype="multipart/form-data" action="{{ Route('medicalLaboratory.rays.store') }}"
                    autocomplete="off">

                    @csrf
                    <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="id"
                                    class="form-control-label">{{ trans('backend/rays_trans.Patient_Name') }}</label>
                                <select name="patient_id" id="patient_id" class="custom-select mr-sm-2">

                                    <option value="{{ $reservation->patient->id }}" selected>
                                        {{ $reservation->patient->name }}
                                    </option>

                                </select>

                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label> {{ trans('backend/rays_trans.Rays_Date') }}<span
                                        class="text-danger">*</span></label>
                                <input class="form-control" name="date" id="datepicker-action"
                                    data-date-format="yyyy-mm-dd">

                            </div>
                        </div>

                    </div>



                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="name">{{ trans('backend/rays_trans.Rays_Name') }}</label>
                                <input type="text" id="name" name="name" class="form-control">

                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="ray_type_id">{{ trans('backend/rays_trans.Rays_Type') }} </label>
                                <!-- <input type="text" name="type" id="type" class="form-control"> -->
                                <select name="ray_type_id" id="ray_type_id" class="custom-select mr-sm-2">
                                    <option value="">{{ trans('backend/rays_trans.Select_Type') }}</option>
                                    @foreach (App\Models\Type::where('type', 'ray')->get() as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>


                    </div>





                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-outline mb-4">
                                <label class="form-label"
                                    for="report">{{ trans('backend/rays_trans.Report') }}</label>
                                <textarea name="report" class="form-control" id="report" rows="3"></textarea>

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