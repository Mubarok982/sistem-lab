<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?php if (empty($ujian)): ?>
        <div class="alert alert-info">Tidak ada ujian yang dijadwalkan untuk Anda.</div>
    <?php else: ?>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Mahasiswa</th>
                    <th>Judul Skripsi</th>
                    <th>Jenis Ujian</th>
                    <th>Tanggal</th>
                    <th>Ruang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($ujian as $u): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $u->nama_mahasiswa; ?></td>
                    <td><?= $u->judul_skripsi; ?></td>
                    <td><?= $u->jenis_ujian; ?></td>
                    <td><?= date('d M Y', strtotime($u->tanggal)); ?></td>
                    <td><?= $u->ruang; ?></td>
                    <td>
                        <a href="<?= base_url('dosen/penilaian_ujian/nilai/'.$u->id); ?>" class="btn btn-sm btn-primary">
                            Input Nilai
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
