<div class="container mt-4">
    <h2 class="mb-3 text-center"><?= $title ?></h2>

    <table class="table table-bordered table-striped mt-3">
        <thead class="table-primary text-center">
            <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>Judul Skripsi</th>
                <th>Tema Skripsi</th>
                <th>Tanggal Ujian</th>
                <th>Nilai Angka</th>
                <th>Huruf Mutu</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($rekap): ?>
                <?php 
                $no = 1; 
                foreach ($rekap as $r): 
                    $nilai = $r->nilai_total ?? 0;
                    if ($nilai >= 85) $huruf = 'A';
                    elseif ($nilai >= 70) $huruf = 'B';
                    elseif ($nilai >= 60) $huruf = 'C';
                    elseif ($nilai >= 50) $huruf = 'D';
                    else $huruf = 'E';
                ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><?= $r->nama_mahasiswa ?></td>
                        <td><?= $r->judul ?></td>
                        <td><?= $r->tema ?></td>
                        <td class="text-center"><?= !empty($r->tanggal) ? date('d-m-Y', strtotime($r->tanggal)) : '-' ?></td>
                        <td class="text-center"><?= $nilai ?: '-' ?></td>
                        <td class="text-center"><?= $huruf ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">Data tidak tersedia</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
