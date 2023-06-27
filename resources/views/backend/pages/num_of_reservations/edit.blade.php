@extends('backend.layouts.master')
@section('css')

@section('title')
    {{trans('backend/reservations_trans.Number_of_Reservation')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">  {{trans('backend/reservations_trans.Number_of_Reservation')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('backend/reservations_trans.Number_of_Reservation')}}</a></li>
                <li class="breadcrumb-item active">{{trans('backend/reservations_trans.Reservations')}}</li>
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

                @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                @endif

                <form method="post" enctype="multipart/form-data" action="{{Route('backend.num_of_reservations.update',$num_of_res->id)}}" autocomplete="off">
                    @csrf
                  
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> {{trans('backend/reservations_trans.Reservation_Date')}} <span class="text-danger">*</span></label>
                                <input class="form-control" value="{{ old('reservation_date', $num_of_res->reservation_date) }}"   name="reservation_date" id="datepicker-action" data-date-format="yyyy-mm-dd" >
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>{{trans('backend/reservations_trans.Number_of_Reservations')}}  </label>
                                <input class="form-control" type="text" name="num_of_reservations" value="{{ old('num_of_reservations', $num_of_res->num_of_reservations) }}"  >
                            </div>
                        </div>


                      
                    </div>

             
                   <button type="submit" class="btn btn-success btn-md nextBtn btn-lg " >{{trans('backend/reservations_trans.Edit')}}</button>


                </form>

                
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
