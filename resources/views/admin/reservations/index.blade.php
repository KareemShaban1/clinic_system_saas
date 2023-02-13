@extends('layouts.master')
@section('css')

@section('title')
{{trans('reservations_trans.Reservations')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('reservations_trans.Reservations')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('reservations_trans.All_Reservations')}}</a></li>
                <li class="breadcrumb-item active">{{trans('reservations_trans.Reservations')}}</li>
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
                            @if (App::getLocale() == 'ar')
                            <th>{{trans('reservations_trans.Number_of_Reservation')}}</th>
                            @endif
                            <th>{{trans('reservations_trans.Patient_Name')}}</th>
                            @if (App::getLocale() == 'ar')
                            <th>{{trans('reservations_trans.Reservation_Type')}}</th>
                            @endif
                            <th>{{trans('reservations_trans.Payment')}}</th>
                            <th>{{trans('reservations_trans.Reservation_Status')}}</th>
                            <th>{{trans('reservations_trans.Rays_Analysis')}}</th>
                            <th>{{trans('reservations_trans.Chronic_Diseases')}}</th>
                            <th>{{trans('reservations_trans.Prescription')}}</th>
                            <th>{{trans('reservations_trans.Control')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($reservations as $reservation)
                        <tr>
                            @if (App::getLocale() == 'ar')
                            <td>{{$reservation->res_num}}</td>
                            @endif
                            
                            <td>{{$reservation->patient->name}}</td>
    
                            @if (App::getLocale() == 'ar')
                            <td>
                                @if( $reservation->res_type == "check" )
                                {{trans('reservations_trans.Check')}}
                                @elseif ($reservation->res_type == "recheck")
                                {{trans('reservations_trans.Recheck')}}
                                @elseif ($reservation->res_type == "consultation")
                                {{trans('reservations_trans.Consultation')}}
                                @endif
                            </td>
                            @endif

                        <td>
                            @if( $reservation->payment == "paid" )
                                <span class="badge badge-rounded badge-success p-2 mb-2">
                                    {{trans('reservations_trans.Paid')}}
                                </span>
                            @elseif ($reservation->payment == "not paid")
                                <span class="badge badge-rounded badge-danger p-2 mb-2">
                                    {{trans('reservations_trans.Not_Paid')}}
                                </span>
                            @endif
                             <div>
                                <a href="{{Route('admin.reservations.payment_status',[$reservation->reservation_id,"paid"])}}" class="btn btn-success btn-sm">{{trans('reservations_trans.Done')}}  </a>
                                <a href="{{Route('admin.reservations.payment_status',[$reservation->reservation_id,"not paid"])}}" class="btn btn-danger btn-sm">{{trans('reservations_trans.Not_Done')}} </a>
                            </div>
                             
                         </td>

                        <td>
                            @if ( $reservation->status == "waiting" )
                                <span class="badge badge-rounded badge-warning text-white p-2 mb-2">
                                    {{trans('reservations_trans.Waiting')}}
                                </span>
                             @elseif ( $reservation->status == "entered")
                                <span class="badge badge-rounded badge-success p-2 mb-2">
                                    {{trans('reservations_trans.Entered')}}
                                </span>
                             @elseif ( $reservation->status == "finished")
                                 <span class="badge badge-rounded badge-danger p-2 mb-2">
                                    {{trans('reservations_trans.Finished')}}
                                </span>
                             @endif

                             <div>
                                <a href="{{Route('admin.reservations.reservation_status',[$reservation->reservation_id,"waiting"])}}" class="btn btn-warning btn-sm text-white">
                                    {{trans('reservations_trans.Waiting')}}
                                </a>
                                <a href="{{Route('admin.reservations.reservation_status',[$reservation->reservation_id,"entered"])}}" class="btn btn-success btn-sm">
                                    {{trans('reservations_trans.Entered')}}
                                </a>
                                <a href="{{Route('admin.reservations.reservation_status',[$reservation->reservation_id,"finished"])}}" class="btn btn-danger btn-sm">
                                    {{trans('reservations_trans.Finished')}}
                                </a>
                            </div>
                         </td>

                         <td>
                            <a href="{{Route('admin.rays.add',$reservation->reservation_id)}}" class="btn btn-success btn-sm">
                                {{trans('reservations_trans.Add')}}
                           </a>
                            <a href="{{Route('admin.rays.show',$reservation->reservation_id)}}" class="btn btn-info btn-sm">
                                {{trans('reservations_trans.Show')}}
                            </a>
                         </td>

                         <td>
                            <a href="{{Route('admin.chronic_diseases.add',$reservation->reservation_id)}}" class="btn btn-success btn-sm">
                                {{trans('reservations_trans.Add')}}
                           </a>
                            <a href="{{Route('admin.chronic_diseases.show',$reservation->reservation_id)}}" class="btn btn-info btn-sm">
                                {{trans('reservations_trans.Show')}}
                            </a>
                         </td>

                         <td>
                            <a href="{{Route('admin.drugs.add',$reservation->reservation_id)}}" class="btn btn-success btn-sm">
                                {{trans('reservations_trans.Add')}}
                           </a>
                            <a href="{{Route('admin.drugs.drug_pdf',$reservation->reservation_id)}}" class="btn btn-info btn-sm">
                                {{trans('reservations_trans.Show')}}
                            </a>
                         </td>
                         

                        <td>
                            <a href="{{Route('admin.reservations.show',$reservation->reservation_id)}}" class="btn btn-primary btn-sm">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{Route('admin.reservations.edit',$reservation->reservation_id)}}" class="btn btn-warning btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{Route('admin.reservations.destroy',$reservation->reservation_id)}}" method="post" style="display:inline">
                                @csrf
                                @method('delete')
                                
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i> 
                                </button>   
                            </form>   
                           
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
<script>
    $(document).ready( function () {
        $('#table_id').DataTable();
    } );
</script>    
@endsection
