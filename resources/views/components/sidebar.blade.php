<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Main</li>
                <li>
                    <a href="{{ route('home') }}" class="waves-effect">
                        <i class="mdi mdi-home"></i><span class="badge badge-primary float-right">3</span> <span> Dashboard </span>
                    </a>
                </li>
                @can('class-list')
                <li>
                    <a href="{{ route('classes.index') }}" class="waves-effect">
                        <i class="mdi mdi-book-open-page-variant"></i><span> Semua Training </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('classes.myClasses') }}" class="waves-effect">
                        <i class="mdi mdi-book-open-variant"></i><span> Training Saya </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('libraries.index') }}" class="waves-effect">
                        <i class="mdi mdi-buffer"></i><span> Library </span>
                    </a>
                </li>
                @endcan

                @hasanyrole('superadmin|admin|trainer')
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-blinds"></i><span> Learnings <span class="float-right menu-arrow"><i class="mdi mdi-plus"></i></span> </span></a>
                    <ul class="submenu">
                        @can('course-list')
                        <li>
                            <a href="{{ route('courses.index') }}" class="waves-effect">
                                <i class="mdi mdi-cellphone-link"></i><span> Manage Courses </span>
                            </a>
                        </li>
                        @endcan
                
                        @can('lesson-list')
                        <li>
                            <a href="{{ route('lessons.index') }}" class="waves-effect">
                                <i class="mdi mdi-book-multiple"></i><span> Manage Lessons </span>
                            </a>
                        </li>
                        @endcan

                        @can('library-list')
                        <li>
                            <a href="{{ route('libraries.index') }}" class="waves-effect">
                                <i class="mdi mdi-buffer"></i><span> Manage Libraries </span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endhasanyrole
                @hasanyrole('superadmin|admin')
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-settings"></i><span> Settings <span class="float-right menu-arrow"><i class="mdi mdi-plus"></i></span> </span></a>
                    <ul class="submenu">
                        @can('user-list')
                        <li>
                            <a href="{{ route('users.index') }}" class="waves-effect">
                                <i class="mdi mdi-account-settings-variant"></i><span> Manage Users </span>
                            </a>
                        </li>
                        @endcan
                        @can('role-list')
                        <li>
                            <a href="{{ route('roles.index') }}" class="waves-effect">
                                <i class="mdi mdi-gavel"></i><span> Manage Roles </span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endhasanyrole


            </ul>

        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>