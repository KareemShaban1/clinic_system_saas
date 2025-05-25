@extends('backend.dashboards.clinic.layouts.master')
@section('css')

@section('title')
{{ trans('backend/reservations_trans.Reservations') }}
@stop

@endsection

@section('page-header')
<h4 class="page-title">{{ trans('backend/reservations_trans.Reservations') }}</h4>
@endsection

@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <!-- Tabs -->
                <ul class="nav nav-tabs" id="reservationTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="today-reservations-tab" data-bs-toggle="tab" href="#today-reservations" role="tab" aria-controls="today-reservations" aria-selected="false">
                            {{ trans('backend/reservations_trans.Today_Reservations') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="all-reservations-tab" data-bs-toggle="tab" href="#all-reservations" role="tab" aria-controls="all-reservations" aria-selected="true">
                            {{ trans('backend/reservations_trans.All_Reservations') }}
                        </a>
                    </li>

                </ul>

                <div class="tab-content mt-4">
                    <!-- Today's Reservations Tab -->
                    <div class="tab-pane fade" id="today-reservations" role="tabpanel" aria-labelledby="today-reservations-tab">
                        <div class="table-responsive">
                            <table id="today_reservations_table" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>{{ trans('backend/reservations_trans.Id') }}</th>
                                        <th>{{ trans('backend/reservations_trans.Patient_Name') }}</th>
                                        <th>{{ trans('backend/reservations_trans.Reservation_Type') }}</th>
                                        <th>{{ trans('backend/reservations_trans.Payment') }}</th>
                                        <th>{{ trans('backend/reservations_trans.Reservation_Status') }}</th>
                                        <th>{{ trans('backend/reservations_trans.Acceptance') }}</th>
                                        <th>{{ trans('backend/reservations_trans.Reservation_Date') }}</th>

                                        <!-- <th>{{ trans('backend/reservations_trans.Rays') }}</th> -->

                                        <!-- <th>{{ trans('backend/reservations_trans.Analysis') }}</th> -->

                                        <th>{{ trans('backend/reservations_trans.Chronic_Diseases') }}</th>
                                        <th>{{ trans('backend/reservations_trans.Glasses_Distance') }}</th>
                                        <th>{{ trans('backend/reservations_trans.Prescription') }}</th>
                                        <th>{{ trans('backend/reservations_trans.Control') }}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <!-- All Reservations Tab -->
                    <div class="tab-pane fade show active" id="all-reservations" role="tabpanel" aria-labelledby="all-reservations-tab">
                        <div class="table-responsive">
                            <table id="reservations_table" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>{{ trans('backend/reservations_trans.Id') }}</th>
                                        <th>{{ trans('backend/reservations_trans.Patient_Name') }}</th>
                                        <th>{{ trans('backend/reservations_trans.Reservation_Type') }}</th>
                                        <th>{{ trans('backend/reservations_trans.Payment') }}</th>
                                        <th>{{ trans('backend/reservations_trans.Reservation_Status') }}</th>
                                        <th>{{ trans('backend/reservations_trans.Acceptance') }}</th>
                                        <th>{{ trans('backend/reservations_trans.Reservation_Date') }}</th>

                                        <!-- <th>{{ trans('backend/reservations_trans.Rays') }}</th> -->

                                        <!-- <th>{{ trans('backend/reservations_trans.Analysis') }}</th> -->

                                        <th>{{ trans('backend/reservations_trans.Chronic_Diseases') }}</th>
                                        <th>{{ trans('backend/reservations_trans.Glasses_Distance') }}</th>
                                        <th>{{ trans('backend/reservations_trans.Prescription') }}</th>
                                        <th>{{ trans('backend/reservations_trans.Control') }}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection

@push('scripts')
<script>
    let reservationsTable;
    let todayReservationsTable;
    $(document).ready(function() {
        // All Reservations Table
        reservationsTable = $('#reservations_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('clinic.reservations.data') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'patient.name',
                    name: 'patient.name'
                },
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'payment',
                    name: 'payment',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'acceptance',
                    name: 'acceptance',
                    orderable: false,
                    searchable: false
                },

                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                // {
                //     data: 'ray_action',
                //     name: 'ray_action',
                //     orderable: false,
                //     searchable: false
                // },
                // {
                //     data: 'analysis_action',
                //     name: 'analysis_action',
                //     orderable: false,
                //     searchable: false
                // },
                {
                    data: 'chronic_disease_action',
                    name: 'chronic_disease_action',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'glasses_distance_action',
                    name: 'glasses_distance_action',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'prescription_action',
                    name: 'prescription_action',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }
            ],
            order: [
                [0, 'desc']
            ],
            language: languages[language],
            pageLength: 10,
            responsive: true,
            drawCallback: function() {
                $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
            }
        });

        // Today's Reservations Table
        todayReservationsTable = $('#today_reservations_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('clinic.reservations.data') }}",
                data: function(d) {
                    d.date = "{{ now()->toDateString() }}"; // Send today's date as a parameter
                }
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'patient.name',
                    name: 'patient.name'
                },
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'payment',
                    name: 'payment',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'acceptance',
                    name: 'acceptance',
                    orderable: false,
                    searchable: false
                },

                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                // {
                //     data: 'ray_action',
                //     name: 'ray_action',
                //     orderable: false,
                //     searchable: false
                // },
                // {
                //     data: 'analysis_action',
                //     name: 'analysis_action',
                //     orderable: false,
                //     searchable: false
                // },
                {
                    data: 'chronic_disease_action',
                    name: 'chronic_disease_action',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'glasses_distance_action',
                    name: 'glasses_distance_action',
                    orderable: false,
                    searchable: false

                },
                
                {
                    data: 'prescription_action',
                    name: 'prescription_action',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }
            ],
            order: [
                [0, 'desc']
            ],
            language: languages[language],
            pageLength: 10,
            responsive: true,
            drawCallback: function() {
                $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
            }
        });
    });

    $(document).on('change', '.res-status-select', function() {
        var reservationId = $(this).data('reservation-id');
        var newStatus = $(this).val();

        $.ajax({
            url: '/clinic/reservations_options/status/' + reservationId,
            type: 'POST',
            data: {
                status: newStatus,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: response.message,

                });
                reservationsTable.ajax.reload();
                todayReservationsTable.ajax.reload();

            },
            error: function(xhr) {
                alert('Error: ' + xhr.responseText); // Display error message
            }
        });
    });
</script>
@endpush