<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <a href="<?= base_url('admin/akun/mahasiswa/tambah'); ?>" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Mahasiswa
    </a>

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list_mahasiswa as $mhs): ?>
                    <tr>
                        <td><?= $mhs->username; ?></td>
                        <td><?= $mhs->nama; ?></td>
                        <td><?= ucfirst($mhs->role); ?></td>
                        <td>
                            <a href="<?= base_url('admin/akun/mahasiswa/edit/'.$mhs->id); ?>" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="<?= base_url('admin/akun/mahasiswa/hapus/'.$mhs->id); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus akun ini?');">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
