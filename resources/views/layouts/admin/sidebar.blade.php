<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.home') }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-home"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Nav::isRoute('admin.home') }}">
        <a class="nav-link" href="{{ route('admin.home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{ __('Dashboard') }}</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        {{ __('Data Master') }}
    </div>

    <!-- Nav Item - Profile -->
    @if (Auth::user()->role_id == App\Models\User::ROLE_ADMIN)
        <li class="nav-item {{ Nav::isRoute('admin.master.setting.edit') }}">
            <a class="nav-link" href="{{ route('admin.master.setting.edit') }}">
                <i class="fas fa-fw fa-gear"></i>
                <span>{{ __('Pengaturan') }}</span>
            </a>
        </li>
        <li class="nav-item {{ Nav::isRoute('admin.master.berita.index') }}">
            <a class="nav-link" href="{{ route('admin.master.berita.index') }}">
                <i class="fas fa-fw fa-newspaper"></i>
                <span>{{ __('Berita') }}</span>
            </a>
        </li>
        <li class="nav-item {{ Nav::isRoute('admin.master.user.index') }}">
            <a class="nav-link" href="{{ route('admin.master.user.index') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>{{ __('Pengguna') }}</span>
            </a>
        </li>
    @endif
    @if (Auth::user()->role_id != \App\Models\User::ROLE_MAHASISWA)
        <li class="nav-item {{ Nav::isRoute('admin.master.category.index') }}">
            <a class="nav-link" href="{{ route('admin.master.category.index') }}">
                <i class="fas fa-fw fa-database"></i>
                <span>{{ __('Kategori') }}</span>
            </a>
        </li>
        <li class="nav-item {{ Nav::isRoute('admin.master.matakuliah.index') }}">
            <a class="nav-link" href="{{ route('admin.master.matakuliah.index') }}">
                <i class="fas fa-fw fa-database"></i>
                <span>{{ __('Mata Kuliah') }}</span>
            </a>
        </li>
    @endif
    <li class="nav-item {{ Nav::isRoute('admin.master.team.index') }}">
        <a class="nav-link" href="{{ route('admin.master.team.index') }}">
            <i class="fas fa-fw fa-database"></i>
            <span>{{ __('Tim Saya') }}</span>
        </a>
    </li>
    @if (Auth::user()->role_id == \App\Models\User::ROLE_MAHASISWA)
        <li class="nav-item {{ Nav::isRoute('admin.master.karya-personal.index') }}">
            <a class="nav-link" href="{{ route('admin.master.karya-personal.index') }}">
                <i class="fas fa-fw fa-paperclip"></i>
                <span>{{ __('Karya Personal') }}</span>
            </a>
        </li>
    @endif

    <li class="nav-item {{ Nav::isRoute('admin.master.karya.index') }}">
        <a class="nav-link" href="{{ route('admin.master.karya.index') }}">
            <i class="fas fa-fw fa-paperclip"></i>
            <span>{{ __('Karya') }}</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    {{-- <div class="sidebar-heading">
        {{ __('Settings') }}
    </div> --}}

    <!-- Nav Item - Profile -->
    {{-- <li class="nav-item {{ Nav::isRoute('admin.profile') }}">
        <a class="nav-link" href="{{ route('admin.profile') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Profile') }}</span>
        </a>
    </li> --}}

    <!-- Divider -->
    {{-- <hr class="sidebar-divider d-none d-md-block"> --}}

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
