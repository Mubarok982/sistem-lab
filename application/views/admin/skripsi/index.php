<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">
        <?= isset($title) ? $title : 'Daftar Skripsi'; ?>
    </h1>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>Mahasiswa</th>
                            <th>Tema</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Skema</th>
                            <th>Pembimbing 1</th>
                            <th>Pembimbing 2</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($list_skripsi)): ?>
                            <?php foreach ($list_skripsi as $s): ?>
                                <tr>
                                    <td><?= htmlspecialchars($s->nama_mahasiswa ?? '-', ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?= htmlspecialchars($s->tema ?? '-', ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td class="text-center">
                                        <?= isset($s->tgl_pengajuan_judul) ? date('d-m-Y', strtotime($s->tgl_pengajuan_judul)) : '-'; ?>
                                    </td>
                                    <td><?= htmlspecialchars($s->skema ?? '-', ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?= htmlspecialchars($s->pembimbing1 ?? '-', ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?= htmlspecialchars($s->pembimbing2 ?? '-', ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('skripsi/detail/' . ($s->id ?? '')); ?>" 
                                           class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    Belum ada data skripsi.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
