@extends('backend.layouts.master')
@section('css')
<style>
    tfoot input {
        width: 70%;
        padding: 3px;
        box-sizing: border-box;
    }
</style>
@section('title')
    {{trans('backend/patients_trans.Patients')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{trans('backend/patients_trans.Patients')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('backend/patients_trans.All_Patients')}}</a></li>
                <li class="breadcrumb-item active">{{trans('backend/patients_trans.Patients')}}</li>
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

                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th>{{trans('backend/patients_trans.Id')}}</th>
                            <th>{{trans('backend/patients_trans.Patient_Name')}}</th>
                            <th>{{trans('backend/patients_trans.Number_of_Reservations')}}</th>
                            <th>{{trans('backend/patients_trans.Phone')}}</th>
                            <th>{{trans('backend/patients_trans.Address')}}</th>
                            <th>{{trans('backend/patients_trans.Age')}}</th>
                            <th>{{trans('backend/patients_trans.Add_Reservation')}}</th>
                            <th>{{trans('backend/patients_trans.Add_Online_Reservation')}}</th>
                            <th></th>
                            <th>{{trans('backend/patients_trans.Control')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($patients as $patient)
                        <tr>
                            <td>{{ $patient->patient_id }}</td>
                            <td>{{ $patient->name }}</td>
                            <th>
                                {{ count(App\Models\Reservation::where('patient_id',$patient->patient_id)->get())}}
                            </th>
                            <td>{{ $patient->phone }}</td>
                            <td>{{ $patient->address }}</td>
                            <td>{{ $patient->age }}</td>
                            <td>
                                <a href="{{Route('backend.reservations.add',$patient->patient_id)}}" class="btn btn-info btn-sm">
                                    {{trans('backend/patients_trans.Add_Reservation')}}
                                </a>
                            </td>

                            <td>
                                <a href="{{Route('backend.online_reservations.add',$patient->patient_id)}}" class="btn btn-info btn-sm">
                                    {{trans('backend/patients_trans.Add_Online_Reservation')}}
                                </a>
                            </td>
                            <td>
                                <a href="{{Route('backend.patients.patient_pdf',$patient->patient_id)}}" class="btn btn-primary btn-sm">
                                    عرض كارت المريض
                                </a>
                            </td>
                            <td>
                                <a href="{{Route('backend.patients.show',$patient->patient_id)}}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{Route('backend.patients.edit',$patient->patient_id)}}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                               
                                @if(count($patient->reservations) == 0)
                                <form action="{{Route('backend.patients.destroy',$patient->patient_id)}}" method="post" style="display:inline">
                                    @csrf
                                    @method('delete')
                                    
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> 
                                    </button>   
                                </form>
                                @endif

                               
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>

                    {{-- <tfoot>
                        <tr>
                            <th>{{trans('backend/patients_trans.Id')}}</th>
                            <th>{{trans('backend/patients_trans.Patient_Name')}}</th>
                            <th>{{trans('backend/patients_trans.Number_of_Reservations')}}</th>
                            <th>{{trans('backend/patients_trans.Phone')}}</th>
                            <th>{{trans('backend/patients_trans.Address')}}</th>
                            <th>{{trans('backend/patients_trans.Age')}}</th>
                            <th>{{trans('backend/patients_trans.Add_Reservation')}}</th>
                            <th>{{trans('backend/patients_trans.Add_Online_Reservation')}}</th>
                            <th></th>
                            <th>{{trans('backend/patients_trans.Control')}}</th>
                        </tr>
                    </tfoot> --}}
                </table>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
{{--  --}}
@endsection
