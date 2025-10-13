<div class="container mt-4">
    <h2><?= $title ?></h2>

    <table class="table table-bordered">
        <tr>
            <th>Nama Mahasiswa</th>
            <td><?= $ujian->nama_mahasiswa ?></td>
        </tr>
        <tr>
            <th>Tema Skripsi</th>
            <td><?= $ujian->tema ?></td>
        </tr>
        <tr>
            <th>Tanggal Ujian</th>
            <td><?= date('d-m-Y', strtotime($ujian->tanggal)) ?></td>
        </tr>
        <tr>
            <th>Ruang</th>
            <td><?= $ujian->ruang ?></td>
        </tr>
        <tr>
            <th>Penguji 1</th>
            <td><?= $ujian->penguji1 ?: '-' ?></td>
        </tr>
        <tr>
            <th>Penguji 2</th>
            <td><?= $ujian->penguji2 ?: '-' ?></td>
        </tr>
        <tr>
            <th>Penguji 3</th>
            <td><?= $ujian->penguji3 ?: '-' ?></td>
        </tr>
        <tr>
            <th>Status</th>
            <td><?= $ujian->status ?></td>
        </tr>
    </table>

    <a href="<?= base_url('admin/rekap_nilai') ?>" class="btn btn-secondary">Kembali</a>
</div>
