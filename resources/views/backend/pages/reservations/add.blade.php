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
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->

<div style="padding: 20px; background-color:#e7e7e7;">
    <div class="row">
        <div class="col-sm-6 col-12">
            <h5 class="mb-0" style="color: rgb(152, 107, 107)"> 
                {{ trans('backend/reservations_trans.You Are Using') }}
                @if ($settings['reservation_slots'] == 1)
                {{ trans('backend/reservations_trans.Reservation_Slots') }}
                @else 
                {{ trans('backend/reservations_trans.Reservation_Numbers') }}
                @endif
                {{ trans('backend/reservations_trans.You Can change it from') }}
                <a href="{{ Route('backend.system_control.index') }}" class="text-dark">
                    {{ trans('backend/reservations_trans.here') }}
                </a>
            </h5>
        </div>

        <div class="col-sm-6 col-12">
            <div>
                <a href="{{ Route('backend.num_of_reservations.add') }}" class="text-success">
                {{ trans('backend/reservations_trans.Add Reservation Numbers') }}
                </a>
            </div>

            <div>
                <a href="{{ Route('backend.reservation_slots.add') }}" class="text-success">
                {{ trans('backend/reservations_trans.Add Reservation Slots') }}
                </a>
            </div>
        </div>

    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <x-backend.alert />

                <form method="post" enctype="multipart/form-data" action="{{ Route('backend.reservations.store') }}"
                    autocomplete="off">
                    @csrf
                    <div class="row">

                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="patient_id" class="form-control-label">{{ trans('backend/reservations_trans.Patient_Name') }}
                                </label>
                                <select name="patient_id" id="patient_id" class="custom-select mr-sm-2">
                                    <option value="{{ $patient->patient_id }}" selected>{{ $patient->name }}</option>
                                </select>

                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="datepicker-action"> {{ trans('backend/reservations_trans.Reservation_Date') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control"  name="res_date" id="datepicker-action"
                                    data-date-format="yyyy-mm-dd">

                            </div>
                        </div>

                        @if ($settings['reservation_slots'] == 1)
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="slot"> {{ trans('backend/reservations_trans.Reservation_Slots') }} <span
                                            class="text-danger">*</span></label>
                                    <select name="slot" id="slot" id="slot-select" class="custom-select mr-sm-2">
                                        <option selected disabled>{{ trans('backend/reservations_trans.Choose') }}
                                        </option>
                                    </select>

                                </div>
                            </div>
                        @else
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="res_num"> {{ trans('backend/reservations_trans.Number_of_Reservation') }} <span
                                            class="text-danger">*</span></label>
                                    <select name="res_num" id="res_num" class="custom-select mr-sm-2">
                                        <option selected disabled>{{ trans('backend/reservations_trans.Choose') }}
                                        </option>

                                    </select>

                                </div>
                            </div>
                        @endif
                    </div>





                    <div class="row">

                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">{{ trans('backend/reservations_trans.Reservation_Type') }}
                                </label for="res_type">
                                <select name="res_type" id="res_type" class="custom-select mr-sm-2">
                                    <option selected disabled>{{ trans('backend/reservations_trans.Choose') }}</option>
                                    <option value="check"> {{ trans('backend/reservations_trans.Check') }}</option>
                                    <option value="recheck"> {{ trans('backend/reservations_trans.Recheck') }}</option>
                                    <option value="consultation">{{ trans('backend/reservations_trans.Consultation') }}
                                    </option>
                                </select>


                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cost"> {{ trans('backend/reservations_trans.Cost') }}<span
                                        class="text-danger">*</span></label>
                                <input class="form-control" id="cost" name="cost" type="number">

                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="payment" class="form-label">{{ trans('backend/reservations_trans.Payment') }}</label>
                                <select name="payment" id="payment" class="custom-select mr-sm-2">
                                    <option selected disabled>{{ trans('backend/reservations_trans.Choose') }}</option>
                                    <option value="paid">{{ trans('backend/reservations_trans.Paid') }} </option>
                                    <option value="not paid"> {{ trans('backend/reservations_trans.Not_Paid') }}
                                    </option>
                                </select>

                            </div>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="res_status">
                                    {{ trans('backend/reservations_trans.Reservation_Status') }}<span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" id="res_status" name="res_status">
                                    <option selected disabled>{{ trans('backend/reservations_trans.Choose') }}</option>
                                    <option value="waiting">{{ trans('backend/reservations_trans.Waiting') }}</option>
                                    <option value="entered">{{ trans('backend/reservations_trans.Entered') }}</option>
                                    <option value="finished">{{ trans('backend/reservations_trans.Finished') }}
                                    </option>
                                </select>

                            </div>
                        </div>

                        {{-- <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="acceptance"> {{ trans('backend/reservations_trans.Acceptance') }}<span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="acceptance" id="acceptance">
                                    <option selected disabled>{{ trans('backend/reservations_trans.Choose') }}</option>
                                    <option value="approved">{{ trans('backend/reservations_trans.Approved') }}
                                    </option>
                                    <option value="not_approved">
                                        {{ trans('backend/reservations_trans.Not_Approved') }}
                                    </option>
                                </select>
                            </div>
                        </div> --}}

                    </div>

                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>{{ trans('backend/reservations_trans.First_Diagnosis') }} </label>
                                <textarea class="summernote" name="first_diagnosis"
                                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </textarea>
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

<script>
    $(document).ready(function() {

        $('#datepicker-action').change(function() {
            var selectedDate = $(this).val();
            var reservationId = $('#reservation_id').val();
            // Perform an AJAX request to fetch the updated number of reservations
            $.ajax({
                url: "{{ URL::to('/backend/reservations/get_res_slot_number_add') }}", // Replace with the actual URL to handle the AJAX request
                method: 'GET',
                data: {
                    res_date: selectedDate,
                    res_id: reservationId,
                },
                success: function(response) {

                    // Clear the existing options
                    $('select[name="res_num"]').empty();
                    // Add the updated options
                    for (var i = 1; i <= response.reservationsCount; i++) {
                        console.log(response.todayReservationResNum.includes(i));
                        if (response.todayReservationResNum.includes(i)) {
                            var option = '<option value="' + i +
                                '" disabled style="background:gainsboro">' + i +
                                '</option>';
                        } else {
                            var option = '<option value="' + i + '">' + i + '</option>';
                        }
                        $('select[name="res_num"]').append(option);
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
