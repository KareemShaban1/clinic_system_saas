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

                    @if ($setting['show_events'] == 1)
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#calendar-menu">
                                <div class="pull-left"><i class="ti-calendar"></i><span
                                        class="right-nav-text">{{ trans('backend/sidebar_trans.Events') }}</span></div>
                                <div class="pull-right"><i class="ti-plus"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="calendar-menu" class="collapse" data-parent="#sidebarnav">
                                <li> <a
                                        href="{{ Route('backend.events.show') }}">{{ trans('backend/sidebar_trans.Calendar') }}</a>
                                </li>
                                <li> <a
                                        href="{{ Route('backend.events.index') }}">{{ trans('backend/sidebar_trans.All_Events') }}</a>
                                </li>
                                <li> <a
                                        href="{{ Route('backend.events.trash') }}">{{ trans('backend/sidebar_trans.Deleted_Events') }}</a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if ($setting['show_num_of_res'] == 1)
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
                                <li> <a href="{{ Route('backend.num_of_reservations.add') }}">
                                        {{ trans('backend/sidebar_trans.Add_Number_of_Reservations') }} </a> </li>
                                <li> <a href="{{ Route('backend.num_of_reservations.index') }}">
                                        {{ trans('backend/sidebar_trans.Number_of_Reservations') }}</a> </li>

                                <li> <a href="{{ Route('backend.reservation_slots.add') }}">
                                        {{ trans('backend/sidebar_trans.Add_Reservation_Slots') }} </a> </li>
                                <li> <a href="{{ Route('backend.reservation_slots.index') }}">
                                        {{ trans('backend/sidebar_trans.Reservation_Slots') }}</a> </li>

                            </ul>
                        </li>
                    @endif

                    @if ($setting['show_patients'] == 1)
                        <!-- menu Patients-->
                        {{-- @can('المرضى') --}}
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#patients-menu">
                                <div class="pull-left"><i class="fa-solid fa-hospital-user"></i><span
                                        class="right-nav-text">{{ trans('backend/sidebar_trans.Patients') }}</span>
                                </div>
                                <div class="pull-right"><i class="ti-plus"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="patients-menu" class="collapse" data-parent="#sidebarnav">
                                @can('أضافة مريض')
                                    <li> <a href="{{ Route('backend.patients.add') }}">
                                            {{ trans('backend/sidebar_trans.Add_Patient') }}</a> </li>
                                @endcan
                                @can('عرض المرضى')
                                    <li> <a href="{{ Route('backend.patients.index') }}">{{ trans('backend/sidebar_trans.All_Patients') }}
                                        </a> </li>
                                @endcan
                                @can('حذف مريض')
                                    <li> <a href="{{ Route('backend.patients.trash') }}">
                                            {{ trans('backend/sidebar_trans.Deleted_Patients') }} </a> </li>
                                @endcan
                            </ul>
                        </li>
                        {{-- @endcan --}}
                    @endif



                    @if ($setting['show_reservations'] == 1)
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
                                <li> <a href="{{ Route('backend.reservations.today_reservations') }}">
                                        {{ trans('backend/sidebar_trans.Today_Reservations') }} </a> </li>
                                <li> <a href="{{ Route('backend.reservations.index') }}">
                                        {{ trans('backend/sidebar_trans.All_Reservations') }}</a> </li>
                                <li> <a href="{{ Route('backend.reservations.trash') }}">
                                        {{ trans('backend/sidebar_trans.Deleted_Reservations') }} </a> </li>

                            </ul>
                        </li>
                    @endif

                    @if ($setting['show_online_reservations'] == 1)
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
                                    <a href="{{ Route('backend.online_reservations.index') }}">
                                        {{ trans('backend/sidebar_trans.All_Online_Reservations') }}</a>
                                </li>

                            </ul>
                        </li>
                    @endif

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#rays-menu">
                            <div class="pull-left"><i class="fa fa-stethoscope"></i><span
                                    class="right-nav-text">{{ trans('backend/sidebar_trans.Rays') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="rays-menu" class="collapse" data-parent="#sidebarnav">

                            <li> <a href="{{ route('backend.rays.index') }}">
                                    {{ trans('backend/sidebar_trans.All_Rays') }}</a> </li>
                            <li> <a href="">
                                    {{ trans('backend/sidebar_trans.Deleted_Rays') }} </a> </li>

                        </ul>
                    </li>


                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#analysis-menu">
                            <div class="pull-left"><i class="fa fa-stethoscope"></i><span
                                    class="right-nav-text">{{ trans('backend/sidebar_trans.Analysis') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="analysis-menu" class="collapse" data-parent="#sidebarnav">

                            <li> <a href="{{ route('backend.analysis.index') }}">
                                    {{ trans('backend/sidebar_trans.All_Analysis') }}</a> </li>
                            <li> <a href="">
                                    {{ trans('backend/sidebar_trans.Deleted_Analysis') }} </a> </li>

                        </ul>
                    </li>






                    {{-- <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#reservation_slots-menu">
                            <div class="pull-left"><i class="fa-sharp fa-solid fa-list"></i><span
                                    class="right-nav-text">{{ trans('backend/sidebar_trans.Reservation_Slots') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="reservation_slots-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{ Route('backend.reservation_slots.add') }}">
                                    {{ trans('backend/sidebar_trans.Add_Reservation_Slots') }} </a> </li>
                            <li> <a href="{{ Route('backend.reservation_slots.index') }}">
                                    {{ trans('backend/sidebar_trans.Reservation_Slots') }}</a> </li>



                        </ul>
                    </li> --}}


                    @if ($setting['show_medicines'] == 1)
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
                                <li> <a href="{{ Route('backend.medicines.add') }}" target="_blank">
                                        {{ trans('backend/sidebar_trans.Add_Medicine') }} </a> </li>
                                <li> <a href="{{ Route('backend.medicines.index') }}" target="_blank">
                                        {{ trans('backend/sidebar_trans.Medicine') }}</a> </li>
                                <li> <a href="{{ Route('backend.medicines.trash') }}" target="_blank">
                                        {{ trans('backend/sidebar_trans.Deleted_Medicines') }}</a> </li>
                            </ul>
                        </li>
                    @endif



                    @if ($setting['show_fees'] == 1)
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
                    @endif

                    @if ($setting['show_users'] == 1)
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
                                        href="{{ Route('backend.users.add') }}">{{ trans('backend/sidebar_trans.Add_User') }}</a>
                                </li>
                                <li> <a
                                        href="{{ Route('backend.users.index') }}">{{ trans('backend/sidebar_trans.All_Users') }}</a>
                                </li>

                            </ul>
                        </li>
                    @endif


                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#roles-menu">
                            <div class="pull-left"><i class="fa fa-user"></i><span
                                    class="right-nav-text">{{ trans('backend/sidebar_trans.Roles') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="roles-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a
                                    href="{{ Route('backend.roles.add') }}">{{ trans('backend/sidebar_trans.Add_Role') }}</a>
                            </li>
                            <li> <a
                                    href="{{ Route('backend.roles.index') }}">{{ trans('backend/sidebar_trans.All_Roles') }}</a>
                            </li>

                        </ul>
                    </li>

                    {{-- 
                    <li>
                        <a href="{{ Route('backend.system_control.index') }}"><i
                                class="fa-sharp fa-solid fa-gear"></i><span class="right-nav-text">
                                {{ trans('backend/sidebar_trans.System_Control') }}</span> </a>
                    </li> --}}

                    {{-- Settings --}}
                    @if ($setting['show_settings'] == 1)
                        <li>
                            <a href="{{ Route('backend.settings.index') }}"><i class="fa-solid fa-cogs"></i><span
                                    class="right-nav-text">
                                    {{ trans('backend/sidebar_trans.Settings') }}</span> </a>
                        </li>
                    @endif




                    {{-- <li>
                        <a href="{{Route('chatify')}}"><i class="fa-solid fa-comment"></i><span class="right-nav-text">
                            {{trans('backend/sidebar_trans.Chat')}}</span> </a>
                    </li> --}}




            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
