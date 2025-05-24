@extends('backend.dashboards.clinic.layouts.master')
@section('css')

@section('title')
{{ trans('backend/roles_trans.Roles') }}
@stop
@endsection
@section('page-header')
<h4 class="page-title">{{__('Roles')}}</h4>

<div class="page-title-right">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoleModal">
        <i class="mdi mdi-plus"></i> {{__('Add Role')}}
    </button>
</div>
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
                            <!-- <th>{{ trans('backend/roles_trans.Guard_Name') }}</th> -->
                            <th>{{ trans('backend/roles_trans.Permissions_Count') }}</th>
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

<!-- Add Role Modal -->
<div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('Add Role')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addRoleForm">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="addRoleName">{{__('Role Name')}}</label>
                        <input type="text" class="form-control" id="addRoleName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>{{__('Permissions')}}</label>
                        <div id="addPermissions">
                            <!-- Checkboxes loaded dynamically -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('Save Role')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Edit Role Modal -->
<div class="modal fade" id="editRoleModal" tabindex="-1" aria-labelledby="editRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('Edit Role')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editRoleForm">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="editRoleId">
                    <div class="form-group">
                        <label for="editRoleName">{{__('Role Name')}}</label>
                        <input type="text" class="form-control" id="editRoleName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="editPermissions">{{__('Permissions')}}</label>
                        <div id="editPermissions">
                        </div>
                        <!-- <select class="form-control" id="editPermissions" name="permissions[]" multiple>
                        </select> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('Save Changes')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteRoleModal" tabindex="-1" aria-labelledby="deleteRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('Delete Role')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{__('Are you sure you want to delete this role?')}}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteRole">{{__('Delete')}}</button>
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
                ajax: "{{ route('clinic.roles.data') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'permissions_count',
                        name: 'permissions_count'
                    },
                    // {
                    //     data: 'guard_name',
                    //     name: 'guard_name'
                    // },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    }
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

        // Helper function to render permissions with 6 per row
        function renderPermissions(containerId, permissions, selectedPermissions = []) {
            const container = $(`#${containerId}`);
            container.empty();

            for (let i = 0; i < permissions.length; i += 6) {
                const row = $('<div class="row mb-2"></div>');

                for (let j = i; j < i + 6 && j < permissions.length; j++) {
                    const permission = permissions[j];
                    const isChecked = selectedPermissions.includes(permission.id) ? 'checked' : '';
                    const col = $(`
                <div class="col-md-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" 
                               name="permissions[]" value="${permission.id}" 
                               id="perm${containerId}${permission.id}" ${isChecked}>
                        <label class="form-check-label" for="perm${containerId}${permission.id}">
                            ${permission.name}
                        </label>
                    </div>
                </div>
            `);
                    row.append(col);
                }

                container.append(row);
            }
        }

        // Load permissions dynamically when opening Add Role Modal
        $('#addRoleModal').on('show.bs.modal', function() {
            $.ajax({
                url: '/clinic/roles/permissions',
                type: 'GET',
                success: function(response) {
                    renderPermissions('addPermissions', response);

                }
            });
        });

        // Submit Add Role Form
        $('#addRoleForm').submit(function(e) {
            e.preventDefault();

            var formData = {
                _token: $('meta[name="csrf-token"]').attr('content'),
                name: $('#addRoleName').val(),
                permissions: $('input[name="permissions[]"]:checked').map(function() {
                    return $(this).val();
                }).get()
            };


            $.ajax({
                url: "{{ route('clinic.roles.store') }}",
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.status === 'success') {
                        $('#addRoleModal').modal('hide');
                        $('#roles_table').DataTable().ajax.reload();
                        alert(response.message);
                    }
                }
            });
        });
        // Open Edit Modal
        $(document).on('click', '.editRole', function() {
            var roleId = $(this).data('id');

            $.ajax({
                url: `/clinic/roles/edit/${roleId}`,
                type: 'GET',
                success: function(response) {
                    if (response.status === 'success') {
                        $('#editRoleId').val(roleId);
                        $('#editRoleName').val(response.role.name);

                        // Load permissions with checked items
                        renderPermissions('editPermissions', response.permissions, response.rolePermissions);


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
                permissions: $('input[name="permissions[]"]:checked').map(function() {
                    return $(this).val();
                }).get()
            };


            $.ajax({
                url: `/clinic/roles/update/${roleId}`,
                type: 'POST',
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