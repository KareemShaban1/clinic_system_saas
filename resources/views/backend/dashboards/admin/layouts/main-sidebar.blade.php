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
                        <a href="{{ Route('clinic.settings.index') }}"><i class="fa-solid fa-cogs"></i><span
                                class="right-nav-text">
                                {{ trans('backend/sidebar_trans.Settings') }}</span> </a>
                    </li>



            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================