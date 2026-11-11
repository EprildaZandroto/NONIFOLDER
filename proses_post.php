<?php
/**
 * proses_post.php
 * Berfungsi menangkap data yang dikirimkan melalui metode POST.
 * Variabel bawaan PHP: $_POST (Array Asosiatif)
 */

// 1. Cek apakah halaman ini diakses via metode POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Jika diakses langsung via URL (GET), kembalikan ke form
    header('Location: form.html');
    exit;
}

// 2. Ambil data dari superglobal $_POST
$nama   = $_POST['nama'] ?? '';
$nim    = $_POST['nim'] ?? '';
$email  = $_POST['email'] ?? '';
$prodi  = $_POST['prodi'] ?? '';
$gender = $_POST['gender'] ?? '';
$hobi   = $_POST['hobi'] ?? []; // Hobi berbentuk Array karena checkbox multiple

// 3. Fungsi sanitasi output
function e($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Pendaftaran (POST) - Pemrograman Web 1</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f8fafc; color: #1e293b; padding: 40px 20px; }
        .box { max-width: 650px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; border-left: 5px solid #0e2a47; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        h2 { color: #0e2a47; margin-bottom: 15px; }
        .url-box { background: #f1f5f9; color: #0e2a47; padding: 12px; border-radius: 6px; font-family: monospace; font-size: 0.85rem; margin: 15px 0; border: 1px solid #cbd5e1; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 10px 12px; border-bottom: 1px solid #e2e8f0; text-align: left; font-size: 0.9rem; }
        th { background-color: #f1f5f9; color: #0e2a47; width: 35%; }
        .btn-back { display: inline-block; margin-top: 15px; padding: 8px 16px; background: #0e2a47; color: white; text-decoration: none; border-radius: 4px; font-size: 0.85rem; }
    </style>
</head>
<body>

<div class="box">
    <h2>✅ Hasil Tangkapan Data (Metode POST)</h2>
    
    <p>Data berhasil diterima oleh server menggunakan superglobal <code>$_POST</code>.</p>

    <!-- Penjelasan Edukasi tentang URL -->
    <div class="url-box">
        <strong>URL Browser Saat Ini:</strong><br>
        http://<?= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>
    </div>

    <table>
        <tr>
            <th>Nama Lengkap</th>
            <td><?= e($nama); ?></td>
        </tr>
        <tr>
            <th>NIM</th>
            <td><?= e($nim); ?></td>
        </tr>
        <tr>
            <th>Alamat Email</th>
            <td><?= e($email); ?></td>
        </tr>
        <tr>
            <th>Program Studi</th>
            <td><?= e($prodi); ?></td>
        </tr>
        <tr>
            <th>Jenis Kelamin</th>
            <td><?= e($gender); ?></td>
        </tr>
        <tr>
            <th>Minat / Hobi</th>
            <td>
                <?php 
                if (!empty($hobi)) {
                    // Gabungkan isi array hobi dengan koma
                    $hobi_clean = array_map('e', $hobi);
                    echo implode(', ', $hobi_clean);
                } else {
                    echo '<em>Tidak memilih hobi</em>';
                }
                ?>
            </td>
        </tr>
    </table>

    <p style="font-size: 0.85rem; color: #1e3a5a; background: #e0f2fe; padding: 10px; border-radius: 4px;">
        💡 <strong>Catatan Edukasi:</strong> Perhatikan alamat URL browser di atas! Data seperti Nama, NIM, dan Email <strong>TIDAK MUNCUL</strong> di URL karena dikirimkan di dalam HTTP Body secara aman.
    </p>

    <a href="form.html" class="btn-back">⬅ Kembali ke Form</a>
</div>

</body>
</html>