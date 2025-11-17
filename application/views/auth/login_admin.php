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
        .login-wrapper {
            height: 100vh;
        }
        .login-image {
            background-image: url("<?= base_url('assets/bg.jpg'); ?>");
            background-size: cover;
            background-position: center;
            border-radius: 0 1rem 1rem 0;
        }
        .login-card {
            padding: 2.5rem;
            border-radius: 1rem;
            min-height: 470px; /* ✔ lebih tinggi */
            display: flex;
            flex-direction: column;
            justify-content: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background: #fff;
        }
        @media (max-width: 992px) {
            .login-image {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container login-wrapper d-flex align-items-center justify-content-center">
        <div class="row w-100 shadow rounded overflow-hidden" style="max-width: 900px;">

            <!-- LEFT IMAGE -->
            <div class="col-lg-6 login-image"></div>

            <!-- RIGHT LOGIN FORM -->
            <div class="col-lg-6 p-4 bg-white">
                <div class="login-card">

                    <h3 class="text-center mb-2"><?= $title; ?></h3>
                    <p class="text-center text-muted mb-4">Silakan login terlebih dahulu</p> <!-- ✔ tambahan -->

                    <!-- Flash Message -->
                    <?= $this->session->flashdata('message'); ?>

                    <!-- Form Error -->
                    <?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>

                    <!-- Form Login -->
                    <form action="<?= base_url('auth'); ?>" method="post">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control"
                                   placeholder="Masukkan username"
                                   value="<?= set_value('username'); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control"
                                   placeholder="Masukkan password" required>
                        </div>

                        <div class="d-grid mt-3">
                            <button class="btn btn-primary" type="submit">Login</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
