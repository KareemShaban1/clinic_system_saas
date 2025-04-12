@extends('backend.dashboards.clinic.layouts.master')

@section('content')
@section('page-header')
<h4 class="page-title">{{__('Service Fees')}}</h4>

<div class="page-title-right">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#serviceFeeModal">
        <i class="mdi mdi-plus"></i> {{__('Add Service Fee')}}
    </button>
</div>
@endsection
<div class="container-fluid">


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="serviceFees_table" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>{{__('ID')}}</th>
                                <th>{{__('Service Name')}}</th>
                                <th>{{__('Fee')}}</th>
                                <th>{{__('Notes')}}</th>
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
<x-modal id="serviceFeeModal" title="{{ __('Add Service Fee') }}">
    <form id="serviceFeeForm" method="POST">
        @csrf
        <input type="hidden" id="serviceFeeId">
        <div class="modal-body">
            <div class="mb-3">
                <label for="service_name" class="form-label">{{ __('Service Name') }}</label>
                <input type="text" class="form-control" id="service_name" name="service_name" required>
                <div class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
                <label for="fee" class="form-label">{{ __('Fee') }}</label>
                <input type="text" class="form-control" id="fee" name="fee" required>
                <div class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
                <label for="notes" class="form-label">{{ __('Notes') }}</label>
                <textarea class="form-control" id="notes" name="notes"></textarea>
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
   let serviceFeesTable = $('#serviceFees_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('clinic.serviceFees.data') }}",
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'service_name',
                name: 'service_name'
            },
            {
                data: 'fee',
                name: 'fee'
            },
            {
                data: 'notes',
                name: 'notes'
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
        $('#serviceFeeForm')[0].reset();
        $('#serviceFeeForm').attr('action', '{{ route("clinic.serviceFees.store") }}');
        $('#serviceFeeId').val('');
        $('#serviceFeeModal .modal-title').text('{{ __("Add Service Fee") }}');
    }

    // Handle Add/Edit Form Submission
    $('#serviceFeeForm').on('submit', function(e) {
        e.preventDefault();
        let url = $('#serviceFeeId').val() ? '{{ route("clinic.serviceFees.update", ":id") }}'.replace(':id', $('#serviceFeeId').val()) : '{{ route("clinic.serviceFees.store") }}';
        let method = $('#serviceFeeId').val() ? 'POST' : 'POST';

        $.ajax({
            url: url,
            method: method,
            data: $(this).serialize(),
            success: function(response) {
                $('#serviceFeeModal').modal('hide');
                serviceFeesTable.ajax.reload();
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

    // Edit serviceFee
    function editServiceFee(id) {
        console.log(id);
        $.get('{{ route("clinic.serviceFees.index") }}/edit/' + id, function(data) {
            $('#serviceFeeId').val(data.id);
            $('#service_name').val(data.service_name);
            $('#fee').val(data.fee);
            $('#notes').val(data.notes);

            $('#serviceFeeModal .modal-title').text('{{ __("Edit Service Fee") }}');
            $('#serviceFeeModal').modal('show');
        });
    }

    // Delete serviceFee
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
                    url: '{{ route("clinic.serviceFees.index") }}/delete/' + id,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token for Laravel
                    },
                    success: function(response) {
                        serviceFeesTable.ajax.reload();
                        Swal.fire('Deleted!', response.message, 'success');
                    }
                });
            }
        });
    }
</script>
@endpush