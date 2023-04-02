@extends('backend.layouts.master')

@section('css')

@section('title')
    {{ trans('dashboard_trans.Dashboard') }}
@stop

@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('dashboard_trans.Dashboard') }} </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{ trans('dashboard_trans.Home') }}</a>
                </li>
                <li class="breadcrumb-item active">{{ trans('dashboard_trans.Dashboard') }}</li>
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
            <div class="card-body" style="background: white">



                <div class="dash-div row">

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <div class="clearfix">
                                    <div class="float-right">
                                        <span class="text-success">
                                            <i class="fa fa-user highlight-icon" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <div class="float-left text-left">
                                        <p class="card-text text-dark">{{ trans('dashboard_trans.Users') }}</p>
                                        <h4>{{ \App\Models\User::count() }}</h4>
                                    </div>
                                </div>
                                <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                    <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a
                                        href="{{ Route('backend.users.index') }}" target="_blank"><span
                                            class="text-danger">عرض البيانات</span></a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <div class="clearfix">
                                    <div class="float-right">
                                        <span class="text-success">
                                            <i class="fa-solid fa-hospital-user highlight-icon" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <div class="float-left text-left">
                                        <p class="card-text text-dark">{{ trans('dashboard_trans.Patients') }}</p>
                                        <h4>{{ $patients_count }}</h4>
                                    </div>
                                </div>
                                <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                    <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a
                                        href="{{ Route('backend.patients.index') }}" target="_blank"><span
                                            class="text-danger">عرض البيانات</span></a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <div class="clearfix">
                                    <div class="float-right">
                                        <span class="text-success">
                                            <i class="fa-solid fa-pills highlight-icon" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <div class="float-left text-left">
                                        <p class="card-text text-dark">{{ trans('dashboard_trans.Medicines_Number') }}
                                        </p>
                                        <h4>{{ $medicines_count }}</h4>
                                    </div>
                                </div>
                                <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                    <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a
                                        href="{{ Route('backend.medicines.index') }}" target="_blank"><span
                                            class="text-danger">عرض البيانات</span></a>
                                </p>
                            </div>
                        </div>
                    </div>



                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <div class="clearfix">
                                    <div class="float-right">
                                        <span class="text-success">
                                            <i class="fa fa-stethoscope highlight-icon" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <div class="float-left text-left">
                                        <p class="card-text text-dark">
                                            {{ trans('dashboard_trans.Today_Reservations') }}</p>
                                        <h4>{{ $today_res_count }}</h4>
                                    </div>
                                </div>
                                <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                    <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a
                                        href="{{ Route('backend.reservations.today_reservations') }}"
                                        target="_blank"><span class="text-danger">عرض البيانات</span></a>
                                </p>
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <div class="clearfix">
                                    <div class="float-right">
                                        <span class="text-success">
                                            <i class="fa fa-stethoscope highlight-icon" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <div class="float-left text-left">
                                        <p class="card-text text-dark">
                                            {{ trans('dashboard_trans.Online_Reservations') }}</p>
                                        <h4>{{ $online_reservations_count }}</h4>
                                    </div>
                                </div>
                                <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                    <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a
                                        href="{{ Route('backend.online_reservations.index') }}" target="_blank"><span
                                            class="text-danger">عرض البيانات</span></a>
                                </p>
                            </div>
                        </div>
                    </div>



                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 ">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <div class="clearfix">
                                    <div class="float-right">
                                        <span class="text-success">
                                            <i class="fa fa-stethoscope highlight-icon" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <div class="float-left text-left">
                                        <p class="card-text text-dark">{{ trans('dashboard_trans.All_Reservations') }}
                                        </p>
                                        <h4>{{ $all_reservations_count }}</h4>
                                    </div>
                                </div>
                                <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                    <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a
                                        href="{{ Route('backend.reservations.index') }}" target="_blank"><span
                                            class="text-danger">عرض البيانات</span></a>
                                </p>
                            </div>
                        </div>
                    </div>



                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 ">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <div class="clearfix">
                                    <div class="float-right">
                                        <span class="text-success">
                                            <i class="fa fa-dollar highlight-icon" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <div class="float-left text-left">
                                        <p class="card-text text-dark">{{ trans('dashboard_trans.Today_Fees') }}</p>
                                        <h4>{{ $today_payment }} جنية</h4>
                                    </div>
                                </div>
                                <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                    <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a
                                        href="{{ Route('backend.fees.today') }}" target="_blank"><span
                                            class="text-danger">عرض البيانات</span></a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <div class="clearfix">
                                    <div class="float-right">
                                        <span class="text-success">
                                            <i class="fa fa-dollar highlight-icon" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <div class="float-left text-left">
                                        <p class="card-text text-dark">{{ trans('dashboard_trans.Month_Fees') }}</p>
                                        <h4>{{ $month_payment }} جنية</h4>
                                    </div>
                                </div>
                                <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                    <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a
                                        href="{{ Route('backend.fees.month') }}" target="_blank"><span
                                            class="text-danger">عرض البيانات</span></a>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>



                <div class="col-12 col-lg-4 p-2">
                    <div class="col-12 p-0 main-box">
                        <div class="col-12 px-0">
                            <div class="col-12 px-3 py-3">
                                إجرائات سريعة
                            </div>
                            <div class="col-12 " style="min-height: 1px;background: #f1f1f1;"></div>
                        </div>
                        <div class="col-12 p-3 row d-flex">
                            <div class="col-4  d-flex justify-content-center align-items-center mb-3 py-2">
                                <a href="" target="_blank" style="color:inherit;">
                                    <div class="col-12 p-0 text-center">
                                        <img src="/images/icons/patient.png" style="width:30px;height: 30px">
                                        {{-- <span class="fal fa-home font-5" ></span> --}}
                                        <div class="col-12 p-0 text-center">
                                            المرضى
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-4 d-flex justify-content-center align-items-center mb-3 py-2">
                                <a href="" style="color:inherit;">
                                    <div class="col-12 p-0 text-center">

                                        <img src="/images/icons/reservations.png" style="width:30px;height: 30px">
                                        {{-- <span class="fal fa-bells font-5" ></span> --}}
                                        <div class="col-12 p-0 text-center">
                                            الحجوزات
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-4 d-flex justify-content-center align-items-center mb-3 py-2">
                                <a href="" style="color:inherit;">
                                    <div class="col-12 p-0 text-center">

                                        <img src="/images/icons/fees.png" style="width:30px;height: 30px">
                                        {{-- <span class="fal fa-bullhorn font-5" ></span> --}}
                                        <div class="col-12 p-0 text-center">
                                            الحسابات
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-4 d-flex justify-content-center align-items-center mb-3 py-2">
                                <a href="" style="color:inherit;">
                                    <div class="col-12 p-0 text-center">
                                        <img src="/images/icons/settings.png" style="width:30px;height: 30px">
                                        {{-- <span class="fal fa-wrench font-5" ></span> --}}
                                        <div class="col-12 p-0 text-center">
                                            الإعدادات
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-4 d-flex justify-content-center align-items-center mb-3 py-2">
                                <a href="" style="color:inherit;">
                                    <div class="col-12 p-0 text-center">
                                        <img src="/images/icons/man.png" style="width:30px;height: 30px">
                                        {{-- <span class="fal fa-user font-5" ></span> --}}
                                        <div class="col-12 p-0 text-center">
                                            ملفي
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-4 d-flex justify-content-center align-items-center mb-3 py-2">
                                <a href="" style="color:inherit;">
                                    <div class="col-12 p-0 text-center">
                                        <img src="/images/icons/edit.png" style="width:30px;height: 30px">
                                        {{-- <span class="fal fa-user-edit font-5" ></span> --}}
                                        <div class="col-12 p-0 text-center">
                                            تعديل ملفي
                                        </div>
                                    </div>
                                </a>
                            </div>
                            

                        

                            <div class="col-4 d-flex justify-content-center align-items-center mb-3 py-2">
                                <a href="#"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                                    style="color:inherit;">
                                    <div class="col-12 p-0 text-center">

                                        <img src="/images/icons/logout.png" style="width:30px;height: 30px">
                                        {{-- <span class="fal fa-sign-out-alt font-5" ></span> --}}
                                        <div class="col-12 p-0 text-center">
                                            خروج
                                        </div>
                                    </div>
                                </a>
                            </div>


                        </div>
                    </div>
                </div>


                {{-- @livewire('calendar')   --}}

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
