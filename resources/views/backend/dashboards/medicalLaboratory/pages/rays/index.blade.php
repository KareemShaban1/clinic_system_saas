@extends('backend.dashboards.medicalLaboratory.layouts.master')
@section('css')

@section('title')
    {{ trans('backend/rays_trans.rays') }}
@stop

@endsection

@section('page-header')

<h4 class="page-title"> {{ trans('backend/rays_trans.rays') }}</h4>

<a href="{{ Route('medicalLaboratory.rays.create') }}" class="btn btn-primary btn-sm">
    <span> {{ trans('backend/rays_trans.Add_Rays') }} <i class="fa fa-plus"></i></span>
</a>

@endsection

@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">


                <div class="table-responsive">
                    <table id="rays_table" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>{{ trans('backend/rays_trans.Id') }}</th>
                                <th>{{ trans('backend/rays_trans.Patient_Name') }}</th>
                                <th>{{ trans('backend/rays_trans.Control') }}</th>
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
    var table = $('#rays_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('medicalLaboratory.rays.data') }}",
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
