@extends('backend.dashboards.clinic.layouts.master')

@section('content')
@section('page-header')
<h4 class="page-title">{{__('Users')}}</h4>

<div class="page-title-right">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">
        <i class="mdi mdi-plus"></i> {{__('Add User')}}
    </button>
</div>
@endsection
<div class="container-fluid">


    <div class="row">
        <div class="col-12">
            <div class="card">
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
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- User Modal -->
<x-modal id="userModal" title="{{ __('Add User') }}">
    <form id="userForm" method="POST">
        @csrf
        <input type="hidden" id="userId">
        <div class="modal-body">
            <div class="mb-3">
                <label for="name" class="form-label">{{ __('Name') }}</label>
                <input type="text" class="form-control" id="name" name="name" required>
                <div class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input type="email" class="form-control" id="email" name="email" required>
                <div class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input type="password" class="form-control" id="password" name="password">
                <div class="invalid-feedback"></div>
            </div>

            <div class="mb-3">
                <label for="roles" class="form-label">{{ __('Roles') }}</label>
                <div id="roles-container">
                    @foreach($roles as $role)
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="role_{{ $role->name }}" name="roles[]" value="{{ $role->name }}">
                        <label class="form-check-label" for="role_{{ $role->name }}">{{ $role->name }}</label>
                    </div>
                    @endforeach
                </div>
                <div class="invalid-feedback"></div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
        </div>
    </form>
</x-modal>
@endsection

@push('scripts')
<script>
   let usersTable = $('#users_table').DataTable({
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
                data: 'organization',
                name: 'organization'
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


    // Reset form
    function resetForm() {
        $('#userForm')[0].reset();
        $('#userForm').attr('action', '{{ route("clinic.users.store") }}');
        $('#userId').val('');
        $('#userModal .modal-title').text('{{ __("Add User") }}');
    }

    // Handle Add/Edit Form Submission
    $('#userForm').on('submit', function(e) {
        e.preventDefault();
        let url = $('#userId').val() ? '{{ route("clinic.users.update", ":id") }}'.replace(':id', $('#userId').val()) : '{{ route("clinic.users.store") }}';
        let method = $('#userId').val() ? 'POST' : 'POST';

        $.ajax({
            url: url,
            method: method,
            data: $(this).serialize(),
            success: function(response) {
                $('#userModal').modal('hide');
                usersTable.ajax.reload();
                Swal.fire('Success', response.message, 'success');
            },
            error: function(xhr) {
                // handleValidationErrors(xhr);
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    var errorMessages = Object.values(errors).map(function(error) {
                        return error[0];
                    }).join('<br>');

                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Errors',
                        html: errorMessages
                    });
                }
            },
        });
    });

    // Edit user
    function editUser(id) {
        console.log(id);
        $.get('{{ route("clinic.users.index") }}/edit/' + id, function(data) {
            $('#userId').val(data.id);
            $('#name').val(data.name);
            $('#email').val(data.email);

            // Reset all checkboxes
            $('#roles-container input[type="checkbox"]').prop('checked', false);

            // Check the user's roles
            data.roles.forEach(role => {
                $('#role_' + role).prop('checked', true);
            });

            $('#userModal .modal-title').text('{{ __("Edit User") }}');
            $('#userModal').modal('show');
        });
    }

    // Delete user
    function deleteUser(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route("clinic.users.index") }}/delete/' + id,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token for Laravel
                    },
                    success: function(response) {
                        usersTable.ajax.reload();
                        Swal.fire('Deleted!', response.message, 'success');
                    }
                });
            }
        });
    }
</script>
@endpush