@extends('backend.layouts.master')
@section('css')
@section('title')
{{trans('backend/online_reservations_trans.All_Online_Reservations')}}@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
{{trans('backend/online_reservations_trans.All_Online_Reservations')}}@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="table_id" class="display">
                                        <thead>
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>{{trans('backend/online_reservations_trans.User_Name')}}</th>
                                            <th>{{trans('backend/online_reservations_trans.Patient_Name')}} </th>
                                            <th>{{trans('backend/online_reservations_trans.Title')}} </th>
                                            <th>{{trans('backend/online_reservations_trans.Time_Date')}} </th>
                                            <th>{{trans('backend/online_reservations_trans.Duration')}}</th>
                                            <th>{{trans('backend/online_reservations_trans.Link')}}</th>
                                            <th>{{trans('backend/online_reservations_trans.Controls')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($online_reservations as $online_reservation)
                                            <tr>
                                            <td>{{ $loop->iteration }}</td>
                                         
                                                <td>{{$online_reservation->created_by}}</td>
                                                <td>{{$online_reservation->patient->name}}</td>
                                                <td>{{$online_reservation->topic}}</td>
                                                <td>{{$online_reservation->start_at}}</td>
                                                <td>{{$online_reservation->duration}}</td>
                                                <td class="text-danger"><a href="{{$online_reservation->join_url}}" target="_blank">انضم الان</a></td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_receipt{{$online_reservation->meeting_id}}" ><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @include('backend.pages.online_reservations.delete')
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')

@endsection
