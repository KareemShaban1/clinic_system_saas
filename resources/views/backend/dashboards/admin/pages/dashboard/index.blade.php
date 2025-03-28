@extends('backend.dashboards.admin.layouts.master')

@section('title')
    {{ trans('backend/dashboard_trans.Dashboard') }}
@endsection

@section('css')
    <style type="text/css">
        a[disabled="disabled"] {
            pointer-events: none;
        }
    </style>
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-12">
                <h4 class="mb-0"> {{ trans('backend/dashboard_trans.Dashboard') }} </h4>
            </div>

            @if (config('app.env') !== 'production')
                <div class="col-md-4 col-sm-4 col-12">
                    <a href="{{ route('clinic.logs') }}" target="blank">
                        Logs
                    </a>
                </div>
            @endif

        </div>
    </div>
    <!-- breadcrumb -->
@endsection



@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 col-sm-12 mb-30">
            <div class="card card-statistics ">
                <div class="card-body" style="background: white">

                    @include('backend.dashboards.admin.pages.dashboard.reservations_add')

                   


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
                        url: "{{ URL::to('/clinic/reservations/get_res_slot_number_add') }}", // Replace with the actual URL to handle the AJAX request
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
