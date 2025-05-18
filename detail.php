<?php
// Menggunakan file koneksi
require 'koneksi.php';

$id = $_GET['id'] ?? 0;
$sql = 'SELECT id, deskripsi, waktu FROM tugas WHERE id = :tugas_id';
$statement = $conn->prepare($sql);
$statement->bindParam(':tugas_id', $id, PDO::PARAM_INT);
$statement->execute();
$tugas = $statement->fetch(PDO::FETCH_ASSOC);

echo "<h2>Detail Tugas</h2>";
if ($tugas) {
    echo "ID: {$tugas['id']}<br>";
    echo "Deskripsi: {$tugas['deskripsi']}<br>";
    echo "Waktu: {$tugas['waktu']} menit<br>";
} else {
    echo "Tugas dengan ID $id tidak ditemukan.";
}
?>
