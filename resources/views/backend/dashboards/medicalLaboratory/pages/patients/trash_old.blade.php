@extends('backend.dashboards.clinic.layouts.master')
@section('css')

@section('title')
    {{trans('backend/patients_trans.Deleted_Patients')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('backend/patients_trans.Deleted_Patients')}}</h4>
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
                            <th>{{trans('backend/patients_trans.Id')}}</th>
                            <th>{{trans('backend/patients_trans.Patient_Name')}}</th>
                            <th>{{trans('backend/patients_trans.Phone')}}</th>
                            <th>{{trans('backend/patients_trans.Address')}}</th>
                            <th>{{trans('backend/patients_trans.Age')}}</th>
                            <th>{{trans('backend/patients_trans.Control')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($patients as $patient)
                        <tr>
                            <td>{{ $patient->id }}</td>
                            <td>{{ $patient->name }}</td>
                            <td>{{ $patient->phone }}</td>
                            <td>{{ $patient->address }}</td>
                            <td>{{ $patient->age }}</td>
                            <td>
                            

                                <form action="{{Route('backend.patients.restore',$patient->id)}}" method="post" style="display:inline">
                                    @csrf
                                    @method('put')
                                    
                                    <button type="submit" class="btn btn-success btn-sm" >
                                        <i class="fa fa-edit"></i>
                                        {{trans('backend/patients_trans.Restore')}}
                                    </button>   
                                </form>
                            
                                <form action="{{Route('backend.patients.forceDelete',$patient->id)}}" method="post" style="display:inline">
                                    @csrf
                                    @method('delete')
                                    
                                    <button type="submit" class="btn btn-danger btn-sm" >
                                        <i class="fa fa-trash"></i> 
                                        {{trans('backend/patients_trans.Delete_Forever')}}
                                    </button>   
                                </form>

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
                { responsivePriority: 3, targets: 5 },
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

