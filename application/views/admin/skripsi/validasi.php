<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mahasiswa</th>
                <th>Naskah</th>
                <th>Status Validasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($berkas as $b): ?>
            <tr>
                <td><?= $b->nama_mahasiswa; ?></td>
                <td><a href="<?= base_url('uploads/naskah/'.$b->naskah); ?>" target="_blank">Lihat File</a></td>
                <td><?= $b->status_validasi ?? 'Belum Divalidasi'; ?></td>
                <td>
                    <a href="<?= base_url('admin/validasi_berkas/setujui/'.$b->id); ?>" class="btn btn-success btn-sm">Setujui</a>
                    <a href="<?= base_url('admin/validasi_berkas/tolak/'.$b->id); ?>" class="btn btn-danger btn-sm">Tolak</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
