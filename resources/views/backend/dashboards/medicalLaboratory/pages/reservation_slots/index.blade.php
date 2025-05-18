@extends('backend.dashboards.clinic.layouts.master')
@section('css')

@section('title')
{{trans('backend/reservations_trans.Reservation Slots')}}
@stop
@endsection
@section('page-header')

<h4 class="page-title">{{ trans('backend/reservations_trans.Reservation Slots') }}</h4>

@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <table id="reservation_slots_table" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>{{trans('backend/reservations_trans.Id')}}</th>
                            <th>{{trans('backend/reservations_trans.Reservation_Date')}}</th>
                            <th>{{trans('backend/reservations_trans.Start_Time')}}</th>
                            <th>{{trans('backend/reservations_trans.End_Time')}}</th>
                            <th>{{trans('backend/reservations_trans.Duration')}}</th>
                            <th>{{trans('backend/reservations_trans.Control')}}</th>


                        </tr>
                    </thead>

                </table>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@push('scripts')
<script>
    $(document).ready(function() {



        var table = $('#reservation_slots_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('clinic.reservation_slots.data') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'start_time',
                    name: 'start_time'
                },
                {
                    data: 'end_time',
                    name: 'end_time'
                },
                {
                    data: 'duration',
                    name: 'duration'
                },
                {
                    data: 'action',
                    name: 'action',
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
            "drawCallback": function() {
                $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
            }
        });
    });
</script>
@endpush