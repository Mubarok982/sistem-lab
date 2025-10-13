<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mahasiswa</th>
                <th>Tema</th>
                <th>Tanggal</th>
                <th>Ruang</th>
                <th>Penguji 1</th>
                <th>Penguji 2</th>
                <th>Penguji 3</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ujian as $u): ?>
            <tr>
                <td><?= $u->nama_mahasiswa; ?></td>
                <td><?= $u->tema; ?></td>
                <td><?= $u->tanggal; ?></td>
                <td><?= $u->ruang; ?></td>
                <td><?= $u->penguji1 ?? '-'; ?></td>
                <td><?= $u->penguji2 ?? '-'; ?></td>
                <td><?= $u->penguji3 ?? '-'; ?></td>
                <td>
                    <a href="<?= base_url('admin/penetapan_penguji/edit/'.$u->id); ?>" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i> Tetapkan
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
