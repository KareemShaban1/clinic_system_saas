@extends('backend.dashboards.medicalLaboratory.layouts.master')
@section('css')

@section('title')
{{ trans('backend/roles_trans.Add_Role') }}
@stop

@endsection

@section('page-header')
<!-- breadcrumb -->
<h4 class="mb-0">{{ trans('backend/roles_trans.Roles') }}</h4>
<div class="page-title-right">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoleModal">
        <i class="mdi mdi-plus"></i> {{__('Add Role')}}
    </button>
</div>
<!-- breadcrumb -->
@endsection

@section('content')

<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">


                <form method="post" enctype="multipart/form-data" action="{{ Route('clinic.roles.store') }}"
                    autocomplete="off">

                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="name">{{ trans('backend/roles_trans.Role_Name') }}<span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" class="form-control">

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label>{{ trans('backend/roles_trans.Permissions') }} <span class="text-danger">*</span></label>
                                <br>
                                @foreach ($permission as $value)
                                <label>
                                    <input type="checkbox" name="permission[]" value="{{ $value->id }}" class="name">
                                    {{ $value->name }}
                                </label>
                                <br>
                                @endforeach
                                @error('permission')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                    </div>



                    <button type="submit"
                        class="btn btn-success btn-md nextBtn btn-lg ">{{ trans('backend/roles_trans.Add') }}</button>


                </form>




            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection