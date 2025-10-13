<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <form action="<?= base_url('admin/penetapan_penguji/update/'.$ujian->id); ?>" method="post">
        <div class="form-group">
            <label>Penguji 1</label>
            <select name="penguji1" class="form-control">
                <option value="">-- Pilih Dosen --</option>
                <?php foreach ($dosen as $d): ?>
                    <option value="<?= $d->id; ?>" <?= ($ujian->penguji1 == $d->id) ? 'selected' : ''; ?>>
                        <?= $d->nama; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Penguji 2</label>
            <select name="penguji2" class="form-control">
                <option value="">-- Pilih Dosen --</option>
                <?php foreach ($dosen as $d): ?>
                    <option value="<?= $d->id; ?>" <?= ($ujian->penguji2 == $d->id) ? 'selected' : ''; ?>>
                        <?= $d->nama; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Penguji 3</label>
            <select name="penguji3" class="form-control">
                <option value="">-- Pilih Dosen --</option>
                <?php foreach ($dosen as $d): ?>
                    <option value="<?= $d->id; ?>" <?= ($ujian->penguji3 == $d->id) ? 'selected' : ''; ?>>
                        <?= $d->nama; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?= base_url('admin/penetapan_penguji'); ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>
