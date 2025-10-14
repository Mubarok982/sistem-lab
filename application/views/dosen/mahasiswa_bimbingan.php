<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nama Mahasiswa</th>
                <th>Tema</th>
                <th>Tanggal Pengajuan</th>
                <th>Skema</th>
                <th>Peran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($mahasiswa_bimbingan)): ?>
                <?php foreach ($mahasiswa_bimbingan as $m): ?>
                    <tr>
                        <td><?= $m->nama_mahasiswa; ?></td>
                        <td><?= $m->tema; ?></td>
                        <td><?= $m->tgl_pengajuan_judul; ?></td>
                        <td><?= $m->skema; ?></td>
                        <td><?= $m->peran; ?></td>
                        <td>
                            <a href="<?= site_url('dosen/mahasiswa_bimbingan/detail/'.$m->id); ?>" 
                               class="btn btn-sm btn-info">Detail</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">Belum ada mahasiswa bimbingan</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
