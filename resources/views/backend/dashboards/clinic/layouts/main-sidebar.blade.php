<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">



                    <li>
                        <a href="{{ Route('clinic.dashboard.index') }}"><i class="fa-solid fa-house-user"></i><span
                                class="right-nav-text">
                                {{ trans('backend/sidebar_trans.Dashboard') }}</span> </a>
                    </li>

                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title"> </li>

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
                                    href="{{ Route('clinic.users.index') }}">{{ trans('backend/sidebar_trans.All_Users') }}</a>
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
                                    href="{{ Route('clinic.roles.index') }}">{{ trans('backend/sidebar_trans.All_Roles') }}</a>
                            </li>

                        </ul>
                    </li>

                    <!-- menu Types-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#types-menu">
                            <div class="pull-left"><i class="fa-sharp fa-solid fa-list"></i><span
                                    class="right-nav-text">{{ trans('backend/sidebar_trans.Types') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="types-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a
                                    href="{{ Route('clinic.type.index') }}">{{ trans('backend/sidebar_trans.All_Types') }}</a>
                            </li>
                        </ul>
                    </li>

                    <!-- menu Service Fees-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#serviceFees-menu">
                            <div class="pull-left"><i class="fa-sharp fa-solid fa-list"></i><span
                                    class="right-nav-text">{{ trans('backend/sidebar_trans.Service_Fees') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="serviceFees-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{ Route('clinic.serviceFees.index') }}">
                                    {{ trans('backend/sidebar_trans.All_Service_Fees') }} </a> </li>

                        </ul>
                    </li>


                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#calendar-menu">
                            <div class="pull-left"><i class="ti-calendar"></i><span
                                    class="right-nav-text">{{ trans('backend/sidebar_trans.Events') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="calendar-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a
                                    href="{{ Route('clinic.events.show') }}">{{ trans('backend/sidebar_trans.Calendar') }}</a>
                            </li>
                            <li> <a
                                    href="{{ Route('clinic.events.index') }}">{{ trans('backend/sidebar_trans.All_Events') }}</a>
                            </li>
                            <li> <a
                                    href="{{ Route('clinic.events.trash') }}">{{ trans('backend/sidebar_trans.Deleted_Events') }}</a>
                            </li>
                        </ul>
                    </li>

                    <!-- menu number of Reservations-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse"
                            data-target="#num_of_reservations-menu">
                            <div class="pull-left"><i class="fa-sharp fa-solid fa-list"></i><span
                                    class="right-nav-text">{{ trans('backend/sidebar_trans.Controll_Number_of_Reservations') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="num_of_reservations-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{ Route('clinic.num_of_reservations.add') }}">
                                    {{ trans('backend/sidebar_trans.Add_Number_of_Reservations') }} </a> </li>
                            <li> <a href="{{ Route('clinic.num_of_reservations.index') }}">
                                    {{ trans('backend/sidebar_trans.Number_of_Reservations') }}</a> </li>

                            <li> <a href="{{ Route('clinic.reservation_slots.add') }}">
                                    {{ trans('backend/sidebar_trans.Add_Reservation_Slots') }} </a> </li>
                            <li> <a href="{{ Route('clinic.reservation_slots.index') }}">
                                    {{ trans('backend/sidebar_trans.Reservation_Slots') }}</a> </li>

                        </ul>
                    </li>

                    <!-- menu Patients-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#patients-menu">
                            <div class="pull-left"><i class="fa-solid fa-hospital-user"></i><span
                                    class="right-nav-text">{{ trans('backend/sidebar_trans.Patients') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="patients-menu" class="collapse" data-parent="#sidebarnav">

                            <li>
                                <a href="{{ Route('clinic.patients.add_patient_code') }}">
                                    {{ trans('backend/sidebar_trans.Add_Patient_Using_Code') }}
                                </a>
                            </li>


                            @can('add-patient')
                            <li> <a href="{{ Route('clinic.patients.add') }}">
                                    {{ trans('backend/sidebar_trans.Add_Patient') }}</a> </li>
                            @endcan
                            @can('view-patients')
                            <li> <a href="{{ Route('clinic.patients.index') }}">{{ trans('backend/sidebar_trans.All_Patients') }}
                                </a> </li>
                            @endcan
                            @can('delete-patient')
                            <li> <a href="{{ Route('clinic.patients.trash') }}">
                                    {{ trans('backend/sidebar_trans.Deleted_Patients') }} </a> </li>
                            @endcan
                        </ul>
                    </li>



                    <!-- menu Reservations-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#reservations-menu">
                            <div class="pull-left"><i class="fa fa-stethoscope"></i><span
                                    class="right-nav-text">{{ trans('backend/sidebar_trans.Reservations') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="reservations-menu" class="collapse" data-parent="#sidebarnav">
                            <!-- <li> <a href="{{ Route('clinic.reservations.today_reservations') }}">
                                        {{ trans('backend/sidebar_trans.Today_Reservations') }} </a> </li> -->
                            <li> <a href="{{ Route('clinic.reservations.index') }}">
                                    {{ trans('backend/sidebar_trans.All_Reservations') }}</a> </li>
                            <li> <a href="{{ Route('clinic.reservations.trash') }}">
                                    {{ trans('backend/sidebar_trans.Deleted_Reservations') }} </a> </li>

                        </ul>
                    </li>

                    <!-- menu Online Reservations-->
                    <li>
                        <a data-toggle="collapse" data-target="#online_reservations-menu">
                            <div class="pull-left"><i class="fa fa-stethoscope"></i><span
                                    class="right-nav-text">{{ trans('backend/sidebar_trans.Online_Reservations') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="online_reservations-menu" class="collapse" data-parent="#sidebarnav">
                            <li>
                                <a href="{{ Route('clinic.online_reservations.index') }}">
                                    {{ trans('backend/sidebar_trans.All_Online_Reservations') }}</a>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#rays-menu">
                            <div class="pull-left"><i class="fa fa-stethoscope"></i><span
                                    class="right-nav-text">{{ trans('backend/sidebar_trans.Rays') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="rays-menu" class="collapse" data-parent="#sidebarnav">

                            <li> <a href="{{ route('clinic.rays.index') }}">
                                    {{ trans('backend/sidebar_trans.All_Rays') }}</a> </li>
                            <!-- <li> <a href="">
                                    {{ trans('backend/sidebar_trans.Deleted_Rays') }} </a> </li> -->

                        </ul>
                    </li>


                    <!-- <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#analysis-menu">
                            <div class="pull-left"><i class="fa fa-stethoscope"></i><span
                                    class="right-nav-text">{{ trans('backend/sidebar_trans.Analysis') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="analysis-menu" class="collapse" data-parent="#sidebarnav">

                            <li> <a href="{{ route('clinic.analysis.index') }}">
                                    {{ trans('backend/sidebar_trans.All_Analysis') }}</a> </li>

                        </ul>
                    </li> -->







                    <!-- menu Medicines-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#medicine-menu">
                            <div class="pull-left"><i class="fa-solid fa-pills"></i><span
                                    class="right-nav-text">{{ trans('backend/sidebar_trans.Medicine') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="medicine-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{ Route('clinic.medicines.add') }}" target="_blank">
                                    {{ trans('backend/sidebar_trans.Add_Medicine') }} </a> </li>
                            <li> <a href="{{ Route('clinic.medicines.index') }}" target="_blank">
                                    {{ trans('backend/sidebar_trans.Medicine') }}</a> </li>
                            <li> <a href="{{ Route('clinic.medicines.trash') }}" target="_blank">
                                    {{ trans('backend/sidebar_trans.Deleted_Medicines') }}</a> </li>
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
                                    href="{{ Route('clinic.fees.today') }}">{{ trans('backend/sidebar_trans.Today_Fees') }}</a>
                            </li>
                            <li> <a
                                    href="{{ Route('clinic.fees.month') }}">{{ trans('backend/sidebar_trans.Month_Fees') }}</a>
                            </li>
                            <li> <a
                                    href="{{ Route('clinic.fees.index') }}">{{ trans('backend/sidebar_trans.All_Fees') }}</a>
                            </li>
                        </ul>
                    </li>






                    <li>
                        <a href="{{ Route('clinic.settings.index') }}"><i class="fa-solid fa-cogs"></i><span
                                class="right-nav-text">
                                {{ trans('backend/sidebar_trans.Settings') }}</span> </a>
                    </li>



            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================