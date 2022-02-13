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
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
            <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                Dashboard Admin
            </p>
            </a>
        </li>
        <li class="nav-item menu-open">
            <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                Dashboard
            </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('schedules.index') }}" class="nav-link {{ request()->routeIs('schedules.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-clock"></i>
                <p>
                    Jadwal
                </p>
            </a>
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
        {{-- <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-poll"></i>
            <p>
                Vote
            </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-graduation-cap"></i>
            <p>
                Absensi
            </p>
            </a>
        </li> --}}
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
            <a href="{{ route('settings.index') }}" class="nav-link {{ request()->routeIs('settings.*') ? 'active' : ''}}">
                <i class="nav-icon fas fa-cogs"></i>
                <p>
                    Pengaturan
                </p>
            </a>
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
