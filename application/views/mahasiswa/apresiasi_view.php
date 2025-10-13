<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar_mahasiswa'); ?>

<div class="container mt-5">
    <h2 class="mb-4">Daftar Apresiasi</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>Dosen Penguji</th>
                <th>Apresiasi</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($apresiasi_list)): ?>
                <?php $no=1; foreach($apresiasi_list as $a): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $a->nama_mahasiswa ?? 'Belum ada' ?></td>
                        <td><?= $a->nama_dosen ?? 'Belum ada' ?></td>
                        <td><?= $a->apresiasi ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">Belum ada apresiasi</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php $this->load->view('templates/footer'); ?>
