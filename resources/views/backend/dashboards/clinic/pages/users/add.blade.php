@extends('backend.dashboards.clinic.layouts.master')
@section('css')

@section('title')
    {{ trans('backend/users_trans.Add_User') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('backend/users_trans.Add_User') }}</h4>
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

                <x-backend.alert/>

                <form method="post" enctype="multipart/form-data" action="{{ Route('backend.users.store') }}"
                    autocomplete="off">

                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ trans('backend/users_trans.User_Name') }}<span
                                        class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control">
                                
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email"> {{ trans('backend/users_trans.Email') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" id="email" name="email" type="email">
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password"> {{ trans('backend/users_trans.Password') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" id="password" name="password" type="password">
                                
                            </div>
                        </div>

                    </div>


                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ trans('backend/users_trans.Roles') }}</strong>
                                <select name="roles[]" class="form-control" multiple>
                                    @foreach ($roles as $roleId => $roleName)
                                        <option value="{{ $roleId }}">{{ $roleName }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <button type="submit"
                        class="btn btn-success btn-md nextBtn btn-lg ">{{ trans('backend/users_trans.Add') }}</button>


                </form>




            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
