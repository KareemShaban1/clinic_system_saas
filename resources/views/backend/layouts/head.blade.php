<!-- Title -->
<title>@yield("title")</title>

<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}" type="image/x-icon" />

<!-- PWA  -->
<meta name="theme-color" content="#6777ef"/>
<link rel="apple-touch-icon" href="{{ asset('logo.PNG') }}">
<link rel="manifest" href="{{ asset('/manifest.json') }}">


<!-- Font -->
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

@yield('css')
<!--- Style css -->


<link href="{{ asset('backend/assets/datatables/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet">

@livewireStyles

<!--- Style css -->
@if (App::getLocale() == 'en' || App::getLocale() == 'it')
    <link href="{{ asset('backend/assets/css/ltr.css') }}" rel="stylesheet">
@else
    <link href="{{ asset('backend/assets/css/rtl.css') }}" rel="stylesheet">
@endif
