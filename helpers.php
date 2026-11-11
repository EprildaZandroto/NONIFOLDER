<?php
/**
 * helpers.php
 * Kumpulan fungsi utilitas untuk digunakan di seluruh project.
 * Konsep: Modularisasi & Reusability (DRY - Don't Repeat Yourself)
 */

// ---------------------------------------------------------
// 1. KEAMANAN OUTPUT: Mencegah XSS (Cross-Site Scripting)
// ---------------------------------------------------------
function e($value) {
    // htmlspecialchars: Mengubah karakter khusus HTML jadi entitas aman
    // ENT_QUOTES: Mengkonversi baik kutip tunggal maupun ganda
    // UTF-8: Standar encoding modern
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

// ---------------------------------------------------------
// 2. VALIDASI INPUT: Membersihkan & Validasi Dasar
// ---------------------------------------------------------
function cleanInput($data) {
    $data = trim($data);        // Hapus spasi/enter di awal & akhir
    $data = stripslashes($data); // Hapus backslash (legacy magic quotes)
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8'); // Amankan HTML
    return $data;
}

// ---------------------------------------------------------
// 3. REDIRECT DENGAN FEEDBACK (PRG Pattern: Post-Redirect-Get)
// ---------------------------------------------------------
function redirectWith($url, $type, $message, $oldData = []) {
    // Simpan pesan & data lama ke SESSION agar tersedia setelah redirect
    session_start();
    $_SESSION['flash'] = [
        'type' => $type, // 'danger' | 'success' | 'warning'
        'message' => $message
    ];
    $_SESSION['old'] = $oldData; // Untuk mengisi ulang form (Sticky Form)
    
    header("Location: $url");
    exit; // PENTING: Hentikan eksekusi script setelah header()
}

// ---------------------------------------------------------
// 4. AMBIL FLASH MESSAGE (Hanya sekali tampil, lalu dihapus)
// ---------------------------------------------------------
function getFlash() {
    session_start();
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']); // Hapus supaya tidak muncul lagi saat refresh
        return $flash;
    }
    return null;
}

// ---------------------------------------------------------
// 5. AMBIL OLD INPUT (Untuk Sticky Form)
// ---------------------------------------------------------
function getOld($key, $default = '') {
    session_start();
    $old = $_SESSION['old'][$key] ?? $default;
    // Hapus old data setelah diambil agar tidak menempel permanen
    if (isset($_SESSION['old'][$key])) unset($_SESSION['old'][$key]);
    return $old;
}

// ---------------------------------------------------------
// 6. BONUS: SIMPAN KE FILE TEKS (data.txt)
// ---------------------------------------------------------
function saveToTextFile($data) {
    $file = 'data.txt';
    // Format: [TIMESTAMP] NIM | NAMA | PRODI | GENDER | HOBI
    $line = sprintf(
        "[%s] %s | %s | %s | %s | %s\n",
        date('Y-m-d H:i:s'),
        $data['nim'],
        $data['nama'],
        $data['prodi'],
        $data['gender'],
        implode(', ', $data['hobi'] ?? [])
    );
    
    // FILE_APPEND: Tambah di akhir file, jangan timpa
    // LOCK_EX: Kunci file saat menulis (mencegah korupsi data jika akses bersamaan)
    file_put_contents($file, $line, FILE_APPEND | LOCK_EX);
}