@extends('backend.layouts.master')
@section('css')

@section('title')
    {{ trans('backend/online_reservations_trans.Add_Reservation') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('backend/online_reservations_trans.Add_Reservation') }}</h4>
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

                <x-backend.alert/>

                <form method="post" enctype="multipart/form-data"
                    action="{{ Route('backend.online_reservations.store') }}" autocomplete="off">
                    @csrf

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label> {{ trans('backend/online_reservations_trans.Title') }} : <span class="text-danger">*</span></label>
                                <input class="form-control" name="topic" type="text">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ trans('backend/online_reservations_trans.Time_Date') }} : <span class="text-danger">*</span></label>
                                <input class="form-control" type="datetime-local" name="start_time">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ trans('backend/online_reservations_trans.Duration') }} : <span class="text-danger">*</span></label>
                                <input class="form-control" name="duration" type="text">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label
                                    class="form-control-label">{{ trans('backend/online_reservations_trans.Patient_Name') }}
                                </label>
                                <select name="patient_id" class="custom-select mr-sm-2">
                                    <option value="{{ $patient->patient_id }}" selected>{{ $patient->name }}</option>
                                </select>
                                @error('patient_id')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>{{ trans('backend/online_reservations_trans.First_Diagnosis') }} </label>
                                <input type="text" name="first_diagnosis" class="form-control">
                                @error('first_diagnosis')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label
                                    class="form-label">{{ trans('backend/online_reservations_trans.Reservation_Type') }}
                                </label>
                                <select name="res_type" class="custom-select mr-sm-2">
                                    <option selected disabled>{{ trans('backend/online_reservations_trans.Choose') }}
                                    </option>
                                    <option value="check"> {{ trans('backend/online_reservations_trans.Check') }}
                                    </option>
                                    <option value="recheck"> {{ trans('backend/online_reservations_trans.Recheck') }}
                                    </option>
                                    <option value="consultation">
                                        {{ trans('backend/online_reservations_trans.Consultation') }}</option>
                                </select>
                                @error('res_type')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label> {{ trans('backend/online_reservations_trans.Cost') }}<span
                                        class="text-danger">*</span></label>
                                <input class="form-control" name="cost" type="number">
                                @error('cost')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label
                                    class="form-label">{{ trans('backend/online_reservations_trans.Payment') }}</label>
                                <select name="payment" class="custom-select mr-sm-2">
                                    <option selected disabled>{{ trans('backend/online_reservations_trans.Choose') }}
                                    </option>
                                    <option value="paid">{{ trans('backend/online_reservations_trans.Paid') }}
                                    </option>
                                    <option value="not paid"> {{ trans('backend/online_reservations_trans.Not_Paid') }}
                                    </option>
                                </select>
                                @error('payment')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                    </div>



                    <button type="submit"
                        class="btn btn-success btn-md nextBtn btn-lg ">{{ trans('backend/online_reservations_trans.Add') }}</button>


                </form>


            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
