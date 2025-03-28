@extends('backend.dashboards.clinic.layouts.master')
@section('css')

@section('title')
    {{ trans('backend/medicines_trans.Medicines') }}
@stop
@endsection
@section('page-header')

<h4 class="page-title"> {{ trans('backend/medicines_trans.Medicines') }}</h4>

@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th style="width: 100px">{{ trans('backend/medicines_trans.Id') }}</th>
                            <th style="width: 150px">{{ trans('backend/medicines_trans.DrugBank_Id') }}</th>
                            <th style="width: 150px">{{ trans('backend/medicines_trans.Drug_Name') }}</th>

                            <th style="width: 150px">{{ trans('backend/medicines_trans.Control') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($medicines as $medicine)
                            <tr>
                                <td style="width: 100px">{{ $medicine->id }}</td>
                                <td style="width: 150px">{{ $medicine->drugbank_id }}</td>
                                <td style="width: 150px">{{ $medicine->name }}</td>

                                <td style="width: 150px">
                                    <form action="{{ Route('clinic.medicines.restore', $medicine->id) }}"
                                        method="post" style="display:inline">
                                        @csrf
                                        @method('put')

                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fa fa-edit"></i>
                                            {{ trans('backend/medicines_trans.Restore') }}
                                        </button>
                                    </form>


                                    <form action="{{ Route('clinic.medicines.forceDelete', $medicine->id) }}"
                                        method="post" style="display:inline">
                                        @csrf
                                        @method('delete')

                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                            {{ trans('backend/medicines_trans.Delete_Forever') }}
                                        </button>
                                    </form>


                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
