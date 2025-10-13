<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th>No</th>
                <th>Mahasiswa</th>
                <th>Nama Berkas</th>
                <th>Status</th>
                <th>Catatan</th>
                <th>Terakhir Diperbarui</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($validasi as $v): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $v->nama_mahasiswa; ?></td>
                <td><?= $v->nama_field_syarat; ?></td>
                <td>
                    <?php if ($v->status == 'Diterima'): ?>
                        <span class="badge badge-success">Diterima</span>
                    <?php elseif ($v->status == 'Revisi'): ?>
                        <span class="badge badge-warning">Revisi</span>
                    <?php else: ?>
                        <span class="badge badge-secondary">Menunggu</span>
                    <?php endif; ?>
                </td>
                <td><?= $v->catatan ?? '-'; ?></td>
                <td><?= date('d M Y H:i', strtotime($v->updated_at)); ?></td>
                <td>
                    <a href="<?= base_url('admin/validasi_ujian/setujui/'.$v->id); ?>" class="btn btn-success btn-sm">Setujui</a>
                    <a href="<?= base_url('admin/validasi_ujian/revisi/'.$v->id); ?>" class="btn btn-warning btn-sm">Revisi</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
