<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.home') }}" class="brand-link">
        <img src="{{ asset('admin_assets/dist/img/AdminLTELogo.png') }}" alt="{{ config('app.name') }}"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin_assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                     alt="User Image">
            </div>
            <div class="info">
                <a href="javascript:void(0);"
                   class="d-block">{{ auth(config('project.auth_guard.admin'))->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                {{-- <li class="nav-item">
                     <a href="{{ route('admin.home') }}"
                        class="nav-link {{ request()->route()->getName() === 'admin.home' ? 'active' : '' }}"
                        title="Dashboard">
                         <i class="nav-icon fas fa-tachometer-alt"></i>
                         <p>Dashboard</p>
                     </a>
                 </li>--}}

                <li class="nav-item">
                    <a href="{{ route('admin.course_student.list') }}"
                       class="nav-link {{ str_starts_with(request()->route()->getName(), 'admin.course_student') ? 'active' : '' }}"
                       title="{{ __('custom.module.course_student.title') }}">
                        <i class="nav-icon fas fa-check-square"></i>
                        <p>{{ __('custom.module.course_student.title') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.students.list') }}"
                       class="nav-link {{ str_starts_with(request()->route()->getName(), 'admin.students') ? 'active' : '' }}"
                       title="{{ __('custom.module.lessons.title') }}">
                        <i class="nav-icon fas fa-user-alt"></i>
                        <p>{{ __('custom.module.students.title') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.courses.list') }}"
                       class="nav-link {{ str_starts_with(request()->route()->getName(), 'admin.courses') ? 'active' : '' }}"
                       title="{{ __('custom.module.lessons.title') }}">
                        <i class="nav-icon fas fa-book-reader"></i>
                        <p>{{ __('custom.module.courses.title') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.lessons.list') }}"
                       class="nav-link {{ str_starts_with(request()->route()->getName(), 'admin.lessons') ? 'active' : '' }}"
                       title="{{ __('custom.module.lessons.title') }}">
                        <i class="nav-icon fas fa-book-open"></i>
                        <p>{{ __('custom.module.lessons.title') }}</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
