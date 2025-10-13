<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <form action="<?= isset($mahasiswa) ? base_url('admin/akun/mahasiswa/update/'.$mahasiswa->id) : base_url('admin/akun/mahasiswa/simpan'); ?>" method="post">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="<?= isset($mahasiswa) ? $mahasiswa->username : ''; ?>" required>
        </div>
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" value="<?= isset($mahasiswa) ? $mahasiswa->nama : ''; ?>" required>
        </div>
        <div class="form-group">
            <label>Password <?= isset($mahasiswa) ? '(isi jika ingin ubah)' : ''; ?></label>
            <input type="password" name="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="<?= base_url('admin/akun/mahasiswa'); ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>
