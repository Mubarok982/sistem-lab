<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?php if ($skripsi): ?>
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <strong>Informasi Skripsi</strong>
        </div>
        <div class="card-body">
            <p><strong>Nama Mahasiswa:</strong> <?= $skripsi->nama_mahasiswa; ?></p>
            <p><strong>Tema:</strong> <?= $skripsi->tema; ?></p>
            <p><strong>Tanggal Pengajuan:</strong> <?= $skripsi->tgl_pengajuan_judul; ?></p>
            <p><strong>Skema:</strong> <?= $skripsi->skema; ?></p>
            <p><strong>Pembimbing 1:</strong> <?= $skripsi->nama_pembimbing1; ?></p>
            <p><strong>Pembimbing 2:</strong> <?= $skripsi->nama_pembimbing2; ?></p>
            <p><strong>Naskah:</strong> 
                <?php if (!empty($skripsi->naskah)): ?>
                    <a href="<?= base_url('uploads/naskah/'.$skripsi->naskah); ?>" target="_blank">Lihat Naskah</a>
                <?php else: ?>
                    <span class="text-muted">Belum diunggah</span>
                <?php endif; ?>
            </p>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-secondary text-white">
            <strong>Data Ujian Skripsi</strong>
        </div>
        <div class="card-body">
            <?php if (!empty($ujian)): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Jenis Ujian</th>
                        <th>Tanggal</th>
                        <th>Tanggal Daftar</th>
                        <th>Ruang</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ujian as $u): ?>
                    <tr>
                        <td><?= $u->jenis_ujian; ?></td>
                        <td><?= $u->tanggal; ?></td>
                        <td><?= $u->tanggal_daftar; ?></td>
                        <td><?= $u->ruang; ?></td>
                        <td><?= $u->status; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
                <p class="text-muted">Belum ada data ujian untuk mahasiswa ini.</p>
            <?php endif; ?>
        </div>
    </div>

    <?php else: ?>
        <div class="alert alert-danger">Data skripsi tidak ditemukan.</div>
    <?php endif; ?>
</div>
