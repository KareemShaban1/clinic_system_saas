@extends('backend.layouts.master')
@section('css')

@section('title')
{{ trans('rays_trans.Add_Rays') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('rays_trans.Add_Rays') }} </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('rays_trans.Add_Rays')}}</a></li>
                <li class="breadcrumb-item active">{{trans('rays_trans.Rays')}}</li>
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

                {{-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                @endif --}}

                <form method="post" enctype="multipart/form-data" action="{{Route('backend.rays.store')}}" autocomplete="off">
                    
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label">{{trans('rays_trans.Reservation_Id')}}</label>
                                <select name="reservation_id" class="custom-select mr-sm-2">
                                   
                                    <option value="{{ $reservation->reservation_id }}" selected >{{ $reservation->reservation_id }}</option>
                                
                                </select>
                                @error('reservation_id')
                                <p class="alert alert-danger">{{ $message }}</p>
                                @enderror 
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12">
                              <div class="form-group">
                                  <label class="form-control-label">{{trans('rays_trans.Patient_Name')}}</label>
                                  <select name="patient_id" class="custom-select mr-sm-2">
                                    
                                      <option value="{{ $reservation->patient->patient_id }}" selected >{{ $reservation->patient->name }}</option>
                                 
                                    </select>
                                  @error('patient_id')
                                  <p class="alert alert-danger">{{ $message }}</p>
                                  @enderror 
                              </div>
                          </div>
                    </div>



                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>{{trans('rays_trans.Rays_Name')}}</label>
                                <input  type="text" name="ray_name"  class="form-control">
                                @error('ray_name')
                                <p class="alert alert-danger">{{ $message }}</p>
                                @enderror 
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12">
                              <div class="form-group">
                                  <label>{{trans('rays_trans.Rays_Type')}} </label>
                                  <input  type="text" name="ray_type"  class="form-control">
                                  @error('ray_type')
                                  <p class="alert alert-danger">{{ $message }}</p>
                                  @enderror 
                              </div>
                          </div>
                        
                      
                    </div>

          

                   <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>  {{trans('rays_trans.Rays_Date')}}<span class="text-danger">*</span></label>
                            <input  class="form-control" name="ray_date" id="datepicker-action" data-date-format="yyyy-mm-dd" >
                            @error('ray_date')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror 
                        </div>
                    </div>


                   </div> 


                   <div class="row">
                    <div class="col-md-12">
                        <div class="form-outline mb-4">
                            <label class="form-label" for="textAreaExample6">{{trans('rays_trans.Notes')}}</label>
                            <textarea name="notes" class="form-control" id="textAreaExample6" rows="3"></textarea>
                            @error('notes')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror 
                        </div>
                    </div>   
                   </div>

                   <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label> {{trans('rays_trans.Rays_Image')}}<span class="text-danger">*</span></label>
                            <input  class="form-control" name="images[]" type="file" accept="image/*" multiple="multiple">
                            @error('images')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror 
                        </div>
                    </div>
 
                   </div> 


                   <button type="submit" class="btn btn-success btn-md nextBtn btn-lg">{{trans('rays_trans.Add')}}</button>


                </form>

                
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
