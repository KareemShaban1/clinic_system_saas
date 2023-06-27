@extends('backend.layouts.master')
@section('css')

@section('title')
{{ trans('backend/rays_trans.Add_Rays') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('backend/rays_trans.Edit_Rays') }} </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('backend/rays_trans.Edit_Rays')}}</a></li>
                <li class="breadcrumb-item active">{{trans('backend/rays_trans.Rays')}}</li>
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

                <form method="post" enctype="multipart/form-data" action="{{Route('backend.rays.update',$ray->id)}}" autocomplete="off">
                    
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label">{{trans('backend/rays_trans.Reservation_Id')}}</label>
                                <select name="reservation_id" class="custom-select mr-sm-2">
                                   
                                    <option value="{{ $ray->reservation_id }}" selected >{{ $ray->reservation_id }}</option>
                                
                                </select>
                                @error('reservation_id')
                                <p class="alert alert-danger">{{ $message }}</p>
                                @enderror 
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12">
                              <div class="form-group">
                                  <label class="form-control-label">{{trans('backend/rays_trans.Patient_Name')}}</label>
                                  <select name="patient_id" class="custom-select mr-sm-2">
                                    
                                      <option value="{{ $ray->patient_id }}" selected >{{ $ray->patient->name }}</option>
                                 
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
                                <label>{{trans('backend/rays_trans.Rays_Name')}}</label>
                                <input  type="text" value="{{old('ray_name',$ray->ray_name)}}" name="ray_name"  class="form-control">
                                @error('ray_name')
                                <p class="alert alert-danger">{{ $message }}</p>
                                @enderror 
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12">
                              <div class="form-group">
                                  <label>{{trans('backend/rays_trans.Rays_Type')}} </label>
                                  <input  type="text" name="ray_type" value="{{old('ray_type',$ray->ray_type)}}"  class="form-control">
                                  @error('ray_type')
                                  <p class="alert alert-danger">{{ $message }}</p>
                                  @enderror 
                              </div>
                          </div>
                        
                      
                    </div>

          

                   <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>  {{trans('backend/rays_trans.Rays_Date')}}<span class="text-danger">*</span></label>
                            <input  class="form-control" name="ray_date" value="{{old('ray_date',$ray->ray_date)}}" id="datepicker-action" data-date-format="yyyy-mm-dd" >
                            @error('ray_date')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror 
                        </div>
                    </div>


                   </div> 


                   <div class="row">
                    <div class="col-md-12">
                        <div class="form-outline mb-4">
                            <label class="form-label" for="textAreaExample6">{{trans('backend/rays_trans.Notes')}}</label>
                            <textarea name="notes" class="form-control" id="textAreaExample6" rows="3">
                              {{old('notes',$ray->notes)}}
                            </textarea>
                            @error('notes')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror 
                        </div>
                    </div>   
                   </div>

                   <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label> {{trans('backend/rays_trans.Rays_Image')}}<span class="text-danger">*</span></label>
                            <?php $images =explode('|',$ray->image); ?>
                            <input  class="form-control" value="{{$ray->image}}" name="images[]" type="file" accept="image/*" multiple="multiple">
                            @error('images')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror 
                        </div>
                    </div>
                    <div class="col-md-9">
                              <?php $images =explode('|',$ray->image); ?>
                              @foreach($images as $key => $value)
                                
                                    <img  src="{{ URL::asset('storage/rays/'.$value)}}"   width="200" height="200">
                                 @endforeach
                    </div>
                    
 
                   </div> 
                  


                   <button type="submit" class="btn btn-success btn-md nextBtn btn-lg">{{trans('backend/rays_trans.Edit')}}</button>


                </form>

                
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
