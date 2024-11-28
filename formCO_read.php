<?php
require 'db.php';

$result = $conn->query("SELECT * FROM form_co");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout List</title>
</head>
<body>
    <h1>Checkout Data</h1>
    <a href="formCO_add.php">Tambah Data Baru</a>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>City</th>
            <th>Phone Number</th>
            <th>Size</th>
            <th>Color</th>
            <th>Notes</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['name']; ?></td>
                <td><?= $row['address']; ?></td>
                <td><?= $row['city']; ?></td>
                <td><?= $row['number']; ?></td>
                <td><?= $row['size']; ?></td>
                <td><?= $row['color']; ?></td>
                <td><?= $row['notes']; ?></td>
                <td>
                    <a href="formCO_edit.php?id=<?= $row['id']; ?>">Edit</a> |
                    <a href="formCO_delete.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
