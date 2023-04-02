<!-- Title -->
<title>@yield("title")</title>

<!-- Favicon -->
<link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico') }}" type="image/x-icon" />

<!-- Font -->
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">
@yield('css')
<!--- Style css -->
{{-- <link href="{{ URL::asset('assets/css/style.css') }}" rel="stylesheet"> --}}

{{-- <link href="{{ URL::asset('assets/css/rtl.css') }}" rel="stylesheet"> --}}

<link href="{{ URL::asset('assets/datatables/jquery.dataTables.min.css') }}" rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet">

<!-- PWA  -->
  <meta name="theme-color" content="#6777ef"/>
  <link rel="apple-touch-icon" href="{{ asset('logo.PNG') }}">
  <link rel="manifest" href="{{ asset('/manifest.json') }}">


@livewireStyles


<!--- Style css -->
@if (App::getLocale() == 'en' || App::getLocale() == 'it')
    <link href="{{ URL::asset('assets/css/ltr.css') }}" rel="stylesheet">
@else
    <link href="{{ URL::asset('assets/css/rtl.css') }}" rel="stylesheet">
@endif
