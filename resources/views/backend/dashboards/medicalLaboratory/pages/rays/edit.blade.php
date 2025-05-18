@extends('backend.dashboards.medicalLaboratory.layouts.master')

@section('css')
@section('title')
{{ trans('backend/rays_trans.Add_Rays') }}
@stop
@endsection

@section('page-header')

<h4 class="page-title"> {{ trans('backend/rays_trans.Edit_Rays') }}</h4>

@endsection

@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <x-backend.alert />

                <form method="post" enctype="multipart/form-data" action="{{ Route('medicalLaboratory.rays.update', $ray->id) }}"
                    autocomplete="off">

                    @csrf

                    <input type="hidden" name="reservation_id" value="{{ $ray->reservation_id }}">

                    <div class="row">


                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label class="form-control-label">{{ trans('backend/rays_trans.Patient_Name') }}</label>
                                <select name="patient_id" class="custom-select mr-sm-2">

                                    <option value="{{ $ray->patient_id }}" selected>{{ $ray->patient->name }}</option>

                                </select>

                            </div>
                        </div>
                    </div>



                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label>{{ trans('backend/rays_trans.Rays_Name') }}</label>
                                <input type="text" value="{{ old('name', $ray->name) }}" name="name"
                                    class="form-control">

                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="ray_type_id">{{ trans('backend/rays_trans.Rays_Type') }} </label>
                                <select name="ray_type_id" id="ray_type_id" class="custom-select mr-sm-2">
                                    <!-- <option value="">{{ trans('backend/rays_trans.Select_Type') }}</option> -->
                                    @foreach (App\Models\Type::where('type', 'ray')->get() as $type)
                                    <option value="{{ $type->id }}" {{ $type->id == $ray->type_id ? 'selected' : '' }}>{{ $type->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>


                    </div>



                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label> {{ trans('backend/rays_trans.Rays_Date') }}<span
                                        class="text-danger">*</span></label>
                                <input class="form-control" name="date"
                                    value="{{ old('date', $ray->date) }}" id="datepicker-action"
                                    data-date-format="yyyy-mm-dd">
                            </div>
                        </div>


                    </div>


                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-outline mb-4">
                                <label class="form-label"
                                    for="report">{{ trans('backend/rays_trans.Report') }}</label>
                                <textarea name="report" class="form-control" id="report" rows="3">
                                {{ old('report', $ray->report) }}
                                </textarea>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-9 col-md-3 col-sm-12 col-12">
                            <div class="form-group">
                                <label> {{ trans('backend/rays_trans.Rays_Image') }}<span class="text-danger">*</span></label>
                                <input class="form-control" name="images[]" type="file" accept="image/*" multiple>
                            </div>
                        </div>

                        <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                            @foreach ($images as $image)
                            <img src="{{ $image->getUrl() }}" width="200" height="200">
                            @endforeach
                        </div>
                    </div>




                    <button type="submit"
                        class="btn btn-success btn-md nextBtn btn-lg">{{ trans('backend/rays_trans.Edit') }}</button>


                </form>


            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection