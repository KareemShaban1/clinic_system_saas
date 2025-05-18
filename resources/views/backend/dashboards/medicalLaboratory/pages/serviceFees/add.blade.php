@extends('backend.dashboards.clinic.layouts.master')
@section('css')

@section('title')
{{ trans('backend/serviceFees_trans.Add_Service_Fee') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('backend/serviceFees_trans.Add_Service_Fee') }}</h4>
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

                <form method="post" enctype="multipart/form-data" action="{{ Route('backend.serviceFees.store') }}"
                    autocomplete="off">

                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ trans('backend/serviceFees_trans.Service_Name') }}<span
                                        class="text-danger">*</span></label>
                                <input type="text" name="service_name" class="form-control">

                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fee"> {{ trans('backend/serviceFees_trans.Fee') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" id="fee" name="fee" type="text">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="notes"> {{ trans('backend/serviceFees_trans.Notes') }} <span
                                        class="text-danger">*</span></label>
                                <textarea name="notes" id="notes" class="form-control"></textarea>



                            </div>
                        </div>

                    </div>


                    <button type="submit"
                        class="btn btn-success btn-md nextBtn btn-lg ">{{ trans('backend/serviceFees_trans.Add') }}</button>


                </form>




            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection