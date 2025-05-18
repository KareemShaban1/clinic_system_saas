@extends('backend.dashboards.clinic.layouts.master')
@section('css')

@section('title')
    {{ trans('backend/serviceFees_trans.Edit_User') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('backend/serviceFees_trans.Edit_User') }}</h4>
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


                <form method="post" enctype="multipart/form-data" action="{{ Route('backend.serviceFees.update', $serviceFee->id) }}"
                    autocomplete="off">

                    @csrf

                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label>{{ trans('backend/serviceFees_trans.Service_Name') }}<span
                                        class="text-danger">*</span></label>
                                <input type="text" value="{{ $serviceFee->service_name }}" name="service_name" class="form-control">
                                @error('service_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label> {{ trans('backend/serviceFees_trans.Fee') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" value="{{ $serviceFee->fee }}" name="fee" type="text">
                                @error('fee')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label>{{ trans('backend/serviceFees_trans.Notes') }} <span
                                        class="text-danger">*</span></label>
                                <textarea name="notes" id="notes" class="form-control">{{ $serviceFee->notes }}</textarea>

                            </div>
                        </div>
                    </div>


                    <button type="submit"
                        class="btn btn-success btn-md nextBtn btn-lg ">{{ trans('backend/serviceFees_trans.Edit') }}</button>


                </form>



            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
