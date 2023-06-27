<!DOCTYPE html>
<html lang="en">
<head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <meta http-equiv="X-UA-Compatible" content="ie=edge">
          <title>Document</title>
          <style>
                    table {
  border: 1px solid #ccc;
  border-collapse: collapse;
  margin: 0;
  padding: 0;
  width: 100%;
  table-layout: fixed;
}

table caption {
  font-size: 1.5em;
  margin: .5em 0 .75em;
}

table tr {
  background-color: #f8f8f8;
  border: 1px solid #ddd;
  padding: .35em;
}

table th,
table td {
  padding: .625em;
  text-align: center;
}

table th {
  font-size: .85em;
  letter-spacing: .1em;
  text-transform: uppercase;
}

@media screen and (max-width: 600px) {
  table {
    border: 0;
  }

  table caption {
    font-size: 1.3em;
  }
  
  table thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  
  table tr {
    border-bottom: 3px solid #ddd;
    display: block;
    margin-bottom: .625em;
  }
  
  table td {
    border-bottom: 1px solid #ddd;
    display: block;
    font-size: .8em;
    text-align: right;
  }
  
  
  table td::before {
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
  
  table td:last-child {
    border-bottom: 0;
  }
}


/* general styling */
body {
  line-height: 1.25;
  direction: rtl;
        font-family: 'XBRiyaz',sans-serif;
        font-size: 18px
}
.top{
          height: 100px;
          background-color: black;
          margin-bottom:20px 
}
.info{
          margin-bottom: 50px;
}
          </style>
</head>
<body>

          <div class="top"> </div>

          <div class="row info" >
                    <div class="column">
                    
                    </div> 
       
                    <div class="column">
                      <div>  دكتور : {{$settings['doctor_name']}} </div>
                      <div style="margin-bottom:30px" >  العنوان : {{$settings['clinic_address']}}</div>

                      <div >أسم المريض :  {{$reservation->patient->name}}</div>
                      <div >رقم الكشف / ميعاد الكشف : {{$reservation->slot ? $reservation->slot : $reservation->res_num}} </div>
                    </div>
                    
            </div>

          <table style="direction: ltr">
                    <thead>
                      <tr>
                        <th style="background-color: white"></th>
                        <th colspan="3">Right</th>
                        <th colspan="3">Left</th>
                      </tr>
                    </thead>
                    <tbody>
                              <tr>
                                        <td style="background-color: white"></td>
                                        <td>SPH</td>
                                        <td>CYL</td>
                                        <td>AX</td>
                                        <td>SPH</td>
                                        <td>CYL</td>
                                        <td>AX</td>
                              </tr>
                              
                              <tr>
                                        <td>Diest</td>
                                        <td>{{$glasses_distance->SPH_R_D}}</td>
                                        <td>{{$glasses_distance->CYL_R_D}}</td>
                                        <td>{{$glasses_distance->AX_R_D}}</td>
                                        <td>{{$glasses_distance->SPH_L_D}}</td>
                                        <td>{{$glasses_distance->CYL_L_D}}</td>
                                        <td>{{$glasses_distance->AX_L_D}}</td>
                              </tr>  
                              
                              <tr>
                                        <td>Near</td>
                                        <td>{{$glasses_distance->SPH_R_N}}</td>
                                        <td>{{$glasses_distance->CYL_R_N}}</td>
                                        <td>{{$glasses_distance->AX_R_N}}</td>
                                        <td>{{$glasses_distance->SPH_L_N}}</td>
                                        <td>{{$glasses_distance->CYL_L_N}}</td>
                                        <td>{{$glasses_distance->AX_L_N}}</td>
                              </tr>  

                                
                     
                    </tbody>
                  </table>
</body>
</html>