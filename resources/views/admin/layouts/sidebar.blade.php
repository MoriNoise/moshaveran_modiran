<!-- Start::main-sidebar -->
<aside class="app-sidebar sticky" id="sidebar">

    <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header">
        <a href="{{route('admin.index')}}" class="header-logo">
            <span class="text-primary fs-6 fw-bold">پنل مدیریت</span>
        </a>
    </div>
    <!-- End::main-sidebar-header -->

    <!-- Start::main-sidebar -->
    <div class="main-sidebar simplebar-scrollable-y" id="sidebar-scroll" data-simplebar="init">
        <div class="simplebar-wrapper" style="margin: -8px 0 -80px;">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer"></div>
            </div>
            <div class="simplebar-mask">
                <div class="simplebar-offset" style="left: 0; bottom: 0;">
                    <div class="simplebar-content-wrapper" tabindex="0" role="region"
                         aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;">
                        <div class="simplebar-content" style="padding: 8px 0 80px;">

                            <!-- Start::nav -->
                            <nav class="main-menu-container nav nav-pills flex-column sub-open active open">
                                <div class="slide-left active open d-none" id="slide-left">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                                         viewBox="0 0 24 24">
                                        <path
                                            d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                                    </svg>
                                </div>
                                <ul class="main-menu mx-0">
                                    <!-- Start::slide -->
                                    <li class="slide {{ is_active_route('admin.index', 'active') }}">
                                        <a href="{{route('admin.index')}}"
                                           class="side-menu__item {{ is_active_route('admin.index', 'active') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="1em"
                                                 height="1em" viewBox="0 0 24 24">
                                                <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                   stroke-linejoin="round" stroke-width="1.5" color="currentColor">
                                                    <path d="m9 22l-.251-3.509a3.259 3.259 0 1 1 6.501 0L15 22"></path>
                                                    <path
                                                        d="M2.352 13.214c-.354-2.298-.53-3.446-.096-4.465s1.398-1.715 3.325-3.108L7.021 4.6C9.418 2.867 10.617 2 12.001 2c1.382 0 2.58.867 4.978 2.6l1.44 1.041c1.927 1.393 2.89 2.09 3.325 3.108c.434 1.019.258 2.167-.095 4.464l-.301 1.96c-.5 3.256-.751 4.884-1.919 5.856S16.554 22 13.14 22h-2.28c-3.415 0-5.122 0-6.29-.971c-1.168-.972-1.418-2.6-1.918-5.857z"></path>
                                                </g>
                                            </svg>
                                            <span class="side-menu__label">داشبورد</span>
                                        </a>
                                    </li>
                                    <!-- End::slide -->

                                    <!-- Start::slide -->
                                    <li class="slide {{ is_active_route('admin.users.*', 'active') }}">
                                        <a href="{{route('admin.users.index')}}"
                                           class="side-menu__item {{ is_active_route('admin.users.*', 'active') }}">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="1em"
                                                 height="1em" viewBox="0 0 24 24">
                                                <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                      stroke-linejoin="round" stroke-width="1.5"
                                                      d="M13 2h-2C7.229 2 5.343 2 4.172 3.172S3 6.229 3 10v4c0 3.771 0 5.657 1.172 6.828S7.229 22 11 22h2c3.771 0 5.657 0 6.828-1.172S21 17.771 21 14v-4c0-3.771 0-5.657-1.172-6.828S16.771 2 13 2m8 10H3m12-5H9m6 10H9"
                                                      color="currentColor"></path>
                                            </svg>

                                            <span class="side-menu__label">مدیریت کاربران</span>
                                        </a>
                                    </li>
                                    <!-- End::slide -->



                                    <!-- Start::slide -->
                                    <li class="slide {{ is_active_route('admin.admins.*', 'active') }}">
                                        <a href="{{ route('admin.admins.index') }}"
                                           class="side-menu__item {{ is_active_route('admin.admins.*', 'active') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="side-menu__icon"
                                                 width="1em"
                                                 height="1em"
                                                 viewBox="0 0 24 24">
                                                <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                      stroke-linejoin="round" stroke-width="1.5"
                                                      d="M12 12a5 5 0 1 0-5-5a5 5 0 0 0 5 5Zm-7 9a7 7 0 0 1 14 0Z"/>
                                            </svg>
                                            <span class="side-menu__label">مدیریت مدیران</span>
                                        </a>
                                    </li>
                                    <!-- End::slide -->


                                    <!-- Start::slide -->
                                    <li class="slide {{ is_active_route('admin.notifications.*', 'active') }}">
                                        <a href="{{ route('admin.notifications.index') }}"
                                           class="side-menu__item {{ is_active_route('admin.notifications.*', 'active') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="1em"
                                                 height="1em" viewBox="0 0 24 24">
                                                <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                   stroke-linejoin="round" stroke-width="1.5">
                                                    <path d="M18 8a6 6 0 1 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/>
                                                    <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                                                </g>
                                            </svg>
                                            <span class="side-menu__label">قالب پیام‌ها</span>
                                        </a>
                                    </li>
                                    <!-- End::slide -->
                                    <!-- Start::slide -->
                                    <li class="slide {{ is_active_route('admin.message-groups.*', 'active') }}">
                                        <a href="{{ route('admin.message-groups.index') }}"
                                           class="side-menu__item {{ is_active_route('admin.message-groups.*', 'active') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="1em"
                                                 height="1em" viewBox="0 0 24 24">
                                                <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                   stroke-linejoin="round" stroke-width="1.5">
                                                    <path d="M18 8a6 6 0 1 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/>
                                                    <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                                                </g>
                                            </svg>
                                            <span class="side-menu__label"> پیام‌ گروهی</span>
                                        </a>
                                    </li>
                                    <!-- End::slide -->

                                </ul>
                                <div class="slide-right d-none" id="slide-right">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                                         viewBox="0 0 24 24">
                                        <path
                                            d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                                    </svg>
                                </div>
                            </nav>
                            <!-- End::nav -->

                        </div>
                    </div>
                </div>
            </div>
            <div class="simplebar-placeholder" style="width: 239px; height: 1578px;"></div>
        </div>
        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
        </div>
        <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
            <div class="simplebar-scrollbar"
                 style="height: 568px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
        </div>
    </div>
    <!-- End::main-sidebar -->

</aside>
<!-- End::main-sidebar -->
