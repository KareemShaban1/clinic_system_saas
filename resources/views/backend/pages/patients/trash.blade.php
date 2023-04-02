@extends('backend.layouts.master')
@section('css')

@section('title')
    {{trans('patients_trans.Deleted_Patients')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('patients_trans.Deleted_Patients')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('patients_trans.Deleted_Patients')}}</a></li>
                <li class="breadcrumb-item active">{{trans('patients_trans.Patients')}}</li>
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
                            <th>{{trans('patients_trans.Id')}}</th>
                            <th>{{trans('patients_trans.Patient_Name')}}</th>
                            <th>{{trans('patients_trans.Phone')}}</th>
                            <th>{{trans('patients_trans.Address')}}</th>
                            <th>{{trans('patients_trans.Age')}}</th>
                            <th>{{trans('patients_trans.Control')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($patients as $patient)
                        <tr>
                            <td>{{ $patient->patient_id }}</td>
                            <td>{{ $patient->name }}</td>
                            <td>{{ $patient->phone }}</td>
                            <td>{{ $patient->address }}</td>
                            <td>{{ $patient->age }}</td>
                            <td>
                              

                                <form action="{{Route('backend.patients.restore',$patient->patient_id)}}" method="post" style="display:inline">
                                    @csrf
                                    @method('put')
                                    
                                    <button type="submit" class="btn btn-success btn-sm" >
                                        <i class="fa fa-edit"></i>
                                        {{trans('patients_trans.Restore')}}
                                    </button>   
                                </form>
                               

                                <form action="{{Route('backend.patients.forceDelete',$patient->patient_id)}}" method="post" style="display:inline">
                                    @csrf
                                    @method('delete')
                                    
                                    <button type="submit" class="btn btn-danger btn-sm" >
                                        <i class="fa fa-trash"></i> 
                                        {{trans('patients_trans.Delete_Forever')}}
                                    </button>   
                                </form>

                               
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
<script>
    $(document).ready( function () {
        $('#table_id').DataTable();
    } );
</script>
@endsection
