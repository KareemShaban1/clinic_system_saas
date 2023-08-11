@extends('backend.layouts.master')
@section('css')

@section('title')
{{trans('backend/reservations_trans.Reservations')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('backend/reservations_trans.Reservations')}}</h4>
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
                            <th>{{trans('backend/reservations_trans.Reservation_Date')}}</th>
                            <th>{{trans('backend/reservations_trans.Start_Time')}}</th>
                            <th>{{trans('backend/reservations_trans.End_Time')}}</th>
                            <th>{{trans('backend/reservations_trans.Duration')}}</th>
                            <th>{{trans('backend/reservations_trans.Control')}}</th>

                            
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($reservation_slots as $slot)
                        <tr>
                        <td>{{$slot->date}}</td>
                        <td>{{$slot->start_time}}</td>
                        <td>{{$slot->end_time}}</td>
                        <td>{{$slot->duration}}</td>

                        <td>
                            
                            <a href="{{Route('backend.reservation_slots.edit',$slot->id)}}" class="btn btn-warning btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>
                            {{-- <form action="{{Route('backend.reservations.destroy',$reservation->reservation_id)}}" method="post" style="display:inline">
                                @csrf
                                @method('delete')
                                
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i> 
                                </button>   
                            </form>    --}}
                            
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
                { responsivePriority: 1, targets: 0 },
                { responsivePriority: 2, targets: 1 },
                { responsivePriority: 3, targets: 2 },
                { responsivePriority: 4, targets: 4 },
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
