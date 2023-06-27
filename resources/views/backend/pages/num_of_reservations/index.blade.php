@extends('backend.layouts.master')
@section('css')

@section('title')
{{trans('backend/reservations_trans.Reservations')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('backend/reservations_trans.Reservations')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('backend/reservations_trans.All_Reservations')}}</a></li>
                <li class="breadcrumb-item active">{{trans('backend/reservations_trans.Reservations')}}</li>
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
                            <th>{{trans('backend/reservations_trans.Reservation_Date')}}</th>
                            <th>{{trans('backend/reservations_trans.Number_of_Reservations')}}</th>
                            <th>{{trans('backend/reservations_trans.Control')}}</th>

                            
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($num_of_reservations as $number)
                        <tr>
                        <td>{{$number->reservation_date}}</td>
                        <td>{{$number->num_of_reservations}}</td>
                    

                        <td>
                            
                            <a href="{{Route('backend.num_of_reservations.edit',$number->id)}}" class="btn btn-warning btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>
                            {{-- <form action="{{Route('backend.reservations.destroy',$reservation->reservation_id)}}" method="post" style="display:inline">
                                @csrf
                                @method('delete')
                                
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i> 
                                </button>   
                            </form>    --}}
                           
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
