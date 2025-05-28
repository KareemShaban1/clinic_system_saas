@extends('backend.dashboards.medicalLaboratory.layouts.master')
@section('css')

@section('title')
{{ trans('backend/medicalAnalysis_trans.medicalAnalysis') }}
@stop

@endsection

@section('page-header')

<h4 class="page-title"> {{ trans('backend/medicalAnalysis_trans.medicalAnalysis') }}</h4>

<a href="{{ route('medicalLaboratory.analysis.create') }}" class="btn btn-primary">{{ trans('backend/medicalAnalysis_trans.Add_Analysis') }}</a>

@endsection

@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">


                <div class="table-responsive">
                    <table id="analysis_table" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>{{ trans('backend/medicalAnalysis_trans.Id') }}</th>
                                <th>{{ trans('backend/medicalAnalysis_trans.Patient_Name') }}</th>
                                <th>{{ trans('backend/medicalAnalysis_trans.Service_Fee') }}</th>
                                <th>{{ trans('backend/medicalAnalysis_trans.Payment') }}</th>
                                <th>{{ trans('backend/medicalAnalysis_trans.Cost') }}</th>
                                <th>{{ trans('backend/medicalAnalysis_trans.Control') }}</th>
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
        var table = $('#analysis_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('medicalLaboratory.analysis.data') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'patient',
                    name: 'patient'
                },
                {
                    data: 'service_fee',
                    name: 'service_fee'
                },
                {
                    data: 'payment',
                    name: 'payment'
                },
                {
                    data: 'cost',
                    name: 'cost'
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