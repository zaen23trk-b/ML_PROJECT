<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Network Intrusion Detection</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { 
            background: radial-gradient(circle at top, #0f172a, #020617); 
            color: #e5e7eb; 
            min-height: 100vh; 
        }
        .card { 
            background: #020617; 
            border-radius: 16px; 
            border: 1px solid #1e293b; 
        }
        label { font-weight: 500; }
        .form-control, .form-select { 
            background-color: #020617; 
            border: 1px solid #334155; 
            color: #e5e7eb; 
        }
        .form-control:focus, .form-select:focus {
            background-color: #020617;
            border-color: #38bdf8;
            box-shadow: none;
            color: #fff;
        }
        .btn-primary {
            background: linear-gradient(135deg, #38bdf8, #2563eb); 
            border-radius: 12px; 
            border: none;
        }
        .btn-primary:hover { opacity: 0.9; }
    </style>
</head>
<body class="d-flex align-items-center">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card p-4 shadow-lg">

                <div class="text-center mb-4">
                    <i class="bi bi-shield-lock-fill fs-1 text-info"></i>
                    <h2 class="fw-bold mt-2">Network Intrusion Detection System</h2>
                    <p class="text-secondary">Decision Tree–based Cyber Attack Prediction</p>
                </div>

                <form method="POST" action="predict.php">

                    <!-- SESSION INFO -->
                    <div class="mb-4">
                        <div class="fw-bold text-secondary mb-2">Session Information</div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label>Packet Size</label>
                                <input type="number" class="form-control" name="network_packet_size" value="200" required>
                            </div>
                            <div class="col-md-4">
                                <label>Session Duration (sec)</label>
                                <input type="number" class="form-control" name="session_duration" value="600" required>
                            </div>
                            <div class="col-md-4">
                                <label>Unusual Time Access</label>
                                <select class="form-select" name="unusual_time_access">
                                    <option value="0" selected>No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- AUTH -->
                    <div class="mb-4">
                        <div class="fw-bold text-secondary mb-2">Authentication Activity</div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label>Login Attempts</label>
                                <input type="number" class="form-control" name="login_attempts" value="1" required>
                            </div>
                            <div class="col-md-4">
                                <label>Failed Logins</label>
                                <input type="number" class="form-control" name="failed_logins" value="0" required>
                            </div>
                            <div class="col-md-4">
                                <label>IP Reputation Score (0–1)</label>
                                <input type="number" step="0.01" class="form-control" name="ip_reputation_score" value="0.95" required>
                            </div>
                        </div>
                    </div>

                    <!-- NETWORK -->
                    <div class="mb-4">
                        <div class="fw-bold text-secondary mb-2">Network Configuration</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label>Protocol</label>
                                <select class="form-select" name="protocol">
                                    <option value="TCP" selected>TCP</option>
                                    <option value="UDP">UDP</option>
                                    <option value="ICMP">ICMP</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Encryption</label>
                                <select class="form-select" name="encryption">
                                    <option value="DES">DES</option>
                                    <option value="AES">AES</option>
                                    <option value="Unknown" selected>Unknown</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- CLIENT -->
                    <div class="mb-4">
                        <div class="fw-bold text-secondary mb-2">Client Environment</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label>Browser</label>
                                <select class="form-select" name="browser">
                                    <option value="Edge">Edge</option>
                                    <option value="Firefox" selected>Firefox</option>
                                    <option value="Safari">Safari</option>
                                    <option value="Chrome">Chrome</option>
                                    <option value="Unknown">Unknown</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg px-5">
                            <i class="bi bi-search"></i> Analyze Traffic
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

</body>
</html>
