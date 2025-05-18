@extends('backend.dashboards.clinic.layouts.master')
@section('css')

@section('title')
    {{ trans('backend/reservations_trans.Trash_Reservations') }}
@stop

@endsection

@section('page-header')
<h4 class="page-title">{{ trans('backend/reservations_trans.Trash_Reservations') }}</h4>

@endsection

@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">


                <div class="table-trash_reservations_table">
                    <table id="trash_reservations_table" class="table table-hover table-sm p-0">
                        <thead>
                            <tr>
                                <th>{{ trans('backend/reservations_trans.Id') }}</th>
                                <th>{{ trans('backend/reservations_trans.Patient_Name') }}</th>
                                <th>{{ trans('backend/reservations_trans.Reservation_Type') }}</th>
                                <th>{{ trans('backend/reservations_trans.Payment') }}</th>
                                <th>{{ trans('backend/reservations_trans.Reservation_Status') }}</th>
                                <th>{{ trans('backend/reservations_trans.Acceptance') }}</th>
                                <th>{{ trans('backend/reservations_trans.Reservation_Date') }}</th>
                                <th>{{ trans('backend/reservations_trans.Control') }}</th>
                            </tr>
                        </thead>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
       // All Reservations Table
       var table = $('#trash_reservations_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('clinic.reservations.trash-data') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'patient.name',
                    name: 'patient.name'
                },
                {
                    data: 'res_type',
                    name: 'res_type'
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
                    data: 'res_status',
                    name: 'res_status'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }
            ],
            order: [[0, 'desc']],
            language: languages[language],
            pageLength: 10,
            responsive: true,
            drawCallback: function() {
                $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
            }
        });

    });
</script>
@endpush