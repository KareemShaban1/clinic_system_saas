@extends('layouts.master')
@section('css')

@section('title')
{{trans('medicines_trans.Show_Medicines')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{trans('medicines_trans.Medicines')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('medicines_trans.Show_Medicines')}}</a></li>
                <li class="breadcrumb-item active">{{trans('medicines_trans.Medicines')}}</li>
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

                
                <div class="my-post-content pt-4">
                                          

                    {{-- @foreach($medicines as $medicine) --}}
                    
                    <div class="card-body">

                        <div class="row mb-4">
                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                <h5 class="f-w-500">{{trans('medicines_trans.Id')}}  <span class="{{trans('chronic_diseases_trans.pull')}}">:</span></h5>
                            </div>
                            <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{$medicine->drugbank_id}}</span>
                            </div>
                        </div>

                
                        <div class="row mb-4">
                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                <h5 class="f-w-500"> {{trans('medicines_trans.Drug_Name')}}<span class="{{trans('chronic_diseases_trans.pull')}}">:</span></h5>
                            </div>
                            <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{$medicine->name}}</span>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                <h5 class="f-w-500"> {{trans('medicines_trans.Brand_Name')}}  <span class="{{trans('chronic_diseases_trans.pull')}}">:</span></h5>
                            </div>
                            <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{$medicine->brand_name}}</span>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                <h5 class="f-w-500"> {{trans('medicines_trans.Drug_Dose')}}  <span class="{{trans('chronic_diseases_trans.pull')}}">:</span></h5>
                            </div>
                            <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{$medicine->drug_dose}}</span>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                <h5 class="f-w-500"> {{trans('medicines_trans.Type')}}  <span class="{{trans('chronic_diseases_trans.pull')}}">:</span></h5>
                            </div>
                            <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{$medicine->type}}</span>
                            </div>
                        </div>

                        <div class="row mb-4">
                              <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                  <h5 class="f-w-500"> {{trans('medicines_trans.Group')}}  <span class="{{trans('chronic_diseases_trans.pull')}}">:</span></h5>
                              </div>
                              <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{$medicine->group}}</span>
                              </div>
                          </div>

                          <div class="row mb-4">
                              <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                  <h5 class="f-w-500"> {{trans('medicines_trans.Categories')}}  <span class="{{trans('chronic_diseases_trans.pull')}}">:</span></h5>
                              </div>
                              <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{$medicine->categories}}</span>
                              </div>
                          </div>

                          <div class="row mb-4">
                              <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                  <h5 class="f-w-500"> {{trans('medicines_trans.Description')}}  <span class="{{trans('chronic_diseases_trans.pull')}}">:</span></h5>
                              </div>
                              <div class="col-lg-9 col-md-8 col-sm-6 col-6" style="text-align: left"><span>{{$medicine->description}}</span>
                              </div>
                          </div>


                          <div class="row mb-4">
                              <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                  <h5 class="f-w-500"> {{trans('medicines_trans.Side_Effect')}}  <span class="{{trans('chronic_diseases_trans.pull')}}">:</span></h5>
                              </div>
                              <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{$medicine->side_effect}}</span>
                              </div>
                          </div>

                       


                        
                    </div>

                    {{-- @endforeach --}}
                </div>


            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
