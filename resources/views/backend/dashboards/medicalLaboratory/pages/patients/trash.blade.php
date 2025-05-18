@extends('backend.dashboards.medicalLaboratory.layouts.master')
@section('css')

@section('title')
    {{trans('backend/patients_trans.Deleted_Patients')}}
@stop

@endsection

@section('page-header')

<h4 class="page-title">{{ trans('backend/patients_trans.Deleted_Patients') }}</h4>

@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <table id="trash_patients_table" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>{{trans('backend/patients_trans.Id')}}</th>
                            <th>{{trans('backend/patients_trans.Patient_Name')}}</th>
                            <th>{{trans('backend/patients_trans.Phone')}}</th>
                            <th>{{trans('backend/patients_trans.Address')}}</th>
                            <th>{{trans('backend/patients_trans.Age')}}</th>
                            <th>{{trans('backend/patients_trans.Control')}}</th>
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

var table = $('#trash_patients_table').DataTable({
    ajax: "{{ route('medicalLaboratory.patients.trash-data') }}",
    columns: [{
            data: 'id',
            name: 'id'
        },
        {
            data: 'name',
            name: 'name'
        },
        {
            data: 'phone',
            name: 'phone'
        },
        {
            data: 'address',
            name: 'address'
        },
        {
            data: 'age',
            name: 'age'
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

