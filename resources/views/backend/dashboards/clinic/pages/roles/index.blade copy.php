@extends('backend.dashboards.clinic.layouts.master')
@section('css')

@section('title')
    {{ trans('backend/roles_trans.Roles') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('backend/roles_trans.Roles') }}</h4>
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
                            <th>{{ trans('backend/roles_trans.Id') }}</th>
                            <th>{{ trans('backend/roles_trans.Role_Name') }}</th>
                            <th>{{ trans('backend/roles_trans.Guard_Name') }}</th>
                            <th>{{ trans('backend/roles_trans.Number_Of_Permissions') }}</th>
                            <th>{{ trans('backend/roles_trans.Control') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->guard_name }}</td>
                                <td>
                                    @php
                                        $permissions_count = Spatie\Permission\Models\Permission::join('role_has_permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                                            ->where('role_has_permissions.role_id', $role->id)
                                            ->count();

                                    @endphp
                                    {{ $permissions_count }}
                                </td>

                                <td>

                                    <a href="{{ Route('clinic.roles.edit', $role->id) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>


                                    {{-- <form action="{{Route('clinic.patients.destroy',$patient->id)}}" method="post" style="display:inline">
                                    @csrf
                                    @method('delete')
                                    
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> 
                                    </button>   
                                </form> --}}

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
            columnDefs: [{
                    responsivePriority: 1,
                    targets: 1
                },
                {
                    responsivePriority: 2,
                    targets: 2
                },
                {
                    responsivePriority: 3,
                    targets: 3
                },
                // {
                //     responsivePriority: 4,
                //     targets: 6
                // },
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
