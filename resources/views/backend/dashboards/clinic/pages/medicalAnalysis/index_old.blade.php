@extends('backend.dashboards.clinic.layouts.master')
@section('css')

@section('title')
{{ trans('backend/medicalAnalysis_trans.medicalAnalysis') }}
@stop

@endsection

@section('page-header')

<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('backend/medicalAnalysis_trans.medicalAnalysis') }}</h4>
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
                    <table id="analysis_table" class="table table-hover table-sm p-0">
                        <thead>
                            <tr>
                                <th>{{ trans('backend/medicalAnalysis_trans.Id') }}</th>
                                <th>{{ trans('backend/medicalAnalysis_trans.Patient_Name') }}</th>
                                <th>{{ trans('backend/medicalAnalysis_trans.Control') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($medicalAnalysis as $analysis)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $analysis->patient->name }}</td>






                                <td>
                                    <div class="res_control">
                                        <a href="{{ Route('backend.analysis.show', $analysis->id) }}"
                                            class="btn btn-primary btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ Route('backend.analysis.edit', $analysis->id) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form
                                            action="{{ Route('backend.analysis.destroy', $analysis->id) }}"
                                            method="post" style="display:inline">
                                            @csrf
                                            @method('delete')

                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>



                            </tr>
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
            columnDefs: [

                {
                    responsivePriority: 1,
                    targets: 1
                },
                {
                    responsivePriority: 2,
                    targets: 5
                },
                {
                    responsivePriority: 3,
                    targets: 6
                },
                {
                    responsivePriority: 4,
                    targets: 10
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

        $('#analysis_table').DataTable(dataTableOptions);
    });
</script>
@endpush