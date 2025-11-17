<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?> | Sistem Lab</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .login-card {
            width: 100%;
            max-width: 900px;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            display: flex;
            flex-direction: row;
            min-height: 70vh; /* card proporsional */
        }

        .login-left {
            flex: 1;
            background: url('<?= base_url("assets/bg.jpg"); ?>') center/cover no-repeat;
        }

        .login-right {
            flex: 1;
            padding: 3rem;
            background-color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-title {
            font-weight: bold;
        }

        .login-desc {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        @media (max-width: 992px) {
            .login-card {
                flex-direction: column;
                min-height: auto;
            }

            .login-left {
                display: none;
            }

            .login-right {
                padding: 2rem;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-card">

            <!-- Sisi kiri: gambar -->
            <div class="login-left d-none d-lg-block"></div>

            <!-- Sisi kanan: form login -->
            <div class="login-right">
                <h3 class="login-title text-center mb-2"><?= $title; ?></h3>
                <p class="login-desc">Silakan masukkan NIP dan password Anda untuk mengakses sistem bimbingan skripsi.</p>

                <!-- Flash Message -->
                <?= $this->session->flashdata('message'); ?>

                <!-- Form Error -->
                <?= validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>

                <!-- Form Login -->
                <form action="<?= base_url('auth/dosen'); ?>" method="post">
                    <div class="mb-3">
                        <label for="nip" class="form-label">NIP</label>
                        <input type="text" class="form-control" id="nip" name="nip" placeholder="Masukkan NIP Anda"
                            value="<?= set_value('nip'); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Masukkan password" required>
                    </div>
                    <div class="d-grid mt-3">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
