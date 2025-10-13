<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar_mahasiswa'); ?>

<div class="container mt-5">
    <h2 class="mb-4">Daftar Saran Perbaikan</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>Dosen Penguji</th>
                <th>Saran</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($saran_list)): ?>
                <?php $no=1; foreach($saran_list as $s): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $s->nama_mahasiswa ?? 'Belum ada' ?></td>
                        <td><?= $s->nama_dosen ?? 'Belum ada' ?></td>
                        <td><?= $s->saran ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">Belum ada saran</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php $this->load->view('templates/footer'); ?>
