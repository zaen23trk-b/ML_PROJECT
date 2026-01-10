<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>NetSecure IDS | Machine Learning</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- AOS ANIMATION -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        body{
            background:radial-gradient(circle at top,#0f172a,#020617);
            color:#e5e7eb;
        }
        .card{
            background:#020617;
            border-radius:16px;
            border:1px solid #1e293b;
            transition:all .4s ease;
        }
        .card:hover{
            transform:translateY(-6px) scale(1.01);
            box-shadow:0 0 25px rgba(56,189,248,.25);
        }
        .section-title{
            color:#38bdf8;
            font-weight:700;
        }
        .section-title::after{
            content:"";
            display:block;
            width:80px;
            height:3px;
            background:linear-gradient(90deg,#38bdf8,#2563eb);
            margin-top:8px;
        }
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
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="index.php">
            <i class="bi bi-shield-lock-fill text-info fs-4"></i>
            NetSecure IDS
        </a>
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav gap-2">
                <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="Prediksi.php">Prediksi</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- HERO -->
<header class="container text-center py-5" data-aos="fade-down">
    <h1 class="fw-bold">Network Intrusion Detection System</h1>
    <p class="text-secondary">
        Sistem Deteksi Serangan Jaringan Berbasis Machine Learning (Decision Tree)
    </p>
    <a href="Prediksi.php" class="btn btn-primary btn-lg mt-3">
        <i class="bi bi-search"></i> Coba Prediksi
    </a>
</header>

<!-- DESKRIPSI WEBSITE -->
<section class="container my-5" data-aos="fade-up">
    <div class="card p-4">
        <h3 class="section-title">Deskripsi Website</h3>
        <p class="text-secondary">
            Website ini merupakan implementasi <strong>Network Intrusion Detection System (IDS)</strong>
            berbasis <strong>Machine Learning</strong> yang bertujuan untuk mendeteksi aktivitas
            <em>normal</em> dan <em>serangan (attack)</em> pada jaringan komputer.
            Sistem ini memanfaatkan model <strong>Decision Tree</strong> yang telah dilatih
            menggunakan dataset keamanan jaringan dan dideploy ke dalam aplikasi web.
        </p>
    </div>
</section>

<!-- TUJUAN & MANFAAT -->
<section class="container my-5" data-aos="fade-right">
    <div class="card p-4">
        <h3 class="section-title">Tujuan dan Manfaat</h3>
        <ul class="text-secondary">
            <li>Mengimplementasikan Machine Learning dalam sistem keamanan jaringan</li>
            <li>Mendeteksi potensi serangan secara otomatis dan cepat</li>
            <li>Membantu administrator jaringan dalam pengambilan keputusan</li>
            <li>Menjadi media pembelajaran penerapan ML ke dalam website</li>
        </ul>
    </div>
</section>

<!-- DATASET -->
<section class="container my-5" data-aos="fade-left">
    <div class="card p-4">
        <h3 class="section-title">Dataset yang Digunakan</h3>

        <p class="text-secondary">
            Dataset yang digunakan adalah <strong>Cybersecurity Intrusion Dataset</strong>
            yang berisi data aktivitas jaringan dengan label
            <em>normal</em> dan <em>attack</em>.
        </p>

        <h6 class="fw-semibold">Contoh Kolom Dataset:</h6>
        <ul class="text-secondary">
            <li>network_packet_size</li>
            <li>session_duration</li>
            <li>login_attempts</li>
            <li>ip_reputation_score</li>
            <li>protocol_type</li>
            <li>browser_type</li>
            <li>encryption_used</li>
            <li>attack_detected (label)</li>
        </ul>

        <p class="text-secondary">
            Pada tahap deployment web, sistem menggunakan
            <strong>4 fitur utama</strong> yaitu:
            network_packet_size, session_duration, login_attempts,
            dan ip_reputation_score, karena bersifat numerik dan
            paling relevan untuk prediksi cepat.
        </p>
    </div>
</section>

<!-- TAHAPAN ML -->
<section class="container my-5" data-aos="zoom-in">
    <div class="card p-4">
        <h3 class="section-title">Tahapan Machine Learning</h3>
        <ol class="text-secondary">
            <li><strong>ETL (Extract, Transform, Load)</strong> – pengambilan dan pembersihan data</li>
            <li><strong>EDA (Exploratory Data Analysis)</strong> – analisis distribusi dan korelasi data</li>
            <li><strong>Feature Engineering</strong> – encoding dan seleksi fitur</li>
            <li><strong>Training Model</strong> – pelatihan Decision Tree</li>
            <li><strong>Evaluation</strong> – accuracy, precision, recall, confusion matrix</li>
            <li><strong>Deployment</strong> – integrasi model ke website</li>
        </ol>
    </div>
</section>

<!-- MODEL ML -->
<section class="container my-5" data-aos="flip-up">
    <div class="card p-4">
        <h3 class="section-title">Model Machine Learning</h3>
        <p class="text-secondary">
            Model yang digunakan adalah <strong>Decision Tree Classifier</strong>.
            Algoritma ini dipilih karena mampu menghasilkan aturan keputusan
            yang mudah dipahami dan efektif dalam klasifikasi intrusion.
        </p>

        <ul class="text-secondary">
            <li>Data Training: ±80%</li>
            <li>Data Testing: ±20%</li>
            <li>Kriteria: Gini Index</li>
            <li>Evaluasi: Accuracy, Precision, Recall</li>
        </ul>

        <p class="text-secondary">
            Hasil evaluasi menunjukkan model memiliki performa yang baik
            dalam membedakan trafik normal dan serangan jaringan.
        </p>
    </div>
</section>

<!-- TEAM -->
<section class="container my-5" data-aos="fade-up">
    <div class="card p-4 text-center">
        <h3 class="section-title">Anggota Tim</h3>
        <ul class="list-unstyled text-secondary">
            <li>Zaen Zidan Al Khalis</li>
            <li>Annisa Mutiara Andita</li>
            <li>Roberto Carlos Simangunsong</li>
        </ul>
    </div>
</section>

<!-- CTA -->
<section class="container text-center my-5" data-aos="zoom-in">
    <a href="Prediksi.php" class="btn btn-primary btn-lg px-5">
        <i class="bi bi-graph-up"></i> Menu Prediksi
    </a>
</section>

<!-- FOOTER -->
<footer class="border-top border-secondary text-center py-4">
    <small class="text-secondary">
        © <?= date('Y'); ?> NetSecure IDS • Machine Learning Project
    </small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
AOS.init({
    duration: 1000,
    once: true,
    easing: 'ease-in-out'
});
</script>
</body>
</html>
