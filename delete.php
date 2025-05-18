<?php
// Menggunakan file koneksi
require 'koneksi.php';

// Mendapatkan ID dari parameter URL
$id = $_GET['id'] ?? 0;

try {
    // SQL untuk menghapus tugas berdasarkan ID
    $sql = 'DELETE FROM tugas WHERE id = :id';
    $statement = $conn->prepare($sql);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);

    // Eksekusi dan cek keberhasilan
    if ($statement->execute()) {
        echo "Tugas dengan ID $id berhasil dihapus!";
        // Redirect ke halaman tugas.php setelah berhasil dihapus
        header("Location: tugas.php");
        exit();
    } else {
        echo "Gagal menghapus tugas dengan ID $id.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
