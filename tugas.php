<?php
// Menggunakan file koneksi
require 'koneksi.php';

$sql = 'SELECT id, deskripsi, waktu FROM tugas';
$statement = $conn->query($sql);
$tugas = $statement->fetchAll(PDO::FETCH_ASSOC);

echo "<h2>Daftar Tugas</h2>";
if ($tugas) {
    foreach ($tugas as $t) {
        echo "<a href='detail.php?id={$t['id']}'>{$t['deskripsi']}</a> - Waktu: {$t['waktu']} menit<br>";
    }
} else {
    echo "Tidak ada tugas yang tersedia.";
}
?>
