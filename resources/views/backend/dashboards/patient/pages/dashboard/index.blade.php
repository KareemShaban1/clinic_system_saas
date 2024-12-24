@extends('backend.dashboards.patient.layouts.master')

@section('css')

@section('title')
    {{ trans('frontend/dashboard_trans.Dashboard') }}
@stop

@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('frontend/dashboard_trans.Dashboard') }} </h4>
        </div>

    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 col-sm-12 mb-30">
        <div class="card card-statistics ">
            <div class="card-body" style="height: 500px">

            <div class="row">
                <div class="col-12 col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-4 ">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-right">
                                    <span class="text-success">
                                        <i class="fa fa-stethoscope highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-left text-left">
                                    <p class="card-text text-dark">
                                        {{ trans('frontend/dashboard_trans.All_Your_Reservations') }}
                                    </p>
                                    <h4>{{ $all_reservations_count }}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a
                                    href="{{ Route('frontend.appointment.index') }}" target="_blank"><span
                                        class="text-danger">عرض البيانات</span></a>
                            </p>
                        </div>

                    </div>
                </div>

                <div class="col-12 col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-4">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-right">
                                    <span class="text-success">
                                        <i class="fa fa-stethoscope highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-left text-left">
                                    <p class="card-text text-dark">
                                        {{ trans('frontend/dashboard_trans.Approved_Reservations') }}
                                    </p>
                                    <h4>{{ $approved_reservations_count }}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a
                                    href="{{ Route('frontend.appointment.index') }}" target="_blank"><span
                                        class="text-danger">عرض البيانات</span></a>
                            </p>
                        </div>

                    </div>
                </div>

                <div class="col-12 col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-4">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-right">
                                    <span class="text-success">
                                        <i class="fa fa-stethoscope highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-left text-left">
                                    <p class="card-text text-dark">
                                        {{ trans('frontend/dashboard_trans.Not_Approved_Reservations') }}
                                    </p>
                                    <h4>{{ $not_approved_reservations_count }}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a
                                    href="{{ Route('frontend.appointment.index') }}" target="_blank"><span
                                        class="text-danger">عرض البيانات</span></a>
                            </p>
                        </div>

                    </div>
                </div>

            </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
