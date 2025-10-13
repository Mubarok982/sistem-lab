 <!-- Sidebar -->
    <?php $this->load->view('templates/sidebar_mahasiswa'); ?>

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

<!-- Card Wrapper -->
<div class="card shadow mb-4 border-0">
    <div class="card-header py-3 bg-gradient-primary text-white">
        <h6 class="m-0 font-weight-bold">Status Validasi Berkas Seminar Proposal</h6>
    </div>

    <div class="card-body">
        <?php if (empty($validasi)) : ?>
            <div class="alert alert-info shadow-sm">
                <i class="fas fa-info-circle me-2"></i>
                Belum ada data validasi untuk berkas Anda. 
                <br>Mohon tunggu informasi dari bagian administrasi.
            </div>
        <?php else : ?>
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle" width="100%">
                    <thead class="table-primary text-center">
                        <tr>
                            <th style="width: 30%">Nama Berkas</th>
                            <th style="width: 15%">Status</th>
                            <th style="width: 35%">Catatan dari Validator</th>
                            <th style="width: 20%">Tanggal Validasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($validasi as $v) : ?>
                            <tr>
                                <td><?= ucwords(str_replace('_', ' ', $v->nama_field_syarat)); ?></td>
                                <td class="text-center">
                                    <?php if ($v->status == 'Diterima') : ?>
                                        <span class="badge bg-success px-3 py-2"><i class="fas fa-check-circle me-1"></i><?= $v->status; ?></span>
                                    <?php elseif ($v->status == 'Revisi') : ?>
                                        <span class="badge bg-danger px-3 py-2"><i class="fas fa-times-circle me-1"></i><?= $v->status; ?></span>
                                    <?php else : ?>
                                        <span class="badge bg-warning text-dark px-3 py-2"><i class="fas fa-hourglass-half me-1"></i><?= $v->status; ?></span>
                                    <?php endif; ?>
                                </td>
                                <td><?= !empty($v->catatan) ? $v->catatan : '<em>Tidak ada catatan</em>'; ?></td>
                                <td class="text-center">
                                    <?= !empty($v->updated_at) ? date('d M Y, H:i', strtotime($v->updated_at)) : '-'; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Optional Styling -->
<style>
    .card-header {
        background: linear-gradient(45deg, #4e73df, #1cc88a);
    }
    .badge {
        font-size: 0.9rem;
    }
</style>
