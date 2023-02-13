@extends('layouts.master')
@section('css')

@section('title')
    empty
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> ncvlxcnvxcnvxcv</h4>
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
                      
                          <div class="col-lg-6 col-md-6">
                            <div> أسم الدكتور :  </div>
                            <div class="mb-3">أسم المريض :  {{$patient->name}}</div>
                          </div>
                          
                           <div class="col-lg-6 col-md-6">
                            <div class="qr_code" style="direction:ltr">
                              <?php 
                                $qrcode=QrCode::size(200)->->generate($patient->patient_id);
                                $code = (string)$qrcode;
                                echo substr($code,38);
                              ?>
                            </div>  
                          </div> 

                      {{-- </div>        --}}
                          
                  </div>
                  

                    {{-- {{DNS2D::getBarcodeHTML('4445645656', 'QRCODE');}} --}}
                    {{-- <div class="mb-3">{!! DNS2D::getBarcodeHTML("$patient->patient_id", 'QRCODE',10,10,'green') !!}</div> --}}

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
