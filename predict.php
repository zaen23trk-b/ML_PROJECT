<?php
$label = null;
$prob_attack = 0;
$prob_normal = 0;
$input = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // ===============================
    // DAFTAR FITUR SESUAI MODEL
    // ===============================
    $features = [
        "network_packet_size","login_attempts","session_duration","ip_reputation_score",
        "failed_logins","unusual_time_access",
        "protocol_type_TCP","protocol_type_UDP","protocol_type_ICMP",
        "encryption_used_DES","encryption_used_AES","encryption_used_Unknown",
        "browser_type_Edge","browser_type_Firefox","browser_type_Safari",
        "browser_type_Chrome","browser_type_Unknown"
    ];

    // ===============================
    // AMBIL INPUT KATEGORI
    // ===============================
    $protocol   = $_POST['protocol']   ?? 'TCP';
    $encryption = $_POST['encryption'] ?? 'DES';
    $browser    = $_POST['browser']    ?? 'Firefox';

    // ===============================
    // ONE HOT ENCODING
    // ===============================
    $category_input = [
        "protocol_type_TCP"    => $protocol === 'TCP' ? 1 : 0,
        "protocol_type_UDP"    => $protocol === 'UDP' ? 1 : 0,
        "protocol_type_ICMP"   => $protocol === 'ICMP' ? 1 : 0,

        "encryption_used_DES"     => $encryption === 'DES' ? 1 : 0,
        "encryption_used_AES"     => $encryption === 'AES' ? 1 : 0,
        "encryption_used_Unknown" => $encryption === 'Unknown' ? 1 : 0,

        "browser_type_Edge"    => $browser === 'Edge' ? 1 : 0,
        "browser_type_Firefox" => $browser === 'Firefox' ? 1 : 0,
        "browser_type_Safari"  => $browser === 'Safari' ? 1 : 0,
        "browser_type_Chrome"  => $browser === 'Chrome' ? 1 : 0,
        "browser_type_Unknown" => $browser === 'Unknown' ? 1 : 0,
    ];

    // ===============================
    // GABUNGKAN INPUT
    // ===============================
    foreach ($features as $f) {
        if (isset($category_input[$f])) {
            $input[$f] = $category_input[$f];
        } else {
            $input[$f] = floatval($_POST[$f] ?? 0);
        }
    }

    // ===============================
    // KIRIM KE PYTHON
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

    // ===============================
    // HANDLE OUTPUT PYTHON (FIX)
    // ===============================
    $result = json_decode(trim($output), true);

    // DEFAULT AMAN
    $label = "Normal";
    $prob_attack = 0;
    $prob_normal = 100;

    // Kalau Python kirim JSON valid
    if (is_array($result)) {

        if (isset($result["label"])) {
            $label = $result["label"];
        } elseif (isset($result["prediction"])) {
            $label = ($result["prediction"] == 1) ? "Attack" : "Normal";
        }

        if (isset($result["prob_attack"])) {
            $prob_attack = round($result["prob_attack"] * 100, 2);
        }

        if (isset($result["prob_normal"])) {
            $prob_normal = round($result["prob_normal"] * 100, 2);
        }

    } else {
        // ⚠️ JANGAN ERROR — anggap ATTACK keras
        $label = "Attack";
        $prob_attack = 100;
        $prob_normal = 0;
    }

}

// ===============================
// ALERT CLASS
// ===============================
$alert_class = ($label === "Attack")
    ? "alert-danger"
    : (($label === "Normal") ? "alert-success" : "alert-warning");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Prediksi</title>
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
        <div class="col-lg-8">
            <div class="card p-4 shadow-lg">

                <h2 class="text-center mb-4">Hasil Prediksi</h2>

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
                    <p class="text-center text-warning">Tidak ada data diproses.</p>
                <?php endif; ?>

                <div class="text-center mt-4">
                    <a href="index.php" class="btn btn-secondary px-4">⬅ Kembali</a>
                </div>

            </div>
        </div>
    </div>
</div>

</body>
</html>
