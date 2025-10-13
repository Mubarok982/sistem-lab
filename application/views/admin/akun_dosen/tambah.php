<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>

    <form method="post" action="">
        <div class="form-group">
            <label>Nama Dosen</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="<?= base_url('admin/akun/dosen') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>
