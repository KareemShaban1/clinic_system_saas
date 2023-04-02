@extends('backend.layouts.master')
@section('css')

@section('title')
    {{trans('roles_trans.Edit_Role')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{trans('roles_trans.Edit_Role')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('roles_trans.Edit_Role')}}</a></li>
                <li class="breadcrumb-item active">{{trans('roles_trans.Roles')}}</li>
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


                <form method="post" enctype="multipart/form-data" action="{{Route('backend.roles.update',$role->id)}}" autocomplete="off">

                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('roles_trans.Role_Name')}}<span class="text-danger">*</span></label>
                                <input  type="text" name="name" value="{{$role->name}}"  class="form-control">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        
                    </div>



                    <div class="row">
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label> {{trans('roles_trans.Permissions')}} <span class="text-danger">*</span></label>
                                <br>
                                @foreach($permission as $value)
                                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                {{ $value->name }}</label>
                                <br/>
                                @endforeach
                                @error('permission')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                      
                    </div>

             

                   <button type="submit" class="btn btn-success btn-md nextBtn btn-lg " >{{trans('roles_trans.Edit')}}</button>


                </form>



                
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
