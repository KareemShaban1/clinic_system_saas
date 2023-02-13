@extends('layouts.master')
@section('css')

@section('title')
{{trans('settings_trans.Settings')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">  {{trans('settings_trans.Settings')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('settings_trans.Edit_Settings')}}</a></li>
                <li class="breadcrumb-item active">{{trans('settings_trans.Settings')}}</li>

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

                <form method="post" enctype="multipart/form-data" action="{{Route('admin.settings.update')}}" autocomplete="off">

                    @csrf
                    {{-- @method('PUT') --}}
                    <div class="row mb-4">
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6"><h5>{{trans('settings_trans.Doctor_Name')}}<span class="text-danger">*</span></h5></div>
                                <div class="col-lg-6 col-md-8 col-sm-6 col-6"><input  type="text" name="doctor_name" value="{{ $setting['doctor_name'] }}"  class="form-control"></div>
                    </div>

                    
                    
                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <h5> {{trans('settings_trans.Doctor_Address')}} <span class="text-danger">*</span></h5>
                        </div>
                        <div class="col-lg-6 col-md-8 col-sm-6 col-6">
                            <input  class="form-control" name="doctor_address" value="{{ $setting['doctor_address'] }}" type="text" >
                        </div>
                       
                          
                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <h5> {{trans('settings_trans.Clinic_Name')}} <span class="text-danger">*</span></h5>
                        </div>
                        <div class="col-lg-6 col-md-8 col-sm-6 col-6">
                            <input  class="form-control" name="clinic_name"  value="{{ $setting['clinic_name'] }}"type="text" >
                        </div>

                             
                    </div>

                    <div class="row mb-4">
                        
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <h5> {{trans('settings_trans.Clinic_Address')}} <span class="text-danger">*</span></h5>
                        </div>
                        <div class="col-lg-6 col-md-8 col-sm-6 col-6">
                            <input  class="form-control" name="clinic_address" value="{{ $setting['clinic_address'] }}" type="text" >
                        </div>
                             
                    </div>

                    <div class="row mb-4">
                        
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <h5> {{trans('settings_trans.Specifications')}} <span class="text-danger">*</span></h5>
                        </div>
                        <div class="col-lg-6 col-md-8 col-sm-6 col-6">
                            <input  class="form-control" name="specifications" value="{{ $setting['specifications'] }}" type="text" >
                        </div>
                             
                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <h5> {{trans('settings_trans.Qualifications')}} <span class="text-danger">*</span></h5>
                        </div>
                        <div class="col-lg-6 col-md-8 col-sm-6 col-6">
                            <textarea name="Qualifications" class="form-control" id="textAreaExample6" rows="3">
                                {{ $setting['qualifications'] }}
                            </textarea>
                        </div>
                        
                             
                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <h5> {{trans('settings_trans.Phone')}} <span class="text-danger">*</span></h5>
                        </div>
                        <div class="col-lg-6 col-md-8 col-sm-6 col-6">
                            <input  class="form-control" name="phone" value="{{ $setting['phone'] }}" type="text" >
                        </div>       
                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <h5> {{trans('settings_trans.Email')}} <span class="text-danger">*</span></h5>
                        </div>
                        <div class="col-lg-6 col-md-8 col-sm-6 col-6">
                            <input  class="form-control" name="email" value="{{ $setting['email'] }}" type="text" >
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <h5> {{trans('settings_trans.Website')}} <span class="text-danger">*</span></h5>
                        </div>
                        <div class="col-lg-6 col-md-8 col-sm-6 col-6">
                            <input  class="form-control" name="website"  value="{{ $setting['website'] }}" type="text" >
                        </div>
                    </div>

      


                

                   <button type="submit" class="btn btn-success btn-md nextBtn btn-lg " >{{trans('settings_trans.Save')}}</button>


                </form>

                
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
