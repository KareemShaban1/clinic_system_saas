@extends('layouts.master')
@section('css')

@section('title')
حسابات اليوم
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> حسابات اليوم</h4>
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

                <div class="row">
                <div class="col-6 cost-span text-white">  تاريخ اليوم : {{$current_date}} </div>

                <div class="col-6 cost-span text-white">  الإجمالى : {{$cost_sum}} </div>
                </div>

                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>الاسم</th>
                            <th>رقم الكشف</th>
                            <th>نوع الكشف</th>
                            <th>حالة الدفع</th>
                            <th>المبلغ</th>
                            
                           
                            
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
                            
                            @if ( $reservation->payment == "paid" )
                             <span class="badge badge-rounded badge-success">تم الدفع</span> 
                             @elseif ( $reservation->payment == "not paid")
                             <span class="badge badge-rounded badge-danger"> لم يتم الدفع </span>
                             @endif
                         </td>

                        <td>
                            <span class="badge badge-rounded badge-info">{{$reservation->cost}}</span>
                        </td>

                        
                    </tr>

                    @endforeach
                    
                    {{-- <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{$cost_sum}}</td>
                    </tr> --}}

                        
                        
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
