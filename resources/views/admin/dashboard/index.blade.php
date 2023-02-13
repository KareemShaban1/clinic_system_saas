@extends('layouts.master')

@section('css')

@section('title')
     {{trans('dashboard_trans.Dashboard')}}
@stop

@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('dashboard_trans.Dashboard')}} </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('dashboard_trans.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('dashboard_trans.Dashboard')}}</li>
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

                {{-- <div class="col-12"> --}}
                    {{-- <div class="row"> --}}
                    <div class="dash-div row"> 

                        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">
                                    <div class="clearfix">
                                        <div class="float-right">
                                            <span class="text-success">
                                                <i class="fa fa-user highlight-icon" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <div class="float-left text-left">
                                            <p class="card-text text-dark">{{trans('dashboard_trans.Users')}}</p>
                                            <h4>{{\App\Models\User::count()}}</h4>
                                        </div>
                                    </div>
                                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                        <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a href="{{Route('admin.users.index')}}" target="_blank"><span class="text-danger">عرض البيانات</span></a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">
                                    <div class="clearfix">
                                        <div class="float-right">
                                            <span class="text-success">
                                                <i class="fa-solid fa-hospital-user highlight-icon" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <div class="float-left text-left">
                                            <p class="card-text text-dark">{{trans('dashboard_trans.Patients')}}</p>
                                            <h4>{{$patients_count}}</h4>
                                        </div>
                                    </div>
                                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                        <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a href="{{Route('admin.patients.index')}}" target="_blank"><span class="text-danger">عرض البيانات</span></a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">
                                    <div class="clearfix">
                                        <div class="float-right">
                                            <span class="text-success">
                                                <i class="fa fa-stethoscope highlight-icon" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <div class="float-left text-left">
                                            <p class="card-text text-dark">{{trans('dashboard_trans.Today_Reservations')}}</p>
                                            <h4>{{$today_res_count}}</h4>
                                        </div>
                                    </div>
                                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                        <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a href="{{Route('admin.reservations.today')}}" target="_blank"><span class="text-danger">عرض البيانات</span></a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">
                                    <div class="clearfix">
                                        <div class="float-right">
                                            <span class="text-success">
                                                <i class="fa fa-dollar highlight-icon" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <div class="float-left text-left">
                                            <p class="card-text text-dark">{{trans('dashboard_trans.Today_Fees')}}</p>
                                            <h4>{{$cost_sum}}</h4>
                                        </div>
                                    </div>
                                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                        <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a href="{{Route('admin.fees.index')}}" target="_blank"><span class="text-danger">عرض البيانات</span></a>
                                    </p>
                                </div>
                            </div>
                        </div>        
                        
                        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">
                                    <div class="clearfix">
                                        <div class="float-right">
                                            <span class="text-success">
                                                <i class="fa-solid fa-pills highlight-icon" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <div class="float-left text-left">
                                            <p class="card-text text-dark">{{trans('dashboard_trans.Medicines_Number')}}</p>
                                            <h4>{{$medicines_count}}</h4>
                                        </div>
                                    </div>
                                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                        <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a href="{{Route('admin.medicines.index')}}" target="_blank"><span class="text-danger">عرض البيانات</span></a>
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>

                  
                    {{-- </div> --}}
                {{-- </div> --}}
                

                @livewire('calendar')                
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
