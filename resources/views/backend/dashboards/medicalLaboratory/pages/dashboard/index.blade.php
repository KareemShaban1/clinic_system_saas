@extends('backend.dashboards.medicalLaboratory.layouts.master')

@section('title')
{{ trans('backend/dashboard_trans.Dashboard') }}
@endsection

@section('css')
<style type="text/css">
    a[disabled="disabled"] {
        pointer-events: none;
    }
</style>
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-md-4 col-sm-4 col-12">
            <h4 class="mb-0"> {{ trans('backend/dashboard_trans.Dashboard') }} </h4>
        </div>


    </div>
</div>
<!-- breadcrumb -->
@endsection



@section('content')





@endsection