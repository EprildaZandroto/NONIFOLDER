<?php
// 1. Mulai Session di paling atas (sebelum output HTML apapun)
session_start();

// 2. Sertakan library helper
require_once 'helpers.php';

// 3. Ambil data flash message & old input (jika ada redirect dari proses.php)
$flash = getFlash();
$oldNama   = getOld('nama');
$oldNim    = getOld('nim');
$oldProdi  = getOld('prodi');
$oldGender = getOld('gender');
$oldHobi   = getOld('hobi', []); // Default array kosong
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Biodata - Praktikum PHP 6</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f6f9; display: flex; justify-content: center; padding-top: 50px; margin: 0; }
        .card { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); width: 100%; max-width: 500px; }
        h2 { color: #0e2a47; margin-bottom: 20px; text-align: center; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: 600; color: #333; }
        input[type="text"], input[type="number"], select {
            width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box;
        }
        .radio-group, .checkbox-group { display: flex; gap: 15px; flex-wrap: wrap; }
        .radio-group label, .checkbox-group label { font-weight: normal; display: flex; align-items: center; gap: 5px; cursor: pointer; }
        button { width: 100%; padding: 12px; background: #0e2a47; color: white; border: none; border-radius: 5px; font-size: 1rem; font-weight: bold; cursor: pointer; transition: background 0.3s; }
        button:hover { background: #f59e0b; }
        
        /* Alert Styles */
        .alert { padding: 12px; border-radius: 5px; margin-bottom: 20px; font-size: 0.9rem; }
        .alert-danger { background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; }
        .alert-success { background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; }
        .is-invalid { border-color: #ef4444 !important; }
    </style>
</head>
<body>

<div class="card">
    <h2>📝 Form Biodata Mahasiswa</h2>

    <!-- MENAMPILKAN FLASH MESSAGE (Error/Success) -->
    <?php if ($flash): ?>
        <div class="alert alert-<?= e($flash['type']) ?>">
            <?= e($flash['message']) ?>
        </div>
    <?php endif; ?>

    <form action="proses.php" method="POST">
        <!-- CSRF Protection Sederhana (Optional tapi baik) -->
        <input type="hidden" name="csrf_token" value="<?= session_id() ?>">

        <!-- NAMA -->
        <div class="form-group">
            <label>Nama Lengkap <span style="color:red">*</span></label>
            <input type="text" name="nama" placeholder="Masukkan nama lengkap" 
                   value="<?= e($oldNama) ?>" 
                   class="<?= isset($flash) && $flash['type'] === 'danger' && empty($oldNama) ? 'is-invalid' : '' ?>" required>
        </div>

        <!-- NIM -->
        <div class="form-group">
            <label>NIM <span style="color:red">*</span></label>
            <input type="text" name="nim" placeholder="Contoh: 2023001" 
                   value="<?= e($oldNim) ?>" 
                   class="<?= isset($flash) && $flash['type'] === 'danger' && empty($oldNim) ? 'is-invalid' : '' ?>" required>
        </div>

        <!-- PRODI (SELECT) -->
        <div class="form-group">
            <label>Program Studi <span style="color:red">*</span></label>
            <select name="prodi" class="<?= isset($flash) && $flash['type'] === 'danger' && empty($oldProdi) ? 'is-invalid' : '' ?>" required>
                <option value="">-- Pilih Prodi --</option>
                <option value="Teknik Informatika" <?= ($oldProdi === 'Teknik Informatika') ? 'selected' : '' ?>>Teknik Informatika</option>
                <option value="Sistem Informasi" <?= ($oldProdi === 'Sistem Informasi') ? 'selected' : '' ?>>Sistem Informasi</option>
                <option value="Teknik Komputer" <?= ($oldProdi === 'Teknik Komputer') ? 'selected' : '' ?>>Teknik Komputer</option>
            </select>
        </div>

        <!-- JENIS KELAMIN (RADIO) -->
        <div class="form-group">
            <label>Jenis Kelamin <span style="color:red">*</span></label>
            <div class="radio-group">
                <label><input type="radio" name="gender" value="Laki-laki" <?= ($oldGender === 'Laki-laki') ? 'checked' : '' ?>> Laki-laki</label>
                <label><input type="radio" name="gender" value="Perempuan" <?= ($oldGender === 'Perempuan') ? 'checked' : '' ?>> Perempuan</label>
            </div>
        </div>

        <!-- HOBI (CHECKBOX MULTIPLE) -->
        <div class="form-group">
            <label>Hobi (Boleh pilih multiple) <span style="color:red">*</span></label>
            <div class="checkbox-group">
                <label><input type="checkbox" name="hobi[]" value="Coding" <?= in_array('Coding', $oldHobi) ? 'checked' : '' ?>> Coding</label>
                <label><input type="checkbox" name="hobi[]" value="Desain" <?= in_array('Desain', $oldHobi) ? 'checked' : '' ?>> Desain</label>
                <label><input type="checkbox" name="hobi[]" value="Jaringan" <?= in_array('Jaringan', $oldHobi) ? 'checked' : '' ?>> Jaringan</label>
                <label><input type="checkbox" name="hobi[]" value="Gaming" <?= in_array('Gaming', $oldHobi) ? 'checked' : '' ?>> Gaming</label>
            </div>
        </div>

        <button type="submit">Simpan Data</button>
    </form>
</div>

</body>
</html>