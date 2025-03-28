@extends('backend.dashboards.clinic.layouts.master')

@section('title')
    {{ trans('backend/dashboard_trans.Dashboard') }}
@endsection

@section('css')
    <style type="text/css">
        a[disabled="disabled"] {
            pointer-events: none;
        }
    </style>
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-12">
                <h4 class="mb-0"> {{ trans('backend/dashboard_trans.Dashboard') }} </h4>
            </div>

            @if (config('app.env') !== 'production')
                <div class="col-md-4 col-sm-4 col-12">
                    <a href="{{ route('clinic.logs') }}" target="blank">
                        Logs
                    </a>
                </div>
            @endif

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

                    @include('backend.dashboards.clinic.pages.dashboard.reservations_add')

                    <div class="dash-div row">

                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-20">
                            <div class="card card-statistics h-100">
                                <div class="card-body">
                                    <div class="clearfix">
                                        <div class="float-right">
                                            <span class="text-success">
                                                <i class="fa fa-user highlight-icon" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <div class="float-left text-left">
                                            <p class="card-text text-dark">{{ trans('backend/dashboard_trans.doctors') }}</p>
                                            <h4>{{ $user_count }}</h4>
                                        </div>
                                    </div>
                                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                        <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a
                                            href="{{ Route('clinic.users.index') }}" target="_blank"><span
                                                class="text-danger">عرض البيانات</span></a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-20">
                            <div class="card card-statistics h-100">
                                <div class="card-body">
                                    <div class="clearfix">
                                        <div class="float-right">
                                            <span class="text-success">
                                                <i class="fa-solid fa-hospital-user highlight-icon" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <div class="float-left text-left">
                                            <p class="card-text text-dark">{{ trans('backend/dashboard_trans.Patients') }}
                                            </p>
                                            <h4>{{ $patients_count }}</h4>
                                        </div>
                                    </div>
                                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                        <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a
                                            href="{{ Route('clinic.patients.index') }}" target="_blank"><span
                                                class="text-danger">عرض البيانات</span></a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-20">
                            <div class="card card-statistics h-100">
                                <div class="card-body">
                                    <div class="clearfix">
                                        <div class="float-right">
                                            <span class="text-success">
                                                <i class="fa-solid fa-pills highlight-icon" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <div class="float-left text-left">
                                            <p class="card-text text-dark">
                                                {{ trans('backend/dashboard_trans.Medicines_Number') }}
                                            </p>
                                            <h4>{{ $medicines_count }}</h4>
                                        </div>
                                    </div>
                                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                        <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a
                                            href="{{ Route('clinic.medicines.index') }}" target="_blank"><span
                                                class="text-danger">عرض البيانات</span></a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-20">
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
                                                {{ trans('backend/dashboard_trans.Today_Reservations') }}</p>
                                            <h4>{{ $today_res_count }}</h4>
                                        </div>
                                    </div>
                                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                        <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a
                                            href="{{ Route('clinic.reservations.today_reservations') }}"
                                            target="_blank"><span class="text-danger">عرض البيانات</span></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dash-div row">
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-20">
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
                                                {{ trans('backend/dashboard_trans.Online_Reservations') }}</p>
                                            <h4>{{ $online_reservations_count }}</h4>
                                        </div>
                                    </div>
                                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                        <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a
                                            href="{{ Route('clinic.online_reservations.index') }}" target="_blank"><span
                                                class="text-danger">عرض البيانات</span></a>
                                    </p>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-20 ">
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
                                                {{ trans('backend/dashboard_trans.All_Reservations') }}
                                            </p>
                                            <h4>{{ $all_reservations_count }}</h4>
                                        </div>
                                    </div>
                                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                        <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a
                                            href="{{ Route('clinic.reservations.index') }}" target="_blank"><span
                                                class="text-danger">عرض البيانات</span></a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-20 ">
                            <div class="card card-statistics h-100">
                                <div class="card-body">
                                    <div class="clearfix">
                                        <div class="float-right">
                                            <span class="text-success">
                                                <i class="fa fa-dollar highlight-icon" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <div class="float-left text-left">
                                            <p class="card-text text-dark">
                                                {{ trans('backend/dashboard_trans.Today_Fees') }}</p>
                                            <h4>{{ $today_payment }} جنية</h4>
                                        </div>
                                    </div>
                                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                        <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a
                                            href="{{ Route('clinic.fees.today') }}" target="_blank"><span
                                                class="text-danger">عرض البيانات</span></a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-20">
                            <div class="card card-statistics h-100">
                                <div class="card-body">
                                    <div class="clearfix">
                                        <div class="float-right">
                                            <span class="text-success">
                                                <i class="fa fa-dollar highlight-icon" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <div class="float-left text-left">
                                            <p class="card-text text-dark">
                                                {{ trans('backend/dashboard_trans.Month_Fees') }}</p>
                                            <h4>{{ $month_payment }} جنية</h4>
                                        </div>
                                    </div>
                                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                        <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a
                                            href="{{ Route('clinic.fees.month') }}" target="_blank"><span
                                                class="text-danger">عرض البيانات</span></a>
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row card-body p-2 last-jobs">

                        <div class="col-12 col-xl-9 col-md-12 col-sm-12 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">

                                    <div class="tab nav-border" style="position: relative;">
                                        <div class="d-block d-md-flex justify-content-between">

                                            <div class="d-block w-100">
                                                <h5 class="card-title">
                                                    {{ trans('backend/dashboard_trans.Last_Processes') }}</h5>
                                            </div>

                                            <div class="d-block d-md-flex nav-tabs-custom p-0">
                                                <ul class="nav nav-tabs" id="myTab" role="tablist">

                                                    <li class="nav-item">
                                                        <a class="nav-link active show" id="patients-tab"
                                                            data-toggle="tab" href="#patients" role="tab"
                                                            aria-controls="patients" aria-selected="true">
                                                            {{ trans('backend/dashboard_trans.Last_Patients') }}</a>
                                                    </li>

                                                    <li class="nav-item">
                                                        <a class="nav-link" id="reservations-tab" data-toggle="tab"
                                                            href="#reservations" role="tab"
                                                            aria-controls="reservations"
                                                            aria-selected="false">{{ trans('backend/dashboard_trans.Last_Reservations') }}
                                                        </a>
                                                    </li>

                                                    <li class="nav-item">
                                                        <a class="nav-link" id="online_reservations-tab"
                                                            data-toggle="tab" href="#online_reservations" role="tab"
                                                            aria-controls="online_reservations"
                                                            aria-selected="false">{{ trans('backend/dashboard_trans.Last_Online_Reservations') }}
                                                        </a>
                                                    </li>


                                                </ul>
                                            </div>

                                        </div>

                                        <div class="tab-content" id="myTabContent">

                                            {{-- patients Table --}}
                                            <div class="tab-pane fade active show" id="patients" role="tabpanel"
                                                aria-labelledby="patients-tab">
                                                <div class="table-responsive mt-15">
                                                    <table style="text-align: center"
                                                        class="table center-aligned-table table-hover mb-0">
                                                        <thead>
                                                            <tr class="table-info text-danger">
                                                                <th>{{ trans('backend/patients_trans.Id') }}</th>
                                                                <th>{{ trans('backend/patients_trans.Patient_Name') }}</th>
                                                                <th>{{ trans('backend/patients_trans.Number_of_Reservations') }}
                                                                </th>
                                                                <th>{{ trans('backend/patients_trans.Phone') }}</th>
                                                                <th>{{ trans('backend/patients_trans.Add_Reservation') }}
                                                                </th>
                                                                <th>{{ trans('backend/patients_trans.Add_Online_Reservation') }}
                                                                </th>
                                                                <th></th>
                                                                <th>{{ trans('backend/patients_trans.Control') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($last_patients as $patient)
                                                                <tr>
                                                                    <td>{{ $patient->id }}</td>
                                                                    <td>{{ $patient->name }}</td>
                                                                    <th>
                                                                        {{ $patient->reservations_count }}
                                                                    </th>
                                                                    <td>{{ $patient->phone }}</td>

                                                                    <td>
                                                                        <a href="{{ Route('clinic.reservations.add', $patient->id) }}"
                                                                            class="btn btn-info btn-sm">
                                                                            {{ trans('backend/patients_trans.Add_Reservation') }}
                                                                        </a>
                                                                    </td>

                                                                    <td>
                                                                        <a href="{{ Route('clinic.online_reservations.add', $patient->id) }}"
                                                                            class="btn btn-info btn-sm">
                                                                            {{ trans('backend/patients_trans.Add_Online_Reservation') }}
                                                                        </a>
                                                                    </td>
                                                                    <td>
                                                                        <a href="{{ Route('clinic.patients.patient_pdf', $patient->id) }}"
                                                                            class="btn btn-primary btn-sm">
                                                                            عرض كارت المريض
                                                                        </a>
                                                                    </td>
                                                                    <td>
                                                                        <a href="{{ Route('clinic.patients.show', $patient->id) }}"
                                                                            class="btn btn-primary btn-sm">
                                                                            <i class="fa fa-eye"></i>
                                                                        </a>
                                                                        <a href="{{ Route('clinic.patients.edit', $patient->id) }}"
                                                                            class="btn btn-warning btn-sm">
                                                                            <i class="fa fa-edit"></i>
                                                                        </a>

                                                                        @if (count($patient->reservations) == 0)
                                                                            <form
                                                                                action="{{ Route('clinic.patients.destroy', $patient->id) }}"
                                                                                method="post" style="display:inline">
                                                                                @csrf
                                                                                @method('delete')

                                                                                <button type="submit"
                                                                                    class="btn btn-danger btn-sm">
                                                                                    <i class="fa fa-trash"></i>
                                                                                </button>
                                                                            </form>
                                                                        @endif


                                                                    </td>

                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            {{-- reservations Table --}}
                                            <div class="tab-pane fade" id="reservations" role="tabpanel"
                                                aria-labelledby="reservations-tab">
                                                <div class="table-responsive mt-15">
                                                    <table style="text-align: center"
                                                        class="table center-aligned-table table-hover mb-0">
                                                        <thead>
                                                            <tr>

                                                                <th>{{ trans('backend/reservations_trans.Patient_Name') }}
                                                                </th>
                                                                @if (App::getLocale() == 'ar')
                                                                    <th>{{ trans('backend/reservations_trans.Reservation_Type') }}
                                                                    </th>
                                                                @endif
                                                                <th>{{ trans('backend/reservations_trans.Payment') }}</th>
                                                                <th>{{ trans('backend/reservations_trans.Reservation_Status') }}
                                                                </th>
                                                                <th>{{ trans('backend/reservations_trans.Acceptance') }}
                                                                </th>


                                                                <th>{{ trans('backend/reservations_trans.Control') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            @foreach ($reservations as $reservation)
                                                                <tr>


                                                                    <td>{{ $reservation->patient->name }}</td>

                                                                    @if (App::getLocale() == 'ar')
                                                                        <td>
                                                                            @if ($reservation->res_type == 'check')
                                                                                {{ trans('backend/reservations_trans.Check') }}
                                                                            @elseif ($reservation->res_type == 'recheck')
                                                                                {{ trans('backend/reservations_trans.Recheck') }}
                                                                            @elseif ($reservation->res_type == 'consultation')
                                                                                {{ trans('backend/reservations_trans.Consultation') }}
                                                                            @endif
                                                                        </td>
                                                                    @endif

                                                                    <td>
                                                                        @if ($reservation->payment == 'paid')
                                                                            <span
                                                                                class="badge badge-rounded badge-success p-2 mb-2">
                                                                                {{ trans('backend/reservations_trans.Paid') }}
                                                                            </span>
                                                                        @elseif ($reservation->payment == 'not paid')
                                                                            <span
                                                                                class="badge badge-rounded badge-danger p-2 mb-2">
                                                                                {{ trans('backend/reservations_trans.Not_Paid') }}
                                                                            </span>
                                                                        @endif
                                                                        <div class="res_control">
                                                                            <a href="{{ Route('clinic.reservations.payment_status', [$reservation->id, 'paid']) }}"
                                                                                class="btn btn-success btn-sm">{{ trans('backend/reservations_trans.Done') }}
                                                                            </a>
                                                                            <a href="{{ Route('clinic.reservations.payment_status', [$reservation->id, 'not paid']) }}"
                                                                                class="btn btn-danger btn-sm">{{ trans('backend/reservations_trans.Not_Done') }}
                                                                            </a>
                                                                        </div>

                                                                    </td>

                                                                    <td>
                                                                        @if ($reservation->res_status == 'waiting')
                                                                            <span
                                                                                class="badge badge-rounded badge-warning text-white p-2 mb-2">
                                                                                {{ trans('backend/reservations_trans.Waiting') }}
                                                                            </span>
                                                                        @elseif ($reservation->res_status == 'entered')
                                                                            <span
                                                                                class="badge badge-rounded badge-success p-2 mb-2">
                                                                                {{ trans('backend/reservations_trans.Entered') }}
                                                                            </span>
                                                                        @elseif ($reservation->res_status == 'finished')
                                                                            <span
                                                                                class="badge badge-rounded badge-danger p-2 mb-2">
                                                                                {{ trans('backend/reservations_trans.Finished') }}
                                                                            </span>
                                                                        @endif

                                                                        <div class="res_control">

                                                                            <a href="{{ Route('clinic.reservations.reservation_status', [$reservation->id, 'waiting']) }}"
                                                                                class="btn btn-warning btn-sm text-white">
                                                                                {{ trans('backend/reservations_trans.Waiting') }}
                                                                            </a>
                                                                            <a href="{{ Route('clinic.reservations.reservation_status', [$reservation->id, 'entered']) }}"
                                                                                class="btn btn-success btn-sm">
                                                                                {{ trans('backend/reservations_trans.Entered') }}
                                                                            </a>
                                                                            <a href="{{ Route('clinic.reservations.reservation_status', [$reservation->id, 'finished']) }}"
                                                                                class="btn btn-danger btn-sm">
                                                                                {{ trans('backend/reservations_trans.Finished') }}
                                                                            </a>
                                                                        </div>
                                                                    </td>


                                                                    <td>
                                                                        @if ($reservation->acceptance == 'approved')
                                                                            <span
                                                                                class="badge badge-rounded badge-success text-white p-2 mb-2">
                                                                                {{ trans('backend/reservations_trans.Approved') }}
                                                                            </span>
                                                                        @elseif ($reservation->acceptance == 'not_approved')
                                                                            <span
                                                                                class="badge badge-rounded badge-danger p-2 mb-2">
                                                                                {{ trans('backend/reservations_trans.Not_Approved') }}
                                                                            </span>
                                                                        @endif


                                                                    </td>




                                                                    <td>
                                                                        <div class="res_control">
                                                                            <a href="{{ Route('clinic.reservations.show', $reservation->id) }}"
                                                                                class="btn btn-primary btn-sm">
                                                                                <i class="fa fa-eye"></i>
                                                                            </a>
                                                                            <a href="{{ Route('clinic.reservations.edit', $reservation->id) }}"
                                                                                class="btn btn-warning btn-sm">
                                                                                <i class="fa fa-edit"></i>
                                                                            </a>
                                                                            <form
                                                                                action="{{ Route('clinic.reservations.destroy', $reservation->id) }}"
                                                                                method="post" style="display:inline">
                                                                                @csrf
                                                                                @method('delete')

                                                                                <button type="submit"
                                                                                    class="btn btn-danger btn-sm">
                                                                                    <i class="fa fa-trash"></i>
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                    </td>



                                                                </tr>
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            {{-- online_reservations Table --}}
                                            <div class="tab-pane fade" id="online_reservations" role="tabpanel"
                                                aria-labelledby="online_reservations-tab">
                                                <div class="table-responsive mt-15">
                                                    <table style="text-align: center"
                                                        class="table center-aligned-table table-hover mb-0">
                                                        <thead>
                                                            <tr class="alert-success">
                                                                <th>#</th>
                                                                <th>{{ trans('backend/online_reservations_trans.doctor_Name') }}
                                                                </th>
                                                                <th>{{ trans('backend/online_reservations_trans.Patient_Name') }}
                                                                </th>
                                                                <th>{{ trans('backend/online_reservations_trans.Title') }}
                                                                </th>
                                                                <th>{{ trans('backend/online_reservations_trans.Time_Date') }}
                                                                </th>
                                                                <th>{{ trans('backend/online_reservations_trans.Duration') }}
                                                                </th>
                                                                <th>{{ trans('backend/online_reservations_trans.Link') }}
                                                                </th>
                                                                <th>{{ trans('backend/online_reservations_trans.Controls') }}
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($online_reservations as $online_reservation)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>

                                                                    <td>{{ $online_reservation->created_by }}</td>
                                                                    <td>{{ $online_reservation->patient->name }}</td>
                                                                    <td>{{ $online_reservation->topic }}</td>
                                                                    <td>{{ $online_reservation->start_at }}</td>
                                                                    <td>{{ $online_reservation->duration }}</td>
                                                                    <td class="text-danger"><a
                                                                            href="{{ $online_reservation->join_url }}"
                                                                            target="_blank">انضم الان</a></td>
                                                                    <td>
                                                                        <button type="button"
                                                                            class="btn btn-danger btn-sm"
                                                                            data-toggle="modal"
                                                                            data-target="#Delete_receipt{{ $online_reservation->meeting_id }}"><i
                                                                                class="fa fa-trash"></i></button>
                                                                    </td>
                                                                </tr>
                                                                @include('backend.dashboards.clinic.pages.online_reservations.delete')
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>


                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div style="height: 400px;" class="col-12 col-lg-3 col-md-12 col-sm-12 ">
                            <div class="card card-statistics h-100">
                                <div class="card-body">
                                    <div class="col-12 px-0">
                                        <div class="col-12 px-3 py-3">
                                            {{ trans('Backend/dashboard_trans.Fast_Processes') }}
                                        </div>
                                        <div class="col-12 " style="min-height: 1px;background: #f1f1f1;"></div>
                                    </div>
                                    <div class="col-12 p-3 row d-flex m-0">
                                        <div class="col-4  d-flex justify-content-center align-items-center mb-3 py-2">
                                            <a href="{{ Route('clinic.patients.index') }}" style="color:inherit;">
                                                <div class="col-12 p-0 text-center">
                                                    <img src="/images/icons/patient.png" style="width:30px;height: 30px">

                                                    <div class="col-12 p-0 text-center">
                                                        {{ trans('backend/dashboard_trans.Patients') }}
                                                    </div>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="col-4 d-flex justify-content-center align-items-center mb-3 py-2">
                                            <a href="{{ Route('clinic.reservations.index') }}" style="color:inherit;">
                                                <div class="col-12 p-0 text-center">

                                                    <img src="/images/icons/reservations.png"
                                                        style="width:30px;height: 30px">

                                                    <div class="col-12 p-0 text-center">
                                                        {{ trans('backend/dashboard_trans.Reservations') }}
                                                    </div>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="col-4 d-flex justify-content-center align-items-center mb-3 py-2">
                                            <a href="{{ Route('clinic.fees.index') }}" style="color:inherit;">
                                                <div class="col-12 p-0 text-center">

                                                    <img src="/images/icons/fees.png" style="width:30px;height: 30px">

                                                    <div class="col-12 p-0 text-center">
                                                        {{ trans('backend/dashboard_trans.Fees') }}
                                                    </div>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="col-4 d-flex justify-content-center align-items-center mb-3 py-2">
                                            <a href="{{ Route('clinic.settings.index') }}" style="color:inherit;">
                                                <div class="col-12 p-0 text-center">
                                                    <img src="/images/icons/settings.png" style="width:30px;height: 30px">

                                                    <div class="col-12 p-0 text-center">
                                                        {{ trans('backend/dashboard_trans.Settings') }}
                                                    </div>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="col-4 d-flex justify-content-center align-items-center mb-3 py-2">
                                            <a href="" style="color:inherit;">
                                                <div class="col-12 p-0 text-center">
                                                    <img src="/images/icons/man.png" style="width:30px;height: 30px">

                                                    <div class="col-12 p-0 text-center">
                                                        {{ trans('backend/dashboard_trans.My_Profile') }}
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-4 d-flex justify-content-center align-items-center mb-3 py-2">
                                            <a href="" style="color:inherit;">
                                                <div class="col-12 p-0 text-center">
                                                    <img src="/images/icons/edit.png" style="width:30px;height: 30px">

                                                    <div class="col-12 p-0 text-center">
                                                        {{ trans('backend/dashboard_trans.Edit_Profile') }}
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

                                                    <div class="col-12 p-0 text-center">
                                                        {{ trans('backend/dashboard_trans.Logout') }}
                                                    </div>
                                                </div>
                                            </a>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    @include('backend.dashboards.clinic.pages.dashboard.charts')


                </div>
            </div>
        </div>




        <!-- row closed -->
    @endsection

    @section('js')
        <script>
            $(document).ready(function() {


                $('#datepicker-action').change(function() {
                    var selectedDate = $(this).val();
                    // Perform an AJAX request to fetch the updated number of reservations
                    $.ajax({
                        url: "{{ URL::to('/backend/reservations/get_res_slot_number_add') }}", // Replace with the actual URL to handle the AJAX request
                        method: 'GET',
                        data: {
                            date: selectedDate,
                        },
                        success: function(response) {

                            // Clear the existing options
                            $('select[name="reservation_number"]').empty();
                            // Add the updated options
                            for (var i = 1; i <= response.reservationsCount; i++) {
                                console.log(response.todayReservationResNum.includes(i));
                                if (response.todayReservationResNum.includes(i)) {
                                    var option = '<option value="' + i +
                                        '" disabled style="background:gainsboro">' + i +
                                        '</option>';
                                } else {
                                    var option = '<option value="' + i + '">' + i + '</option>';
                                }
                                $('select[name="reservation_number"]').append(option);
                            }



                            // Clear the current options
                            $('#slot-select').empty();
                            // Add the new options based on the response
                            $.each(response.slots, function(index, slot) {
                                var option = $('<option>').val(slot.slot_start_time).text(
                                    slot.slot_start_time + ' - ' + slot.slot_end_time);

                                if (response.today_reservation_slots.includes(slot
                                        .slot_start_time)) {
                                    option.attr('disabled',
                                        true); // Disable the option if reserved
                                    option.css('background', 'gainsboro');
                                }
                                $('#slot-select').append(option);
                            });
                        },
                        error: function(xhr, status, error) {
                            // Handle the error response
                            console.log(error);
                        }
                    });
                });


            });
        </script>
    @endsection
