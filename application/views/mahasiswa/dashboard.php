<?php $this->load->view('templates/header'); ?>

<div id="wrapper" class="d-flex">
    <!-- Sidebar -->
    <?php $this->load->view('templates/sidebar_mahasiswa'); ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="flex-grow-1 d-flex flex-column">
        <div id="content" class="container-fluid">

            <!-- Judul Halaman -->
            <h1 class="h3 mb-4 text-gray-800"><?= $title ?? 'Dashboard Mahasiswa'; ?></h1>

            <!-- Row untuk Card Utama -->
            <div class="row">
                <!-- Card Status Skripsi -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Status Skripsi
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= !empty($status_skripsi) ? $status_skripsi : 'Belum ada data'; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Nilai Terakhir -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Nilai Terakhir
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= !empty($nilai_terakhir) ? $nilai_terakhir : '-'; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Dosen Pembimbing -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Dosen Pembimbing
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= !empty($dosen_pembimbing) ? $dosen_pembimbing : '-'; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row untuk Grafik dan Informasi -->
            <div class="row">
                <!-- Grafik Progress di sebelah kiri -->
                <div class="col-lg-6 mb-4">
                    <div class="card shadow">
                        <div class="card-header py-3 text-center">
                            <h6 class="m-0 font-weight-bold text-primary">Progress Skripsi</h6>
                        </div>
                        <div class="card-body text-center">
                            <div style="height:200px;">
                                <canvas id="progressChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pengingat & Jadwal di sebelah kanan -->
                <div class="col-lg-6 mb-4">
                    <!-- Pengingat Bimbingan -->
                    <div class="card shadow mb-3">
                        <div class="card-header py-3 bg-warning">
                            <h6 class="m-0 font-weight-bold text-dark">Pengingat Bimbingan</h6>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($pengingat_bimbingan)): ?>
                                <ul class="mb-0">
                                    <?php foreach ($pengingat_bimbingan as $bimbingan): ?>
                                        <li><?= $bimbingan ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p class="mb-0 text-muted">Tidak ada jadwal bimbingan dalam waktu dekat.</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Jadwal Sidang -->
                    <div class="card shadow">
                        <div class="card-header py-3 bg-info">
                            <h6 class="m-0 font-weight-bold text-white">Jadwal Sidang</h6>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($jadwal_sidang)): ?>
                                <p><strong>Tanggal:</strong> <?= $jadwal_sidang['tanggal'] ?></p>
                                <p><strong>Waktu:</strong> <?= $jadwal_sidang['waktu'] ?></p>
                                <p><strong>Tempat:</strong> <?= $jadwal_sidang['tempat'] ?></p>
                            <?php else: ?>
                                <p class="mb-0 text-muted">Belum ada jadwal sidang yang ditetapkan.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- End Container -->
    </div> <!-- End Content Wrapper -->
</div> <!-- End Wrapper -->

<?php $this->load->view('templates/footer'); ?>

<!-- Tambah Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('progressChart').getContext('2d');
const data = {
    labels: ['Proposal', 'Seminar', 'Sidang'],
    datasets: [{
        label: 'Progress (%)',
        data: [
            <?= $progress['proposal'] ?? 0 ?>,
            <?= $progress['seminar'] ?? 0 ?>,
            <?= $progress['sidang'] ?? 0 ?>
        ],
        backgroundColor: ['#3498db', '#f1c40f', '#2ecc71']
    }]
};

new Chart(ctx, {
    type: 'bar',
    data: data,
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                max: 100,
                ticks: { stepSize: 25 }
            }
        },
        plugins: {
            legend: { display: false },
            tooltip: { enabled: true }
        }
    }
});
</script>
