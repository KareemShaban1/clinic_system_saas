@extends('backend.layouts.master')

@section('css')

@section('title')
    {{trans('backend/events_trans.Calendar')}}
@stop

@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('backend/events_trans.Calendar')}} </h4>
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
            <div class="card-body">


                @livewire('calendar')  

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
