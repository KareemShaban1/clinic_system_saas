@extends('backend.layouts.master')
@section('css')

@section('title')
{{trans('backend/patients_trans.Patients')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('backend/patients_trans.Patient_Profile')}}</h4>
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

                <div class="content-body">
                    <!-- row -->
                    <div class="container-fluid p-0">
                    
                        <div class="row">
                            
                            <div class="col-xl-12 col-xxl-8 col-lg-8 p-0">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="profile-tab">
                                            <div class="custom-tab-1">
                                                <ul class="nav nav-tabs">
                                                    <li class="nav-item">
                                                        <a href="#info" data-toggle="tab" class="nav-link active show">{{trans('backend/patients_trans.Patient_Information')}}</a>
                                                    </li>
                                                    
                                                    <li class="nav-item">
                                                        <a href="#reservations" data-toggle="tab" class="nav-link">{{trans('backend/patients_trans.Reservations')}}</a>
                                                    </li>
                                                </ul>

                                                <div class="tab-content">
                                                    
                                                    <div id="info" class="tab-pane fade active show">


                                                        <div class="profile-personal-info pt-4">
                                                            
                                                            
                                                            <div class="row mb-4">
                                                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                                    <h5 class="f-w-500">{{trans('backend/patients_trans.Patient_Name')}} <span class="{{trans('backend/patients_trans.pull')}}">:</span>
                                                                    </h5>
                                                                </div>
                                                                <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{$patient->name}}</span>
                                                                </div>
                                                            </div>
                    
                    
                                                            <div class="row mb-4">
                                                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                                    <h5 class="f-w-500"> {{trans('backend/patients_trans.Email')}} <span class="{{trans('backend/patients_trans.pull')}}">:</span>
                                                                    </h5>
                                                                </div>
                                                                <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{$patient->email}}</span>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="row mb-4">
                                                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                                    <h5 class="f-w-500">{{trans('backend/patients_trans.Age')}} <span class="{{trans('backend/patients_trans.pull')}}">:</span></h5>
                                                                </div>
                                                                <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{$patient->age}}</span>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-4">
                                                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                                    <h5 class="f-w-500"> {{trans('backend/patients_trans.Phone')}} <span class="{{trans('backend/patients_trans.pull')}}">:</span>
                                                                    </h5>
                                                                </div>
                                                                <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{$patient->phone}}</span>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-4">
                                                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                                    <h5 class="f-w-500">{{trans('backend/patients_trans.Address')}} <span class="{{trans('backend/patients_trans.pull')}}">:</span></h5>
                                                                </div>
                                                                <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{$patient->address}}</span>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-4">
                                                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                                    <h5 class="f-w-500">{{trans('backend/patients_trans.Reservation_Count')}} <span class="{{trans('backend/patients_trans.pull')}}">:</span></h5>
                                                                </div>
                                                                <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{$patient->reservations_count}}</span>
                                                                </div>
                                                            </div>
                    
                                                            <div class="row mb-4">
                                                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                                    <h5 class="f-w-500">{{trans('backend/patients_trans.Patient_Gender')}} <span class="{{trans('backend/patients_trans.pull')}}">:</span></h5>
                                                                </div>
                                                                <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                                                    <span>
                                                                        @if( $patient->gender == "male" )
                                                                        {{trans('backend/patients_trans.Male')}}
                                                                        @elseif ($patient->gender == "female")
                                                                        {{trans('backend/patients_trans.Female')}}
                                                                        @endif
                                                                    </span>
                                                                </div>
                                                            </div>
                    
                    
                                                            <div class="row mb-4">
                                                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                                    <h5 class="f-w-500">{{trans('backend/patients_trans.Blood_Group')}}  <span class="{{trans('backend/patients_trans.pull')}}">:</span></h5>
                                                                </div>
                                                                <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{$patient->blood_group}}</span>
                                                                </div>
                                                            </div>
                    
                                                           
                                                        </div>
                                                        
                                                    </div>


                                                    <div id="reservations" class="tab-pane fade">
                                                    
                                                        <div class="my-post-content pt-4">
                                          

                                                            @forelse($patient->reservations as $reservation)
                                                            <h5 class="card-header">
                                                                <span class="badge badge-rounded badge-warning ">
                                                               <h5>  {{trans('backend/patients_trans.Reservation_Number')}}   {{$loop->index+1}} </h5>
                                                                </span>
                                                            </h5>
                                                            <div class="card-body">
                    
                                                                <div class="row mb-4">
                                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                                        <h5 class="f-w-500">{{trans('backend/patients_trans.Id')}} <span class="{{trans('backend/patients_trans.pull')}}">:</span></h5>
                                                                    </div>
                                                                    <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{$reservation->reservation_id}}</span>
                                                                    </div>
                                                                </div>
                    
                                                                
                                                                <div class="row mb-4">
                                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                                        <h5 class="f-w-500"> {{trans('backend/patients_trans.Number_of_Reservation')}} <span class="{{trans('backend/patients_trans.pull')}}">:</span></h5>
                                                                    </div>
                                                                    <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{$reservation->res_num}}</span>
                                                                    </div>
                                                                </div>
                    
                                                                <div class="row mb-4">
                                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                                        <h5 class="f-w-500">{{trans('backend/patients_trans.First_Diagnosis')}}  <span class="{{trans('backend/patients_trans.pull')}}">:</span></h5>
                                                                    </div>
                                                                    <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{$reservation->first_diagnosis}}</span>
                                                                    </div>
                                                                </div>
                    
                                                                <div class="row mb-4">
                                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                                        <h5 class="f-w-500"> {{trans('backend/patients_trans.Reservation_Type')}} <span class="{{trans('backend/patients_trans.pull')}}">:</span></h5>
                                                                    </div>
                                                                    <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span> <p> 
                                                                        @if( $reservation->res_type == "check" )
                                                                        {{trans('backend/patients_trans.Check')}}
                                                                        @elseif ($reservation->res_type == "recheck")
                                                                        {{trans('backend/patients_trans.Recheck')}}
                                                                        @elseif ($reservation->res_type == "consultation")
                                                                        {{trans('backend/patients_trans.Consultation')}}
                                                                        @endif
                                                                    </p></span>
                                                                    </div>
                                                                </div>
                    
                                                                <div class="row mb-4">
                                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                                        <h5 class="f-w-500">{{trans('backend/patients_trans.Payment')}} <span class="{{trans('backend/patients_trans.pull')}}">:</span></h5>
                                                                    </div>
                                                                    <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                                                                        @if( $reservation->payment == "paid" )
                                                                        <span class="badge badge-rounded badge-success p-3">
                                                                            {{trans('backend/patients_trans.Paid')}}
                                                                        </span>
                                                                        @elseif ($reservation->payment == "not paid")
                                                                        <span class="badge badge-rounded badge-danger p-3">
                                                                            {{trans('backend/patients_trans.Not_Paid')}}
                                                                        </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                              
                    
                    
                                                              
                                                                <div class="row mb-4">
                                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                                        <h5 class="f-w-500"> {{trans('backend/patients_trans.Reservation_Date')}}<span class="pull-left">:</span></h5>
                                                                    </div>
                                                                    <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{$reservation->res_date}}</span>
                                                                    </div>
                                                                </div>
                    
                                                    
                                                                <div class="row mb-4">
                                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                                                        <h5 class="f-w-500"> {{trans('backend/patients_trans.Final_Diagnosis')}}  <span class="pull-left">:</span></h5>
                                                                    </div>
                                                                    <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{$reservation->final_diagnosis}}</span>
                                                                    </div>
                                                                </div>
                    
                    
                                                                
                                                            </div>
                                                            @empty
                                                            <div> لا توجد حجوزات للمريض </div>
                                                            @endforelse
                                                        </div>


                                                    </div>




                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
