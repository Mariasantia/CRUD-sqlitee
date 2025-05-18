<?php
// Menggunakan file koneksi
require 'koneksi.php';

// Mendapatkan ID dari parameter URL
$id = $_GET['id'] ?? 0;

// Jika form disubmit, lakukan update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $deskripsi = $_POST['deskripsi'] ?? '';
    $waktu = $_POST['waktu'] ?? 0;

    try {
        // SQL untuk memperbarui tugas
        $sql = 'UPDATE tugas SET deskripsi = :deskripsi, waktu = :waktu WHERE id = :id';
        $statement = $conn->prepare($sql);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->bindParam(':deskripsi', $deskripsi);
        $statement->bindParam(':waktu', $waktu, PDO::PARAM_INT);

        if ($statement->execute()) {
            // Redirect ke halaman tugas.php setelah update berhasil
            header("Location: tugas.php");
            exit();
        } else {
            echo "Gagal mengubah tugas!";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    // Ambil data tugas yang akan diubah
    $sql = 'SELECT id, deskripsi, waktu FROM tugas WHERE id = :id';
    $statement = $conn->prepare($sql);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $tugas = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$tugas) {
        echo "Tugas dengan ID $id tidak ditemukan.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ubah Tugas</title>
</head>
<body>
    <h2>Ubah Tugas</h2>
    <form method="POST">
        <label>Deskripsi:</label>
        <input type="text" name="deskripsi" value="<?php echo htmlspecialchars($tugas['deskripsi']); ?>" required><br>

        <label>Waktu (menit):</label>
        <input type="number" name="waktu" value="<?php echo htmlspecialchars($tugas['waktu']); ?>" required><br>

        <button type="submit">Update</button>
        <a href="tugas.php">Kembali</a>
    </form>
</body>
</html>
