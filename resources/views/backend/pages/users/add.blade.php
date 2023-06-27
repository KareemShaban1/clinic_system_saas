@extends('backend.layouts.master')
@section('css')

@section('title')
    {{trans('backend/users_trans.Add_User')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{trans('backend/users_trans.Add_User')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('backend/users_trans.Add_User')}}</a></li>
                <li class="breadcrumb-item active">{{trans('backend/users_trans.Users')}}</li>
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


                <form method="post" enctype="multipart/form-data" action="{{Route('backend.users.store')}}" autocomplete="off">

                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('backend/users_trans.User_Name')}}<span class="text-danger">*</span></label>
                                <input  type="text" name="name"  class="form-control">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        
                    </div>



                    <div class="row">
                        

                        <div class="col-md-6">
                            <div class="form-group">
                                <label> {{trans('backend/users_trans.Email')}} <span class="text-danger">*</span></label>
                                <input  class="form-control" name="email" type="email" >
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                      
                    </div>

                   <div class="row">

                           
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> {{trans('backend/users_trans.Password')}} <span class="text-danger">*</span></label>
                            <input  class="form-control" name="password" type="password" >
                            @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                   </div> 


                   <div class="row">
                       
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>{{trans('backend/users_trans.Roles')}}</strong>
                                    {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
                                </div>
                            </div>
                   </div>

                   <button type="submit" class="btn btn-success btn-md nextBtn btn-lg " >{{trans('backend/users_trans.Add')}}</button>


                </form>



                
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
