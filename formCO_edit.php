<?php
require 'db.php';

// Validasi ID dari URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID tidak valid atau tidak ada.");
}

$id = (int) $_GET['id'];

// Ambil data dari database
$result = $conn->query("SELECT * FROM form_co WHERE id = $id");
if ($result->num_rows === 0) {
    die("Data tidak ditemukan.");
}
$data = $result->fetch_assoc();

// Proses update data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $number = $_POST['number'];
    $size = $_POST['size'];
    $color = $_POST['color'];
    $notes = $_POST['notes'];

    $stmt = $conn->prepare("UPDATE form_co SET name = ?, address = ?, city = ?, number = ?, size = ?, color = ?, notes = ? WHERE id = ?");
    $stmt->bind_param('sssssssi', $name, $address, $city, $number, $size, $color, $notes, $id);

    if ($stmt->execute()) {
        header('Location: read.php'); // Redirect ke halaman list data
        exit();
    } else {
        echo "Gagal mengupdate data: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
</head>
<body>
    <h1>Edit Data Checkout</h1>
    <form action="http://localhost:8080/CONVERSE_DATABASE/php/proses_checkout.php" method="POST">
        <label>Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($data['name']); ?>" required><br>
        <label>Address:</label>
        <input type="text" name="address" value="<?= htmlspecialchars($data['address']); ?>" required><br>
        <label>City:</label>
        <input type="text" name="city" value="<?= htmlspecialchars($data['city']); ?>" required><br>
        <label>Phone Number:</label>
        <input type="text" name="number" value="<?= htmlspecialchars($data['number']); ?>" required><br>
        <label>Size:</label>
        <input type="text" name="size" value="<?= htmlspecialchars($data['size']); ?>" required><br>
        <label>Color:</label>
        <input type="text" name="color" value="<?= htmlspecialchars($data['color']); ?>" required><br>
        <label>Notes:</label>
        <textarea name="notes" required><?= htmlspecialchars($data['notes']); ?></textarea><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
