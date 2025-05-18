<?php
// Asumsikan koneksi $conn sudah dibuat sebelumnya

// Ambil semua tugas
$sql = 'SELECT id, deskripsi, waktu FROM tugas';
$statement = $conn->query($sql);
$tugas_list = $statement->fetchAll(PDO::FETCH_ASSOC);

if ($tugas_list) {
    foreach ($tugas_list as $t) {
        echo $t['deskripsi'] . '<br>';
    }
}

echo "<hr>";

// Ambil tugas berdasarkan id
$id = 1;
$sql = 'SELECT id, deskripsi, waktu FROM tugas WHERE id = :tugas_id';
$statement = $conn->prepare($sql);
$statement->bindParam(':tugas_id', $id, PDO::PARAM_INT);
$statement->execute();
$tugas = $statement->fetch(PDO::FETCH_ASSOC);

if ($tugas) {
    echo $tugas['id'] . '. ' . $tugas['deskripsi'];
} else {
    echo "Tugas dengan id $id tidak ditemukan.";
}
?>

