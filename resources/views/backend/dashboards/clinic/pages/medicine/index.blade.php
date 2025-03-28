@extends('backend.dashboards.clinic.layouts.master')
@section('css')

@section('title')
    {{ trans('backend/medicines_trans.Medicines') }}
@stop
@endsection
@section('page-header')

<h4 class="page-title"> {{ trans('backend/medicines_trans.Medicines') }}</h4>

@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div
                    style="  display: flex;
                align-items: center; 
                justify-content:left;
                ">
                    <div style="margin:5px; height:50px; width:150px; background-color:bisque;  position: relative;">
                        <a style=" margin: 0;
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%); "
                            href="https://go.drugbank.com/" target="blank"> Drug Bank </a>
                    </div>
                    <div style="margin:5px; height:50px; width:150px; background-color:bisque;  position: relative;">
                        <a style=" margin: 0;
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);"
                            href="https://www.webteb.com/drug" target="blank"> Web Teb </a>
                    </div>
                </div>


                <br><br>



                <div class="table-responsive">
                    <table id="medicine_table" class="table table-hover table-sm p-0">
                        <thead>
                            <tr>
                                <th style="width: 100px">{{ trans('backend/medicines_trans.Id') }}</th>
                                <th style="width: 150px">{{ trans('backend/medicines_trans.DrugBank_Id') }}</th>
                                <th style="width: 150px">{{ trans('backend/medicines_trans.Drug_Name') }}</th>
                                <th style="width: 150px">{{ trans('backend/medicines_trans.Brand_Name') }}</th>
                                <th style="width: 150px">{{ trans('backend/medicines_trans.Drug_Dose') }}</th>
                                <th style="width: 250px">{{ trans('backend/medicines_trans.Categories') }}</th>
                                <th style="width: 150px">{{ trans('backend/medicines_trans.Control') }}</th>
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
        var table = $('#medicine_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('clinic.medicines.data') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'drugbank_id',
                    name: 'drugbank_id' 
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'brand_name',
                    name: 'brand_name'
                },
                {
                    data: 'drug_dose',
                    name: 'drug_dose'
                },
                {
                    data: 'categories',
                    name: 'categories'
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
