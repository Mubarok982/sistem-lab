<div class="container mt-5">
    <h2 class="mb-4">Dashboard Dosen</h2>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Mahasiswa Bimbingan</h5>
                    <p class="card-text display-5"><?= $jumlah_bimbingan ?></p>
                </div>
            </div>
        </div>
    </div>

    <h4>Jadwal Ujian Mendatang</h4>
    <table class="table table-bordered table-striped mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Skripsi</th>
                <th>Tanggal Ujian</th>
                <th>Waktu Ujian</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($jadwal_ujian)): ?>
                <?php $no=1; foreach($jadwal_ujian as $u): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $u->judul ?></td>
                        <td><?= date('d-m-Y', strtotime($u->tanggal)) ?></td>
                        <td><?= $u->waktu_ujian ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">Belum ada jadwal ujian</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
