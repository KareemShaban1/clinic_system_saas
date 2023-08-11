@extends('backend.layouts.master')
@section('css')

@section('title')
{{ trans('backend/users_trans.Edit_User') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('backend/users_trans.Edit_User') }}</h4>
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


                <form method="post" enctype="multipart/form-data"
                    action="{{ Route('backend.users.update', $user->id) }}" autocomplete="off">

                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label>{{ trans('backend/users_trans.User_Name') }}<span
                                        class="text-danger">*</span></label>
                                <input type="text" value="{{ $user->name }}" name="name" class="form-control">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label> {{ trans('backend/users_trans.Email') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" value="{{ $user->email }}" name="email" type="text">
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label>{{ trans('backend/users_trans.Password') }} <span
                                        class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control">
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-12">
                            <div class="form-group">
                                <strong>Role:</strong>
                                <select name="roles[]" class="form-control" multiple>
                                    @foreach ($roles as $roleId => $roleName)
                                        <option value="{{ $roleId }}" @if(in_array($roleId, $userRole)) selected @endif>{{ $roleName }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>



                    <button type="submit"
                        class="btn btn-success btn-md nextBtn btn-lg ">{{ trans('backend/users_trans.Edit') }}</button>


                </form>



            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
