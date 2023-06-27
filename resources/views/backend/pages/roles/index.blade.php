@extends('backend.layouts.master')
@section('css')

@section('title')
    {{trans('backend/roles_trans.Roles')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('backend/roles_trans.Roles')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('backend/roles_trans.All_Roles')}}</a></li>
                <li class="breadcrumb-item active">{{trans('backend/roles_trans.Roles')}}</li>
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

                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th>{{trans('backend/roles_trans.Id')}}</th>
                            <th>{{trans('backend/roles_trans.Role_Name')}}</th>
                            <th>{{trans('backend/roles_trans.Guard_Name')}}</th>
                            <th>{{trans('backend/roles_trans.Control')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->guard_name }}</td>
                           
                            <td>
                                <a href="" class="btn btn-primary btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{Route('backend.roles.edit',$role->id)}}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                               
                               
                                {{-- <form action="{{Route('backend.patients.destroy',$patient->patient_id)}}" method="post" style="display:inline">
                                    @csrf
                                    @method('delete')
                                    
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> 
                                    </button>   
                                </form> --}}
                               
                                {{-- <a href="" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i> 
                                    
                                </a>     --}}
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
