@extends('backend.dashboards.clinic.layouts.master')
@section('css')

@section('title')
    {{ trans('backend/fees_trans.Today_Fees') }}
@stop
@endsection
@section('page-header')

<h4 class="page-title"> {{ trans('backend/fees_trans.Today_Fees') }}</h4>

@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <div class="row">
                    <div class="col-7 cost-span text-white"> {{ trans('backend/fees_trans.Today_Date') }}: {{ $current_date }} </div>

                    <div class="col-5 cost-span text-white"> 
                        {{ trans('backend/fees_trans.Total') }} : {{ $cost_sum }} جنية</div>
                </div>

                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th>{{ trans('backend/fees_trans.Id') }}</th>
                            <th>{{ trans('backend/fees_trans.Patient_Name') }}</th>
                            <th>{{ trans('backend/fees_trans.Reservation_Number') }}</th>
                            <th>{{ trans('backend/fees_trans.Reservation_Type') }}</th>
                            <th>{{ trans('backend/fees_trans.Payment') }}</th>
                            <th>{{ trans('backend/fees_trans.Cost') }}</th>
                            <th>{{ trans('backend/fees_trans.Total') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->id }}</td>
                                <td>{{ $reservation->patient->name }}</td>
                                <td>{{ $reservation->reservation_number }}</td>

                                <td>
                                    @if ($reservation->res_type == 'check')
                                        كشف
                                    @elseif ($reservation->res_type == 'recheck')
                                        اعادة كشف
                                    @elseif ($reservation->res_type == 'consultation')
                                        استشارة
                                    @endif
                                </td>

                                <td>

                                    @if ($reservation->payment == 'paid')
                                        <span class="badge badge-rounded badge-success">تم الدفع</span>
                                    @elseif ($reservation->payment == 'not paid')
                                        <span class="badge badge-rounded badge-danger"> لم يتم الدفع </span>
                                    @endif
                                </td>

                                <td>
                                    <span class="badge badge-rounded badge-info">{{ $reservation->cost }} جنية</span>
                                </td>
                                <td></td>


                            </tr>
                        @endforeach

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{ $cost_sum }}</td>
                        </tr>



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
