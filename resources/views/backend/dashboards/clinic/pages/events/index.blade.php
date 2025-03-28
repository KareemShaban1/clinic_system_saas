@extends('backend.dashboards.clinic.layouts.master')
@section('css')

@section('title')
{{trans('backend/events_trans.Events')}}
@stop
@endsection
@section('page-header')
<h4 class="page-title">{{trans('backend/events_trans.Events')}}</h4>


@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                

                <table id="events_table" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>{{trans('backend/events_trans.Id')}}</th>
                            <th>{{trans('backend/events_trans.Event_Title')}}</th>
                            <th>{{trans('backend/events_trans.Event_Date')}} </th>
                            <td>{{trans('backend/events_trans.Control')}}</td>
                            
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
        var table = $('#events_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('clinic.events.data') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'date',
                    name: 'date'
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