@extends('backend.dashboards.clinic.layouts.master')

@section('content')
@section('page-header')
<h4 class="page-title">{{__('Types')}}</h4>

<div class="page-title-right">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#TypeModal">
        <i class="mdi mdi-plus"></i> {{__('Add Type')}}
    </button>
</div>
@endsection
<div class="container-fluid">


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="type_table" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>{{__('ID')}}</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Description')}}</th>
                                <th>{{__('Type')}}</th>
                                <th>{{__('Actions')}}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ServiceFee Modal -->
<x-modal id="TypeModal" title="{{ __('Add Type') }}">
    <form id="TypeForm" method="POST">
        @csrf
        <input type="hidden" id="typeId">
        <div class="modal-body">
            <div class="mb-3">
                <label for="name" class="form-label">{{ __('Name') }}</label>
                <input type="text" class="form-control" id="name" name="name" required>
                <div class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">{{ __('Description') }}</label>
                <textarea name="description" id="description" class="form-control"></textarea>
                <div class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">{{ __('Type') }}</label>
                <select name="type" id="" class="form-control">
                <option value="ray">{{ __('Ray') }}</option>
                    <option value="glassesDistance">{{ __('Glasses Distance') }}</option>
                    <option value="medicalAnalysis">{{ __('Medical Analysis') }}</option>
                    <option value="chronicDisease">{{ __('Chronic Disease') }}</option>

                </select>
                
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
   let typeTable = $('#type_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('clinic.type.data') }}",
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'description',
                name: 'description'
            },
            {
                data: 'type',
                name: 'type'
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
        $('#TypeForm')[0].reset();
        $('#TypeForm').attr('action', '{{ route("clinic.type.store") }}');
        $('#TypeId').val('');
        $('#TypeModal .modal-title').text('{{ __("Add Type") }}');
    }

    // Handle Add/Edit Form Submission
    $('#TypeForm').on('submit', function(e) {
        e.preventDefault();
        let url = $('#TypeId').val() ? '{{ route("clinic.type.update", ":id") }}'.replace(':id', $('#TypeId').val()) : '{{ route("clinic.type.store") }}';
        let method = $('#TypeId').val() ? 'POST' : 'POST';

        $.ajax({
            url: url,
            method: method,
            data: $(this).serialize(),
            success: function(response) {
                $('#TypeModal').modal('hide');
                typeTable.ajax.reload();
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

    // Edit Type
    function editServiceFee(id) {
        console.log(id);
        $.get('{{ route("clinic.type.index") }}/edit/' + id, function(data) {
            $('#TypeId').val(data.id);
            $('#name').val(data.name);
            $('#description').val(data.description);
            $('#type').val(data.type);

            $('#TypeModal .modal-title').text('{{ __("Edit Type") }}');
            $('#TypeModal').modal('show');
        });
    }

    // Delete Type
    function deleteServiceFee(id) {
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
                    url: '{{ route("clinic.type.index") }}/delete/' + id,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token for Laravel
                    },
                    success: function(response) {
                        typeTable.ajax.reload();
                        Swal.fire('Deleted!', response.message, 'success');
                    }
                });
            }
        });
    }
</script>
@endpush