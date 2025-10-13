<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <a href="<?= base_url('admin/penjadwalan_ujian/tambah'); ?>" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Jadwal
    </a>

    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th>No</th>
                <th>Mahasiswa</th>
                <th>Jenis Ujian</th>
                <th>Tanggal Ujian</th>
                <th>Tanggal Daftar</th>
                <th>Ruang</th>
                <th>Penguji 1</th>
                <th>Penguji 2</th>
                <th>Penguji 3</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach ($jadwal as $j): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $j->nama_mahasiswa; ?></td>
                <td><?= $j->jenis_ujian; ?></td>
                <td><?= $j->tanggal; ?></td>
                <td><?= $j->tanggal_daftar; ?></td>
                <td><?= $j->ruang; ?></td>
                <td><?= $j->penguji1; ?></td>
                <td><?= $j->penguji2; ?></td>
                <td><?= $j->penguji3; ?></td>
                <td>
                    <?php if ($j->status == 'Selesai'): ?>
                        <span class="badge badge-success">Selesai</span>
                    <?php elseif ($j->status == 'Diterima'): ?>
                        <span class="badge badge-primary">Diterima</span>
                    <?php elseif ($j->status == 'Perbaikan'): ?>
                        <span class="badge badge-warning">Perbaikan</span>
                    <?php else: ?>
                        <span class="badge badge-info">Dijadwalkan</span>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?= base_url('admin/penjadwalan_ujian/hapus/'.$j->id); ?>" class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
