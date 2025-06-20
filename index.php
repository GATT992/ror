<?php
session_start();

// File untuk menyimpan sesi
$fileSesi = 'sesi_web.json';

// Generate ID unik pengunjung
function buatIdUnik() {
    return uniqid('user_', true);
}

// Cek apakah sudah ada sesi aktif
if (file_exists($fileSesi)) {
    $data = json_decode(file_get_contents($fileSesi), true);

    // Jika ID-nya bukan milik sesi sekarang → berarti ada orang lain yang sedang aktif
    if (!isset($_SESSION['pengunjung_id']) || $_SESSION['pengunjung_id'] !== $data['id']) {
        die('<h1>❌ Web sedang digunakan orang lain!</h1>');
    }
}

// Kalau belum ada sesi → buatkan sesi baru
if (!isset($_SESSION['pengunjung_id'])) {
    $_SESSION['pengunjung_id'] = buatIdUnik();
    file_put_contents($fileSesi, json_encode(['id' => $_SESSION['pengunjung_id'], 'waktu' => time()]));
}

echo "<h1>✅ Selamat datang, ID Anda:</h1>";
echo "<h2>" . $_SESSION['pengunjung_id'] . "</h2>";
echo "<a href='keluar.php'>Keluar dari Web</a>";
?>
