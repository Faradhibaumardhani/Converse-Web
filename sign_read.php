<?php
include 'db.php';  
 
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$result = mysqli_query($conn, "SELECT * FROM sign_up");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Sign Up</title>
</head>
<body>
    <h2>Data Sign Up</h2>
    <a href="sign_add.php">Tambah Data Baru</a>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Password (hashed)</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['password']) ?></td>
                    <td>
                        <a href="sign_update.php?id=<?= $row['id'] ?>">Edit</a> |
                        <a href="sign_delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
