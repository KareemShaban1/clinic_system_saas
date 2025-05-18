@extends('backend.dashboards.clinic.layouts.master')
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
            <h4 class="mb-0"> {{trans('backend/chronic_diseases_trans.Chronic')}}</h4>
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

                <form action="{{Route('clinic.chronic_diseases.update',$chronic_disease->id)}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf

                    <input type="text" name="patient_id" hidden value="{{$chronic_disease->patient_id}}" type="text">
                    <input type="text" name="reservation_id" hidden value="{{$chronic_disease->reservation_id}}" type="text">

                    <br>

                    <div class="row">
                        <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 child-repeater-table">
                            <table class="table table-bordered table-responsive" id="table">

                                <thead>
                                    <tr>
                                        <th>{{trans('backend/chronic_diseases_trans.Disease_Name')}}</th>
                                        <th>{{trans('backend/chronic_diseases_trans.Disease_Measure')}}</th>
                                        <th>{{trans('backend/chronic_diseases_trans.Disease_Date')}}</th>
                                        <th>{{trans('backend/chronic_diseases_trans.Notes')}}</th>
                                        <!-- <th>
                                            <a href="javascript:void(0)" class="btn btn-success addRow">
                                                {{trans('backend/chronic_diseases_trans.Add_Disease')}}
                                            </a>
                                        </th> -->
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    <tr>


                                        <td>
                                            <input type="text" name="name" value="{{old('name',$chronic_disease->name)}}" class="form-control" placeholder="{{trans('backend/chronic_diseases_trans.Disease_Name')}}">
                                            @error('name')
                                            <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="text" name="measure" value="{{old('title',$chronic_disease->measure)}}" class="form-control" placeholder="{{trans('backend/chronic_diseases_trans.Disease_Measure')}}">
                                            @error('measure')
                                            <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </td>
                                        <td>
                                            <input id="datepicker-action" data-date-format="yyyy-mm-dd" name="date" value="{{old('title',$chronic_disease->date)}}" class="form-control" placeholder="{{trans('backend/chronic_diseases_trans.Disease_Date')}}">
                                            @error('date')
                                            <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="text" name="notes" class="form-control" value="{{old('title',$chronic_disease->notes)}}" placeholder="{{trans('backend/chronic_diseases_trans.Notes')}}">
                                            @error('notes')
                                            <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </td>
                                        <!-- <th><a href="javascript:void(0)" class="btn btn-danger deleteRow"> {{trans('backend/chronic_diseases_trans.Delete')}} </a></th> -->

                                    </tr>
                                </tbody>


                            </table>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">{{trans('backend/chronic_diseases_trans.Edit')}}</button>

                </form>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection