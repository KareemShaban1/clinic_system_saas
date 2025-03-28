@extends('backend.dashboards.clinic.layouts.master')
@section('css')

@section('title')
    {{ trans('backend/reservations_trans.Edit_Reservation') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('backend/reservations_trans.Edit_Reservation') }} </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#"
                        class="default-color">{{ trans('backend/reservations_trans.Edit_Reservation') }}</a></li>
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

                <x-backend.alert />

                <form method="post" enctype="multipart/form-data"
                    action="{{ Route('clinic.reservations.update', $reservation->id) }}"
                    autocomplete="off">
                    @csrf

                    <div class="row">
                        <input type="hidden" id="id" value="{{ $reservation->id }}"
                            name="id">

                        <input type="hidden" id="id" value="{{ $reservation->patient->id }}"
                            name="id">

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label
                                    class="form-control-label">{{ trans('backend/reservations_trans.Patient_Name') }}</label>
                                <!-- <select name="id" class="custom-select mr-sm-2">
                                   
                                    <option value="{{ $reservation->patient->id }}"
                                    disabled
                                        @if ($reservation->patient->id == old('id', $reservation->id)) selected @endif>
                                        {{ $reservation->patient->name }}</option>
                                </select> -->
                                <input type="text" disabled value="{{ $reservation->patient->name }}" class="form-control">
                            </div>
                        </div>


                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label> {{ trans('backend/reservations_trans.Reservation_Date') }}<span
                                        class="text-danger">*</span></label>
                                <input class="form-control" name="date"
                                    value="{{ old('date', $reservation->date) }}" id="datepicker-action"
                                    data-date-format="yyyy-mm-dd">
                            </div>
                        </div>

                        @if ($reservationType === 'slot')
                            <div class="col-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label> {{ trans('backend/reservations_trans.Reservation_Slots') }} <span
                                            class="text-danger">*</span></label>
                                    <select name="slot" id="slot-select" class="custom-select mr-sm-2">
                                        @foreach ($slots as $slot)
                                            <option value="{{ $slot['slot_start_time'] }}"
                                                {{ $slot['slot_start_time'] == $reservation->slot ? 'selected' : '' }}>
                                                {{ $slot['slot_start_time'] }} - {{ $slot['slot_end_time'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @else
                            <div class="col-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label> {{ trans('backend/reservations_trans.Number_of_Reservation') }} <span
                                            class="text-danger">*</span></label>
                                    <select name="reservation_number" class="custom-select mr-sm-2">
                                        @for ($i = 1; $i <= $numberOfRes; $i++)
                                            <option value="{{ $i }}"
                                                {{ $reservationResNum == $i ? 'selected style=background:gainsboro' : ($i == $reservation->reservation_number ? 'selected' : '') }}>
                                                {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        @endif


                    </div>


                    <div class="row">

                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">{{ trans('backend/reservations_trans.Reservation_Type') }}
                                </label>
                                <select name="type" class="custom-select mr-sm-2">
                                    <option selected disabled>{{ trans('backend/reservations_trans.Choose') }}</option>
                                    <option value="check" @if (old('type', $reservation->type) == 'check') selected @endif>
                                        {{ trans('backend/reservations_trans.Check') }}
                                    </option>
                                    <option value="recheck" @if (old('type', $reservation->type) == 'recheck') selected @endif>
                                        {{ trans('backend/reservations_trans.Recheck') }}
                                    </option>
                                    <option value="consultation" @if (old('type', $reservation->type) == 'consultation') selected @endif>
                                        {{ trans('backend/reservations_trans.Consultation') }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label> {{ trans('backend/reservations_trans.Cost') }}<span
                                        class="text-danger">*</span></label>
                                <input class="form-control" value="{{ old('cost', $reservation->cost) }}"
                                    name="cost" type="number">

                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">{{ trans('backend/reservations_trans.Payment') }}</label>
                                <select name="payment" class="custom-select mr-sm-2">
                                    <option selected disabled>{{ trans('backend/reservations_trans.Choose') }}</option>
                                    <option value="paid" @if (old('payment', $reservation->payment) == 'paid') selected @endif>
                                        {{ trans('backend/reservations_trans.Paid') }}
                                    </option>
                                    <option value="not paid" @if (old('payment', $reservation->payment) == 'not paid') selected @endif>
                                        {{ trans('backend/reservations_trans.Not_Paid') }}
                                    </option>
                                </select>
                            </div>
                        </div>

                    </div>


                    <div class="row">

                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="status">
                                    {{ trans('backend/reservations_trans.Reservation_Status') }}<span
                                        class="text-danger">*</span></label>

                                <select class="custom-select mr-sm-2" name="status">
                                    <option selected disabled>{{ trans('backend/reservations_trans.Choose') }}</option>
                                    <option value="waiting" @if (old('status', $reservation->status) == 'waiting') selected @endif>
                                        {{ trans('backend/reservations_trans.Waiting') }}
                                    </option>
                                    <option value="entered" @if (old('status', $reservation->status) == 'entered') selected @endif>
                                        {{ trans('backend/reservations_trans.Entered') }}
                                    </option>
                                    <option value="finished" @if (old('status', $reservation->status) == 'finished') selected @endif>
                                        {{ trans('backend/reservations_trans.Finished') }}
                                    </option>
                                </select>
                            </div>
                        </div>


                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="acceptance"> {{ trans('backend/reservations_trans.Acceptance') }}<span
                                        class="text-danger">*</span></label>

                                <select class="custom-select mr-sm-2" name="acceptance">
                                    <option selected disabled>{{ trans('backend/reservations_trans.Choose') }}</option>
                                    <option value="approved" @if (old('acceptance', $reservation->acceptance) == 'approved') selected @endif>
                                        {{ trans('backend/reservations_trans.Approved') }}
                                    </option>
                                    <option value="not_approved" @if (old('acceptance', $reservation->acceptance) == 'not_approved') selected @endif>
                                        {{ trans('backend/reservations_trans.Not_Approved') }}
                                    </option>

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label> {{ trans('backend/reservations_trans.First_Diagnosis') }} </label>
                                <textarea class="summernote" name="first_diagnosis"
                                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                {{ old('first_diagnosis', $reservation->first_diagnosis) }}   
                                </textarea>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>{{ trans('backend/reservations_trans.Final_Diagnosis') }} </label>
                                <textarea id="summernote_1" name="final_diagnosis"
                                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                {{ old('final_diagnosis', $reservation->first_diagnosis) }}   
                                </textarea>
                            </div>
                        </div>
                    </div>


                    <button type="submit"
                        class="btn btn-success btn-md nextBtn btn-lg ">{{ trans('backend/reservations_trans.Edit') }}</button>


                </form>


            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

<script>
    $(document).ready(function() {

        $('#datepicker-action').change(function() {
            var selectedDate = $(this).val();
            var reservationId = $('#id').val();

            // Perform an AJAX request to fetch the updated number of reservations
            $.ajax({
                url: "{{ URL::to('/backend/reservations/get_res_slot_number_edit') }}", // Replace with the actual URL to handle the AJAX request
                method: 'GET',
                data: {
                    date: selectedDate,
                    res_id: reservationId,
                },
                success: function(response) {

                    // Clear the existing options
                    $('select[name="reservation_number"]').empty();
                    // Add the updated options
                    for (var i = 1; i <= response.reservationsCount; i++) {
                        if (response.todayReservationResNum.includes(i)) {
                            var option = '<option value="' + i +
                                '" disabled style="background:gainsboro">' + i +
                                '</option>';
                            if (response.reservation.reservation_number == i) {
                                var option = '<option value="' + i +
                                    '" style="background:red">' + i +
                                    '</option>';
                            }
                        } else {
                            var option = '<option value="' + i + '">' + i + '</option>';
                        }
                        $('select[name="reservation_number"]').append(option);
                    }



                    // Clear the current options
                    $('#slot-select').empty();
                    // Add the new options based on the response
                    $.each(response.slots, function(index, slot) {
                        var option = $('<option>').val(slot.slot_start_time).text(
                            slot.slot_start_time + ' - ' + slot.slot_end_time);

                        if (response.today_reservation_slots.includes(slot
                                .slot_start_time)) {
                            option.attr('disabled',
                                true); // Disable the option if reserved
                            option.css('background', 'gainsboro');
                        }
                        if (response.reservation.slot === slot.slot_start_time) {

                            option.css('background', 'red');
                        }

                        $('#slot-select').append(option);
                    });
                },
                error: function(xhr, status, error) {
                    // Handle the error response
                    console.log(error);
                }
            });
        });


    });
</script>
@endsection
