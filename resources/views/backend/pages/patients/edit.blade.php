@extends('backend.layouts.master')
@section('css')

@section('title')
    {{ trans('backend/patients_trans.Edit_Patient') }}
@stop
@endsection


@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('backend/patients_trans.Edit_Patient') }}</h4>
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

                <x-backend.alert />

                <form method="post" enctype="multipart/form-data"
                    action="{{ Route('backend.patients.update', $patient->patient_id) }}" autocomplete="off">

                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="name">{{ trans('backend/patients_trans.Patient_Name') }}<span
                                        class="text-danger">*</span></label>
                                <input type="text" id="name" value="{{ $patient->name }}" name="name" class="form-control">

                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="age"> {{ trans('backend/patients_trans.Age') }} </label>
                                <input class="form-control" id="age" value="{{ $patient->age }}" name="age" type="number">

                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="address">{{ trans('backend/patients_trans.Address') }} <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="address" value="{{ $patient->address }}" name="address"
                                    class="form-control">

                            </div>
                        </div>

                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="email"> {{ trans('backend/patients_trans.Email') }} </label>
                                <input class="form-control" id="email" value="{{ $patient->email }}" name="email"
                                    type="email">
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="phone"> {{ trans('backend/patients_trans.Phone') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" id="phone" value="{{ $patient->phone }}" name="phone"
                                    type="phone">

                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6 col-12">
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="gender"> {{ trans('backend/patients_trans.Patient_Gender') }} <span
                                            class="text-danger">*</span></label>

                                    <select class="custom-select mr-sm-2" name="gender" id="gender"
                                        @if ($patient->gender == old('gender', $patient->gender)) selected @endif>
                                        <option selected disabled>{{ trans('backend/patients_trans.Choose') }}</option>

                                        <option value="Male" @if (old('gender', $patient->gender) == 'male') selected @endif>
                                            {{ trans('backend/patients_trans.Male') }}
                                        </option>

                                        <option value="Female" @if (old('gender', $patient->gender) == 'female') selected @endif>
                                            {{ trans('backend/patients_trans.Female') }}
                                        </option>
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="blood_group"> {{ trans('backend/patients_trans.Blood_Group') }} <span
                                            class="text-danger">*</span></label>

                                    <select class="custom-select mr-sm-2" name="blood_group" id="blood_group"
                                        @if ($patient->blood_group == old('blood_group', $patient->blood_group)) selected @endif>
                                        <option selected disabled>{{ trans('backend/patients_trans.Choose') }}</option>
                                        <option value="A+" @if (old('blood_group', $patient->blood_group) == 'A+') selected @endif>A+
                                        </option>
                                        <option value="A-" @if (old('blood_group', $patient->blood_group) == 'A-') selected @endif>A-
                                        </option>
                                        <option value="B+" @if (old('blood_group', $patient->blood_group) == 'B+') selected @endif>B+
                                        </option>
                                        <option value="B-" @if (old('blood_group', $patient->blood_group) == 'B-') selected @endif>B-
                                        </option>
                                        <option value="O+" @if (old('blood_group', $patient->blood_group) == 'O+') selected @endif>O+
                                        </option>
                                        <option value="O-" @if (old('blood_group', $patient->blood_group) == 'O-') selected @endif>O-
                                        </option>
                                        <option value="AB+" @if (old('blood_group', $patient->blood_group) == 'AB+') selected @endif>AB+
                                        </option>
                                        <option value="AB-" @if (old('blood_group', $patient->blood_group) == 'AB-') selected @endif>AB-
                                        </option>

                                    </select>


                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit"
                        class="btn btn-success btn-md nextBtn btn-lg ">{{ trans('backend/patients_trans.Edit') }}</button>


                </form>


            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
