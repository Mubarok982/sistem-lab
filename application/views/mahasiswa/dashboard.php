<?php $this->load->view('templates/header'); ?>
<div id="wrapper" class="d-flex">

    <!-- Sidebar -->
    <?php $this->load->view('templates/sidebar_mahasiswa'); ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="flex-grow-1 d-flex flex-column">
        <div id="content" class="container-fluid">

            <h1 class="h3 mb-4 text-gray-800">Dashboard Mahasiswa</h1>

            <div class="row">

                <!-- Card Status Skripsi -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Status Skripsi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $status_skripsi ?? 'Belum ada data'; ?></div>
                        </div>
                    </div>
                </div>

                <!-- Card Nilai Terakhir -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Nilai Terakhir</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $nilai_terakhir ?? '-'; ?></div>
                        </div>
                    </div>
                </div>

                <!-- Card Dosen Pembimbing -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Dosen Pembimbing</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $dosen_pembimbing ?? '-'; ?></div>
                        </div>
                    </div>
                </div>

            </div> <!-- End Row -->

        </div> <!-- End Container-fluid -->
    </div> <!-- End Content Wrapper -->

</div> <!-- End Wrapper -->

<?php $this->load->view('templates/footer'); ?>
