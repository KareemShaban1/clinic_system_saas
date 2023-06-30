@extends('backend.layouts.master')
@section('css')

@section('title')
    {{ trans('backend/reservations_trans.Add_Reservation') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('backend/reservations_trans.Add_Reservation') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#"
                        class="default-color">{{ trans('backend/reservations_trans.Add_Reservation') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('backend/reservations_trans.Reservations') }}</li>
            </ol>
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

                {{-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                @endif --}}

                <form method="post" enctype="multipart/form-data" action="{{ Route('backend.reservations.store') }}"
                    autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label">{{ trans('backend/reservations_trans.Patient_Name') }}
                                </label>
                                <select name="patient_id" class="custom-select mr-sm-2">
                                    <option value="{{ $patient->patient_id }}" selected>{{ $patient->name }}</option>
                                </select>
                                @error('patient_id')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>


                        @if ($settings['reservation_slots'] == 0)
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label> {{ trans('backend/reservations_trans.Number_of_Reservation') }} <span
                                            class="text-danger">*</span></label>
                                    <select name="res_num" class="custom-select mr-sm-2">
                                        <option selected disabled>{{ trans('backend/reservations_trans.Choose') }}</option>
                                        @for ($i = 1; $i <= $numberOfRes; $i++)
                                            @if ($todayReservationResNum == $i)
                                                <option value="{{ $i }}" disabled
                                                    style="background:gainsboro">
                                                    {{ $i }}</option>
                                            @else
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endif
                                        @endfor
                                    </select>
                                    @error('res_num')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        @endif



                        @if ($settings['reservation_slots'] == 1)
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label> {{ trans('backend/reservations_trans.Reservation_Slots') }} <span
                                            class="text-danger">*</span></label>
                                    <select name="slot" class="custom-select mr-sm-2">
                                        <option selected disabled>{{ trans('backend/reservations_trans.Choose') }}</option>

                                        @for ($i = 1; $i <= count($slots); $i++)
                                            @if ($todayReservationSlots == $slots[$i]['slot_start_time'])
                                                <option value="{{ $slots[$i]['slot_start_time'] }}" disabled
                                                    style="background:gainsboro"> {{ $slots[$i]['slot_start_time'] }} -
                                                    {{ $slots[$i]['slot_end_time'] }}</option>
                                            @else
                                                <option value="{{ $slots[$i]['slot_start_time'] }}">
                                                    {{ $slots[$i]['slot_start_time'] }} -
                                                    {{ $slots[$i]['slot_end_time'] }}
                                                </option>
                                            @endif
                                        @endfor

                                    </select>
                                    @error('res_num')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        @endif
                    </div>



                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>{{ trans('backend/reservations_trans.First_Diagnosis') }} </label>
                                <input type="text" name="first_diagnosis" class="form-control">
                                @error('first_diagnosis')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">{{ trans('backend/reservations_trans.Reservation_Type') }} </label>
                                <select name="res_type" class="custom-select mr-sm-2">
                                    <option selected disabled>{{ trans('backend/reservations_trans.Choose') }}</option>
                                    <option value="check"> {{ trans('backend/reservations_trans.Check') }}</option>
                                    <option value="recheck"> {{ trans('backend/reservations_trans.Recheck') }}</option>
                                    <option value="consultation">{{ trans('backend/reservations_trans.Consultation') }}
                                    </option>
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
                                <label> {{ trans('backend/reservations_trans.Cost') }}<span
                                        class="text-danger">*</span></label>
                                <input class="form-control" name="cost" type="number">
                                @error('cost')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">{{ trans('backend/reservations_trans.Payment') }}</label>
                                <select name="payment" class="custom-select mr-sm-2">
                                    <option selected disabled>{{ trans('backend/reservations_trans.Choose') }}</option>
                                    <option value="paid">{{ trans('backend/reservations_trans.Paid') }} </option>
                                    <option value="not paid"> {{ trans('backend/reservations_trans.Not_Paid') }} </option>
                                </select>
                                @error('payment')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label> {{ trans('backend/reservations_trans.Reservation_Date') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" name="res_date" id="datepicker-action"
                                    data-date-format="yyyy-mm-dd">
                                @error('res_date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="res_status"> {{ trans('backend/reservations_trans.Reservation_Status') }}<span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="res_status">
                                    <option selected disabled>{{ trans('backend/reservations_trans.Choose') }}</option>
                                    <option value="waiting">{{ trans('backend/reservations_trans.Waiting') }}</option>
                                    <option value="entered">{{ trans('backend/reservations_trans.Entered') }}</option>
                                    <option value="finished">{{ trans('backend/reservations_trans.Finished') }}</option>
                                </select>
                                @error('res_status')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="status"> {{ trans('backend/reservations_trans.Status') }}<span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="status">
                                    <option selected disabled>{{ trans('backend/reservations_trans.Choose') }}</option>
                                    <option value="active">{{ trans('backend/reservations_trans.Active') }}</option>
                                    <option value="inactive">{{ trans('backend/reservations_trans.Inactive') }}</option>
                                </select>
                                @error('status')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                    </div>


                    <button type="submit"
                        class="btn btn-success btn-md nextBtn btn-lg ">{{ trans('backend/reservations_trans.Add') }}</button>


                </form>


            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
