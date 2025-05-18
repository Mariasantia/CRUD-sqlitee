<?php
try {
    // Buat koneksi ke database SQLite
    $conn = new PDO("sqlite:./database.db");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Jika ada data yang dikirim melalui metode POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $deskripsi = $_POST['deskripsi'] ?? 'Tidur siang';
        $waktu = $_POST['waktu'] ?? 90;

        // SQL untuk menambahkan data ke tabel 'tugas'
        $sql = 'INSERT INTO tugas (deskripsi, waktu) VALUES (:deskripsi, :waktu)';

        // Mempersiapkan statement
        $statement = $conn->prepare($sql);

        // Mengeksekusi statement dengan data yang aman
        $statement->execute([
            ':deskripsi' => $deskripsi,
            ':waktu' => $waktu,
        ]);

        // Mendapatkan ID tugas yang baru ditambahkan
        $tugas_id = $conn->lastInsertId();

        // Memberikan notifikasi jika berhasil
        echo "Data berhasil ditambahkan dengan ID: " . $tugas_id;

        // Redirect ke halaman tugas.php
        header("Location: tugas.php");
        exit();
    }
} catch (PDOException $e) {
    // Menampilkan pesan jika terjadi error
    echo "Error: " . $e->getMessage();
} finally {
    // Menutup koneksi
    $conn = null;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Tugas</title>
</head>
<body>
    <h2>Tambah Tugas Baru</h2>
    <form method="POST" action="create.php">
        <label>Deskripsi:</label>
        <input type="text" name="deskripsi" placeholder="Masukkan deskripsi" required><br>

        <label>Waktu (menit):</label>
        <input type="number" name="waktu" placeholder="Durasi tugas" required><br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
