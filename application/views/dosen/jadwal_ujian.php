<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?php if (empty($jadwal)): ?>
        <div class="alert alert-info">Tidak ada jadwal ujian untuk Anda.</div>
    <?php else: ?>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Mahasiswa</th>
                    <th>Judul Skripsi</th>
                    <th>Jenis Ujian</th>
                    <th>Tanggal</th>
                    <th>Ruang</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($jadwal as $j): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $j->nama_mahasiswa; ?></td>
                    <td><?= $j->judul_skripsi; ?></td>
                    <td><?= ucfirst($j->jenis_ujian); ?></td>
                    <td><?= date('d M Y', strtotime($j->tanggal)); ?></td>
                    <td><?= $j->ruang; ?></td>
                    <td>
                        <span class="badge badge-<?= ($j->status == 'Berlangsung') ? 'warning' : 'success'; ?>">
                            <?= $j->status; ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

