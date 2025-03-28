@extends('backend.dashboards.clinic.layouts.master')
@section('css')

@section('title')
    {{ trans('backend/chronic_diseases_trans.Chronic') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('backend/chronic_diseases_trans.Chronic') }}</h4>
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

                <form action="{{ Route('backend.chronic_diseases.store') }}" method="post" enctype="multipart/form-data"
                    autocomplete="off">
                    @csrf

                    <br>

                    <div class="row">
                        <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 child-repeater-table">
                            <table class="table table-bordered table-responsive" id="table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>{{ trans('backend/chronic_diseases_trans.Disease_Name') }}</th>
                                        <th>{{ trans('backend/chronic_diseases_trans.Disease_Measure') }}</th>
                                        <th>{{ trans('backend/chronic_diseases_trans.Disease_Measure_Date') }}</th>
                                        <th>{{ trans('backend/chronic_diseases_trans.Notes') }}</th>
                                        <th>
                                            <a href="javascript:void(0)" class="btn btn-success addRow">
                                                {{ trans('backend/chronic_diseases_trans.Add_Disease') }}
                                            </a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    <tr>

                                        <td>
                                            <input class="form-control" name="id[]" hidden
                                                value="{{ $reservation->id }}" type="text">
                                            <input class="form-control" name="id[]" hidden
                                                value="{{ $reservation->patient->id }}" type="text">

                                        </td>
                                        <td>
                                            <input type="text" name="title[]" class="form-control"
                                                style="width: 150px;"
                                                placeholder="{{ trans('backend/chronic_diseases_trans.Disease_Name') }}">

                                        </td>
                                        <td>
                                            <input type="text" name="measure[]" class="form-control"
                                                style="width: 150px;"
                                                placeholder="{{ trans('backend/chronic_diseases_trans.Disease_Measure') }}">

                                        </td>
                                        <td>
                                            <input type="date" name="date[]" class="form-control"
                                                style="width: 150px;"
                                                placeholder="{{ trans('backend/chronic_diseases_trans.Disease_Date') }}">

                                        </td>
                                        <td>
                                            <input type="text" name="notes[]" class="form-control"
                                                style="width: 200px;"
                                                placeholder="{{ trans('backend/chronic_diseases_trans.Notes') }}">

                                        </td>
                                        <th><a href="javascript:void(0)" class="btn btn-danger deleteRow">
                                                {{ trans('backend/chronic_diseases_trans.Delete') }} </a></th>

                                    </tr>
                                </tbody>


                            </table>
                        </div>
                    </div>

                    <button type="submit"
                        class="btn btn-primary">{{ trans('backend/chronic_diseases_trans.Add') }}</button>

                </form>

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
            '<td><input class="form-control" hidden name="id[]" type="text" value="{{ $reservation->id }}"> <input class="form-control" hidden name="id[]" type="text" value="{{ $reservation->patient->id }}"></td>' +
            '<td><input type="text" name="title[]" class="form-control" placeholder="{{ trans('backend/chronic_diseases_trans.Disease_Name') }}"></td>' +
            '<td><input type="text" name="measure[]" class="form-control" placeholder="{{ trans('backend/chronic_diseases_trans.Disease_Measure') }}"></td>' +
            '<td><input type="date" id="datepicker-action" data-date-format="yyyy-mm-dd" name="date[]" class="form-control" placeholder="{{ trans('backend/chronic_diseases_trans.Disease_Date') }}"></td>' +
            '<td><input type="text" name="notes[]" class="form-control" placeholder="{{ trans('backend/chronic_diseases_trans.Notes') }}"></td>' +
            '<th><a href="javascript:void(0)" class="btn btn-danger deleteRow"> {{ trans('backend/chronic_diseases_trans.Delete') }} </a></th>' +
            '</tr>'
        $('#tbody').append(tr);
    });

    $('tbody').on('click', '.deleteRow', function() {
        $(this).parent().parent().remove();
    });
</script>


@endsection
