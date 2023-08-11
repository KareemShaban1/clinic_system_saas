@extends('backend.layouts.master')
@section('css')

@section('title')
{{ trans('backend/fees_trans.All_Fees') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('backend/fees_trans.All_Fees') }} </h4>
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

                {{-- <div class="row">
                <div class="col-6 cost-span text-white">  تاريخ اليوم : {{$current_date}} </div>

                <div class="col-6 cost-span text-white">  الإجمالى : {{$cost_sum}} </div>
                </div> --}}

                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>الاسم</th>
                            <th>رقم الكشف</th>
                            <th>نوع الكشف</th>
                            <th>تاريخ الكشف</th>
                            <th>حالة الدفع</th>
                            <th>المبلغ</th>

                            
                           
                            
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($reservations as $reservation)
                        <tr>
                        <td>{{$reservation->reservation_id}}</td>
                        <td>{{$reservation->patient->name}}</td>
                        <td>{{$reservation->res_num}}</td>

                        <td>
                           @if ( $reservation->res_type == "check" )
                            كشف
                            @elseif ( $reservation->res_type == "recheck")
                            اعادة كشف
                            @elseif ( $reservation->res_type == "consultation")
                            استشارة
                            @endif
                        </td>

                        <td>{{$reservation->res_date}}</td>

                        <td>
                            
                            @if ( $reservation->payment == "paid" )
                             <span class="badge badge-rounded badge-success">تم الدفع</span> 
                             @elseif ( $reservation->payment == "not paid")
                             <span class="badge badge-rounded badge-danger"> لم يتم الدفع </span>
                             @endif
                         </td>

                        <td>
                            <span class="badge badge-rounded badge-info">{{$reservation->cost}}</span>
                        </td>

                        
                    </tr>

                    @endforeach
                    
                    {{-- <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{$cost_sum}}</td>
                    </tr> --}}

                        
                        
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
            columnDefs: [{
                    responsivePriority: 1,
                    targets: 1
                },
                {
                    responsivePriority: 2,
                    targets: 4
                },
                {
                    responsivePriority: 3,
                    targets: 5
                },
                {
                    responsivePriority: 4,
                    targets: 6
                },
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
