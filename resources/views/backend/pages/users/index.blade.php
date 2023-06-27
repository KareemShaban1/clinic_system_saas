@extends('backend.layouts.master')
@section('css')

@section('title')
    {{trans('backend/users_trans.Users')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('backend/users_trans.Users')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('backend/users_trans.All_Users')}}</a></li>
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

                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th>{{trans('backend/users_trans.Id')}}</th>
                            <th>{{trans('backend/users_trans.User_Name')}}</th>
                            <th>{{trans('backend/users_trans.Email')}}</th>
                            <th>{{trans('backend/users_trans.User_Type')}}</th>
                            <th>{{trans('backend/users_trans.Control')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            {{-- <td>{{ $user->power }}</td> --}}
                            <td>
                                @if(!empty($user->getRoleNames()))
                                    @foreach($user->getRoleNames() as $v)
                                        <span class="badge rounded-pill bg-dark text-white">{{ $v }}</span>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                <a href="" class="btn btn-primary btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{Route('backend.users.edit',$user->id)}}" class="btn btn-warning btn-sm">
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
