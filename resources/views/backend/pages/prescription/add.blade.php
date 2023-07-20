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
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#"
                        class="default-color">{{ trans('backend/drugs_trans.Add_Prescription') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('backend/drugs_trans.Prescription') }}</li>
            </ol>
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


            <div class="row pt-4">
                <div class="col-md-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">

                            <form action="{{ Route('backend.prescription.store') }}" method="post"
                                enctype="multipart/form-data" autocomplete="off">
                                @csrf


                                <br>

                                <div class="row">
                                    <div
                                        class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 child-repeater-table">
                                        <table class="table table-bordered table-responsive" id="table">

                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>{{ trans('backend/drugs_trans.Drug_Name') }}</th>
                                                    <th>{{ trans('backend/drugs_trans.Drug_Dose') }}</th>
                                                    <th>{{ trans('backend/drugs_trans.Drug_Type') }}</th>
                                                    <th>{{ trans('backend/drugs_trans.Frequency') }}</th>
                                                    <th>{{ trans('backend/drugs_trans.Period') }}</th>
                                                    <th>{{ trans('backend/drugs_trans.Notes') }}</th>
                                                    <th><a href="javascript:void(0)" class="btn btn-success addRow">
                                                            {{ trans('backend/drugs_trans.Add_Drug') }}
                                                        </a></th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody">
                                                <tr>

                                                    <td>
                                                        <input class="form-control" name="reservation_id[]" hidden
                                                            value="{{ $reservation->reservation_id }}" type="text">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="drug_name[]" class="form-control"
                                                            placeholder="{{ trans('backend/drugs_trans.Drug_Name') }}">
                                                        @error('drug_name')
                                                            <p class="alert alert-danger">{{ $message }}</p>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input type="text" name="drug_dose[]" class="form-control"
                                                            placeholder="{{ trans('backend/drugs_trans.Drug_Dose') }}">
                                                        @error('drug_dose')
                                                            <p class="alert alert-danger">{{ $message }}</p>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input type="text" name="drug_type[]" class="form-control"
                                                            placeholder="{{ trans('backend/drugs_trans.Drug_Type') }}">
                                                        @error('drug_type')
                                                            <p class="alert alert-danger">{{ $message }}</p>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input type="text" name="frequency[]" class="form-control"
                                                            placeholder="{{ trans('backend/drugs_trans.Frequency') }}">
                                                        @error('frequency')
                                                            <p class="alert alert-danger">{{ $message }}</p>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input type="text" name="period[]" class="form-control"
                                                            placeholder="{{ trans('backend/drugs_trans.Period') }}">
                                                        @error('period')
                                                            <p class="alert alert-danger">{{ $message }}</p>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input type="text" name="notes[]" class="form-control"
                                                            placeholder="{{ trans('backend/drugs_trans.Notes') }}">
                                                        @error('notes')
                                                            <p class="alert alert-danger">{{ $message }}</p>
                                                        @enderror
                                                    </td>
                                                    <th><a href="javascript:void(0)" class="btn btn-danger deleteRow">
                                                            {{ trans('backend/drugs_trans.Delete') }} </a></th>

                                                </tr>
                                            </tbody>


                                        </table>
                                    </div>
                                </div>

                                <button type="submit"
                                    class="btn btn-primary">{{ trans('backend/drugs_trans.Save') }}</button>

                            </form>

                        </div>
                    </div>
                </div>
            </div>


        </div>


        <div id="add_prescription" class="tab-pane fade">


            <div class="row  pt-4">
                <div class="col-md-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">

                            <form method="post" enctype="multipart/form-data"
                                action="{{ Route('backend.prescription.UploadPrescription') }}" autocomplete="off">

                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label
                                                class="form-control-label">{{ trans('backend/drugs_trans.Reservation_Id') }}</label>
                                            <select name="reservation_id" class="custom-select mr-sm-2">

                                                <option value="{{ $reservation->reservation_id }}" selected>
                                                    {{ $reservation->reservation_id }}</option>

                                            </select>
                                            @error('reservation_id')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>


                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-outline mb-4">
                                            <label class="form-label"
                                                for="textAreaExample6">{{ trans('backend/drugs_trans.Notes') }}</label>
                                            <textarea name="notes" class="form-control" id="textAreaExample6" rows="3"></textarea>
                                            @error('notes')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label> {{ trans('backend/drugs_trans.Prescription_Image') }}<span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control" name="images[]" type="file"
                                                accept="image/*" multiple="multiple">
                                            @error('images')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                </div>


                                <button type="submit"
                                    class="btn btn-success btn-md nextBtn btn-lg">{{ trans('backend/drugs_trans.Add') }}</button>


                            </form>

                        </div>
                    </div>
                </div>
            </div>



        </div>

        <div id="prescriptions" class="tab-pane fade">

            <div class="row pt-4">
                @forelse ($prescriptions as $key => $prescription)
                    <div class="col-md-6 mb-30">
                        <div class="card card-statistics h-100">
                            <h5 class="card-header">
                                <span class="badge badge-rounded badge-warning">
                                    <h5>{{ trans('backend/drugs_trans.Prescription_Number') }} {{ $key + 1 }}
                                    </h5>
                                </span>
                            </h5>
                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                        <h5 class="f-w-500">{{ trans('backend/drugs_trans.Notes') }}<span
                                                class="pull-left">:</span></h5>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                        <span>{{ $prescription->notes }}</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                        <h5 class="f-w-500">{{ trans('backend/drugs_trans.Prescription_Image') }}<span
                                                class="pull-left">:</span></h5>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                        <?php $images = explode('|', $prescription->images); ?>
                                        @foreach ($images as $value)
                                        <a  href="{{ URL::asset('storage/prescriptions/' . $value) }}" download
                                        title="تحميل الصورة">
                                            <img src="{{ URL::asset('storage/prescriptions/' . $value) }}"
                                            alt="تحميل الصورة"   width="350" height="500">
                                        </a>        
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (($key + 1) % 2 === 0)
            </div>
            <div class="row pt-4">
                @endif
            @empty
                <div class="col-md-12">
                    <p>No prescriptions found.</p>
                </div>
                @endforelse
            </div>



        </div>
    </div>


