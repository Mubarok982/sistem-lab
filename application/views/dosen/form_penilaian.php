<div class="container-fluid">
    <h3 class="mb-4"><?= $title; ?></h3>

    <div class="card mb-4">
        <div class="card-body">
            <strong>Mahasiswa:</strong> <?= $mahasiswa->nama_mahasiswa; ?><br>
            <strong>Judul Skripsi:</strong> <?= $mahasiswa->judul_skripsi; ?><br>
            <strong>Jenis Ujian:</strong> <?= ucfirst($mahasiswa->jenis_ujian); ?>
        </div>
    </div>

    <form action="<?= base_url('dosen/penilaian_ujian/simpan_nilai'); ?>" method="post">
        <input type="hidden" name="id_ujian" value="<?= $id_ujian; ?>">

        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Komponen</th>
                    <th>Nilai (0-100)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($komponen as $k): ?>
                <tr>
                    <td><?= $k->nama_komponen; ?></td>
                    <td>
                        <input type="number" name="nilai[<?= $k->id; ?>]" class="form-control" min="0" max="100" required>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="form-group">
            <label>Saran Perbaikan</label>
            <textarea name="saran" class="form-control" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label>Apresiasi</label>
            <textarea name="apresiasi" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan Nilai</button>
    </form>
</div>
