<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <img src="{{ asset('asset') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        <a href="{{ route('users.index') }}" class="d-block">{{ auth()->user()->name }}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
            @can('dashboard-admin')
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
            @endcan
        </li>
        <li class="nav-item menu-open">
            @can('dashboard-student')
            <a href="{{ route('student.dashboard', auth()->user()->student->id) }}" class="nav-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
            @endcan
        </li>
        <li class="nav-item menu-open">
            @can('dashboard-teacher')
            <a href="{{ route('teacher.dashboard', auth()->user()->teacher->id) }}" class="nav-link
                {{ request()->routeIs('teacher.dashboard') || request()->routeIs('modules.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
            @endcan
        </li>
        <li class="nav-item">
            @can('module-list')
            <a href="{{ route('modules.index', auth()->user()->student_id) }}" class="nav-link {{ request()->routeIs('modules.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-book"></i>
                <p>
                    Modul
                </p>
            </a>
            @endcan
        </li>
        <li class="nav-item">
            @can('quiz-list')
            <a href="{{ route('quizzes.index', auth()->user()->teacher_id) }}" class="nav-link {{ request()->routeIs('quizzes.*') || request()->routeIs('questions.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-book"></i>
                <p>
                    Quiz
                </p>
            </a>
            @endcan
        </li>
        <li class="nav-item">
            @can('schedule-list')
            <a href="{{ route('schedules.index') }}" class="nav-link {{ request()->routeIs('schedules.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-clock"></i>
                <p>
                    Jadwal
                </p>
            </a>
            @endcan
        </li>
        <li class="nav-item">
            @can('student-list')
            <a href="{{ route('students.index') }}" class="nav-link {{ request()->routeIs('students.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user-graduate"></i>
                <p>
                    Siswa
                </p>
            </a>
            @endcan
        </li>
        <li class="nav-item">
            @can('teacher-list')
            <a href="{{ route('teachers.index') }}" class="nav-link {{ request()->routeIs('teachers.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-graduation-cap"></i>
                <p>
                    Guru
                </p>
            </a>
            @endcan
        </li>
        <li class="nav-item">
            @can('classroom-list')
            <a href="{{ route('classrooms.index') }}" class="nav-link {{ request()->routeIs('classrooms.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-chalkboard"></i>
                <p>
                    Kelas
                </p>
            </a>
            @endcan
        </li>
        <li class="nav-item">
            @can('studies-list')
            <a href="{{ route('studies.index') }}" class="nav-link {{ request()->routeIs('studies.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-book-open"></i>
                <p>
                    Mata Pelajaran
                </p>
            </a>
            @endcan
        </li>
        <li class="nav-item">
            @can('major-list')
            <a href="{{ route('majors.index') }}" class="nav-link {{ request()->routeIs('majors.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-cogs"></i>
                <p>
                    Jurusan
                </p>
            </a>
            @endcan
        </li>
        <li class="nav-item">
            @can('room-list')
            <a href="{{ route('rooms.index') }}" class="nav-link {{ request()->routeIs('rooms.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-building"></i>
                <p>
                    Ruang
                </p>
            </a>
            @endcan
        </li>
        <li class="nav-item">
            @can('student-list')
            <a class="nav-link {{ request()->routeIs('users.*') || request()->routeIs('roles.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-recycle"></i>
            <p>
                Sampah
                <i class="right fas fa-angle-left"></i>
            </p>
            </a>
            @endcan
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    @can('student-list')
                    <a href="{{ route('students.trash') }}" class="nav-link {{ request()->routeIs('students.trash') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-user-graduate"></i>
                    <p>
                        Data Siswa
                    </p>
                    </a>
                    @endcan
                </li>
                <li class="nav-item">
                    @can('teacher-list')
                    <a href="{{ route('teachers.trash') }}" class="nav-link {{ request()->routeIs('teachers.trash') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-graduation-cap"></i>
                    <p>
                        Data Guru
                    </p>
                    </a>
                    @endcan
                </li>
                <li class="nav-item">
                    @can('classroom-list')
                    <a href="{{ route('classrooms.trash') }}" class="nav-link {{ request()->routeIs('classrooms.trash') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chalkboard"></i>
                        <p>
                            Data Kelas
                        </p>
                    </a>
                    @endcan
                </li>
                <li class="nav-item">
                    @can('studies-list')
                    <a href="{{ route('studies.trash') }}" class="nav-link {{ request()->routeIs('studies.trash') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book-open"></i>
                        <p>
                            Data Mapel
                        </p>
                    </a>
                    @endcan
                </li>
                <li class="nav-item">
                    @can('schedule-list')
                    <a href="{{ route('schedules.trash') }}" class="nav-link {{ request()->routeIs('schedules.trash') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-clock"></i>
                        <p>
                            Jadwal
                        </p>
                    </a>
                    @endcan
                </li>
            </ul>
        </li>
        <li class="nav-item">
            @can('user-list')
            <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') || request()->routeIs('roles.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-user"></i>
            <p>
                Pengguna
                <i class="right fas fa-angle-left"></i>
            </p>
            </a>
            @endcan
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    @can('user-list')
                    <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Data Pengguna
                    </p>
                    </a>
                    @endcan
                </li>
                <li class="nav-item">
                    @can('role-list')
                    <a href="{{ route('roles.index') }}" class="nav-link {{ request()->routeIs('roles.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-user-tag"></i>
                    <p>
                        Role Pengguna
                    </p>
                    </a>
                    @endcan
                </li>
            </ul>
        </li>
        <li class="nav-item">
            @can('setting-list')
            <a href="{{ route('settings.index') }}" class="nav-link {{ request()->routeIs('settings.*') ? 'active' : ''}}">
                <i class="nav-icon fas fa-cogs"></i>
                <p>
                    Pengaturan
                </p>
            </a>
            @endcan
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <i class="nav-icon fas fa-sign-out-alt" style="color: rgb(184, 0, 0);"></i>
            <p>
                <span>Keluar</span>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </p>
            </a>
        </li>

        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
