@extends('backend.dashboards.clinic.layouts.master')
@section('css')

@section('title')
    {{trans('backend/glasses_distance_trans.Glasses_Distance')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{trans('backend/glasses_distance_trans.Glasses_Distance')}}</h4>
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

                <table id="glasses_distances_table" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>{{trans('backend/glasses_distance_trans.Id')}}</th>
                            <th>{{trans('backend/glasses_distance_trans.Patient')}}</th>

                            <th>{{trans('backend/glasses_distance_trans.Control')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
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

        var table = $('#glasses_distances_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('clinic.glasses_distance.data') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'patient',
                    name: 'patient'
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
