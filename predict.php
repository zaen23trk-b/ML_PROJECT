<?php
$label = null;
$prob_attack = 0;
$prob_normal = 0;
$input = [];

// ===============================
// CEK APAKAH DATA DITERIMA VIA POST
// ===============================
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // ===============================
    // 4 FITUR UTAMA MODEL
    // ===============================
    $features = [
        "network_packet_size",
        "login_attempts",
        "session_duration",
        "ip_reputation_score"
    ];

    // ===============================
    // AMBIL INPUT DARI POST
    // ===============================
    foreach ($features as $f) {
        $input[$f] = isset($_POST[$f]) ? floatval($_POST[$f]) : 0;
    }

    // ===============================
    // RULE-BASED NORMAL TRAFFIC
    // ===============================
    $normal_rule = (
        $input["ip_reputation_score"] >= 0.9 &&
        $input["login_attempts"] <= 2 &&
        $input["session_duration"] <= 3600 &&
        $input["network_packet_size"] <= 1500
    );

    if ($normal_rule) {
        $label = "Normal";
        $prob_normal = 95;
        $prob_attack = 5;
    } else {
        // ===============================
        // KIRIM KE PYTHON UNTUK PREDIKSI ML
        // ===============================
        $json = json_encode($input);

        $process = proc_open(
            "python predict.py",
            [
                0 => ["pipe", "r"],
                1 => ["pipe", "w"],
                2 => ["pipe", "w"]
            ],
            $pipes
        );

        fwrite($pipes[0], $json);
        fclose($pipes[0]);

        $output = stream_get_contents($pipes[1]);
        fclose($pipes[1]);

        $error = stream_get_contents($pipes[2]);
        fclose($pipes[2]);

        proc_close($process);

        $result = json_decode(trim($output), true);

        // DEFAULT JIKA PYTHON ERROR
        $label = "Attack";
        $prob_attack = 100;
        $prob_normal = 0;

        if (is_array($result)) {
            $label = $result["label"] ?? (($result["prediction"] ?? 1) == 1 ? "Attack" : "Normal");
            $prob_attack = isset($result["prob_attack"]) ? round($result["prob_attack"] * 100, 2) : 0;
            $prob_normal = isset($result["prob_normal"]) ? round($result["prob_normal"] * 100, 2) : 100;
        }
    }
}

// ===============================
// ALERT CLASS
// ===============================
$alert_class = ($label === "Attack") ? "alert-danger" : "alert-success";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Prediksi Trafik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #0f172a;
            color: #e5e7eb;
            min-height: 100vh;
        }
        .card {
            background: #020617;
            border-radius: 16px;
            border: 1px solid #1e293b;
        }
        .alert {
            border-radius: 12px;
            font-size: 1.2rem;
        }
        table td, table th {
            color: #e5e7eb;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center py-5">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card p-4 shadow-lg">

                <h2 class="text-center mb-4">Hasil Prediksi Trafik Jaringan</h2>

                <?php if ($label): ?>
                    <div class="alert <?= $alert_class ?> text-center">
                        <h3><?= htmlspecialchars($label) ?></h3>
                        <p>
                            Attack: <?= $prob_attack ?>% |
                            Normal: <?= $prob_normal ?>%
                        </p>
                    </div>

                    <h5 class="mt-4">Input Vector</h5>
                    <table class="table table-borderless mt-2">
                        <tbody>
                        <?php foreach ($input as $k => $v): ?>
                            <tr>
                                <th><?= htmlspecialchars($k) ?></th>
                                <td><?= htmlspecialchars($v) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-center text-warning">Tidak ada data yang diproses.</p>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

</body>
</html>
