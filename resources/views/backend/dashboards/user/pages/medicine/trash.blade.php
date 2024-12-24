@extends('backend.dashboards.user.layouts.master')
@section('css')

@section('title')
    {{ trans('backend/medicines_trans.Medicines') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('backend/medicines_trans.Medicines') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#"
                        class="default-color">{{ trans('backend/medicines_trans.Deleted_Medicines') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('backend/medicines_trans.Medicines') }}</li>
            </ol>
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
                                    <form action="{{ Route('backend.medicines.restore', $medicine->id) }}"
                                        method="post" style="display:inline">
                                        @csrf
                                        @method('put')

                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fa fa-edit"></i>
                                            {{ trans('backend/medicines_trans.Restore') }}
                                        </button>
                                    </form>


                                    <form action="{{ Route('backend.medicines.forceDelete', $medicine->id) }}"
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
