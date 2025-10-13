<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-3 mb-4">
            <?= $sidebar; ?>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9">
            <!-- Flash Message -->
            <?php if($this->session->flashdata('message')): ?>
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('message'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Form Upload Berkas Seminar Proposal</h5>
                </div>
                <div class="card-body">
                    <?php if($bisa_daftar): ?>
                        <form action="<?= base_url('mahasiswa/submit_sempro'); ?>" method="post" enctype="multipart/form-data">
                            
                            <!-- IPK -->
                            <div class="mb-3">
                                <label for="ipk" class="form-label">IPK</label>
                                <input type="number" step="0.01" name="ipk" id="ipk" class="form-control" value="<?= set_value('ipk'); ?>" required>
                                <?= form_error('ipk', '<small class="text-danger">', '</small>'); ?>
                            </div>

                            <!-- Upload File Persyaratan Sempro -->
                            <div class="row">
                                <?php 
                                $file_fields = [
                                    'naskah' => 'Naskah Skripsi',
                                    'fotokopi_daftar_nilai' => 'Fotokopi Daftar Nilai',
                                    'fotokopi_krs' => 'Fotokopi KRS',
                                    'buku_kendali_bimbingan' => 'Buku Kendali Bimbingan',
                                    'lembar_revisi_ba_dan_tanda_terima_laporan_kp' => 'Lembar Revisi BA & Tanda Terima Laporan KP',
                                    'bukti_seminar_teman' => 'Bukti Seminar Teman'
                                ];
                                ?>
                                <?php foreach($file_fields as $field => $label): ?>
                                    <div class="col-md-6 mb-3">
                                        <label for="<?= $field; ?>" class="form-label"><?= $label; ?></label>
                                        <input type="file" name="<?= $field; ?>" id="<?= $field; ?>" class="form-control">
                                        <?php if(!empty($syarat[$field])): ?>
                                            <small class="text-success d-block mt-1">
                                                File sebelumnya: 
                                                <a href="<?= base_url('uploads/syarat_sempro/'.$syarat[$field]); ?>" target="_blank"><?= $syarat[$field]; ?></a>
                                            </small>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3 w-100">Daftar Seminar Proposal</button>
                        </form>
                    <?php else: ?>
                        <div class="alert alert-warning">
                            Anda belum mendapatkan persetujuan dari dosen pembimbing untuk mendaftar Seminar Proposal.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS Bundle CDN (Popper + JS) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
