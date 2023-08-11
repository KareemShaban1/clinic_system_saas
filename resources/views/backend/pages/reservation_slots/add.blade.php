@extends('backend.layouts.master')
@section('css')

@section('title')
    {{trans('backend/reservations_trans.Reservation_Slots')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">  {{trans('backend/reservations_trans.Reservation_Slots')}}</h4>
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

                <form method="post" enctype="multipart/form-data" action="{{Route('backend.reservation_slots.store')}}" autocomplete="off">
                    @csrf
                  


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> {{trans('backend/reservations_trans.Reservation_Date')}} <span class="text-danger">*</span></label>
                                <input  class="form-control" name="date" id="datepicker-action" data-date-format="yyyy-mm-dd" >
                                @error('date')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>    

                        <div class="row">

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>{{trans('backend/reservations_trans.Start_Time')}}  </label>
                                    <input  type="time" name="start_time"  class="form-control">
                                    @error('start_time')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>{{trans('backend/reservations_trans.End_Time')}}  </label>
                                    <input  type="time" name="end_time"  class="form-control">
                                    @error('end_time')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>{{trans('backend/reservations_trans.Duration')}}  </label>
                                    <input  type="text" name="duration"  class="form-control">
                                    @error('duration')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>{{trans('backend/reservations_trans.Total_Reservation')}}  </label>
                                    <input  type="text" name="total_reservations"  class="form-control">
                                    @error('total_reservations')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                      

                    
                   <button type="submit" class="btn btn-success btn-md nextBtn btn-lg " >{{trans('backend/reservations_trans.Add')}}</button>


                </form>

                
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
