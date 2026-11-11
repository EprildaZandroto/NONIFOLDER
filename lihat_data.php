<?php
require_once 'helpers.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Tersimpan (data.txt)</title>
    <style>
        body { font-family: monospace; padding: 20px; background: #1e293b; color: #e2e8f0; }
        .container { max-width: 900px; margin: 0 auto; background: #0f172a; padding: 20px; border-radius: 8px; border: 1px solid #334155; }
        h2 { color: #f59e0b; border-bottom: 1px solid #334155; padding-bottom: 10px; }
        pre { white-space: pre-wrap; word-wrap: break-word; background: #020617; padding: 15px; border-radius: 4px; }
        .btn-back { display: inline-block; margin-top: 20px; padding: 10px 20px; background: #f59e0b; color: #0e2a47; text-decoration: none; font-weight: bold; border-radius: 5px; }
    </style>
</head>
<body>
<div class="container">
    <h2>📄 Isi File data.txt (Log Pendaftaran)</h2>
    <pre>
<?php
$file = 'data.txt';
if (file_exists($file)) {
    // Tampilkan isi file, baris terbaru di atas (array_reverse)
    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    echo e(implode("\n", array_reverse($lines)));
} else {
    echo "Belum ada data tersimpan.";
}
?>
    </pre>
    <a href="form.php" class="btn-back">⬅ Kembali ke Form</a>
</div>
</body>
</html>