@extends('backend.dashboards.patient.layouts.master')
@section('css')

@section('title')
    {{ trans('frontend/reservations_trans.Add_Reservation') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('frontend/reservations_trans.Add_Reservation') }}</h4>
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

                <form method="POST" enctype="multipart/form-data" action="{{ Route('frontend.appointment.store') }}"
                    autocomplete="off">
                    @csrf


                    <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-1 col-12">
                            <div class="form-group">
                                <label class="form-control-label">{{ trans('frontend/reservations_trans.Patient_Name') }}
                                </label>
                                <select name="patient_id" class="custom-select mr-sm-2">
                                    <option value="{{ $patient->id }}" selected>{{ $patient->name }}</option>
                                </select>
                                @error('patient_id')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label> {{ trans('frontend/reservations_trans.Reservation_Date') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" name="date" id="datepicker-action"
                                    data-date-format="yyyy-mm-dd">
                                @error('date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                    </div>

                    <div class="row">

                        @if (isset($settings['reservation_slots']) && $settings['reservation_slots'] == 0)
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label> {{ trans('frontend/reservations_trans.Number_of_Reservation') }} <span
                                            class="text-danger">*</span></label>
                                    <select name="reservation_number" class="custom-select mr-sm-2">
                                        <option selected disabled>{{ trans('frontend/reservations_trans.Choose') }}</option>

                                    </select>
                                    @error('reservation_number')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        @endif



                        @if (isset($settings['reservation_slots']) && $settings['reservation_slots'] == 1)
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label> {{ trans('frontend/reservations_trans.Reservation_Slots') }} <span
                                            class="text-danger">*</span></label>
                                    <select name="slot" id="slot-select" class="custom-select mr-sm-2">
                                        <option selected disabled>{{ trans('frontend/reservations_trans.Choose') }}</option>

                                        {{-- @for ($i = 1; $i <= count($slots); $i++)
                                            <option value="{{ $slots[$i]['slot_start_time'] }}">
                                                {{ $slots[$i]['slot_start_time'] }} -
                                                {{ $slots[$i]['slot_end_time'] }}
                                            </option>
                                        @endfor --}}

                                    </select>
                                    @error('reservation_number')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        @endif
                    </div>



                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label>{{ trans('frontend/reservations_trans.First_Diagnosis') }} </label>
                                <input type="text" name="first_diagnosis" class="form-control">
                                @error('first_diagnosis')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label class="form-label">{{ trans('frontend/reservations_trans.Reservation_Type') }} </label>
                                <select name="res_type" class="custom-select mr-sm-2">
                                    <option selected disabled>{{ trans('frontend/reservations_trans.Choose') }}</option>
                                    <option value="check"> {{ trans('frontend/reservations_trans.Check') }}</option>
                                    <option value="recheck"> {{ trans('frontend/reservations_trans.Recheck') }}</option>
                                    <option value="consultation">{{ trans('frontend/reservations_trans.Consultation') }}
                                    </option>
                                </select>
                                @error('res_type')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>

                    </div>


                    <button type="submit"
                        class="btn btn-success btn-md nextBtn btn-lg ">{{ trans('frontend/reservations_trans.Add') }}</button>


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

            // Perform an AJAX request to fetch the updated number of reservations
            $.ajax({
                url: "{{ URL::to('/appointment/get_res_slot_number') }}", // Replace with the actual URL to handle the AJAX request
                method: 'GET',
                data: {
                    date: selectedDate,
                },
                success: function(response) {

                    // Clear the existing options
                    $('select[name="reservation_number"]').empty();
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
