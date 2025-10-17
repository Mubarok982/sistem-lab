<!-- Sidebar untuk Admin/Operator/Tata Usaha -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center"
        href="<?= base_url('admin/Admin/dashboard'); ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin Panel</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= $this->uri->segment(3) == 'dashboard' ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('admin/Admin/dashboard'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Manajemen Akun</div>

    <!-- Manajemen Akun -->
    <li class="nav-item <?= in_array($this->uri->segment(2), ['Akun']) ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAkun" aria-expanded="true"
            aria-controls="collapseAkun">
            <i class="fas fa-fw fa-users-cog"></i>
            <span>Manajemen Akun</span>
        </a>
        <div id="collapseAkun" class="collapse" aria-labelledby="headingAkun" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= base_url('admin/Akun/dosen'); ?>">
                    <i class="fas fa-fw fa-chalkboard-teacher"></i> Dosen
                </a>
                <a class="collapse-item" href="<?= base_url('admin/Akun/mahasiswa'); ?>">
                    <i class="fas fa-fw fa-user-graduate"></i> Mahasiswa
                </a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Manajemen Skripsi</div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSkripsi"
            aria-expanded="false" aria-controls="collapseSkripsi">
            <i class="fas fa-fw fa-book"></i>
            <span>Manajemen Skripsi</span>
        </a>
        <div id="collapseSkripsi" class="collapse" aria-labelledby="headingSkripsi" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= site_url('admin/Jadwal_ujian'); ?>">
                    <i class="fas fa-fw fa-calendar-alt"></i> Jadwal Ujian Skripsi
                </a>


                <a class="collapse-item" href="<?= site_url('admin/Skripsi'); ?>">
                    <i class="fas fa-fw fa-book-reader"></i> Data Skripsi
                </a>

                <a class="collapse-item" href="<?= site_url('admin/Validasi_berkas'); ?>">
                    <i class="fas fa-fw fa-check-circle"></i> Validasi Berkas
                </a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Manajemen Ujian</div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUjian" aria-expanded="true"
            aria-controls="collapseUjian">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Manajemen Ujian</span>
        </a>
        <div id="collapseUjian" class="collapse" aria-labelledby="headingUjian" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= base_url('admin/Validasi_ujian'); ?>">
                    <i class="fas fa-fw fa-clipboard-check"></i> Validasi Syarat Ujian
                </a>
                <a class="collapse-item" href="<?= base_url('admin/Penjadwalan_ujian'); ?>">
                    <i class="fas fa-fw fa-calendar-check"></i> Penjadwalan Ujian
                </a>
                <a class="collapse-item" href="<?= base_url('admin/Penetapan_penguji'); ?>">
                    <i class="fas fa-fw fa-user-tie"></i> Penetapan Dosen Penguji
                </a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Monitoring & Laporan</div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporan"
            aria-expanded="true" aria-controls="collapseLaporan">
            <i class="fas fa-fw fa-chart-line"></i>
            <span>Monitoring & Laporan</span>
        </a>
        <div id="collapseLaporan" class="collapse" aria-labelledby="headingLaporan" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= base_url('admin/Rekap_nilai'); ?>">
                    <i class="fas fa-fw fa-file-invoice"></i> Rekapitulasi Nilai
                </a>
                <a class="collapse-item" href="<?= base_url('admin/Detail_ujian'); ?>">
                    <i class="fas fa-fw fa-list-alt"></i> Detail Ujian
                </a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>