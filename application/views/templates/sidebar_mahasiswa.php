<!-- Sidebar untuk Mahasiswa -->
<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('mahasiswa'); ?>">
        <div class="sidebar-brand-icon">
            <i class="fas fa-user-graduate"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Mahasiswa Panel</div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= ($this->uri->segment(2) == '' || $this->uri->segment(2) == 'dashboard') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('mahasiswa/dashboard'); ?>">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Skripsi Saya
    </div>

    <!-- Nav Item - Pengajuan Judul -->
    <li class="nav-item <?= ($this->uri->segment(2) == 'pengajuan') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('mahasiswa/pengajuan'); ?>">
            <i class="fas fa-fw fa-file-signature"></i>
            <span>Ajukan Judul Skripsi</span>
        </a>
    </li>

    <!-- Nav Item - Pendaftaran Ujian (Dropdown) -->
    <li class="nav-item <?= ($this->uri->segment(2) == 'pendaftaran_sempro' || $this->uri->segment(2) == 'pendaftaran_ujian') ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUjian"
           aria-expanded="true" aria-controls="collapseUjian">
            <i class="fas fa-fw fa-edit"></i>
            <span>Pendaftaran Ujian</span>
        </a>
        <div id="collapseUjian" class="collapse <?= ($this->uri->segment(2) == 'pendaftaran_sempro' || $this->uri->segment(2) == 'pendaftaran_ujian') ? 'show' : ''; ?>"
             aria-labelledby="headingUjian" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= base_url('mahasiswa/pendaftaran_sempro'); ?>">Seminar Proposal</a>
                <a class="collapse-item" href="<?= base_url('mahasiswa/pendaftaran_ujian'); ?>">Pendadaran</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Status Validasi (Dropdown) -->
    <li class="nav-item <?= ($this->uri->segment(2) == 'validasi_sempro' || $this->uri->segment(2) == 'validasi_pendadaran') ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseValidasi"
           aria-expanded="true" aria-controls="collapseValidasi">
            <i class="fas fa-fw fa-check-circle"></i>
            <span>Status Validasi Berkas</span>
        </a>
        <div id="collapseValidasi" class="collapse <?= ($this->uri->segment(2) == 'validasi_sempro' || $this->uri->segment(2) == 'validasi_pendadaran') ? 'show' : ''; ?>"
             aria-labelledby="headingValidasi" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= base_url('mahasiswa/validasi_sempro'); ?>">Seminar Proposal</a>
                <a class="collapse-item" href="<?= base_url('mahasiswa/validasi_pendadaran'); ?>">Pendadaran</a>
            </div>
        </div>
    </li>

    <!-- Hasil Ujian -->
    <li class="nav-item <?= ($this->uri->segment(2) == 'hasil_ujian') ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseHasilUjian"
           aria-expanded="true" aria-controls="collapseHasilUjian">
            <i class="fas fa-fw fa-poll"></i>
            <span>Hasil Ujian</span>
        </a>
        <div id="collapseHasilUjian" class="collapse <?= ($this->uri->segment(2) == 'hasil_ujian') ? 'show' : ''; ?>"
             aria-labelledby="headingHasilUjian" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= base_url('mahasiswa/hasil_ujian'); ?>">Lihat Nilai & Hasil</a>
                <a class="collapse-item" href="<?= base_url('saran'); ?>">Lihat Saran Perbaikan</a>
                <a class="collapse-item" href="<?= base_url('apresiasi'); ?>">Lihat Apresiasi</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Logout -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </li>

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

