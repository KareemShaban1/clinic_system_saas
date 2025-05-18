@extends('backend.dashboards.clinic.layouts.master')
@section('css')

@section('title')
    {{ trans('backend/reservations_trans.Number_of_Reservations') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('backend/reservations_trans.Number_of_Reservations') }}</h4>
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

                <table id="table_id" class="table table-hover table-sm p-0">
                    <thead>
                        <tr>
                            <th>{{ trans('backend/reservations_trans.Reservation_Date') }}</th>
                            <th>{{ trans('backend/reservations_trans.Number_of_Reservations') }}</th>
                            <th>{{ trans('backend/reservations_trans.Control') }}</th>


                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($num_of_reservations as $number)
                            <tr>
                                <td>{{ $number->reservation_date }}</td>
                                <td>{{ $number->num_of_reservations }}</td>


                                <td>

                                    <a href="{{ Route('backend.num_of_reservations.edit', $number->id) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    {{-- <form action="{{Route('backend.reservations.destroy',$reservation->id)}}" method="post" style="display:inline">
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
            stateSave: true,
            sortable: true,
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0, 1]
                    }
                },

                'colvis'
            ],
            responsive: true,
            columnDefs: [{
                    responsivePriority: 1,
                    targets: 0
                },
                {
                    responsivePriority: 2,
                    targets: 1
                },
                {
                    responsivePriority: 3,
                    targets: 2
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
