@extends('backend.dashboards.clinic.layouts.master')
@section('css')

@section('title')
{{ trans('backend/reservations_trans.Edit_Reservation') }}
@stop
@endsection
@section('page-header')
<h4 class="page-title"> {{ trans('backend/reservations_trans.Add_Reservation') }}</h4>
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

                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label
                                    class="form-control-label">{{ trans('backend/reservations_trans.Patient_Name') }}</label>
                                <input type="text" disabled value="{{ $reservation->patient->name }}" class="form-control">
                            </div>
                        </div>

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

                        <!-- <div class="col-md-4">
                            <div class="form-group">
                                <label> {{ trans('backend/reservations_trans.Cost') }}<span
                                        class="text-danger">*</span></label>
                                <input class="form-control" value="{{ old('cost', $reservation->cost) }}"
                                    name="cost" type="number">

                            </div>
                        </div> -->

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

                    <div id="service-fee-container">
                        <button type="button" class="btn btn-primary mt-3" id="add-service-fee">{{ __('Add Service Fee') }}</button>

                        @forelse ($reservation->serviceFees as $index => $serviceFee)
                        
                        <div class="service-fee-row">
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label>{{ __('Service Name') }}</label>
                                    <select name="service_fee_id[]" class="service-fee-select form-control p-0">
                                        <option value="">{{ __('Select Service') }}</option>
                                        @foreach (App\Models\ServiceFee::all() as $fee)
                                        <option value="{{ $fee->id }}"
                                            data-fee="{{ $fee->fee }}"
                                            data-notes="{{ $fee->notes }}"
                                            {{ $serviceFee->id == $fee->id ? 'selected' : '' }}>
                                            {{ $fee->service_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>{{ __('Fee') }}</label>
                                    <input type="number" class="form-control service-fee-input" name="service_fee[]" value="{{ $serviceFee->fee }}">
                                </div>
                                <div class="col-md-3">
                                    <label>{{ __('Notes') }}</label>
                                    <textarea name="service_fee_notes[]" class="form-control service-fee-notes">{{ $serviceFee->pivot->notes }}</textarea>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-danger remove-service-fee mt-2">{{ __('Remove') }}</button>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="service-fee-row">
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label>{{ __('Service Name') }}</label>
                                    <select name="service_fee_id[]" class="service-fee-select form-control p-0">
                                        <option value="">{{ __('Select Service Fee') }}</option>
                                        @foreach (App\Models\ServiceFee::all() as $fee)
                                        <option value="{{ $fee->id }}"
                                            data-fee="{{ $fee->fee }}"
                                            data-notes="{{ $fee->notes }}">
                                            {{ $fee->service_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>{{ __('Fee') }}</label>
                                    <input type="number" class="form-control service-fee-input" name="service_fee[]">
                                </div>
                                <div class="col-md-3">
                                    <label>{{ __('Notes') }}</label>
                                    <textarea name="service_fee_notes[]" class="form-control service-fee-notes"></textarea>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-danger remove-service-fee mt-2">{{ __('Remove') }}</button>
                                </div>
                            </div>
                        </div>
                        @endforelse
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
                                {{ old('final_diagnosis', $reservation->final_diagnosis) }}
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
@push('scripts')

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

        $(document).on('click', '.remove-service-fee', function() {
            $(this).closest('.service-fee-row').remove();
        });
    });


    document.addEventListener("DOMContentLoaded", function() {
        const serviceFeeContainer = document.querySelector("#service-fee-container");

        // Handle service fee selection
        serviceFeeContainer.addEventListener("change", function(event) {
            if (event.target.classList.contains("service-fee-select")) {
                let selectedOption = event.target.options[event.target.selectedIndex];
                let row = event.target.closest(".row");
                let feeInput = row.querySelector(".service-fee-input");
                let notesInput = row.querySelector(".service-fee-notes");

                feeInput.value = selectedOption.getAttribute("data-fee") || "";
                notesInput.value = selectedOption.getAttribute("data-notes") || "";
            }
        });

        // Handle adding a new service fee row
        document.querySelector("#add-service-fee").addEventListener("click", function() {
            let originalRow = document.querySelector(".service-fee-row");
            let newRow = originalRow.cloneNode(true);

            // Reset input values
            newRow.querySelector(".service-fee-select").value = "";
            newRow.querySelector(".service-fee-input").value = "";
            newRow.querySelector(".service-fee-notes").value = "";

            // Append the new row inside the container
            serviceFeeContainer.appendChild(newRow);
        });

        // Handle removing a service fee row
        serviceFeeContainer.addEventListener("click", function(event) {
            if (event.target.classList.contains("remove-service-fee")) {
                let row = event.target.closest(".service-fee-row");
                if (document.querySelectorAll(".service-fee-row").length > 1) {
                    row.remove();
                }
            }
        });
    });
</script>
@endpush