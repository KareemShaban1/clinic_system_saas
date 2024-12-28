@extends('backend.dashboards.user.layouts.master')
@section('css')
@section('title')
    {{ trans('backend/online_reservations_trans.All_Online_Reservations') }}@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> {{ trans('backend/online_reservations_trans.All_Online_Reservations') }}</h4>
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


                    <div class="table-responsive">
                        <table id="table_id" class="table table-hover table-sm p-0">
                            <thead>
                                <tr class="alert-success">
                                    <th>#</th>
                                    <th>{{ trans('backend/online_reservations_trans.User_Name') }}</th>
                                    <th>{{ trans('backend/online_reservations_trans.Patient_Name') }} </th>
                                    <th>{{ trans('backend/online_reservations_trans.Title') }} </th>
                                    <th>{{ trans('backend/online_reservations_trans.Time_Date') }} </th>
                                    <th>{{ trans('backend/online_reservations_trans.Duration') }}</th>
                                    <th>{{ trans('backend/online_reservations_trans.Link') }}</th>
                                    <th>{{ trans('backend/online_reservations_trans.Controls') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($online_reservations as $online_reservation)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ $online_reservation->created_by }}</td>
                                        <td>{{ $online_reservation->patient->name }}</td>
                                        <td>{{ $online_reservation->topic }}</td>
                                        <td>{{ $online_reservation->start_at }}</td>
                                        <td>{{ $online_reservation->duration }}</td>
                                        <td class="text-danger"><a href="{{ $online_reservation->join_url }}"
                                                target="_blank">انضم الان</a></td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#Delete_receipt{{ $online_reservation->meeting_id }}"><i
                                                    class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    @include('backend.dashboards.user.pages.online_reservations.delete')
                                @endforeach
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
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },

                    'colvis'
                ],
                responsive: true,
                columnDefs: [{
                        responsivePriority: 1,
                        targets: 2
                    },
                    {
                        responsivePriority: 2,
                        targets: 4
                    },
                    {
                        responsivePriority: 3,
                        targets: 6
                    },
                    {
                        responsivePriority: 4,
                        targets: 7
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
