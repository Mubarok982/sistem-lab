<!-- Sidebar untuk Dosen -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dosen/dashboard'); ?>">
        <div class="sidebar-brand-icon">
            <i class="fas fa-chalkboard-teacher"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Dosen Panel</div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('Dashboard'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading - Peran Pembimbing -->
    <div class="sidebar-heading">
        Sebagai Pembimbing
    </div>

    <!-- Nav Item - Mahasiswa Bimbingan -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('dosen/mahasiswa_bimbingan'); ?>">
            <i class="fas fa-fw fa-users"></i>
            <span>Mahasiswa Bimbingan</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading - Peran Penguji -->
    <div class="sidebar-heading">
        Sebagai Penguji
    </div>

    <!-- Nav Item - Jadwal Ujian -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('dosen/jadwal_ujian'); ?>">
            <i class="fas fa-fw fa-calendar-alt"></i>
            <span>Jadwal Ujian</span>
        </a>
    </li>

    <!-- Nav Item - Penilaian Ujian -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('dosen/penilaian_ujian'); ?>">
            <i class="fas fa-fw fa-clipboard-check"></i>
            <span>Penilaian Ujian</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Logout -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </li>

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
