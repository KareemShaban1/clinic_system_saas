<!DOCTYPE html>
<html lang="en">
<head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <meta http-equiv="X-UA-Compatible" content="ie=edge">
          <title>Document</title>
          <link href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css" rel="stylesheet" />
          <link href="https://cdn.datatables.net/buttons/2.3.5/css/buttons.dataTables.min.css" rel="stylesheet" />
          {{-- <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
          <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
       --}}
          <style>
        body{
        direction: rtl;
        font-family: 'XBRiyaz',sans-serif;
        font-size: 18px
    }
    table{
        width: 100%;
        
    }
    td , th {
        border: 1px solid #ddd;
  padding: 8px;
  text-align: center;
    }
    th {
  padding-top: 12px;
  padding-bottom: 12px;
  background-color: #11062f;
  color: white;
}
.title{
    padding-top: 12px;
  padding-bottom: 12px;
  background-color: #15a37b;
  color: white;
}
          </style>
</head>
<body>

    <table >
        <thead>
            <tr>
                <th class="title" colspan="6"> {{trans('reservations_trans.Daily_Report')}} </th>
            </tr>
            <tr>
                <th>{{trans('reservations_trans.Number_of_Reservation')}}</th>

                <th>{{trans('reservations_trans.Patient_Name')}}</th>

                <th>{{trans('reservations_trans.Reservation_Type')}}</th>
                
                <th>{{trans('reservations_trans.Payment')}}</th>
                
                <th>{{trans('reservations_trans.Reservation_Status')}}</th>

                <th>{{trans('reservations_trans.Cost')}}</th>
                
              
            </tr>
        </thead>
        <tbody>
            
            @foreach ($reservations as $reservation)
            <tr>

            <td>{{$reservation->res_num}}</td>
            
            <td>{{$reservation->patient->name}}</td>

            <td>
                @if( $reservation->res_type == "check" )
                {{trans('reservations_trans.Check')}}
                @elseif ($reservation->res_type == "recheck")
                {{trans('reservations_trans.Recheck')}}
                @elseif ($reservation->res_type == "consultation")
                {{trans('reservations_trans.Consultation')}}
                @endif
            </td>

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

                 
             </td>

             <td>{{$reservation->cost}}</td>
      
        </tr>
            @endforeach

            <tr>
            <td colspan="5">{{trans('reservations_trans.Total')}}</td>
           
            <td>{{$cost_sum}}</td>

            </tr>
            
        </tbody>
    </table>
    

  </body>





   
</html>