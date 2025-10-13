<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Rekapitulasi Nilai Akhir Ujian</h6>
        </div>
        <div class="card-body">
            <?php if (empty($rekap)) : ?>
                <div class="alert alert-info">Belum ada data nilai ujian yang tersedia.</div>
            <?php else : ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Jenis Ujian</th>
                                <th>Komponen Penilaian</th>
                                <th>Jenis Nilai</th>
                                <th>Bobot</th>
                                <th>Rata-rata</th>
                                <th>Nilai Akhir (× Bobot)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $total = 0;
                            foreach ($rekap as $r) : 
                                $total += $r['nilai_akhir'];
                            ?>
                                <tr>
                                    <td><?= $r['jenis_ujian']; ?></td>
                                    <td><?= $r['komponen']; ?></td>
                                    <td><?= $r['jenis_nilai']; ?></td>
                                    <td><?= $r['bobot']; ?></td>
                                    <td><?= number_format($r['rata_rata'], 2); ?></td>
                                    <td><?= number_format($r['nilai_akhir'], 2); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr class="table-primary">
                                <th colspan="5" class="text-right">Total Nilai Akhir</th>
                                <th><?= number_format($total, 2); ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
