<?php
require 'koneksi.php'; // Pastikan file koneksi

$sql = 'SELECT id, deskripsi, waktu FROM tugas';
$statement = $conn->query($sql);
$tugas = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Daftar Tugas</h2>
<ul>
<?php if ($tugas): ?>
    <?php foreach ($tugas as $t): ?>
        <li>
            <a href="tugas.php?id=<?= $t['id'] ?>">
                <?= htmlspecialchars($t['deskripsi']) ?> - <?= htmlspecialchars($t['waktu']) ?>
            </a>
        </li>
    <?php endforeach; ?>
<?php else: ?>
    <li>Tidak ada tugas.</li>
<?php endif; ?>
</ul>
