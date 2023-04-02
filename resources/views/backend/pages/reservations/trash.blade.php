@extends('backend.layouts.master')
@section('css')

@section('title')
     الحجوزات المحذوفة
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> الحجوزات المحذوفة </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">Page Title</li>
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
                            <th>id</th>
                            <th>الاسم</th>
                            <th>رقم الكشف</th>
                            <th>نوع الكشف</th>
                            <th>حالة الكشف</th>
                            <th>التحكم</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($reservations as $reservation)
                        <tr>
                        <td>{{$reservation->reservation_id}}</td>
                        <td>{{$reservation->patient->name}}</td>
                        <td>{{$reservation->res_num}}</td>

                        <td>
                           @if ( $reservation->res_type == "check" )
                            كشف
                            @elseif ( $reservation->res_type == "recheck")
                            اعادة كشف
                            @elseif ( $reservation->res_type == "consultation")
                            استشارة
                            @endif
                        </td>

                        <td>
                            @if ( $reservation->status == "waiting" )
                             إنتظار
                             @elseif ( $reservation->status == "entered")
                                دخول
                             @elseif ( $reservation->status == "finished")
                                انتهاء
                             @endif
                         </td>

                         
                         

                        <td>
                            <form action="{{Route('backend.reservations.restore',$reservation->reservation_id)}}" method="post" style="display:inline">
                                @csrf
                                @method('put')
                                
                                <button type="submit" class="btn btn-success btn-sm" >
                                    <i class="fa fa-edit"></i>
                                    إعادة
                                </button>   
                            </form>
                           

                            <form action="{{Route('backend.reservations.forceDelete',$reservation->reservation_id)}}" method="post" style="display:inline">
                                @csrf
                                @method('delete')
                                
                                <button type="submit" class="btn btn-danger btn-sm" >
                                    <i class="fa fa-trash"></i> 
                                    حذف نهائى
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
