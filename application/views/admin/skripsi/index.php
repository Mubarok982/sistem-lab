<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mahasiswa</th>
                <th>Tema</th>
                <th>Tanggal Pengajuan</th>
                <th>Skema</th>
                <th>Pembimbing 1</th>
                <th>Pembimbing 2</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list_skripsi as $s): ?>
            <tr>
                <td><?= $s->nama_mahasiswa; ?></td>
                <td><?= $s->tema; ?></td>
                <td><?= $s->tgl_pengajuan_judul; ?></td>
                <td><?= $s->skema; ?></td>
                <td><?= $s->pembimbing1; ?></td>
                <td><?= $s->pembimbing2; ?></td>
                <td>
                    <a href="#" class="btn btn-sm btn-info">Detail</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
