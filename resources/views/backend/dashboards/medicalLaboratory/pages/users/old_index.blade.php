@extends('backend.dashboards.clinic.layouts.master')
@section('css')

@section('title')
{{ trans('backend/users_trans.Users') }}
@stop
@endsection

@section('page-header')
<h4 class="page-title">{{__('Users')}}</h4>

<div class="page-title-right">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
        <i class="mdi mdi-plus"></i> {{__('Add User')}}
    </button>
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
                @csrf
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
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ trans('backend/users_trans.Roles') }}</strong>
                                <select name="roles[]" class="form-control" multiple>
                                    @foreach ($roles as $roleId => $roleName)
                                        <option value="{{ $roleId }}">{{ $roleName }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
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

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editUserForm">
                <input type="hidden" name="user_id" id="editUserId">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Name:</label>
                        <input type="text" name="name" id="editUserName" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Email:</label>
                        <input type="email" name="email" id="editUserEmail" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>New Password (Optional):</label>
                        <input type="password" name="password" id="editUserPassword" class="form-control">
                    </div>
                    @php
                        $userRole = $user->roles->pluck('name', 'name')->all();
                    @endphp
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-12">
                            <div class="form-group">
                                <strong>Role:</strong>
                                <select name="roles[]" class="form-control" multiple>
                                    @foreach ($roles as $roleId => $roleName)
                                        <option value="{{ $roleId }}"
                                            @if (in_array($roleId, $userRole)) selected @endif>{{ $roleName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
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
        // Load users into DataTable
        loadUsers();

        function loadUsers() {
            $('#users_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('clinic.users.data') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'clinic',
                        name: 'clinic'
                    },
                    {
                        data: 'roles',
                        name: 'roles',
                        orderable: false,
                        searchable: false
                    },
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
            });
        }

        // Add User
        $(document).on('submit', '#addUserForm', function(e) {
            e.preventDefault();
            
            $.ajax({
                url: "{{ route('clinic.users.store') }}",
                type: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#addUserModal').modal('hide');
                    loadUsers();
                    
                    // Show success message
                    $('#successMessage').text('User added successfully!');
                    $('#successModal').modal('show');
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    $('#errorModal').modal('show');
                }
            });
        });

        // Show Edit Modal and Load User Data
        $(document).on('click', '.editUser', function() {
            let userId = $(this).data('id');

            $.ajax({
                url: `/clinic/users/edit/${userId}`,
                method: "GET",
                success: function(response) {
                    $('#editUserId').val(response.id);
                    $('#editUserName').val(response.name);
                    $('#editUserEmail').val(response.email);

                    // Clear previous selections and select new roles
                    $('#editUserRoles').val(response.roles).trigger('change');

                    $('#editUserModal').modal('show');
                },
                error: function() {
                    alert('Error loading user data.');
                }
            });
        });

        // Submit Edit User Form
        $('#editUserForm').submit(function(e) {
            e.preventDefault();

            let userId = $('#editUserId').val();
            let formData = $(this).serialize();

            $.ajax({
                url: `/clinic/users/update/${userId}`,
                method: "POST",
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#editUserModal').modal('hide');
                    $('#users_table').DataTable().ajax.reload();
                    alert('User updated successfully!');
                },
                error: function(xhr) {
                    alert('Error updating user.');
                }
            });
        });
    });
</script>
@endpush