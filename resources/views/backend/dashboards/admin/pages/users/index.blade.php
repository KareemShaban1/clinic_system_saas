@extends('backend.dashboards.admin.layouts.master')
@section('css')

@section('title')
    {{ trans('backend/users_trans.Users') }}
@stop
@endsection

@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('backend/users_trans.Users') }}</h4>
        </div>
        <div class="col-sm-6 text-end">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal">
                <i class="fa fa-plus"></i> Add User
            </button>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <table id="users_table" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>{{__('ID')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Email')}}</th>
                            <th>{{__('Clinic')}}</th>
                            <th>{{__('Roles')}}</th>
                            <th>{{__('Actions')}}</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addUserForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Name:</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Email:</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Password:</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Roles:</label>
                        <select name="roles[]" class="form-control" multiple required>
                            @foreach($roles as $role)
                                <option value="{{ $role }}">{{ $role }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        loadUsers();

        function loadUsers() {
            $('#users_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.users.data') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'clinic', name: 'clinic' },
                    { data: 'roles', name: 'roles', orderable: false, searchable: false },
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

        $('#addUserForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('admin.users.store') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    $('#addUserModal').modal('hide');
                    $('#addUserForm')[0].reset();
                    $('#users_table').DataTable().ajax.reload();
                    alert('User added successfully!');
                },
                error: function(xhr) {
                    alert('Error adding user!');
                }
            });
        });
    });
</script>
@endpush
