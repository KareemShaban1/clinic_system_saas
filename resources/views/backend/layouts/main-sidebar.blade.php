<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">

                    {{-- <div class="col-12 px-0 py-5 text-center justify-content-center align-items-center ">
                        <a href="">
                        <img src="{{URL::asset('assets/images/user.png')}}" style="width: 40px;height: 40px;color: #fff;border-radius: 50%" class="d-inline-block">
                            </a>
                            <div class="col-12 px-0 mt-2" style="color: #fff">
                                {{trans('sidebar_trans.Welcome')}} <div  style="color: #dfbe02"> {{auth()->user()->name}} </div>
                            </div> 

                            <div class="col-12 px-0 mt-2" style="color: #fff">
                                {{auth()->user()->power}}
                            </div> 
                        </div> --}}
       
                    <li>
                        <a href="{{Route('backend.dashboard.index')}}"><i class="fa-solid fa-house-user"></i><span class="right-nav-text">
                               {{trans('sidebar_trans.Dashboard')}}</span> </a>
                    </li>
                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title"> </li>
                    
                    @if($setting['show_events'] == 1)
                    <!-- menu item calendar-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#calendar-menu">
                            <div class="pull-left"><i class="ti-calendar"></i><span
                                    class="right-nav-text">{{trans('sidebar_trans.Events')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="calendar-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{Route('backend.events.show')}}">{{trans('sidebar_trans.Calendar')}}</a>  </li>
                            <li> <a href="{{Route('backend.events.index')}}">{{trans('sidebar_trans.All_Events')}}</a>  </li>
                            <li> <a href="{{Route('backend.events.trash')}}">{{trans('sidebar_trans.Deleted_Events')}}</a>  </li>
                        </ul>
                    </li>
                   @endif
                   
                   @if($setting['show_patients'] == 1)
                    <!-- menu Patients-->
                    {{-- @can('المرضى') --}}
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#patients-menu">
                            <div class="pull-left"><i class="fa-solid fa-hospital-user"></i><span
                                    class="right-nav-text">{{trans('sidebar_trans.Patients')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="patients-menu" class="collapse" data-parent="#sidebarnav">
                            @can('patient add')
                            <li> <a href="{{Route('backend.patients.add')}}"> {{trans('sidebar_trans.Add_Patient')}}</a> </li>
                            @endcan
                            @can('patient index')
                            <li> <a href="{{Route('backend.patients.index')}}">{{trans('sidebar_trans.All_Patients')}} </a> </li>
                            @endcan
                            @can('patient trash')
                            <li> <a href="{{Route('backend.patients.trash')}}"> {{trans('sidebar_trans.Deleted_Patients')}} </a> </li>
                            @endcan
                        </ul>
                    </li>
                    {{-- @endcan --}}
                    @endif



                    @if($setting['show_reservations'] == 1)
                    <!-- menu Reservations-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#reservations-menu">
                            <div class="pull-left"><i class="fa fa-stethoscope"></i><span
                                    class="right-nav-text">{{trans('sidebar_trans.Reservations')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="reservations-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{Route('backend.reservations.today_reservations')}}"> {{trans('sidebar_trans.Today_Reservations')}}  </a> </li>  
                            <li> <a href="{{Route('backend.reservations.index')}}"> {{trans('sidebar_trans.All_Reservations')}}</a> </li>
                            <li> <a href="{{Route('backend.reservations.trash')}}"> {{trans('sidebar_trans.Deleted_Reservations')}} </a> </li>

                        </ul>
                    </li>
                    @endif

                    @if($setting['show_online_reservations'] == 1)
                     <!-- menu Online Reservations-->
                     <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#online_reservations-menu">
                            <div class="pull-left"><i class="fa fa-stethoscope"></i><span
                                    class="right-nav-text">{{trans('sidebar_trans.Online_Reservations')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="online_reservations-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{Route('backend.online_reservations.index')}}"> {{trans('sidebar_trans.All_Online_Reservations')}}</a> </li>
   
                        </ul>
                    </li>

                    @endif

                    @if($setting['show_num_of_res'] == 1)
                         <!-- menu number of Reservations-->
                         <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#num_of_reservations-menu">
                                <div class="pull-left"><i class="fa-sharp fa-solid fa-list"></i><span
                                        class="right-nav-text">{{trans('sidebar_trans.Number_of_Reservations')}}</span></div>
                                <div class="pull-right"><i class="ti-plus"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="num_of_reservations-menu" class="collapse" data-parent="#sidebarnav">
                                <li> <a href="{{Route('backend.num_of_reservations.add')}}"> {{trans('sidebar_trans.Add_Number_of_Reservations')}} </a> </li>
                                <li> <a href="{{Route('backend.num_of_reservations.index')}}"> {{trans('sidebar_trans.Number_of_Reservations')}}</a> </li>
    
                                
                                
                            </ul>
                        </li>
                        @endif


                        @if($setting['show_medicines'] == 1)
                         <!-- menu Medicines-->
                         <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#medicine-menu">
                                <div class="pull-left"><i class="fa-solid fa-pills"></i><span
                                        class="right-nav-text">{{trans('sidebar_trans.Medicine')}}</span></div>
                                <div class="pull-right"><i class="ti-plus"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="medicine-menu" class="collapse" data-parent="#sidebarnav">
                                <li> <a href="{{Route('backend.medicines.add')}}" target="_blank"> {{trans('sidebar_trans.Add_Medicine')}} </a> </li>
                                <li> <a href="{{Route('backend.medicines.index')}}" target="_blank"> {{trans('sidebar_trans.Medicine')}}</a> </li>
                                <li> <a href="{{Route('backend.medicines.trash')}}" target="_blank"> {{trans('sidebar_trans.Deleted_Medicines')}}</a> </li>
                            </ul>
                        </li>
                        @endif



                    @if($setting['show_fees'] == 1)
                    <!-- menu Fees-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#fees-menu">
                            <div class="pull-left"><i class="fa-solid fa-dollar-sign"></i><span
                                    class="right-nav-text">{{trans('sidebar_trans.Fees')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="fees-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{Route('backend.fees.today')}}">{{trans('sidebar_trans.Today_Fees')}}</a> </li>
                            <li> <a href="{{Route('backend.fees.month')}}">{{trans('sidebar_trans.Month_Fees')}}</a> </li>
                            <li> <a href="{{Route('backend.fees.index')}}">{{trans('sidebar_trans.All_Fees')}}</a> </li>
                        </ul>
                    </li>

                    @endif

                    @if($setting['show_users'] == 1)
                    <!-- menu Users-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#users-menu">
                            <div class="pull-left"><i class="fa fa-user"></i><span
                                    class="right-nav-text">{{trans('sidebar_trans.Users')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="users-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{Route('backend.users.add')}}">{{trans('sidebar_trans.Add_User')}}</a> </li>
                            <li> <a href="{{Route('backend.users.index')}}">{{trans('sidebar_trans.All_Users')}}</a> </li>
                            
                        </ul>
                    </li>
                    @endif


                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#roles-menu">
                            <div class="pull-left"><i class="fa fa-user"></i><span
                                    class="right-nav-text">{{trans('sidebar_trans.Roles')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="roles-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{Route('backend.roles.add')}}">{{trans('sidebar_trans.Add_Role')}}</a> </li>
                            <li> <a href="{{Route('backend.roles.index')}}">{{trans('sidebar_trans.All_Roles')}}</a> </li>
                            
                        </ul>
                    </li>

                    
                    <li>
                        <a href="{{Route('backend.reservation_control.index')}}"><i class="fa-sharp fa-solid fa-gear"></i><span class="right-nav-text">
                            {{trans('sidebar_trans.System_Control')}}</span> </a>
                    </li>

                    {{-- Settings --}}
                    @if($setting['show_settings'] == 1)
                    <li>
                        <a href="{{Route('backend.settings.index')}}"><i class="fa-solid fa-cogs"></i><span class="right-nav-text">
                            {{trans('sidebar_trans.Settings')}}</span> </a>
                    </li>
                    @endif

                 
                     

                    {{-- <li>
                        <a href="{{Route('chatify')}}"><i class="fa-solid fa-comment"></i><span class="right-nav-text">
                            {{trans('sidebar_trans.Chat')}}</span> </a>
                    </li> --}}
                    
                   
                   
                                  
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
