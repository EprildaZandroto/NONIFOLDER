<?php
// 1. Booting: Session & Helpers
session_start();
require_once 'helpers.php';

// 2. HANYA TERIMA REQUEST POST (Keamanan)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Jika diakses langsung via GET (ketik URL), tendang ke form
    redirectWith('form.php', 'warning', 'Akses tidak sah. Silakan isi form terlebih dahulu.');
}

// 3. AMBIL & BERSIHKAN INPUT (Sanitasi Awal)
$nama   = cleanInput($_POST['nama'] ?? '');
$nim    = cleanInput($_POST['nim'] ?? '');
$prodi  = cleanInput($_POST['prodi'] ?? '');
$gender = cleanInput($_POST['gender'] ?? '');
$hobi   = $_POST['hobi'] ?? []; // Array, tidak perlu cleanInput per item jika hanya disimpan/tampilkan kembali via e()

// 4. VALIDASI SERVER-SIDE (Wajib, meskipun ada required di HTML)
$errors = [];

if (empty($nama))   $errors[] = "Nama wajib diisi.";
if (empty($nim))    $errors[] = "NIM wajib diisi.";
if (empty($prodi))  $errors[] = "Program Studi wajib dipilih.";
if (empty($gender)) $errors[] = "Jenis Kelamin wajib dipilih.";
if (empty($hobi))   $errors[] = "Minimal pilih 1 Hobi.";

// Validasi Tambahan: NIM harus angka & panjang tertentu
if (!empty($nim) && !ctype_digit($nim)) {
    $errors[] = "NIM harus berupa angka.";
}

// 5. LOGIKA KEPUTUSAN: ERROR vs SUKSES
if (!empty($errors)) {
    // --- JIKA ADA ERROR ---
    // Gabungkan error jadi 1 string
    $msg = implode('<br>', $errors);
    // Redirect balik ke form.php DENGAN data error & old input
    redirectWith('form.php', 'danger', $msg, [
        'nama'   => $nama,
        'nim'    => $nim,
        'prodi'  => $prodi,
        'gender' => $gender,
        'hobi'   => $hobi
    ]);
} else {
    // --- JIKA SUKSES (VALID) ---
    
    // A. BONUS: Simpan ke File Teks (data.txt)
    saveToTextFile([
        'nim'   => $nim,
        'nama'  => $nama,
        'prodi' => $prodi,
        'gender'=> $gender,
        'hobi'  => $hobi
    ]);

    // B. Redirect ke form.php dengan pesan SUKSES
    // Data 'old' tidak dikirim (kosongkan) agar form bersih
    redirectWith('form.php', 'success', "Data mahasiswa <b>" . e($nama) . "</b> (NIM: " . e($nim) . ") berhasil disimpan!");
}
