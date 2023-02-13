@extends('layouts.master')
@section('css')

@section('title')
    {{trans('reservations_trans.Add_Reservation')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">  {{trans('reservations_trans.Add_Reservation')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('reservations_trans.Add_Reservation')}}</a></li>
                <li class="breadcrumb-item active">{{trans('reservations_trans.Reservations')}}</li>
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

                <form method="post" enctype="multipart/form-data" action="{{Route('admin.reservations.store')}}" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label">{{trans('reservations_trans.Patient_Name')}} </label>
                                <select name="patient_id" class="custom-select mr-sm-2">
                                    {{-- <option value="" selected>إختار من القائمة ...</option> --}}
                                    {{-- @foreach($patients as $patient) --}}
                                    <option value="{{ $patient->patient_id }}" selected >{{ $patient->name }}</option>
                                    {{-- @endforeach --}}
                                </select>
                                @error('patient_id')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror 
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label> {{trans('reservations_trans.Number_of_Reservation')}}  <span class="text-danger">*</span></label>
                                {{-- <input  class="form-control" name="res_num" type="number" > --}}
                                <select name="res_num" class="custom-select mr-sm-2">
                                    {{-- <option  disabled style="background:gainsboro">{{trans('reservations_trans.Choose')}}</option> --}}

                                    {{-- @foreach($patients as $patient) --}}
                                    @for($i = 1 ; $i <= $number_of_res ; $i++ )
                                       @if($today_reservation_res_num == $i)
                                       <option value="{{ $i }}" disabled style="background:gainsboro" >{{ $i }}</option>
                                       @else
                                       <option value="{{ $i }}"  >{{ $i }}</option>
                                       @endif
                                       {{-- <option value="{{ $i }}"  >{{ $i }}</option> --}}
                                    @endfor
                                    {{-- @endforeach --}}
                                </select>
                            </div>
                        </div>
                    </div>



                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>{{trans('reservations_trans.First_Diagnosis')}}  </label>
                                <input  type="text" name="first_diagnosis"  class="form-control">
                            </div>
                        </div>


                         <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">{{trans('reservations_trans.Reservation_Type')}} </label>
                                <select name="res_type" class="custom-select mr-sm-2">
                                    <option selected disabled>{{trans('reservations_trans.Choose')}}</option>
                                    <option value="check">       {{trans('reservations_trans.Check')}}</option>
                                    <option value="recheck">     {{trans('reservations_trans.Recheck')}}</option>
                                    <option value="consultation">{{trans('reservations_trans.Consultation')}}</option>           
                                </select>
                                
                            </div>
                        </div>
                      
                    </div>

                    <div class="row">    

                        <div class="col-md-4">
                            <div class="form-group">
                                <label> {{trans('reservations_trans.Cost')}}<span class="text-danger">*</span></label>
                                <input  class="form-control" name="cost" type="number" >
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">{{trans('reservations_trans.Payment')}}</label>
                                <select name="payment" class="custom-select mr-sm-2">
                                    <option selected disabled>{{trans('reservations_trans.Choose')}}</option>
                                    <option value="paid">{{trans('reservations_trans.Paid')}} </option>
                                    <option value="not paid"> {{trans('reservations_trans.Not_Paid')}}  </option>                          
                                </select>
                                
                            </div>
                        </div>


                    </div>

                   <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label> {{trans('reservations_trans.Reservation_Date')}} <span class="text-danger">*</span></label>
                            <input  class="form-control" name="res_date" id="datepicker-action" data-date-format="yyyy-mm-dd" >
                        </div>
                    </div>

                    
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="status">  {{trans('reservations_trans.Reservation_Status')}}<span class="text-danger">*</span></label>
                                
                                <select class="custom-select mr-sm-2" name="status">
                                    <option selected disabled>{{trans('reservations_trans.Choose')}}</option>
                                    <option  value="waiting">{{trans('reservations_trans.Waiting')}}</option>
                                    <option  value="entered">{{trans('reservations_trans.Entered')}}</option>
                                    <option  value="finished">{{trans('reservations_trans.Finished')}}</option>
                                </select>
                            
                            </div>
                        </div>
                    

                   </div> 


                   <button type="submit" class="btn btn-success btn-md nextBtn btn-lg " >{{trans('reservations_trans.Add')}}</button>


                </form>

                
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
