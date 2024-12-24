@extends('backend.dashboards.user.layouts.master')
@section('css')

@section('title')
    {{trans('backend/events_trans.Deleted_Events')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"></h4> {{trans('backend/events_trans.Deleted_Events')}}</h4>
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
                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th>{{trans('backend/events_trans.Id')}}</th>
                            <th>{{trans('backend/events_trans.Event_Title')}}</th>
                            <th>{{trans('backend/events_trans.Event_Date')}} </th>
                            <td>{{trans('backend/events_trans.Control')}}</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                        <tr>
                        <td>{{$event->id}}</td>
                        <td>{{$event->title}}</td>
                        <td>{{$event->start}}</td>
                            <td>
                               
                                <form action="{{Route('backend.events.restore',$event->id)}}" method="post" style="display:inline">
                                    @csrf
                                    @method('put')
                                    
                                    <button type="submit" class="btn btn-success btn-sm" >
                                        <i class="fa fa-edit"></i>
                                        {{trans('backend/events_trans.Restore')}}
                                    </button>   
                                </form>
                               

                                <form action="{{Route('backend.events.forceDelete',$event->id)}}" method="post" style="display:inline">
                                    @csrf
                                    @method('delete')
                                    
                                    <button type="submit" class="btn btn-danger btn-sm" >
                                        <i class="fa fa-trash"></i> 
                                         {{trans('backend/events_trans.Delete_Forever')}}
                                    </button>   
                                </form>

                                {{-- <a href="" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i> 
                                    
                                </a>     --}}
                            </td>
                            
                        </tr>
                        @endforeach
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
        var lang = "{{ App::getLocale() }}";
        var dataTableOptions = {
            responsive: true,
            columnDefs: [
                { responsivePriority: 1, targets: 1 },
                { responsivePriority: 2, targets: 2 },
                { responsivePriority: 3, targets: 3 },
                // Add more columnDefs for other columns, if needed
            ],
            oLanguage: {
                sZeroRecords: lang === 'ar' ? 'لا يوجد سجل متطابق' : 'No matching records found',
                sEmptyTable: lang === 'ar' ? 'لا يوجد بيانات في الجدول' : 'No data available in table',
                oPaginate: {
                    sFirst: lang === 'ar' ? "الأول" : "First",
                    sLast: lang === 'ar' ? "الأخير" : "Last",
                    sNext: lang === 'ar' ? "التالى" : "Next",
                    sPrevious: lang === 'ar' ? "السابق" : "Previous",
                },
            },
        };

        $('#table_id').DataTable(dataTableOptions);
    });
</script>
@endpush
