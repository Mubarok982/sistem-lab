<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar_mahasiswa'); ?>

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800">Dashboard Mahasiswa</h1>

            <div class="row">

                <!-- Card Status Skripsi -->
                <div class="col-md-4 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Status Skripsi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $status_skripsi ?? 'Belum ada data'; ?></div>
                        </div>
                    </div>
                </div>

                <!-- Card Nilai Ujian -->
                <div class="col-md-4 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Nilai Terakhir</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $nilai_terakhir ?? '-'; ?></div>
                        </div>
                    </div>
                </div>

                <!-- Card Dosen Pembimbing -->
                <div class="col-md-4 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Dosen Pembimbing</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $dosen_pembimbing ?? '-'; ?></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php $this->load->view('mahasiswa/footer'); ?>
</div>
