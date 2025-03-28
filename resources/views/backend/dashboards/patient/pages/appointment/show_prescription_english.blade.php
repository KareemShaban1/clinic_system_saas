
<!DOCTYPE html>
<html>
    <head>


  <title>{{trans('frontend/drugs_trans.Prescription')}}</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet">

<style>
  /* ROOT FONT STYLES */

* {
    padding: 0;
    margin: 0 auto;
    box-sizing: border-box;
}

body{
  font-size: 15px;
}


/* ==== GRID SYSTEM ==== */
.container {
  /* width: 90%; */
  height: 100%;
  margin-left: auto;
  margin-right: auto;
}

.row {
  position: relative;
  width: 100%;
}

.column {
  float: left;
  width: 50%;
}
.row [class^="col"] {
  float: left;
 }

.row::after {
    content: "";
    clear: both;
    display: block;
}

.col-1 {width: 8.33%;}
.col-2 {width: 16.66%;}
.col-3 {width: 25%;}
.col-4 {width: 33.33%;}
.col-5 {width: 41.66%;}
.col-6 {width: 50%;}
.col-7 {width: 58.33%;}
.col-8 {width: 66.66%;}
.col-9 {width: 75%;}
.col-10 {width: 83.33%;}
.col-11 {width: 91.66%;}
.col-12 {width: 100%;}

/* Custom */

  .container{
    min-height:84px;
    border:1px solid black;
    max-width:420px;
    margin: 0 auto;
    margin-top:40px;
  }
  header{
    min-height:83px;
    border-bottom:1px solid black;

  }

.doc-details{
    margin-top:5px;
  margin-left:15px;

}

.clinic.-details{
  margin-top:5px;
  margin-left:15px;
}
  .doc-name{
    font-weight:bold;
    margin-bottom:5px;

  }
  .doc-meta{
    /* font-size:9px; */
  }
.datetime{
  /* font-size:10px; */
  margin-top:5px;
  padding-left: 15px;

}

.row.title{
 font-weight:bold;
  padding-left:10px;
  margin-top:10px;
  margin-bottom:10px;
}

.prescription{
  min-height:380px;
  margin-bottom:10px;
}
table{
  text-align:left;
  width:90%;
  min-height:25px;
}
table th{
  /* font-size:8px; */
  font-weight:bold;
}

table tr{
  margin-top:20px;
}
table td{
  /* font-size:7px; */
  text-align: center
}

.instruction{
  /* font-size:6px; */
}
.top{
  height: 100px;
  background-color: white

}
</style>


</head>
<body>

          {{-- <div class="container">
                    <header class="row">
                      <div class=" info">
                        <div  >
                          <p >{{trans('frontend/drugs_trans.Doctor')}} : {{$settings['doctor_name']}}</p>
                        </div>

                        <div >
                          <p >{{trans('frontend/drugs_trans.Clinic_Name')}} : {{$settings['clinic_name']}} </p>
                          <p >{{trans('frontend/drugs_trans.Clinic_Address')}}  : {{$settings['clinic_address']}} </p>
                        </div>


                      </div>
                      <div class="row datetime">
                        <div class="column">
                          <p>{{trans('frontend/drugs_trans.Date')}} : {{Carbon\Carbon::now('Egypt')->format('Y-m-d')}}</p>
                        </div>
                        <div class="column">
                          <p>{{trans('frontend/drugs_trans.Time')}} : {{Carbon\Carbon::now('Egypt')->format('g:i A')}}</p>

                        </div>

                      </div>
                      <p style="margin-left:15px;font-size:18px;font-weight:bold;">{{trans('frontend/drugs_trans.Patient_Name')}} : {{$reservation->patient->name}}</p>



                    </header>
                    <div class="prescription">

                    <table>
                    <thead>
                              <tr>
                                  <th scope="col">{{trans('frontend/drugs_trans.Drug_Name')}}</th>
                                  <th scope="col">{{trans('frontend/drugs_trans.Drug_Dose')}}</th>
                                  <th scope="col">{{trans('frontend/drugs_trans.Quantity')}}</th>
                                  <th scope="col">{{trans('frontend/drugs_trans.Notes')}}</th>

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

          </div> --}}

          <div class="top">
            <div class="doc-details">
              <p class="doc-name">DR.  {{$settings['doctor_name']}} </p>
              {{-- <p class="doc-meta">Benha , Egypt</p> --}}
              <p class="doc-meta">DR. {{$settings['clinic_name']}} Clinic</p>
              <p class="doc-meta">Address : {{$settings['clinic_address']}}
                </p>
            </div>
          </div>

          <div class="container">
            <header class="row">
              <div class="col-10">
                {{-- <div class="doc-details">
                  <p class="doc-name">DR.  {{$settings['doctor_name']}} </p>
                  <p class="doc-meta">MS - General Surgery , F.I.A.G.E.S , F.UROGYN(USA) , FECSM (Oxford , UK) , MBBS</p>
                </div> --}}

                <div class="clinic-details">
                  {{-- <p class="doc-meta">Clinic Name</p>
                  <p class="doc-meta">#1, Crescent Park Street, Chennai</p> --}}
                </div>

              </div>
              <div class="row datetime">

                <div class="column">
                  <p>Name: {{$reservation->patient->name}}</p>
                  <p>Date: {{Carbon\Carbon::now('Egypt')->format('Y-m-d')}}</p>
                </div>
                <div class="column">
                  <p>Age: {{$reservation->patient->age}}</p>
                  <p>Time: {{Carbon\Carbon::now('Egypt')->addHour()->format('g:i A')}}</p>
                </div>


              </div>
            </header>
          <div class="prescription" >
              <p style="margin-left:15px;font-size:20px;font-weight:bold;">Rx </p>
            <table>
             <tr>
              <th>Type</th>
              <th>Drug</th>
              <th>Dosage</th>
              <th>Frequency</th>
              <th>Period</th>
              <th>Notes</th>
             </tr>

             <tbody>
              @foreach ($drugs as $drug)
              <tr>
                  <td>{{$drug->drug_type}}</td>
                  <td >{{$drug->drug_name}}</td>
                  <td>{{$drug->drug_dose}}</td>
                  <td>{{$drug->frequency}}</td>
                  <td>{{$drug->period}}</td>
                  <td>{{$drug->notes}}</td>

              </tr>
              @endforeach
          </tbody>

            </table>



          </div>
          <p style="font-size:9px;text-align:right;padding-bottom:15px;padding-right:25px; bottom:5px;">Dr. {{$settings['doctor_name']}}</p>



</body>


</html>
