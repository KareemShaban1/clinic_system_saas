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
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('backend/events_trans.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('backend/events_trans.Calendar')}}</li>
            </ol>
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
