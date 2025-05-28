@extends('backend.dashboards.medicalLaboratory.layouts.master')
@section('css')
@section('title')
{{ trans('backend/medicalAnalysis_trans.Edit_Analysis') }}
@stop
@endsection

@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('backend/medicalAnalysis_trans.Edit_Analysis') }} </h4>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <x-backend.alert />

                <form method="POST" enctype="multipart/form-data" action="{{ route('medicalLaboratory.analysis.update', $analysis->id) }}" autocomplete="off">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>{{ trans('backend/medicalAnalysis_trans.Patient_Name') }}</label>
                                <select name="patient_id" id="patient_id" class="custom-select mr-sm-2">
                                    <option value="{{ $analysis->patient->id }}" selected>{{ $analysis->patient->name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>{{ trans('backend/medicalAnalysis_trans.Analysis_Date') }} <span class="text-danger">*</span></label>
                                <input class="form-control" name="date" id="datepicker-action" data-date-format="yyyy-mm-dd" value="{{ $analysis->date }}">
                            </div>
                        </div>
                    </div>

                    <div id="service-fee-container">
                        <button type="button" class="btn btn-primary mb-3" id="add-service-fee">
                            {{ __('Add Service Fee') }}
                        </button>

                        @foreach ($analysis->serviceFees as $index => $serviceFee)
                        <div class="service-fee-row" data-id="{{ $serviceFee->id }}">
                            <div class="row mb-3 align-items-center">
                                <div class="col-md-3">
                                    <label>{{ __('Service Name') }}</label>
                                    <select name="service_fee_id[{{ $index }}]" class="service-fee-select form-control p-0">
                                        <option value="">{{ __('Select Service') }}</option>
                                        @foreach (App\Models\ServiceFee::all() as $fee)
                                            <option value="{{ $fee->id }}" data-fee="{{ $fee->fee }}" data-notes="{{ $fee->notes }}"
                                                {{ $fee->id == $serviceFee->service_fee_id ? 'selected' : '' }}>
                                                {{ $fee->service_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>{{ __('Fee') }}</label>
                                    <input type="number" class="form-control service-fee-input" name="service_fee[{{ $index }}]" value="{{ $serviceFee->fee }}">
                                </div>
                                <div class="col-md-3">
                                    <label>{{ __('Notes') }}</label>
                                    <textarea name="service_fee_notes[{{ $index }}]" class="form-control service-fee-notes">{{ $serviceFee->notes }}</textarea>
                                </div>
                                <div class="col-md-3">
                                    <label>{{ __('Images') }}</label>
                                    <input type="file" name="service_fee_images[{{ $index }}][]" class="form-control service-fee-image-input" multiple accept="image/*">
                                    <div class="preview-images mt-2 d-flex flex-wrap">
                                        @foreach ($serviceFee->images as $image)
                                            <img src="{{ $image }}" class="img-thumbnail mr-2 mb-2" width="100" height="100">
                                        @endforeach
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <button type="button" class="btn btn-danger remove-service-fee mt-2">{{ __('Remove') }}</button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <button type="submit" class="btn btn-success btn-md btn-lg">{{ trans('backend/medicalAnalysis_trans.Update') }}</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).on('click', '.remove-service-fee', function () {
    const $row = $(this).closest('.service-fee-row');
    const serviceFeeId = $row.data('id'); // assuming you store the DB id in data-id

    console.log(serviceFeeId);
    if (confirm('Are you sure you want to remove this service fee?')) {
        if (serviceFeeId) {
            // Send AJAX request to remove from the server
            $.ajax({
                url: `medical-laboratory/service_fee/delete/${serviceFeeId}`, // update with actual route
                method: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function () {
                    $row.remove(); // Remove from DOM only after successful delete
                },
                error: function () {
                    alert('Failed to delete service fee.');
                }
            });
        } else {
            // No ID, just remove from DOM
            $row.remove();
        }
    }
});

    $(document).on('change', '.service-fee-select', function () {
        var selectedOption = $(this).find(':selected');
        var fee = selectedOption.data('fee');
        var notes = selectedOption.data('notes');

        var row = $(this).closest('.service-fee-row');
        row.find('.service-fee-input').val(fee);
        row.find('.service-fee-notes').val(notes);
    });

    $(document).on('click', '#add-service-fee', function () {
        let totalRows = $('.service-fee-row').length;
        let newRow = $('.service-fee-row:first').clone();

        newRow.find('select, input[type="number"], textarea').val('');
        newRow.find('.preview-images').html('');
        newRow.find('input[type="file"]').val('');

        newRow.find('select[name^="service_fee_id"]').attr('name', `service_fee_id[${totalRows}]`);
        newRow.find('input[name^="service_fee"]').attr('name', `service_fee[${totalRows}]`);
        newRow.find('textarea[name^="service_fee_notes"]').attr('name', `service_fee_notes[${totalRows}]`);
        newRow.find('input[type="file"]').attr('name', `service_fee_images[${totalRows}][]`);

        $('#service-fee-container').append(newRow);
    });

    $(document).on('change', '.service-fee-image-input', function () {
        let previewContainer = $(this).siblings('.preview-images');
        previewContainer.html('');

        Array.from(this.files).forEach(file => {
            let reader = new FileReader();
            reader.onload = function (e) {
                previewContainer.append(`<img src="${e.target.result}" class="img-thumbnail mr-2 mb-2" width="100" height="100">`);
            };
            reader.readAsDataURL(file);
        });
    });
</script>
@endpush
