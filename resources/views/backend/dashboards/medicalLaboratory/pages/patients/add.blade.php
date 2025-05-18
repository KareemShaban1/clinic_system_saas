@extends('backend.dashboards.medicalLaboratory.layouts.master')
@section('css')

@section('title')
    {{ trans('backend/patients_trans.Add_Patient') }}
@stop
@endsection
@section('page-header')
<h4 class="page-title">{{ trans('backend/patients_trans.Add_Patient') }}</h4>
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">


                <x-backend.alert />

                <form method="post" enctype="multipart/form-data" action="{{ Route('medicalLaboratory.patients.store') }}"
                    autocomplete="off">

                    @csrf
                    <div class="row">

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="name">{{ trans('backend/patients_trans.Patient_Name') }}<span
                                        class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control">

                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="address">{{ trans('backend/patients_trans.Address') }} <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="address" name="address" class="form-control">

                            </div>
                        </div>


                      
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="email"> {{ trans('backend/patients_trans.Email') }} </label>
                                <input class="form-control" id="email" name="email" type="email">

                            </div>
                        </div>

                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="password"> {{ trans('backend/patients_trans.Password') }} </label>
                                <input class="form-control" id="password" name="password" type="password">

                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="phone"> {{ trans('backend/patients_trans.Phone') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" id="phone" name="phone" type="phone">

                            </div>
                        </div>
                    </div>
 
                    <div class="row">
                    <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="age"> {{ trans('backend/patients_trans.Age') }} </label>
                                <input class="form-control" id="age" name="age" type="number">

                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="gender"> {{ trans('backend/patients_trans.Patient_Gender') }} <span
                                        class="text-danger">*</span></label>

                                <select class="custom-select mr-sm-2" name="gender" id="gender">
                                    <option selected disabled>{{ trans('backend/patients_trans.Choose') }}</option>
                                    <option value="male">{{ trans('backend/patients_trans.Male') }}</option>
                                    <option value="female">{{ trans('backend/patients_trans.Female') }}</option>
                                </select>
                                

                            </div>
                        </div>

                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="blood_group"> {{ trans('backend/patients_trans.Blood_Group') }} <span
                                        class="text-danger">*</span></label>

                                <select class="custom-select mr-sm-2" id="blood_group" name="blood_group">
                                    <option selected disabled>{{ trans('backend/patients_trans.Choose') }}</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                </select>
                                
                            </div>
                        </div>
                    </div>

                    <div class="row">
                   
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="height">{{ trans('backend/patients_trans.Height') }}</label>
                                <input type="text" id="height" name="height" class="form-control">

                            </div>
                        </div>


                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="weight"> {{ trans('backend/patients_trans.Weight') }} </label>
                                <input class="form-control" id="weight" name="weight" type="text">

                            </div>
                        </div>
                    </div>



                    <button type="submit" style="margin: 10px;"
                        class="btn btn-success btn-md  btn-lg">{{ trans('backend/patients_trans.Add') }}</button>


                </form>


            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
