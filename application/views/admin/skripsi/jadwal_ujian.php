<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>

<!-- Card Style Wrapper -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Jadwal Ujian</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Mahasiswa</th>
                        <th>Tanggal Ujian</th>
                        <th>Ruang</th>
                        <th>Penguji 1</th>
                        <th>Penguji 2</th>
                        <th>Penguji 3</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($jadwal)): ?>
                        <?php foreach ($jadwal as $j): ?>
                        <tr>
                            <td><?= $j->nama_mahasiswa ?? '-'; ?></td>
                            <td><?= $j->tanggal ?? '-'; ?></td>
                            <td><?= $j->ruang ?? '-'; ?></td>
                            <td><?= $j->penguji1 ?? '-'; ?></td>
                            <td><?= $j->penguji2 ?? '-'; ?></td>
                            <td><?= $j->penguji3 ?? '-'; ?></td>
                            <td>
                                <span class="badge badge-info"><?= ucfirst($j->status ?? 'Belum Ditetapkan'); ?></span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted">Belum ada data ujian skripsi.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
