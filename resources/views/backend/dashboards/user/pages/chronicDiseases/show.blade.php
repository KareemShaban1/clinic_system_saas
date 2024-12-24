@extends('backend.dashboards.user.layouts.master')
@section('css')

@section('title')
{{trans('backend/chronic_diseases_trans.Chronic')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{trans('backend/chronic_diseases_trans.Chronic')}}</h4>
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

                
                <div class="my-post-content pt-4">
                

                    @foreach($chronic_diseases as $chronic_disease)

                    <h5 class="card-header">
                        <span class="badge badge-rounded badge-info ">
                       <h5 class="text-white">  {{trans('backend/chronic_diseases_trans.Disease_Number')}}    {{$loop->index+1}} </h5>
                        </span>

                   <div style="float: left">
                    <a href="{{Route('backend.chronic_diseases.edit',$chronic_disease->id)}}" class="btn btn-warning btn-sm">
                        
                        <span> {{trans('backend/chronic_diseases_trans.Edit')}} <i class="fa fa-edit"></i></span>
                    </a>
                    </div>
                        
                    </h5>



                    <div class="card-body">

                        <div class="row mb-4">
                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                <h5 class="f-w-500">{{trans('backend/chronic_diseases_trans.Id')}}  <span class="{{trans('backend/chronic_diseases_trans.pull')}}">:</span></h5>
                            </div>
                            <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{$chronic_disease->reservation_id}}</span>
                            </div>
                        </div>

                
                        <div class="row mb-4">
                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                <h5 class="f-w-500"> {{trans('backend/chronic_diseases_trans.Disease_Name')}}<span class="{{trans('backend/chronic_diseases_trans.pull')}}">:</span></h5>
                            </div>
                            <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{$chronic_disease->title}}</span>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                <h5 class="f-w-500"> {{trans('backend/chronic_diseases_trans.Disease_Measure')}}  <span class="{{trans('backend/chronic_diseases_trans.pull')}}">:</span></h5>
                            </div>
                            <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{$chronic_disease->measure}}</span>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                <h5 class="f-w-500"> {{trans('backend/chronic_diseases_trans.Disease_Date')}}  <span class="{{trans('backend/chronic_diseases_trans.pull')}}">:</span></h5>
                            </div>
                            <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{$chronic_disease->date}}</span>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                <h5 class="f-w-500"> {{trans('backend/chronic_diseases_trans.Notes')}}  <span class="{{trans('backend/chronic_diseases_trans.pull')}}">:</span></h5>
                            </div>
                            <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{$chronic_disease->notes}}</span>
                            </div>
                        </div>

                       


                        
                    </div>

                    @endforeach
                </div>


            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
