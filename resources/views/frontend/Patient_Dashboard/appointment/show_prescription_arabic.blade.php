<!DOCTYPE>
<html>

<head>


    <title>{{ trans('frontend/drugs_trans.Prescription') }}</title>

    @if (App::getLocale() == 'ar')
        <style>
            * {
                padding: 0;
                margin: 0 auto;
                box-sizing: border-box;
            }

            body {
                direction: rtl;
                font-family: 'XBRiyaz', sans-serif;
                font-size: 18px
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

            .col-1 {
                width: 8.33%;
            }

            .col-2 {
                width: 16.66%;
            }

            .col-3 {
                width: 25%;
            }

            .col-4 {
                width: 33.33%;
            }

            .col-5 {
                width: 41.66%;
            }

            .col-6 {
                width: 50%;
            }

            .col-7 {
                width: 58.33%;
            }

            .col-8 {
                width: 66.66%;
            }

            .col-9 {
                width: 75%;
            }

            .col-10 {
                width: 83.33%;
            }

            .col-11 {
                width: 91.66%;
            }

            .col-12 {
                width: 100%;
            }

            /* Custom */

            .container {
                min-height: 84px;
                border: 1px solid black;
                max-width: 420px;
                margin: 0 auto;
                margin-top: 40px;
                height: 100%;
                padding-right: 10px;
                padding-left: 10px;
            }

            header {
                min-height: 83px;
                border-bottom: 1px solid black;

            }

            .doc-details {
                margin-top: 5px;
                /* margin-right:15px; */

            }

            .clinic-details {
                margin-top: 5px;
                /* margin-right:15px; */
            }

            .doc-name {
                font-weight: bold;
                margin-bottom: 5px;

            }

            .doc-meta {
                /* font-size:9px; */
            }

            .datetime {
                /* font-size:10px; */
                margin-top: 5px;

            }

            .row.title {
                font-weight: bold;
                /* padding-right:10px; */
                margin-top: 10px;
                margin-bottom: 10px;
            }

            .prescription {
                min-height: 380px;
                margin-bottom: 10px;
                margin-top: 10px;

            }

            table {

                text-align: center;
                width: 90%;
                min-height: 25px;
            }

            table th {
                /* font-size:8px; */
                font-weight: bold;

            }

            table thead tr {}

            table td {
                /* font-size:7px; */

            }

            .instruction {
                /* font-size:6px; */
            }
        </style>
    @endif

    @if (App::getLocale() == 'en')
        <style>
            * {
                padding: 0;
                margin: 0 auto;
                box-sizing: border-box;
            }

            body {
                direction: ltr;
                /* font-family: 'XBRiyaz',sans-serif; */
                font-size: 18px
            }



            /* ==== GRID SYSTEM ==== */
            .container {
                width: 90%;
                margin-left: auto;
                margin-right: auto;
                padding: 10px
            }

            .row {
                position: relative;
                width: 100%;
            }

            .row [class^="col"] {
                float: left;
            }

            .row::after {
                content: "";
                clear: both;
                display: block;
            }

            .col-1 {
                width: 8.33%;
            }

            .col-2 {
                width: 16.66%;
            }

            .col-3 {
                width: 25%;
            }

            .col-4 {
                width: 33.33%;
            }

            .col-5 {
                width: 41.66%;
            }

            .col-6 {
                width: 50%;
            }

            .col-7 {
                width: 58.33%;
            }

            .col-8 {
                width: 66.66%;
            }

            .col-9 {
                width: 75%;
            }

            .col-10 {
                width: 83.33%;
            }

            .col-11 {
                width: 91.66%;
            }

            .col-12 {
                width: 100%;
            }

            /* Custom */

            .container {
                min-height: 84px;
                border: 1px solid black;
                max-width: 420px;
                margin: 0 auto;
                margin-top: 40px;
            }

            header {
                min-height: 83px;
                border-bottom: 1px solid black;

            }

            .doc-details {
                margin-top: 5px;
                /* margin-right:15px; */

            }

            .clinic-details {
                margin-top: 5px;
                /* margin-right:15px; */
            }

            .doc-name {
                font-weight: bold;
                margin-bottom: 5px;

            }

            .doc-meta {
                /* font-size:9px; */
            }

            .datetime {
                /* font-size:10px; */
                margin-top: 5px;

            }

            .row.title {
                font-weight: bold;
                /* padding-right:10px; */
                margin-top: 10px;
                margin-bottom: 10px;
            }

            .prescription {
                min-height: 380px;
                margin-bottom: 10px;
                /* margin-top:10px; */

            }

            table {

                text-align: center;
                width: 90%;
                min-height: 25px;
            }

            table th {
                /* font-size:8px; */
                font-weight: bold;

            }

            table thead tr {}

            table td {
                /* font-size:7px; */

            }

            .instruction {
                /* font-size:6px; */
            }

            .top {
                height: 100px;
                background-color: white
            }
        </style>
    @endif


</head>

<body>

    <div class="top">
        <div class="doc-details">
            <p class="doc-name">{{ trans('frontend/drugs_trans.Doctor') }} : {{ $settings['doctor_name'] }}</p>
            {{-- <p class="doc-meta">Benha , Egypt</p> --}}
            <p class="doc-meta">{{ trans('frontend/drugs_trans.Clinic_Name') }} : {{ $settings['clinic_name'] }} </p>
            <p class="doc-meta">{{ trans('frontend/drugs_trans.Clinic_Address') }} : {{ $settings['clinic_address'] }} </p>
            </p>
        </div>
    </div>

    <div class="container">
        <header class="row">
            <div class="col-10">
                {{-- <div class="doc-details" >
                          <p class="doc-name">{{trans('frontend/drugs_trans.Doctor')}} : {{$settings['doctor_name']}}</p>
                          <p class="doc-meta"></p>
                        </div>
                  
                        <div class="clinic-details">
                          <p class="doc-meta">{{trans('frontend/drugs_trans.Clinic_Name')}} : {{$settings['clinic_name']}} </p>
                          <p class="doc-meta">{{trans('frontend/drugs_trans.Clinic_Address')}}  : {{$settings['clinic_address']}} </p>
                        </div> --}}

            </div>
            <div class="row datetime">


                <div class="column">
                    <p>السن: {{ $reservation->patient->age }}</p>
                    <p>الوقت: {{ Carbon\Carbon::now('Egypt')->addHour()->format('g:i A') }}</p>
                </div>
                <div class="column">
                    <p>أسم المريض: {{ $reservation->patient->name }}</p>
                    <p>التاريخ: {{ Carbon\Carbon::now('Egypt')->format('Y-m-d') }}</p>
                </div>


            </div>

        </header>
        <div class="prescription">

            <table>
                <thead>
                    <tr>
                        <th scope="col">{{ trans('frontend/drugs_trans.Drug_Type') }}</th>
                        <th scope="col">{{ trans('frontend/drugs_trans.Drug_Name') }}</th>
                        <th scope="col">{{ trans('frontend/drugs_trans.Drug_Dose') }}</th>
                        <th scope="col">{{ trans('frontend/drugs_trans.Frequency') }}</th>
                        <th scope="col">{{ trans('frontend/drugs_trans.Period') }}</th>
                        <th scope="col">{{ trans('frontend/drugs_trans.Notes') }}</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($drugs as $drug)
                        <tr>
                            <td>{{ $drug->drug_type }}</td>
                            <td>{{ $drug->drug_name }}</td>
                            <td>{{ $drug->drug_dose }}</td>
                            <td>{{ $drug->frequency }}</td>
                            <td>{{ $drug->period }}</td>
                            <td>{{ $drug->notes }}</td>

                        </tr>
                    @endforeach
                </tbody>

            </table>


        </div>

        {{-- <p style="font-size:9px;text-align:left;padding-bottom:15px;padding-right:25px;">Dr. Alvin plus father name</p> --}}
    </div>
</body>


</html>
