<div id="wrapper" class="d-flex">

    <!-- Sidebar Mahasiswa -->
    <?php $this->load->view('templates/sidebar_mahasiswa'); ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="flex-grow-1 d-flex flex-column">
        <div id="content" class="container-fluid">

            <h1 class="h3 mb-4 text-gray-800"><?= $title ?? 'Pendaftaran Ujian'; ?></h1>

            <?php if($this->session->flashdata('message')): ?>
                <div class="alert alert-info"><?= $this->session->flashdata('message'); ?></div>
            <?php endif; ?>

            <!-- Data Skripsi -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    Data Skripsi
                </div>
                <div class="card-body">
                    <p><strong>Tema:</strong> <?= $skripsi->tema ?? '-'; ?></p>
                    <p><strong>Judul:</strong> <?= $skripsi->judul ?? '-'; ?></p>
                    <p><strong>Skema:</strong> <?= $skripsi->skema ?? '-'; ?></p>
                </div>
            </div>

            <!-- Form Pendaftaran Ujian -->
            <?php if($bisa_daftar): ?>
                <div class="card shadow mb-4">
                    <div class="card-header">
                        Form Pendaftaran Ujian Pendadaran
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('mahasiswa/submit_ujian'); ?>" method="post" enctype="multipart/form-data">

                            <div class="row">
                                <!-- IPK -->
                                <div class="col-md-4 mb-3">
                                    <label for="ipk">IPK</label>
                                    <input type="number" step="0.01" name="ipk" id="ipk" class="form-control" value="<?= set_value('ipk'); ?>" required>
                                    <?= form_error('ipk', '<small class="text-danger">', '</small>'); ?>
                                </div>

                                <!-- File Persyaratan -->
                                <?php
                                $file_fields = [
                                    'naskah' => 'Naskah',
                                    'berita_acara_seminar' => 'Berita Acara Seminar',
                                    'daftar_nilai_sementara' => 'Daftar Nilai Sementara',
                                    'krs_terbaru' => 'KRS Terbaru',
                                    'dokumen_identitas' => 'Dokumen Identitas',
                                    'sertifikat_toefl_niit' => 'Sertifikat TOEFL/NIIT',
                                    'sertifikat_office_puskom' => 'Sertifikat Office Puskom',
                                    'sertifikat_btq_ibadah' => 'Sertifikat BTQ/Ibadah',
                                    'sertifikat_bahasa' => 'Sertifikat Bahasa',
                                    'sertifikat_kompetensi_ujian_komprehensif' => 'Sertifikat Kompetensi Ujian Komprehensif',
                                    'sertifikat_semaba_ppk_masta' => 'Sertifikat SEMABA/PPK/MASTA',
                                    'sertifikat_kkn' => 'Sertifikat KKN',
                                    'buku_kendali_bimbingan' => 'Buku Kendali Bimbingan',
                                    'bukti_pembayaran_sidang' => 'Bukti Pembayaran Sidang'
                                ];

                                foreach($file_fields as $field => $label):
                                ?>
                                    <div class="col-md-4 mb-3">
                                        <label for="<?= $field; ?>"><?= $label; ?></label>
                                        <input type="file" name="<?= $field; ?>" id="<?= $field; ?>" class="form-control" required>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Daftar Ujian</button>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-warning">Anda belum mendapatkan persetujuan dari dosen pembimbing.</div>
            <?php endif; ?>

            <!-- Status Pendaftaran -->
            <?php if($ujian): ?>
                <div class="card shadow mb-4">
                    <div class="card-header">
                        Status Pendaftaran Ujian
                    </div>
                    <div class="card-body">
                        <p><strong>Status:</strong> <?= $ujian->status ?? '-'; ?></p>
                        <p><strong>Tanggal Daftar:</strong> <?= !empty($ujian->tanggal_daftar) ? date('d-m-Y', strtotime($ujian->tanggal_daftar)) : '-'; ?></p>
                        <p><strong>Catatan:</strong> <?= $ujian->catatan ?? '-'; ?></p>
                    </div>
                </div>
            <?php endif; ?>

        </div> <!-- End Container-fluid -->
    </div> <!-- End Content Wrapper -->

</div> <!-- End Wrapper -->
