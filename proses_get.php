<?php
/**
 * proses_get.php
 * Berfungsi menangkap data yang dikirimkan melalui metode GET.
 * Variabel bawaan PHP: $_GET (Array Asosiatif)
 */

// 1. Ambil data dari array $_GET menggunakan key nama atribut 'name' di form HTML
// Gunakan Operator Null Coalescing (??) untuk menghindari warning jika data kosong
$keyword  = $_GET['keyword'] ?? '';
$nama    = $_GET['nama'] ?? '';
$kategori = $_GET['kategori'] ?? '';

// 2. Fungsi sanitasi sederhana agar aman dari XSS
function e($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Pencarian (GET) - Pemrograman Web 1</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f8fafc; color: #1e293b; padding: 40px 20px; }
        .box { max-width: 650px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; border-left: 5px solid #f59e0b; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        h2 { color: #0e2a47; margin-bottom: 15px; }
        .url-box { background: #1e293b; color: #f8fafc; padding: 12px; border-radius: 6px; font-family: monospace; font-size: 0.85rem; margin: 15px 0; word-break: break-all; }
        .data-list { margin: 15px 0; line-height: 1.8; }
        .btn-back { display: inline-block; margin-top: 15px; padding: 8px 16px; background: #0e2a47; color: white; text-decoration: none; border-radius: 4px; font-size: 0.85rem; }
    </style>
</head>
<body>

<div class="box">
    <h2>🔍 Hasil Tangkapan Data (Metode GET)</h2>
    
    <p>Data berhasil ditangkap melalui superglobal <code>$_GET</code>.</p>
    
    <!-- Penjelasan Edukasi tentang URL -->
    <div class="url-box">
        <strong>URL Asli Browser Saat Ini:</strong><br>
        http://<?= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>
    </div>

    <div class="data-list">
        <ul>
            <li><strong>Kata Kunci (keyword):</strong> <?= e($keyword); ?></li>
            <li><strong>Kata Kunci (nama lengkap):</strong> <?= e($nama); ?></li>
            <li><strong>Kategori Filter:</strong> <?= e($kategori); ?></li>
        </ul>
    </div>

    <p style="font-size: 0.85rem; color: #64748b; background: #fffbe6; padding: 10px; border-radius: 4px;">
        💡 <strong>Catatan Edukasi:</strong> Perhatikan bagian paling atas alamat browser Anda. Nilai yang Anda ketik muncul setelah tanda tanya (<code>?keyword=...&kategori=...</code>).
    </p>

    <a href="form.html" class="btn-back">⬅ Kembali ke Form</a>
</div>

</body>
</html>