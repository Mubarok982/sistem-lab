<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
    <?php endif; ?>

    <a href="<?= base_url('admin/akun/dosen/tambah') ?>" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Akun Dosen
    </a>

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($list_dosen as $d): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $d->nama ?></td>
                        <td><?= $d->username ?></td>
                        <td>
                            <a href="<?= base_url('admin/akun/dosen/edit/'.$d->id) ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="<?= base_url('admin/akun/dosen/hapus/'.$d->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus akun ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
