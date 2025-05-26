@extends('backend.dashboards.medicalLaboratory.layouts.master')
@section('css')
<style>
    tfoot input {
        width: 70%;
        padding: 3px;
        box-sizing: border-box;
    }
</style>
@section('title')
{{ trans('backend/patients_trans.Patients') }}
@stop
@endsection
@section('page-header')

<h4 class="page-title">{{ trans('backend/patients_trans.Patients') }}</h4>

@endsection

@section('content')

<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <div class="table-responsive p-0">
                    <table id="patients_table" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>{{ trans('backend/patients_trans.Id') }}</th>
                                <th>{{ trans('backend/patients_trans.Patient_Name') }}</th>
                                <th>{{ trans('backend/patients_trans.Number_of_Reservations') }}</th>
                                <th>{{ trans('backend/patients_trans.Email') }}</th>
                                <th>{{ trans('backend/patients_trans.Phone') }}</th>
                                <th>{{ trans('backend/patients_trans.Address') }}</th>
                                <th>{{ trans('backend/patients_trans.Age') }}</th>
                                <th>{{ trans('backend/patients_trans.Add_Analysis') }}</th>
                                <!-- <th>{{ trans('backend/patients_trans.Add_Online_Reservation') }}</th> -->
                                <th>{{ trans('backend/patients_trans.Patient_Card') }}</th>
                                <th>{{ trans('backend/patients_trans.Control') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                          
                        </tbody>


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

        var table = $('#patients_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('medicalLaboratory.patients.data') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'number_of_reservations',
                    name: 'number_of_reservations',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'email',
                    name: 'email'
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
                    data: 'add_analysis',
                    name: 'add_analysis'
                },
              
                {
                    data: 'patient_card',
                    name: 'patient_card',
                    orderable: false,
                    searchable: false
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