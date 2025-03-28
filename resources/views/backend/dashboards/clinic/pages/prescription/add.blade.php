@extends('backend.layouts.master')
@section('css')

@section('title')
    {{ trans('backend/drugs_trans.Prescription') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('backend/drugs_trans.Prescription') }}</h4>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')

<!-- row -->
<div class="custom-tab-1">
    <ul class="nav nav-tabs">

        <li class="nav-item">
            <a href="#drugs" data-toggle="tab" class="nav-link active show">
                {{ trans('backend/drugs_trans.Drugs') }}
            </a>
        </li>

        <li class="nav-item">
            <a href="#add_prescription" data-toggle="tab" class="nav-link">
                {{ trans('backend/drugs_trans.Add_Prescription') }}
            </a>
        </li>

        <li class="nav-item">
            <a href="#prescriptions" data-toggle="tab" class="nav-link">
                {{ trans('backend/drugs_trans.Prescriptions') }}
            </a>
        </li>

    </ul>

    <div class="tab-content">

        <div id="drugs" class="tab-pane fade active show">

            @include('backend.pages.prescription.add_drugs')

        </div>

        <div id="add_prescription" class="tab-pane fade">

            @include('backend.pages.prescription.add_prescription_image')

        </div>

        <div id="prescriptions" class="tab-pane fade">

            @include('backend.pages.prescription.show_prescription')

        </div>

    </div>


</div>

<!-- row closed -->
@endsection
@section('js')
<script>
    $('thead').on('click', '.addRow', function() {
        var tr = '<tr>' +
            '<td><input class="form-control" hidden value="{{ $reservation->id }}"  name="id[]" type="text" ></td>' +
            '<td><input type="text" name="drug_name[]" class="form-control" placeholder="{{ trans('backend/drugs_trans.Drug_Name') }}"></td>' +
            '<td><input type="text" name="drug_dose[]" class="form-control" placeholder="{{ trans('backend/drugs_trans.Drug_Dose') }}"></td>' +
            '<td><input type="text" name="drug_type[]" class="form-control" placeholder="{{ trans('backend/drugs_trans.Drug_Type') }}"></td>' +
            '<td><input type="text" name="frequency[]" class="form-control" placeholder="{{ trans('backend/drugs_trans.Frequency') }}"></td>' +
            '<td><input type="text" name="period[]" class="form-control" placeholder="{{ trans('backend/drugs_trans.Period') }}"></td>' +
            '<td><input type="text" name="notes[]" class="form-control" placeholder="{{ trans('backend/drugs_trans.Notes') }}"></td>' +
            '<th><a href="javascript:void(0)" class="btn btn-danger deleteRow"> {{ trans('backend/drugs_trans.Delete') }} </a></th>' +
            '<input class="form-control" hidden name="id[]" type="text" value="{{ $reservation->id }}">' +
            '</tr>'
        $('#tbody').append(tr);
    });

    $('tbody').on('click', '.deleteRow', function() {
        $(this).parent().parent().remove();
    });
</script>
@endsection
