@extends('backend.dashboards.admin.layouts.master')

@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <!-- <div class="page-title-right">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClinicModal">
                        <i class="mdi mdi-plus"></i> {{__('Add Clinic')}}
                    </button>
                </div> -->
                <h4 class="page-title">{{__('Clinics')}}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="clinics-table" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>{{__('ID')}}</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Email')}}</th>
                                <th>{{__('Clinic Status')}}</th>
                                <th>{{__('Doctors Count')}}</th>
                                <th>{{__('Patients Count')}}</th>
                                <th>{{__('Users Count')}}</th>
                                <th>{{__('Actions')}}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(function() {
        // Initialize DataTable
        var table = $('#clinics-table').DataTable({
            ajax: "{{ route('admin.clinics.data') }}",
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
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'doctors_count',
                    name: 'doctors_count'
                },
                {
                    data: 'patients_count',
                    name: 'patients_count'
                },
                {
                    data: 'users_count',
                    name: 'users_count'
                },
                {
                    data: 'action',
                    name: 'action',
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

        // Add Clinic Form Submit
        $('#addClinicForm').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');

            $.ajax({
                url: url,
                type: 'POST',
                data: form.serialize(),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    if (response.success) {
                        $('#addClinicModal').modal('hide');
                        form[0].reset();
                        table.ajax.reload();
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message
                        });
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        Object.keys(errors).forEach(function(key) {
                            var input = form.find(`[name="${key}"]`);
                            input.addClass('is-invalid');
                            input.siblings('.invalid-feedback').text(errors[key][0]);
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseJSON.message || 'Something went wrong!'
                        });
                    }
                }
            });
        });

        // Edit Clinic Form Submit
        $('#editClinicForm').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');

            $.ajax({
                url: url,
                type: 'POST',
                data: form.serialize(),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    if (response.success) {
                        $('#editClinicModal').modal('hide');
                        form[0].reset();
                        table.ajax.reload();
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message
                        });
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        Object.keys(errors).forEach(function(key) {
                            var input = form.find(`[name="${key}"]`);
                            input.addClass('is-invalid');
                            input.siblings('.invalid-feedback').text(errors[key][0]);
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseJSON.message || 'Something went wrong!'
                        });
                    }
                }
            });
        });

        // Clear form validation on modal hide
        $('.modal').on('hidden.bs.modal', function() {
            var form = $(this).find('form');
            form.find('.is-invalid').removeClass('is-invalid');
            form.find('.invalid-feedback').text('');
        });

        $(document).on('change', '.toggle-status', function() {
            var $toggle = $(this); // Store reference to avoid conflicts
            var clinicId = $toggle.data('id');
            var newStatus = $toggle.is(':checked') ? 'active' : 'inactive';

            $.ajax({
                // url: '/clinics/update-status',
                url: "{{ route('admin.clinics.update-status') }}",
                type: 'POST',
                data: {
                    id: clinicId,
                    status: newStatus,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success(response.message); // Show success message
                    } else {
                        toastr.error('Failed to update status.');
                        $toggle.prop('checked', !$toggle.prop('checked')); // Revert UI if failed
                    }
                },
                error: function() {
                    toastr.error('Error updating clinic status.');
                    $toggle.prop('checked', !$toggle.prop('checked')); // Revert UI on error
                }
            });
        });


    });

    // Edit Clinic Function
</script>
@endpush