</div>

<!-- row closed -->
@endsection
@section('js')
<script>
    $('thead').on('click', '.addRow', function() {
        var tr = '<tr>' +
            '<td><input class="form-control" hidden value="{{ $reservation->reservation_id }}"  name="reservation_id[]" type="text" ></td>' +
            '<td><input type="text" name="drug_name[]" class="form-control" placeholder="{{ trans('backend/drugs_trans.Drug_Name') }}"></td>' +
            '<td><input type="text" name="drug_dose[]" class="form-control" placeholder="{{ trans('backend/drugs_trans.Drug_Dose') }}"></td>' +
            '<td><input type="text" name="drug_type[]" class="form-control" placeholder="{{ trans('backend/drugs_trans.Drug_Type') }}"></td>' +
            '<td><input type="text" name="frequency[]" class="form-control" placeholder="{{ trans('backend/drugs_trans.Frequency') }}"></td>' +
            '<td><input type="text" name="period[]" class="form-control" placeholder="{{ trans('backend/drugs_trans.Period') }}"></td>' +
            '<td><input type="text" name="notes[]" class="form-control" placeholder="{{ trans('backend/drugs_trans.Notes') }}"></td>' +
            '<th><a href="javascript:void(0)" class="btn btn-danger deleteRow"> {{ trans('backend/drugs_trans.Delete') }} </a></th>' +
            '<input class="form-control" hidden name="reservation_id[]" type="text" value="{{ $reservation->reservation_id }}">' +
            '</tr>'
        $('#tbody').append(tr);
    });

    $('tbody').on('click', '.deleteRow', function() {
        $(this).parent().parent().remove();
    });
</script>
@endsection
