<div class="container mt-4">
    <h2><?= $title ?></h2>
    <table class="table table-bordered table-striped mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>Tema Skripsi</th>
                <th>Tanggal Ujian</th>
                <th>Ruang</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if($rekap): ?>
                <?php $no = 1; foreach($rekap as $r): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $r->nama_mahasiswa ?></td>
                        <td><?= $r->tema ?></td>
                        <td><?= date('d-m-Y', strtotime($r->tanggal)) ?></td>
                        <td><?= $r->ruang ?></td>
                        <td>
                            <a href="<?= base_url('admin/rekap_nilai/detail/'.$r->id) ?>" class="btn btn-sm btn-info">Detail</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">Data tidak tersedia</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
