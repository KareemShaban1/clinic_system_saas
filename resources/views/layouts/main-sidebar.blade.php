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
                                {{trans('main_trans.Welcome')}} <div  style="color: #dfbe02"> {{auth()->user()->name}} </div>
                            </div> 

                            <div class="col-12 px-0 mt-2" style="color: #fff">
                                {{auth()->user()->power}}
                            </div> 
                        </div> --}}
       
                    <li>
                        <a href="{{Route('admin.dashboard.index')}}"><i class="fa-solid fa-house-user"></i><span class="right-nav-text">
                               {{trans('main_trans.Dashboard')}}</span> </a>
                    </li>
                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title"> </li>
                    

                    @can('AdminDoctorView',\App\Models\User::class)
                    <!-- menu item calendar-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#calendar-menu">
                            <div class="pull-left"><i class="ti-calendar"></i><span
                                    class="right-nav-text">{{trans('main_trans.Events')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="calendar-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{Route('admin.events.index')}}">{{trans('main_trans.All_Events')}}</a>  </li>
                            <li> <a href="{{Route('admin.events.trash')}}">{{trans('main_trans.Deleted_Events')}}</a>  </li>
                        </ul>
                    </li>
                    @endcan
                   
                   
                    <!-- menu Patients-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#patients-menu">
                            <div class="pull-left"><i class="fa-solid fa-hospital-user"></i><span
                                    class="right-nav-text">{{trans('main_trans.Patients')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="patients-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{Route('admin.patients.add')}}"> {{trans('main_trans.Add_Patient')}}</a> </li>
                            <li> <a href="{{Route('admin.patients.index')}}">{{trans('main_trans.All_Patients')}} </a> </li>
                            <li> <a href="{{Route('admin.patients.trash')}}"> {{trans('main_trans.Deleted_Patients')}} </a> </li>
                            
                        </ul>
                    </li>




                    <!-- menu Reservations-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#reservations-menu">
                            <div class="pull-left"><i class="fa fa-stethoscope"></i><span
                                    class="right-nav-text">{{trans('main_trans.Reservations')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="reservations-menu" class="collapse" data-parent="#sidebarnav">
                            {{-- <li> <a href="{{Route('admin.reservations.add')}}">   {{trans('main_trans.Add_Reservarion')}}</a> </li> --}}
                            <li> <a href="{{Route('admin.reservations.today')}}"> {{trans('main_trans.Today_Reservations')}}  </a> </li>  
                            <li> <a href="{{Route('admin.reservations.index')}}"> {{trans('main_trans.All_Reservations')}}</a> </li>
                            <li> <a href="{{Route('admin.reservations.trash')}}"> {{trans('main_trans.Deleted_Reservations')}} </a> </li>

                            
                            
                        </ul>
                    </li>

                         <!-- menu number of Reservations-->
                         <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#num_of_reservations-menu">
                                <div class="pull-left"><i class="fa fa-stethoscope"></i><span
                                        class="right-nav-text">{{trans('main_trans.Number_of_Reservations')}}</span></div>
                                <div class="pull-right"><i class="ti-plus"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="num_of_reservations-menu" class="collapse" data-parent="#sidebarnav">
                                <li> <a href="{{Route('admin.num_of_reservations.add')}}"> {{trans('main_trans.Add_Number_of_Reservations')}} </a> </li>
                                <li> <a href="{{Route('admin.num_of_reservations.index')}}"> {{trans('main_trans.Number_of_Reservations')}}</a> </li>
    
                                
                                
                            </ul>
                        </li>


                         <!-- menu Medicines-->
                         <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#medicine-menu">
                                <div class="pull-left"><i class="fa-solid fa-pills"></i><span
                                        class="right-nav-text">{{trans('main_trans.Medicine')}}</span></div>
                                <div class="pull-right"><i class="ti-plus"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="medicine-menu" class="collapse" data-parent="#sidebarnav">
                                <li> <a href="{{Route('admin.medicines.add')}}" target="_blank"> {{trans('main_trans.Add_Medicine')}} </a> </li>
                                <li> <a href="{{Route('admin.medicines.index')}}" target="_blank"> {{trans('main_trans.Medicine')}}</a> </li>
                                <li> <a href="{{Route('admin.medicines.trash')}}" target="_blank"> {{trans('main_trans.Deleted_Medicines')}}</a> </li>

    
                                
                                
                            </ul>
                        </li>




                    <!-- menu Fees-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#fees-menu">
                            <div class="pull-left"><i class="fa-solid fa-dollar-sign"></i><span
                                    class="right-nav-text">{{trans('main_trans.Fees')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="fees-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{Route('admin.fees.today')}}">{{trans('main_trans.Today_Fees')}}</a> </li>
                            <li> <a href="{{Route('admin.fees.index')}}">{{trans('main_trans.All_Fees')}}</a> </li>
                        </ul>
                    </li>


                    <!-- menu Users-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#users-menu">
                            <div class="pull-left"><i class="fa fa-user"></i><span
                                    class="right-nav-text">{{trans('main_trans.Users')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="users-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{Route('admin.users.add')}}">{{trans('main_trans.Add_User')}}</a> </li>
                            <li> <a href="{{Route('admin.users.index')}}">{{trans('main_trans.All_Users')}}</a> </li>
                            
                        </ul>
                    </li>

                    {{-- Seetings --}}
                    <li>
                        <a href="{{Route('admin.settings.index')}}"><i class="fa-solid fa-cogs"></i><span class="right-nav-text">
                            {{trans('main_trans.Settings')}}</span> </a>
                    </li>
                     

                    <li>
                        <a href="{{Route('chatify')}}"><i class="fa-solid fa-comment"></i><span class="right-nav-text">
                            {{trans('main_trans.Chat')}}</span> </a>
                    </li>
                    
                   
                   
                                  
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
