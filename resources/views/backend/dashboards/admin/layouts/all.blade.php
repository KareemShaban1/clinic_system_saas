<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <!-- Title -->
    <title>@yield('title')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}" type="image/x-icon" />

    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef" />
    <link rel="apple-touch-icon" href="{{ asset('logo.PNG') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">


    <!-- Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

    @yield('css')
    <!--- Style css -->


    <!-- <link href="{{ asset('backend/assets/datatables/jquery.dataTables.min.css') }}" rel="stylesheet"> -->

    <!-- DataTables CSS -->
    <link href="{{asset('backend/assets/datatable/css/dataTables.bootstrap5.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/datatable/css/responsive.bootstrap5.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/datatable/css/buttons.bootstrap5.css')}}" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('backend/assets/css/summernote.min.css') }}">


    @livewireStyles

    <link href="{{asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">

    <!--- Style css -->
    @if (App::getLocale() !== 'ar')
    <link href="{{ asset('backend/assets/css/ltr.css') }}" rel="stylesheet">
    @else
    <link href="{{ asset('backend/assets/css/rtl.css') }}" rel="stylesheet">
    @endif

    <link href="{{ asset('backend/assets/css/responsive.css') }}" rel="stylesheet">

</head>

<body>

    <div class="wrapper">

        <!--=================================
 preloader -->

        <div id="pre-loader">
            <img src="{{ URL::asset('backend/assets/images/pre-loader/loader-02.svg') }}" alt="">
        </div>

        <!--=================================
 preloader -->

        <!--================================= header start-->
        <nav class="admin-header navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">

            <!-- logo -->
            <div class="text-left navbar-brand-wrapper">
                {{-- <a class="navbar-brand brand-logo" href="index.html"><img src="" alt=""></a> --}}
                {{-- <a class="navbar-brand brand-logo-mini" href="index.html"><img src="" alt=""></a> --}}
            </div>

            <!-- Top bar left -->
            <ul class="nav navbar-nav mr-auto">
                <li class="nav-item">
                    <a id="button-toggle" class="button-toggle-nav inline-block ml-20 pull-left"
                        href="javascript:void(0);"><i class="zmdi zmdi-menu ti-align-right"></i></a>
                </li>

            </ul>
            <!-- top bar right -->
            <ul class="nav navbar-nav ml-auto">
                <div class="btn-group mb-1">
                    <button type="button" class="btn btn-light btn-sm dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        @if (App::getLocale() == 'ar')
                        {{ LaravelLocalization::getCurrentLocaleName() }}
                        <img src="{{ asset('backend/assets/images/flags/EG.png') }}" alt="">
                        @else
                        {{ LaravelLocalization::getCurrentLocaleName() }}
                        <img src="{{ asset('backend/assets/images/flags/US.png') }}" alt="">
                        @endif
                    </button>
                    <div class="dropdown-menu">
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
                        @endforeach
                    </div>
                </div>
                <li class="nav-item fullscreen">
                    <a id="btnFullscreen" href="#" class="nav-link"><i class="ti-fullscreen"></i></a>
                </li>

                <x-backend.notification-menu count="7" />

                <li class="nav-item dropdown mr-30">

                    <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('backend/assets/images/user.png') }}" alt="avatar">
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header">
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mt-0 mb-0"></h5>
                                    <span>{{ Auth::user()->email }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ Route('backend.settings.index') }}"><i
                                class="text-info ti-settings"></i>الإعدادات</a>


                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            this.closest('form').submit(); "
                                role="button">

                                <i class="text-danger ti-unlock"></i>
                                تسجل الخروج
                            </a>

                        </form>
                    </div>
                </li>
            </ul>
        </nav>

        <!--=================================
 header End-->


        <div class="container-fluid">
            <div class="row">
                <!-- Left Sidebar start-->
                <div class="side-menu-fixed">
                    <div class="scrollbar side-menu-bg">
                        <ul class="nav navbar-nav side-menu" id="sidebarnav">



                            <li>
                                <a href="{{ Route('backend.dashboard.index') }}"><i class="fa-solid fa-house-user"></i><span
                                        class="right-nav-text">
                                        {{ trans('backend/sidebar_trans.Dashboard') }}</span> </a>
                            </li>

                            <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title"> </li>


                            <li>
                                <a href="{{ Route('admin.specialities.index') }}"><i class="fa-regular fa-clipboard"></i><span
                                        class="right-nav-text">
                                        {{ __('Specialities') }}</span> </a>
                            </li>


                            <li>
                                <a href="{{ Route('admin.clinics.index') }}"><i class="fa-regular fa-hospital"></i><span
                                        class="right-nav-text">
                                        {{ __('Clinics') }}</span> </a>
                            </li>


                            <!-- location Fees-->
                            <li>
                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#locations-menu">
                                    <div class="pull-left"><i class="ti-location-arrow"></i><span
                                            class="right-nav-text">{{ __('Locations') }}</span></div>
                                    <div class="pull-right"><i class="ti-plus"></i></div>
                                    <div class="clearfix"></div>
                                </a>
                                <ul id="locations-menu" class="collapse" data-parent="#sidebarnav">
                                    <li> <a
                                            href="{{ Route('admin.governorates.index') }}">{{ __('Governorates') }}</a>
                                    </li>
                                    <li> <a
                                            href="{{ Route('admin.cities.index') }}">{{ __('Cities') }}</a>
                                    </li>
                                    <li> <a
                                            href="{{ Route('admin.areas.index') }}">{{ __('Areas') }}</a>
                                    </li>
                                </ul>
                            </li>


                            <!-- menu Fees-->
                            <li>
                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#fees-menu">
                                    <div class="pull-left"><i class="fa-solid fa-dollar-sign"></i><span
                                            class="right-nav-text">{{ trans('backend/sidebar_trans.Fees') }}</span></div>
                                    <div class="pull-right"><i class="ti-plus"></i></div>
                                    <div class="clearfix"></div>
                                </a>
                                <ul id="fees-menu" class="collapse" data-parent="#sidebarnav">
                                    <li> <a
                                            href="{{ Route('backend.fees.today') }}">{{ trans('backend/sidebar_trans.Today_Fees') }}</a>
                                    </li>
                                    <li> <a
                                            href="{{ Route('backend.fees.month') }}">{{ trans('backend/sidebar_trans.Month_Fees') }}</a>
                                    </li>
                                    <li> <a
                                            href="{{ Route('backend.fees.index') }}">{{ trans('backend/sidebar_trans.All_Fees') }}</a>
                                    </li>
                                </ul>
                            </li>

                            <!-- menu Users-->
                            <li>
                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#users-menu">
                                    <div class="pull-left"><i class="fa fa-user"></i><span
                                            class="right-nav-text">{{ trans('backend/sidebar_trans.Users') }}</span></div>
                                    <div class="pull-right"><i class="ti-plus"></i></div>
                                    <div class="clearfix"></div>
                                </a>
                                <ul id="users-menu" class="collapse" data-parent="#sidebarnav">
                                    <li> <a
                                            href="{{ Route('admin.users.add') }}">{{ trans('backend/sidebar_trans.Add_User') }}</a>
                                    </li>
                                    <li> <a
                                            href="{{ Route('admin.users.index') }}">{{ trans('backend/sidebar_trans.All_Users') }}</a>
                                    </li>

                                </ul>
                            </li>


                            <li>
                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#roles-menu">
                                    <div class="pull-left"><i class="fa fa-user"></i><span
                                            class="right-nav-text">{{ trans('backend/sidebar_trans.Roles') }}</span></div>
                                    <div class="pull-right"><i class="ti-plus"></i></div>
                                    <div class="clearfix"></div>
                                </a>
                                <ul id="roles-menu" class="collapse" data-parent="#sidebarnav">
                                    <li> <a
                                            href="{{ Route('admin.roles.add') }}">{{ trans('backend/sidebar_trans.Add_Role') }}</a>
                                    </li>
                                    <li> <a
                                            href="{{ Route('admin.roles.index') }}">{{ trans('backend/sidebar_trans.All_Roles') }}</a>
                                    </li>

                                </ul>
                            </li>




                            <li>
                                <a href="{{ Route('backend.settings.index') }}"><i class="fa-solid fa-cogs"></i><span
                                        class="right-nav-text">
                                        {{ trans('backend/sidebar_trans.Settings') }}</span> </a>
                            </li>



                    </div>
                </div>

                <!-- Left Sidebar End-->

                <!--================================================================== Main content -->
                <!-- main-content -->

                <div class="content-wrapper">

                    @yield('page-header')

                    @yield('content')


                </div>
            </div>
        </div>
    </div>

    <!--================================= footer -->

    <!-- jquery -->
    <script src="{{ asset('backend/assets/js/jquery-3.3.1.min.js') }}"></script>

    <script src="{{ asset('backend/assets/js/bootstrap.min.js') }}"></script>

    <!-- plugins-jquery -->
    <script src="{{ asset('backend/assets/js/plugins-jquery.js') }}"></script>

    <!-- plugin_path -->
    <script>
        var plugin_path = '{{ asset('
        backend / assets / js / ') }}';
    </script>

    <!-- datepicker -->
    <script src="{{ asset('backend/assets/js/datepicker.js') }}"></script>
    <!-- sweetalert2 -->
    <!-- <script src="{{ asset('backend/assets/js/sweetalert2.js') }}"></script> -->

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('backend/assets/js/popper.min.js') }}"></script>

    <script src="{{ asset('backend/assets/js/toastr.js') }}"></script>


    <script>
        @if(session('toast_success'))
        toastr.success("{{ session('toast_success') }}", "", {
            "timeOut": 1000
        }); // Set timeOut to 1000 milliseconds (1 second)
        @endif
        @if(session('toast_error'))
        toastr.error("{{ session('toast_error') }}", "", {
            "timeOut": 1000
        }); // Set timeOut to 1000 milliseconds (1 second)
        @endif
    </script>

    <script src="{{ asset('backend/assets/js/custom.min.js') }}"></script>


    <script src="{{ asset('backend/assets/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{asset('backend/assets/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/assets/datatable/dataTables.bootstrap5.js')}}"></script>
    <script src="{{asset('backend/assets/datatable/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('backend/assets/datatable/responsive.bootstrap5.min.js')}}"></script>

    <script>
        const languages = {
            @if(App::getLocale() == 'en')
            en: {
                paginate: {
                    previous: "<i class='mdi mdi-chevron-left'></i> Previous",
                    next: "Next <i class='mdi mdi-chevron-right'></i>"
                },
                info: "Showing records _START_ to _END_ of _TOTAL_",
                lengthMenu: "Display _MENU_ records",
                search: "_INPUT_",
                searchPlaceholder: "Search...",
                zeroRecords: "No matching records found",
                infoEmpty: "No records to display",
                infoFiltered: "(filtered from _MAX_ total records)"
            },
            @else
            ar: {
                paginate: {
                    previous: "<i class='mdi mdi-chevron-right'></i> السابق",
                    next: "التالي <i class='mdi mdi-chevron-left'></i>"
                },
                info: "عرض السجلات من _START_ إلى _END_ من إجمالي _TOTAL_ سجلات",
                lengthMenu: "عرض _MENU_ سجلات",
                search: "_INPUT_",
                searchPlaceholder: "بحث...",
                zeroRecords: "لا توجد سجلات مطابقة",
                infoEmpty: "لا توجد سجلات للعرض",
                infoFiltered: "(تمت التصفية من إجمالي _MAX_ سجلات)"
            }
            @endif
        };


        const language = '{{ App::getLocale() }}';
    </script>

    <script defer>
        document.addEventListener('DOMContentLoaded', function() {
            // Global DataTable defaults
            $.extend(true, $.fn.dataTable.defaults, {
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search...",
                    lengthMenu: "_MENU_ records per page",
                    info: "Showing _START_ to _END_ of _TOTAL_ records",
                    infoEmpty: "No records available",
                    infoFiltered: "(filtered from _MAX_ total records)",
                    paginate: {
                        first: '<i class="mdi mdi-chevron-double-left"></i>',
                        previous: '<i class="mdi mdi-chevron-left"></i>',
                        next: '<i class="mdi mdi-chevron-right"></i>',
                        last: '<i class="mdi mdi-chevron-double-right"></i>'
                    }
                },
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                pageLength: 10,
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                order: [
                    [0, 'desc']
                ],
                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ]
            });

            // Global delete function
            window.deleteRecord = function(id, routePrefix) {
                Swal.fire({
                    title: '{{__("Are you sure?")}}',
                    text: "{{__("
                    You won 't be able to revert this!")}}",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#727cf5',
                    cancelButtonColor: '#d33',
                    cancelButtonText: '{{__("Cancel")}}',
                    confirmButtonText: '{{__("Yes, delete it!")}}',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `${routePrefix}/delete/${id}`,
                            type: 'DELETE',
                            data: {
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                if (response.success) {
                                    $('.dataTable').DataTable().ajax.reload();
                                    Swal.fire(
                                        'Deleted!',
                                        'Record has been deleted.',
                                        'success'
                                    );
                                }
                            },
                            error: function(error) {
                                Swal.fire(
                                    'Error!',
                                    'Something went wrong.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            };
        });
    </script>

    @livewireScripts
    @stack('scripts')

</body>

</html>