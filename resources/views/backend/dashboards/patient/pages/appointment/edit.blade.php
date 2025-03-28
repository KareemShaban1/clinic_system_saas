@extends('backend.dashboards.patient.layouts.master')
@section('css')

@section('title')
    {{ trans('frontend/reservations_trans.Edit_Reservation') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('frontend/reservations_trans.Edit_Reservation') }} </h4>
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

                <x-frontend.alert/>

                <form method="post" enctype="multipart/form-data"
                    action="{{ Route('backend.reservations.update', $reservation->id) }}" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label
                                    class="form-control-label">{{ trans('frontend/reservations_trans.Patient_Name') }}</label>
                                <select name="id" class="custom-select mr-sm-2">
                                    <option value="" selected>{{ trans('frontend/reservations_trans.Choose') }}
                                    </option>
                                    <option value="{{ $reservation->patient->id }}"
                                        @if ($reservation->patient->id == old('id', $reservation->id)) selected @endif>
                                        {{ $reservation->patient->name }}</option>
                                </select>
                                @error('id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label> {{ trans('frontend/reservations_trans.Number_of_Reservation') }} <span
                                        class="text-danger">*</span></label>
                                <select name="reservation_number" class="custom-select mr-sm-2"
                                    value="{{ old('reservation_number', $reservation->reservation_number) }}">
                                    @for ($i = 1; $i <= $number_of_res; $i++)
                                        @if ($today_reservation_reservation_number == $i)
                                            <option value="{{ $i }}" selected style="background:gainsboro">
                                                {{ $i }}</option>
                                        @else
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endif
                                    @endfor
                                </select>
                                @error('reservation_number')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>



                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label> {{ trans('frontend/reservations_trans.First_Diagnosis') }} </label>
                                <input type="text" name="first_diagnosis"
                                    value="{{ old('first_diagnosis', $reservation->first_diagnosis) }}"
                                    class="form-control">
                                @error('first_diagnosis')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">{{ trans('frontend/reservations_trans.Reservation_Type') }}
                                </label>
                                <select name="res_type" class="custom-select mr-sm-2">
                                    <option selected disabled>{{ trans('frontend/reservations_trans.Choose') }}
                                    </option>
                                    <option value="check" @if (old('res_type', $reservation->res_type) == 'check') selected @endif>
                                        {{ trans('frontend/reservations_trans.Check') }}
                                    </option>
                                    <option value="recheck" @if (old('res_type', $reservation->res_type) == 'recheck') selected @endif>
                                        {{ trans('frontend/reservations_trans.Recheck') }}
                                    </option>
                                    <option value="consultation" @if (old('res_type', $reservation->res_type) == 'consultation') selected @endif>
                                        {{ trans('frontend/reservations_trans.Consultation') }}
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
                                <label> {{ trans('frontend/reservations_trans.Cost') }}<span
                                        class="text-danger">*</span></label>
                                <input class="form-control" value="{{ old('cost', $reservation->cost) }}" name="cost"
                                    type="number">
                                @error('cost')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">{{ trans('frontend/reservations_trans.Payment') }}</label>
                                <select name="payment" class="custom-select mr-sm-2">
                                    <option selected disabled>{{ trans('frontend/reservations_trans.Choose') }}
                                    </option>
                                    <option value="paid" @if (old('payment', $reservation->payment) == 'paid') selected @endif>
                                        {{ trans('frontend/reservations_trans.Paid') }}
                                    </option>
                                    <option value="not paid" @if (old('payment', $reservation->payment) == 'not paid') selected @endif>
                                        {{ trans('frontend/reservations_trans.Not_Paid') }}
                                    </option>
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
                                <label> {{ trans('frontend/reservations_trans.Reservation_Date') }}<span
                                        class="text-danger">*</span></label>
                                <input class="form-control" name="date"
                                    value="{{ old('date', $reservation->date) }}" id="datepicker-action"
                                    data-date-format="yyyy-mm-dd">
                                @error('date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="status">
                                    {{ trans('frontend/reservations_trans.Reservation_Status') }}<span
                                        class="text-danger">*</span></label>

                                <select class="custom-select mr-sm-2" name="status">
                                    <option selected disabled>{{ trans('frontend/reservations_trans.Choose') }}
                                    </option>
                                    <option value="waiting" @if (old('status', $reservation->status) == 'waiting') selected @endif>
                                        {{ trans('frontend/reservations_trans.Waiting') }}
                                    </option>
                                    <option value="entered" @if (old('status', $reservation->status) == 'entered') selected @endif>
                                        {{ trans('frontend/reservations_trans.Entered') }}
                                    </option>
                                    <option value="finished" @if (old('status', $reservation->status) == 'finished') selected @endif>
                                        {{ trans('frontend/reservations_trans.Finished') }}
                                    </option>
                                </select>
                                @error('status')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>




                    </div>

                    @can('DoctorView', \App\Models\User::class)
                        <div class="row">

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>{{ trans('frontend/reservations_trans.Final_Diagnosis') }} </label>
                                    <input type="text" name="final_diagnosis"
                                        value="{{ old('final_diagnosis', $reservation->final_diagnosis) }}"
                                        class="form-control">
                                    @error('final_diagnosis')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    @endcan


                    <button type="submit"
                        class="btn btn-success btn-md nextBtn btn-lg ">{{ trans('frontend/reservations_trans.Edit') }}</button>


                </form>


            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
