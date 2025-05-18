<?php
// Menggunakan file koneksi
require 'koneksi.php';

$sql = 'SELECT id, deskripsi, waktu FROM tugas';
$statement = $conn->query($sql);
$tugas = $statement->fetchAll(PDO::FETCH_ASSOC);

echo "<h2>Daftar Tugas</h2>";
if ($tugas) {
    foreach ($tugas as $t) {
        echo "<p>";
        echo "<a href='detail.php?id={$t['id']}'>{$t['deskripsi']}</a> - Waktu: {$t['waktu']} menit ";
        echo "<a href='update.php?id={$t['id']}' style='color: blue;'>[Edit]</a> ";
        echo "<a href='delete.php?id={$t['id']}' onclick='return confirm(\"Yakin ingin menghapus tugas ini?\")' style='color: red;'>[Hapus]</a>";
        echo "</p>";
    }
} else {
    echo "Tidak ada tugas yang tersedia.";
}
?>

