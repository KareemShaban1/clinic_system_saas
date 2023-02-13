@extends('layouts.master')
@section('css')

@section('title')
{{trans('patients_trans.Add_Patient')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">  {{trans('patients_trans.Add_Patient')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('patients_trans.Add_Patient')}}</a></li>
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

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                <form method="post" enctype="multipart/form-data" action="{{Route('admin.patients.store')}}" autocomplete="off">

                    @csrf
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('patients_trans.Patient_Name')}}<span class="text-danger">*</span></label>
                                <input  type="text" name="name"  class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label> {{trans('patients_trans.Age')}} <span class="text-danger">*</span></label>
                                <input  class="form-control" name="age" type="number" >
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{trans('patients_trans.Address')}} <span class="text-danger">*</span></label>
                                <input  type="text" name="address"  class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label> {{trans('patients_trans.Email')}} <span class="text-danger">*</span></label>
                                <input  class="form-control" name="email" type="email" >
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label> {{trans('patients_trans.Phone')}}  <span class="text-danger">*</span></label>
                                <input  class="form-control" name="phone" type="phone" >
                            </div>
                        </div>
                    </div>

                   <div class="row">

                            <div class="col-md-6">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="gender"> {{trans('patients_trans.Patient_Gender')}} <span class="text-danger">*</span></label>
                                        
                                        <select class="custom-select mr-sm-2" name="gender">
                                            <option selected disabled>{{trans('patients_trans.Choose')}}</option>
                                            <option  value="male">{{trans('patients_trans.Male')}}</option>
                                            <option  value="female">{{trans('patients_trans.Female')}}</option>
                                        </select>
                                    
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="blood_group"> {{trans('patients_trans.Blood_Group')}} <span class="text-danger">*</span></label>
                                        
                                        <select class="custom-select mr-sm-2" name="blood_group">
                                            <option selected disabled>{{trans('patients_trans.Choose')}}</option>
                                            <option  value="A+">A+</option>
                                            <option  value="A-">A-</option>
                                            <option  value="B+">B+</option>
                                            <option  value="B-">B-</option>
                                            <option  value="O+">O+</option>
                                            <option  value="O-">O-</option>
                                            <option  value="AB+">AB+</option>
                                            <option  value="AB-">AB-</option>
                                        
                                        </select>
                                    
                                    </div>
                                </div>
                            </div>
                   </div> 


                   <button type="submit" class="btn btn-success btn-md nextBtn btn-lg " >{{trans('patients_trans.Add')}}</button>


                </form>

                
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
