@extends('backend.layouts.master')
@section('css')

@section('title')
    تعديل مستخدم
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> تعديل مستخدم</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">Page Title</li>
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

                
                <form method="post" enctype="multipart/form-data" action="{{Route('backend.users.update',$user->id)}}" autocomplete="off">

                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('backend/users_trans.User_Name')}}<span class="text-danger">*</span></label>
                                <input  type="text" value="{{$user->name}}" name="name"  class="form-control">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label> {{trans('backend/users_trans.Email')}}  <span class="text-danger">*</span></label>
                                <input  class="form-control" value="{{$user->email}}" name="email" type="text" >
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('backend/users_trans.Password')}} <span class="text-danger">*</span></label>
                                <input  type="password"  name="password"  class="form-control">
                            </div>
                        </div>
                    </div>

                   

                   <div class="row">

                            {{-- <div class="col-md-6">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="power"> {{trans('backend/users_trans.User_Type')}}<span class="text-danger">*</span></label>
                                        
                                        <select class="custom-select mr-sm-2" name="power"
                                        @if($user->power == old('power', $user->power)) selected @endif> 
                                            <option selected disabled>{{trans('backend/users_trans.Choose')}}</option>
                                            <option value="Admin"  @if(old('power', $user->power) == 'Admin') selected @endif>
                                                {{trans('backend/users_trans.Admin')}}
                                            </option>
                                            <option value="Doctor"  @if(old('power', $user->power) == 'Doctor') selected @endif>
                                                {{trans('backend/users_trans.Doctor')}}
                                            </option>
                                        </select>
                                        @error('power')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    
                                    </div>
                                </div>
                            </div>
                            --}}

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Role:</strong>
                                    {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
                                </div>
                            </div>
                   </div> 



                   <button type="submit" class="btn btn-success btn-md nextBtn btn-lg " >{{trans('backend/users_trans.Edit')}}</button>


                </form>


                
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
