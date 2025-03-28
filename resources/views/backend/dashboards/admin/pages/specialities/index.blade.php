@extends('backend.dashboards.admin.layouts.master')

@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
            <h4 class="page-title">{{__('Specialities')}}</h4>

                <div class="page-title-right">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSpecialityModal">
                        <i class="mdi mdi-plus"></i> {{__('Add Speciality')}}
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="specialities-table" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>{{__('ID')}}</th>
                                <th>{{__('Name Ar')}}</th>
                                <th>{{__('Name En')}}</th>
                                <th>{{__('Actions')}}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Speciality Modal -->
<x-modal id="addSpecialityModal" title="{{__('Add Speciality')}}">
    <form id="addSpecialityForm" method="POST" action="{{ route('admin.specialities.store') }}">
        @csrf
        <div class="modal-body">
            <div class="mb-3">
                <label for="name" class="form-label">{{__('Name En')}}</label>
                <input type="text" class="form-control" id="name" name="name_en" required>
                <div class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">{{__('Name Ar')}}</label>
                <input type="text" class="form-control" id="name" name="name_ar" required>
                <div class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">{{__('Description')}}</label>
                <textarea name="description" id="description" class="form-control"></textarea>
                <div class="invalid-feedback"></div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{__('Close')}}</button>
            <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
        </div>
    </form>
</x-modal>

<!-- Edit Speciality Modal -->
<x-modal id="editSpecialityModal" title="{{__('Edit Speciality')}}">
    <form id="editSpecialityForm" method="POST">
        @csrf
        <div class="modal-body">
            <div class="mb-3">
                <label for="edit_name" class="form-label">{{__('Name En')}}</label>
                <input type="text" class="form-control" id="edit_name_en" name="name_en" required>
                <div class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
                <label for="edit_name" class="form-label">{{__('Name Ar')}}</label>
                <input type="text" class="form-control" id="edit_name_ar" name="name_ar" required>
                <div class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">{{__('Description')}}</label>
                <textarea name="description" id="edit_description" class="form-control"></textarea>
                <div class="invalid-feedback"></div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{__('Close')}}</button>
            <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
        </div>
    </form>
</x-modal>

@endsection

@push('scripts')
<script>
    $(function() {
        // Initialize DataTable
        var table = $('#specialities-table').DataTable({
            ajax: "{{ route('admin.specialities.data') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name_ar',
                    name: 'name_ar'
                },
                {
                    data: 'name_en',
                    name: 'name_en'
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

        // Add Speciality Form Submit
        $('#addSpecialityForm').on('submit', function(e) {
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
                        $('#addSpecialityModal').modal('hide');
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

        // Edit Speciality Form Submit
        $('#editSpecialityForm').on('submit', function(e) {
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
                        $('#editSpecialityModal').modal('hide');
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
    });

    // Edit Speciality Function
    function editSpeciality(id, name_en, name_ar,description) {
        var form = $('#editSpecialityForm');
        form.attr('action', `{{ route('admin.specialities.update', '') }}/${id}`);
        form.find('#edit_name_en').val(name_en);
        form.find('#edit_name_ar').val(name_ar);
        form.find('#edit_description').val(description);
        $('#editSpecialityModal').modal('show');
    }
</script>
@endpush