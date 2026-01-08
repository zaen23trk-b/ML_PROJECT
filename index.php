<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Network Intrusion Detection</title>

    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- BOOTSTRAP ICONS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- CUSTOM CSS -->
    <style>
        body{
            background:radial-gradient(circle at top,#0f172a,#020617);
            color:#e5e7eb;
            min-height:100vh;
        }
        .card{
            background:#020617;
            border-radius:16px;
            border:1px solid #1e293b;
        }
        label{font-weight:500}
        .form-control,.form-select{
            background:#020617;
            border:1px solid #334155;
            color:#e5e7eb;
        }
        .form-control:focus,.form-select:focus{
            background:#020617;
            border-color:#38bdf8;
            box-shadow:none;
            color:#fff;
        }
        .btn-primary{
            background:linear-gradient(135deg,#38bdf8,#2563eb);
            border-radius:12px;
            border:none;
        }
        .btn-primary:hover{opacity:.9}
        .navbar{
            background:rgba(2,6,23,.85);
            backdrop-filter:blur(6px);
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark border-bottom border-secondary">
    <div class="container">
        <!-- BRAND -->
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="index.php">
            <i class="bi bi-shield-lock-fill text-info fs-4"></i>
            NetSecure IDS
        </a>

        <!-- TOGGLER -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- MENU -->
        <div class="collapse navbar-collapse justify-content-end" id="mainNavbar">
            <ul class="navbar-nav mb-2 mb-lg-0 gap-lg-2">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">
                        <i class="bi bi-house-door"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Prediksi.php">
                        <i class="bi bi-graph-up-arrow"></i> Prediksi
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- HEADER TITLE -->
<header class="container text-center my-5">
    <h1 class="fw-bold">Network Intrusion Detection System</h1>
    <p class="text-secondary">Decision Tree–based Cyber Attack Prediction</p>
</header>

<!-- DESKRIPSI SISTEM -->
<section class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card p-4 p-md-5">
                <h3 class="fw-bold text-info mb-3 text-center">
                    Tentang Sistem
                </h3>

                <p class="text-secondary" style="text-align: justify;">
                    Proyek ini bertujuan untuk membangun sebuah
                    <strong>Network Intrusion Detection System (IDS)</strong>
                    berbasis <strong>machine learning</strong> dengan
                    menggunakan algoritma <strong>Decision Tree Classifier</strong>.
                    Sistem ini dirancang untuk menganalisis log aktivitas
                    keamanan jaringan dan mengklasifikasikan setiap aktivitas
                    apakah termasuk aktivitas <em>normal</em> atau
                    <em>serangan (attack)</em>.
                </p>

                <p class="text-secondary" style="text-align: justify;">
                    Dengan memanfaatkan pola yang diperoleh dari data historis,
                    model yang dibangun diharapkan mampu membantu administrator
                    keamanan jaringan dalam mengenali aktivitas mencurigakan
                    secara lebih cepat, akurat, dan otomatis. Hal ini dapat
                    mendukung proses mitigasi ancaman, mencegah penyalahgunaan
                    akses, serta meningkatkan tingkat keamanan jaringan
                    secara keseluruhan.
                </p>

                <hr class="border-secondary my-4">

                <h5 class="fw-semibold text-center mb-3">
                    Kelompok Pengembang
                </h5>

                <ul class="list-unstyled text-center text-secondary">
                    <li>Zaen Zidan Al Khalis</li>
                    <li>Annisa Mutiara Andita</li>
                    <li>Roberto Carlos Simangunsong</li>
                </ul>
            </div>
        </div>
    </div>
</section>



<!-- FOOTER -->
<footer class="mt-auto border-top border-secondary" style="background:#020617">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <div class="fw-semibold">
                    <i class="bi bi-shield-lock-fill text-info"></i>
                    Network Intrusion Detection System
                </div>
                <small class="text-secondary">
                    Decision Tree–based Cyber Attack Prediction
                </small>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <small class="text-secondary">
                    © <?php echo date('Y'); ?> ML Project • All Rights Reserved
                </small>
            </div>
        </div>
    </div>
</footer>

<!-- BOOTSTRAP JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

