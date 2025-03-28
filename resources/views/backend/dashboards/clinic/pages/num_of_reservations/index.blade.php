@extends('backend.dashboards.clinic.layouts.master')
@section('css')

@section('title')
    {{ trans('backend/reservations_trans.Number_of_Reservations') }}
@stop
@endsection
@section('page-header')
<h4 class="page-title">{{ trans('backend/reservations_trans.Number_of_Reservations') }}</h4>
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <table id="num_of_reservations_table" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                        <th>{{ trans('backend/reservations_trans.Id') }}</th>
                            <th>{{ trans('backend/reservations_trans.Reservation_Date') }}</th>
                            <th>{{ trans('backend/reservations_trans.Number_of_Reservations') }}</th>
                            <th>{{ trans('backend/reservations_trans.Control') }}</th>


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
    
        var table = $('#num_of_reservations_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('clinic.num_of_reservations.data') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'reservation_date',
                    name: 'reservation_date'
                },
                {
                    data: 'num_of_reservations',
                    name: 'num_of_reservations'
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
