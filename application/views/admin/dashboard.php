<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
</div>

<!-- Content Row -->
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Selamat Datang</h6>
            </div>
            <div class="card-body">
                <p>Selamat datang di dashboard admin, <strong><?= htmlspecialchars($user->nama, ENT_QUOTES, 'UTF-8'); ?></strong>!</p>
                <p>Anda telah berhasil login sebagai <?= htmlspecialchars($user->role, ENT_QUOTES, 'UTF-8'); ?>.</p>
                <p class="mb-0">Gunakan sidebar di sebelah kiri untuk menavigasi menu yang tersedia.</p>
            </div>
        </div>
    </div>
</div>

