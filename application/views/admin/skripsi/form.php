<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <form action="<?= isset($skripsi) ? base_url('admin/skripsi/update/'.$skripsi->id) : base_url('admin/skripsi/simpan'); ?>" method="post">
        <div class="form-group">
            <label>Mahasiswa</label>
            <select name="id_mahasiswa" class="form-control" required>
                <option value="">-- Pilih Mahasiswa --</option>
                <?php foreach ($mahasiswa as $m): ?>
                    <option value="<?= $m->id; ?>" <?= isset($skripsi) && $skripsi->id_mahasiswa == $m->id ? 'selected' : ''; ?>>
                        <?= $m->nama; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Tema</label>
            <select name="tema" class="form-control">
                <option value="Software Engineering">Software Engineering</option>
                <option value="Networking">Networking</option>
                <option value="Artificial Intelligence">Artificial Intelligence</option>
            </select>
        </div>

        <div class="form-group">
            <label>Pembimbing 1</label>
            <select name="pembimbing1" class="form-control">
                <?php foreach ($dosen as $d): ?>
                    <option value="<?= $d->id; ?>" <?= isset($skripsi) && $skripsi->pembimbing1 == $d->id ? 'selected' : ''; ?>>
                        <?= $d->nidk; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Pembimbing 2</label>
            <select name="pembimbing2" class="form-control">
                <?php foreach ($dosen as $d): ?>
                    <option value="<?= $d->id; ?>" <?= isset($skripsi) && $skripsi->pembimbing2 == $d->id ? 'selected' : ''; ?>>
                        <?= $d->nidk; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Tanggal Pengajuan</label>
            <input type="date" name="tgl_pengajuan_judul" class="form-control" value="<?= isset($skripsi) ? $skripsi->tgl_pengajuan_judul : ''; ?>">
        </div>

        <div class="form-group">
            <label>Skema</label>
            <select name="skema" class="form-control">
                <option value="Reguler">Reguler</option>
                <option value="Penyerataan">Penyerataan</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="<?= base_url('admin/skripsi'); ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>
