@extends('backend.dashboards.clinic.layouts.master')
@section('css')

@section('title')
    {{ trans('backend/rays_trans.rays') }}
@stop

@endsection

@section('page-header')

<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('backend/rays_trans.rays') }}</h4>
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
                    <table id="rays_table" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>{{ trans('backend/rays_trans.Id') }}</th>
                                <th>{{ trans('backend/rays_trans.Patient_Name') }}</th>
                                <th>{{ trans('backend/rays_trans.Control') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($rays as $ray)
                           
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $ray->patient->name }}</td>
                                    <td>
                                        <div class="res_control">
                                            <a href="{{ Route('backend.rays.show', $ray->id) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ Route('backend.rays.edit', $ray->id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form
                                                action="{{ Route('backend.rays.destroy', $ray->id) }}"
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

    $('#rays_table').DataTable({
        stateSave: true,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: { columns: [0, 1, 2] }
            },
            {
                extend: 'excelHtml5',
                exportOptions: { columns: [0, 1] }
            },
            'colvis'
        ],
        responsive: true,
        columnDefs: [
            { responsivePriority: 1, targets: 0 }, // Adjust as needed
            { responsivePriority: 2, targets: 1 },
            { responsivePriority: 3, targets: 2 }
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
    });
});

</script>
@endpush
