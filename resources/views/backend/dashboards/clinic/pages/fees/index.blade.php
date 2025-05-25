@extends('backend.dashboards.clinic.layouts.master')

@section('title')
{{ trans('backend/fees_trans.Fees') }}
@endsection

@section('css')
<!-- Add any CSS if needed -->
@endsection

@section('page-header')
<h4 class="page-title"> {{ trans('backend/fees_trans.Fees') }}</h4>
@endsection

@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="btn-group" role="group" aria-label="Filter">
                                <button class="btn btn-primary filter-btn" data-filter="today">{{ trans('backend/fees_trans.Today') }}</button>
                                <button class="btn btn-info filter-btn" data-filter="week">{{ trans('backend/fees_trans.This_Week') }}</button>
                                <button class="btn btn-success filter-btn" data-filter="month">{{ trans('backend/fees_trans.This_Month') }}</button>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <input type="date" id="start_date" class="form-control" placeholder="Start Date">
                                </div>
                                <div class="col-md-4">
                                    <input type="date" id="end_date" class="form-control" placeholder="End Date">
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-dark" id="custom_filter">{{ trans('backend/fees_trans.Apply_Filter') }}</button>
                                </div>
                            </div>
                        </div>
                </div>





                <table id="fees_table" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>{{ trans('backend/fees_trans.Id') }}</th>
                            <th>{{ trans('backend/fees_trans.Patient_Name') }}</th>
                            <th>{{ trans('backend/fees_trans.Reservation_Number') }}</th>
                            <th>{{ trans('backend/fees_trans.Date') }}</th>
                            <th>{{ trans('backend/fees_trans.Payment') }}</th>
                            <th>{{ trans('backend/fees_trans.Cost') }}</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th colspan="5" class="text-end">{{ trans('backend/fees_trans.Total') }}</th>
                            <th id="totalCostCell">0</th>
                        </tr>
                    </tfoot>
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
        const language = "{{ app()->getLocale() }}";

        const table = $('#fees_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('clinic.fees.data') }}",
                data: function(d) {
                    d.filter = $('#filter_type').val();
                    d.start_date = $('#start_date').val();
                    d.end_date = $('#end_date').val();
                }
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'patient_name',
                    name: 'patient_name'
                },
                {
                    data: 'reservation_number',
                    name: 'reservation_number'
                },
                {
                    data: 'date',
                    name: 'date',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'payment',
                    name: 'payment',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'cost',
                    name: 'cost'
                }
            ],
            order: [
                [0, 'desc']
            ],
            language: languages[language],
            pageLength: 10,
            responsive: true,
            drawCallback: function(settings) {
                $('.dataTables_paginate > .pagination').addClass('pagination-rounded');

                // ✅ Update footer with total cost
                let response = settings.json;
                if (response && response.total_cost !== undefined) {
                    $('#totalCostCell').text(response.total_cost + ' {{ trans("backend/fees_trans.Currency") }}');
                }
            }
        });

        // Store filter in hidden input
        $('<input>').attr({
            type: 'hidden',
            id: 'filter_type',
            value: 'today'
        }).appendTo('body');

        $('.filter-btn').on('click', function() {
            $('#filter_type').val($(this).data('filter'));
            $('#start_date').val('');
            $('#end_date').val('');
            table.ajax.reload();
        });

        $('#custom_filter').on('click', function() {
            $('#filter_type').val('custom');
            table.ajax.reload();
        });
    });
</script>

@endpush