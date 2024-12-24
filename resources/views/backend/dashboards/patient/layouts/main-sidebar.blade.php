<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">



                    <li>
                        <a href="{{Route('frontend.patient.dashboard')}}"><i class="fa-solid fa-house-user"></i><span class="right-nav-text">
                                {{ trans('frontend/sidebar_trans.Dashboard') }}</span> </a>
                    </li>

                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title"> </li>

                    
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#appointmets-menu">
                            <div class="pull-left"><i class="fa fa-stethoscope"></i><span
                                    class="right-nav-text">{{ trans('frontend/sidebar_trans.Appointmets') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="appointmets-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{Route('frontend.appointment.add')}}">{{ trans('frontend/sidebar_trans.Add_Appointmet') }}</a>
                            </li>
                            <li> <a href="{{Route('frontend.appointment.index')}}">{{ trans('frontend/sidebar_trans.All_Appointmets') }}</a>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#rays-menu">
                            <div class="pull-left"><i class="fa fa-stethoscope"></i><span
                                    class="right-nav-text">{{ trans('frontend/sidebar_trans.Rays_Analysis') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="rays-menu" class="collapse" data-parent="#sidebarnav">
                            
                            <li> <a href="{{Route('frontend.appointment.patient_rays')}}">{{ trans('frontend/sidebar_trans.All_Rays_Analysis') }}</a>
                            </li>

                        </ul>
                    </li>


                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#chronic_disease-menu">
                            <div class="pull-left"><i class="fa fa-stethoscope"></i><span
                                    class="right-nav-text">{{ trans('frontend/sidebar_trans.Chronic_Diseases') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="chronic_disease-menu" class="collapse" data-parent="#sidebarnav">

                            <li> <a href="{{Route('frontend.appointment.patient_chronic_disease')}}">{{ trans('frontend/sidebar_trans.All_Chronic_Diseases') }}</a>
                            </li>

                        </ul>
                    </li>




            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
