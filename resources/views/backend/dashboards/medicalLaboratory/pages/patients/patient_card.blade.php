<!DOCTYPE>
<html>

<head>


    <title>{{ trans('backend/patients_trans.Patient_Card') }}</title>

    @if (App::getLocale() == 'ar')
        <style>
            body {
                direction: rtl;
                font-family: 'XBRiyaz', sans-serif;
                font-size: 18px
            }



            /* ==== GRID SYSTEM ==== */
            .container {
                width: 95%;
                margin-left: auto;
                margin-right: auto;
                padding: 20px;
                min-height: 84px;
                border: 1px solid black;
                border-radius: 10px;
                max-width: 420px;
                margin: 0 auto;
                margin-top: 40px;
                height: 20%;
                background-color: antiquewhite
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


            header {
                min-height: 83px;
                border-bottom: 1px solid black;

            }

            .doc-details {
                margin-top: 5px;
                /* margin-right:15px; */

            }

            .clinic.-details {
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

            .column {
                float: left;
                width: 50%;
            }

            /* Clear floats after the columns */
            .row:after {
                content: "";
                display: table;
                clear: both;
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
                height: 100%;
            }

            header {
                min-height: 83px;
                border-bottom: 1px solid black;

            }

            .doc-details {
                margin-top: 5px;
                /* margin-right:15px; */

            }

            .clinic.-details {
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


</head>

<body>

    <div class="container">


        <div class="row" >
            <div class="column">
                <div class="qr_code" style="direction:ltr">
                    <?php
                    $qrcode = QrCode::format('svg')->size(150)->generate($patient->patient_code);
                    $code = (string) $qrcode;
                    echo substr($code, 38);
                    ?>

                </div>
            </div>

            <div class="column">

                <div>أسم المريض : {{ $patient->name }}</div>
            </div>

        </div>

    </div>
</body>


</html>
