<!DOCTYPE >
<html>
    <head>
    {{-- <link href="{{ URL::asset('assets/css/style.css') }}" rel="stylesheet"> --}}
    <link href="{{ URL::asset('assets/css/rtl.css') }}" rel="stylesheet">

  <title>روشتة</title>

  <style>
    body { 
        display:flex; 
        flex-direction:column; 
        justify-content:center;
        padding: 0px;
  /* min-height:100vh; */
    }
   .container {
    /* height: 100%; */
    /* display: flex; */
    justify-content: center;
    align-items: center;
    padding: 0px;
}
#print-content {
    border: 1px solid #000;
    padding: 30px;
}

.break{
    border: 2px solid #000;
}

  
  </style>
  
</head>
<body>

    {{-- <div class="row"> --}}
        <div class="col-md-12 ">
            {{-- <div class="card card-statistics "> --}}
                <div class="card-body">
                    <div class="container ">

                        <div id="print-content">

                           
                            <br>
                            <br>

                            {{-- <img style="width:100px;height:100px;" src="{{URL::asset('assets/images/profile-avatar.jpg')}}" alt="avatar"> --}}

                            <h1 style="text-align: center"> دكتور </h1>

                            <br>
                            <br>    
                            <br>
                            <br>
                            <br>

                        
                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                    <h4 class="f-w-500">اسم المريض<span class="pull-left">:</span>
                                    </h4>
                                </div>
                                <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{$reservation->patient->name}}</span>
                                </div>
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                    <h4 class="f-w-500">تاريخ الكشف<span class="pull-left">:</span>
                                    </h4>
                                </div>
                                <div class="col-lg-9 col-md-8 col-sm-6 col-6"><span>{{$reservation->res_date}}</span>
                                </div>
                            </div>
                            

                            <br>
                            <br>

                            <div class="break"></div>
                           
                            <br>

                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">


                                    <table class="table table-bordered table-striped" >
                                        <thead>
                                            <tr>
                                                <th scope="col">اسم الدواء</th>
                                                <th scope="col">الجرعة</th>
                                                <th scope="col">الكمية</th>
                                                <th scope="col">الملاحظات</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($drugs as $drug)
                                            <tr>
                                                <td >{{$drug->drug_name}}</td>
                                                <td>{{$drug->drug_dose}}</td>
                                                <td>{{$drug->quantity}}</td>
                                                <td>{{$drug->notes}}</td>
                                                
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>   
                        </div>

                        <br>
                        <br>

                        <button type="button" class="btn btn-primary" onclick="printDiv('print-content')">طباعة</button>
                           
                    </div>
                    
                </div>
            {{-- </div> --}}
        </div>
    {{-- </div> --}}

</body>

<script type="text/javascript">
    function printDiv(divName) {
         var printContents = document.getElementById(divName).innerHTML;
         var originalContents = document.body.innerHTML;

         document.body.innerHTML = printContents;

         window.print();

         document.body.innerHTML = originalContents;
    }
</script>
</html>