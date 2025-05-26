@extends('backend.dashboards.medicalLaboratory.layouts.master')
@section('css')

@section('title')
{{ trans('backend/medicalAnalysis_trans.Add_Analysis') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('backend/medicalAnalysis_trans.Add_Analysis') }} </h4>
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

                <x-backend.alert />

                <form method="post" enctype="multipart/form-data" action="{{ Route('medicalLaboratory.analysis.store') }}"
                    autocomplete="off">

                    @csrf
                    <div class="row">


                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="id"
                                    class="form-control-label">{{ trans('backend/medicalAnalysis_trans.Patient_Name') }}</label>
                                <select name="patient_id" id="patient_id" class="custom-select mr-sm-2">

                                    <option value="{{ $patient->id }}" selected>
                                        {{ $patient->name }}
                                    </option>

                                </select>

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label> {{ trans('backend/medicalAnalysis_trans.Analysis_Date') }}<span
                                        class="text-danger">*</span></label>
                                <input class="form-control" name="date" id="datepicker-action"
                                    data-date-format="yyyy-mm-dd">

                            </div>
                        </div>

                    </div>


                    <!-- 
                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label
                                    for="name">{{ trans('backend/medicalAnalysis_trans.Analysis_Name') }}</label>
                                <input type="text" id="name" name="name" class="form-control">

                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="type">{{ trans('backend/medicalAnalysis_trans.Analysis_Type') }}
                                </label>
                                <input type="text" name="type" id="type" class="form-control">

                            </div>
                        </div>


                    </div> -->
                    <!-- 

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-outline mb-4">
                                <label class="form-label"
                                    for="report">{{ trans('backend/medicalAnalysis_trans.Report') }}</label>
                                <textarea name="report" class="form-control" id="report" rows="3"></textarea>

                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="images"> {{ trans('backend/medicalAnalysis_trans.Analysis_Image') }}<span
                                        class="text-danger">*</span></label>
                                <input class="form-control" name="images[]" id="images" type="file"
                                    accept="image/*" multiple="multiple">

                            </div>
                        </div>
                    </div> -->


                    <div id="service-fee-container">
                        <button type="button" class="btn btn-primary mb-3" id="add-service-fee">
                            {{ __('Add Service Fee') }}
                        </button>

                        <div class="service-fee-row">
                            <div class="row mb-3" style="display: flex;align-items: center;">
                                <div class="col-md-3">
                                    <label>{{ __('Service Name') }}</label>
                                    <select name="service_fee_id[]" class="service-fee-select form-control p-0">
                                        <option value="">{{ __('Select Service') }}</option>
                                        @foreach (App\Models\ServiceFee::all() as $serviceFee)
                                        <option value="{{ $serviceFee->id }}"
                                            data-fee="{{ $serviceFee->fee }}"
                                            data-notes="{{ $serviceFee->notes }}">
                                            {{ $serviceFee->service_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>{{ __('Fee') }}</label>
                                    <input type="number" class="form-control service-fee-input" name="service_fee[]">
                                </div>
                                <div class="col-md-3">
                                    <label>{{ __('Notes') }}</label>
                                    <textarea name="service_fee_notes[]" class="form-control service-fee-notes"></textarea>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-danger remove-service-fee mt-2">{{ __('Remove') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <button type="submit"
                        class="btn btn-success btn-md nextBtn btn-lg">{{ trans('backend/medicalAnalysis_trans.Add') }}</button>

                </form>


            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@push('scripts')

<script>
    $(document).on('click', '.remove-service-fee', function() {
        $(this).closest('.service-fee-row').remove();
    });

    $(document).on('change', '.service-fee-select', function() {
        var selectedOption = $(this).find(':selected');
        var fee = selectedOption.data('fee');
        var notes = selectedOption.data('notes');

        var row = $(this).closest('.service-fee-row');
        row.find('.service-fee-input').val(fee);
        row.find('.service-fee-notes').val(notes);
    });

    $(document).on('click', '.remove-service-fee', function() {
        $(this).closest('.service-fee-row').remove();
    });


    // Add new service fee row
    $(document).on('click', '#add-service-fee', function() {

        var newRow = $('.service-fee-row:first').clone();
        newRow.find('select, input, textarea').val('');
        newRow.find('.remove-service-fee').show(); 
        $('#service-fee-container').append(newRow);
    });
</script>

@endpush