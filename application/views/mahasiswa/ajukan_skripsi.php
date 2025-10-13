<div id="wrapper" class="d-flex">

    <!-- Sidebar Mahasiswa -->
    <?php $this->load->view('templates/sidebar_mahasiswa'); ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="flex-grow-1 d-flex flex-column">
        <div id="content" class="container-fluid">

            <h1 class="h3 mb-4 text-gray-800"><?= $title ?? 'Ajukan Skripsi'; ?></h1>

            <?php if($this->session->flashdata('message')): ?>
                <div class="alert alert-success"><?= $this->session->flashdata('message'); ?></div>
            <?php endif; ?>

            <!-- Status Pengajuan Terakhir -->
            <?php if(!empty($pengajuan_terakhir)): ?>
                <div class="card mb-4 shadow">
                    <div class="card-header">
                        Status Pengajuan Terakhir
                    </div>
                    <div class="card-body">
                        <p><strong>Tema:</strong> <?= $pengajuan_terakhir->tema ?? '-'; ?></p>
                        <p><strong>Judul:</strong> <?= $pengajuan_terakhir->judul ?? '-'; ?></p>
                        <p><strong>Skema:</strong> <?= $pengajuan_terakhir->skema ?? '-'; ?></p>
                        <p><strong>Status Ujian:</strong> <?= $pengajuan_terakhir->status_ujian ?? '-'; ?></p>
                        <p><strong>Tanggal Pengajuan:</strong> <?= !empty($pengajuan_terakhir->tanggal_pengajuan_judul) ? date('d-m-Y', strtotime($pengajuan_terakhir->tanggal_pengajuan_judul)) : '-'; ?></p>

                </div>
            <?php else: ?>
                <div class="alert alert-info">Belum ada pengajuan skripsi sebelumnya.</div>
            <?php endif; ?>

            <!-- Form Pengajuan Skripsi -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    Form Pengajuan Skripsi
                </div>
                <div class="card-body">
                    <form action="<?= base_url('mahasiswa/pengajuan'); ?>" method="post">
                        <div class="form-group">
                            <label for="tema">Tema Skripsi</label>
                            <select name="tema" id="tema" class="form-control" required>
                                <option value="">-- Pilih Tema --</option>
                                <option value="Software Engineering" <?= set_select('tema','Software Engineering'); ?>>Software Engineering</option>
                                <option value="Networking" <?= set_select('tema','Networking'); ?>>Networking</option>
                                <option value="Artificial Intelligence" <?= set_select('tema','Artificial Intelligence'); ?>>Artificial Intelligence</option>
                            </select>
                            <?= form_error('tema', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <div class="form-group">
                            <label for="judul">Judul Skripsi</label>
                            <input type="text" name="judul" id="judul" class="form-control" value="<?= set_value('judul'); ?>" required>
                            <?= form_error('judul', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <div class="form-group">
                            <label for="skema">Skema</label>
                            <select name="skema" id="skema" class="form-control" required>
                                <option value="">-- Pilih Skema --</option>
                                <option value="Reguler" <?= set_select('skema','Reguler'); ?>>Reguler</option>
                                <option value="Penyetaraan" <?= set_select('skema','Penyetaraan'); ?>>Penyetaraan</option>
                            </select>
                            <?= form_error('skema', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Ajukan</button>
                    </form>
                </div>
            </div>

        </div> <!-- End Container-fluid -->
    </div> <!-- End Content Wrapper -->

</div> <!-- End Wrapper -->
