<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Network Intrusion Detection - 4 Fitur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: radial-gradient(circle at top,#0f172a,#020617);
            color: #e5e7eb;
            min-height: 100vh;
        }
        .card {
            background: #020617;
            border-radius: 16px;
            border: 1px solid #1e293b;
        }
        label { font-weight: 500 }
        .form-control { background: #020617; border: 1px solid #334155; color: #e5e7eb; }
        .form-control:focus { border-color: #38bdf8; box-shadow: none; color: #fff; }
        .btn-primary { background: linear-gradient(135deg,#38bdf8,#2563eb); border-radius: 12px; border: none; }
        .btn-primary:hover { opacity: .9 }
        .navbar { background: rgba(2,6,23,.85); backdrop-filter: blur(6px); }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark border-bottom border-secondary">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="index.php">
            <i class="bi bi-shield-lock-fill text-info fs-4"></i> NetSecure IDS
        </a>
    </div>
</nav>

<!-- HEADER -->
<header class="container text-center my-5">
    <h1 class="fw-bold">Network Intrusion Detection System</h1>
    <p class="text-secondary">Decision Tree–based Cyber Attack Prediction (4 Fitur)</p>
</header>

<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card p-4 shadow-lg">
                <form method="POST" action="predict.php">

                    <!-- 4 FITUR -->
                    <div class="mb-3">
                        <label class="form-label">Packet Size</label>
                        <input type="number" class="form-control" name="network_packet_size" value="200" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Session Duration (sec)</label>
                        <input type="number" class="form-control" name="session_duration" value="600" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Login Attempts</label>
                        <input type="number" class="form-control" name="login_attempts" value="1" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">IP Reputation Score (0–1)</label>
                        <input type="number" step="0.01" class="form-control" name="ip_reputation_score" value="0.95" required>
                    </div>

                    <div class="text-center pt-2">
                        <button type="submit" class="btn btn-primary btn-lg px-5">
                            <i class="bi bi-search"></i> Analyze Traffic
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- FOOTER -->
<footer class="mt-auto border-top border-secondary" style="background:#020617">
    <div class="container py-4 text-center text-secondary">
        © <?php echo date('Y'); ?> ML Project • All Rights Reserved
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
