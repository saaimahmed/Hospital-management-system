<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
    <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
        <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
            <!--begin:Dashboard Menu link-->
            <div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-element-11 fs-2">
                            <span class="path1"></span><span class="path2"></span>
                            <span class="path3"></span><span class="path4"></span>
                        </i>
                    </span>
                    <span class="menu-title">Dashboards</span>
                </span>
            </div>

            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-address-book fs-2">
                            <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                        </i>
                    </span>
                    <span class="menu-title">Department</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion">

                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('departments.index') }}">
                            <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                            <span class="menu-title">Department List</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="">
                            <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                            <span class="menu-title">Department Trash</span>
                        </a>
                    </div>
                </div>


                {{--                Doctors--}}
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
               <span class="menu-link"><span class="menu-icon"><i class="ki-duotone ki-people fs-2x">
                                                             <span class="path1"></span>
                                                             <span class="path2"></span>
                                                             <span class="path3"></span>
                                                             <span class="path4"></span>
                                                             <span class="path5"></span>
                                                            </i>
                                        </span>
                   <span class="menu-title">Doctors</span><span class="menu-arrow"></span></span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link" href="{{ route('doctors.index') }}"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                <span class="menu-title">All Doctors List</span></a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link" href="{{ route('doctors.soft-delete') }}"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                <span class="menu-title">Doctor Trash</span>
                            </a>
                        </div>

{{--                        <div class="menu-item">--}}
{{--                            <a class="menu-link" href=""><span class="menu-bullet"><span class="bullet bullet-dot"></span></span>--}}
{{--                                <span class="menu-title">Districts</span>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <div class="menu-item">--}}
{{--                            <a class="menu-link" href=""><span class="menu-bullet"><span class="bullet bullet-dot"></span></span>--}}
{{--                                <span class="menu-title">Divisions</span>--}}
{{--                            </a>--}}
{{--                        </div>--}}

                    </div>
                </div>
                {{--                Patients--}}
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
               <span class="menu-link"><span class="menu-icon">
                       <i class="ki-duotone ki-profile-circle fs-2x">
                           <span class="path1"></span>
                         <span class="path2"></span>
                         <span class="path3"></span>
                        </i>
                                        </span>
                   <span class="menu-title">Patients</span><span class="menu-arrow"></span></span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link" href="{{ route('patients.index') }}"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                <span class="menu-title">All Patient List</span></a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link" href="{{ route('patients.soft-delete') }}"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                <span class="menu-title">Patient Trash</span>
                            </a>
                        </div>

                    </div>
                </div>

                {{--                Appoinment--}}
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                  <span class="menu-link"><span class="menu-icon">

                          <i class="ki-duotone ki-calendar-add fs-2x">
                             <span class="path1"></span>
                             <span class="path2"></span>
                             <span class="path3"></span>
                             <span class="path4"></span>
                             <span class="path5"></span>
                             <span class="path6"></span>
                        </i>

                      </span><span class="menu-title">Appointments</span><span class="menu-arrow"></span>
                  </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                     <span class="menu-link"><i class="ki-duotone ki-calendar-8 fs-2x me-2">
                         <span class="path1"></span>
                         <span class="path2"></span>
                         <span class="path3"></span>
                         <span class="path4"></span>
                         <span class="path5"></span>
                         <span class="path6"></span>
                        </i>
                  <span class="menu-title">Schedule</span><span class="menu-arrow"></span>
                     </span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg">
                                <div class="menu-item"><a class="menu-link" href="{{ route('schedules.index') }}"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span class="menu-title">All Schedule List</span></a>
                                </div>
                                <div class="menu-item"><a class="menu-link" href="{{ route('schedules.soft-delete') }}"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span class="menu-title">Schedule Trash</span></a>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="menu-sub menu-sub-accordion">
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">

                     <span class="menu-link">
                                <i class="ki-duotone ki-calendar-tick fs-2x me-2 ">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                            <span class="path6"></span>
                                        </i>
                         <span class="menu-title">Appointments</span><span class="menu-arrow"></span>
                     </span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg">
                                <div class="menu-item"><a class="menu-link" href=""><span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span class="menu-title">All Appointments List</span></a>
                                </div>
                                <div class="menu-item"><a class="menu-link" href=""><span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span class="menu-title">Appointment Trash</span></a>
                                </div>

                            </div>
                        </div>


                    </div>

                </div>




{{--                Settings--}}
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-setting-2 fs-2">
                            <span class="path1"></span><span class="path2"></span>
                        </i>
                    </span>
                    <span class="menu-title">Setting</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                        <a class="menu-link" href="">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Site Data</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Setting 2</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Setting 3</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Setting 4</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
