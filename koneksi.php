<?php
try {
    // Koneksi ke database SQLite
    $conn = new PDO("sqlite:./database.db");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error Koneksi: " . $e->getMessage();
    exit();
}
?>
