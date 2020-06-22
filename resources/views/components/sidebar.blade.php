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
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-email"></i><span> Email <span class="float-right menu-arrow"><i class="mdi mdi-plus"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="email-inbox.html">Inbox</a></li>
                        <li><a href="email-read.html">Email Read</a></li>
                        <li><a href="email-compose.html">Email Compose</a></li>
                    </ul>
                </li>
                @can('user-list')
                <li>
                    <a href="{{ route('users.index') }}" class="waves-effect">
                        <i class="mdi mdi-account-multiple"></i><span> Manage Users </span>
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
                @can('course-list')
                <li>
                    <a href="{{ route('courses.index') }}" class="waves-effect">
                        <i class="mdi mdi-cellphone-link"></i><span> Courses </span>
                    </a>
                </li>
                @endcan
                @can('lesson-list')
                <li>
                    <a href="{{ route('lessons.index') }}" class="waves-effect">
                        <i class="mdi mdi-book-multiple"></i><span> Lessons </span>
                    </a>
                </li>
                @endcan
            </ul>

        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>