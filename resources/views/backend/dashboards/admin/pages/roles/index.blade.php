@extends('backend.dashboards.admin.layouts.master')
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

                <table id="roles_table" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>{{ trans('backend/roles_trans.Id') }}</th>
                            <th>{{ trans('backend/roles_trans.Role_Name') }}</th>
                            <th>{{ trans('backend/roles_trans.Guard_Name') }}</th>
                            <!-- <th>{{ trans('backend/roles_trans.Number_Of_Permissions') }}</th> -->
                            <th>{{ trans('backend/roles_trans.Control') }}</th>
                        </tr>
                    </thead>
                    <tbody>
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
        loadRoles();

        function loadRoles() {
            $('#roles_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.roles.data') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'guard_name', name: 'guard_name' },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false }
                ],
                order: [
                [0, 'desc']
            ],
            buttons: [{
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1]
                    }
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    title: 'Specialities Data',
                    exportOptions: {
                        columns: [0, 1]
                    }
                },
                {
                    extend: 'copy',
                    exportOptions: {
                        columns: [0, 1]
                    },
                },
            ],

            dom: '<"d-flex justify-content-between align-items-center mb-3"lfB>rtip',
            pageLength: 10,
            responsive: true,
            language: languages[language],
            "drawCallback": function() {
                $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
            }
            });
        }

         // Open Edit Modal
         $(document).on('click', '.editRole', function() {
            var roleId = $(this).data('id');

            $.ajax({
                url: `/clinic/roles/${roleId}/edit`,
                type: 'GET',
                success: function(response) {
                    if (response.status === 'success') {
                        $('#editRoleId').val(roleId);
                        $('#editRoleName').val(response.role.name);

                        // Load permissions into the select dropdown
                        $('#editPermissions').empty();
                        $.each(response.permissions, function(index, permission) {
                            $('#editPermissions').append(`<option value="${permission.id}" ${response.rolePermissions.includes(permission.id) ? 'selected' : ''}>${permission.name}</option>`);
                        });

                        $('#editRoleModal').modal('show');
                    }
                }
            });
        });

        // Submit Edit Role Form
        $('#editRoleForm').submit(function(e) {
            e.preventDefault();

            var roleId = $('#editRoleId').val();
            var formData = {
                _token: $('meta[name="csrf-token"]').attr('content'),
                name: $('#editRoleName').val(),
                permission: $('#editPermissions').val(),
            };

            $.ajax({
                url: `/clinic/roles/${roleId}`,
                type: 'PUT',
                data: formData,
                success: function(response) {
                    if (response.status === 'success') {
                        $('#editRoleModal').modal('hide');
                        $('#roles_table').DataTable().ajax.reload();
                        alert(response.message);
                    }
                }
            });
        });

        // Open Delete Confirmation Modal
        $(document).on('click', '.deleteRole', function() {
            var roleId = $(this).data('id');
            $('#confirmDeleteRole').data('id', roleId);
            $('#deleteRoleModal').modal('show');
        });

        // Confirm Delete
        $('#confirmDeleteRole').click(function() {
            var roleId = $(this).data('id');

            $.ajax({
                url: `/clinic/roles/${roleId}`,
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status === 'success') {
                        $('#deleteRoleModal').modal('hide');
                        $('#roles_table').DataTable().ajax.reload();
                        alert(response.message);
                    }
                }
            });
        });

    });
</script>
@endpush
