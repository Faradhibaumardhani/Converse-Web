<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $address = trim($_POST['address']);
    $city = trim($_POST['city']);
    $number = trim($_POST['number']);
    $size = trim($_POST['size']);
    $color = trim($_POST['color']);
    $notes = trim($_POST['notes']);

    if (empty($name) || empty($address) || empty($city) || empty($number) || empty($size) || empty($color) || empty($notes)) {
        echo "Semua field wajib diisi!";
        exit();
    }

    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";

    $stmt = $conn->prepare("INSERT INTO form_co (name, address, city, number, size, color, notes) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Gagal menyiapkan statement: " . $conn->error);
    }

    $stmt->bind_param('sssssss', $name, $address, $city, $number, $size, $color, $notes);

    if ($stmt->execute()) {
        header('Location: formCO_read.php');
        exit();
    } else {
        echo "Gagal menambahkan data: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Baru</title>
</head>
<body>
    <h1>Tambah Data Baru</h1>
    <form action="http://localhost:8080/CONVERSE_DATABASE/php/proses_checkout.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required><br>

        <label for="city">City:</label>
        <input type="text" id="city" name="city" required><br>

        <label for="number">Phone Number:</label>
        <input type="text" id="number" name="number" required><br>

        <label for="size">Size:</label>
        <select id="size" name="size" required>
            <option value="">Select Size</option>
            <option value="3">US 3</option>
            <option value="3.5">US 3.5</option>
            <option value="4.5">US 4.5</option>
            <option value="5.5">US 5.5</option>
            <option value="6">US 6</option>
            <option value="6.5">US 6.5</option>
            <option value="7">US 7</option>
            <option value="7.5">US 7.5</option>
            <option value="8.5">US 8.5</option>
            <option value="9.5">US 9.5</option>
            <option value="10">US 10</option>
            <option value="11">US 11</option>
        </select><br>

        <label for="color">Color:</label>
        <select id="color" name="color" required>
            <option value="">Select Color</option>
            <option value="Red">Red</option>
            <option value="White">White</option>
            <option value="Blue">Blue</option>
            <option value="Black">Black</option>
            <option value="Brown">Brown</option>
            <option value="Green">Green</option>
        </select><br>

        <label for="notes">Notes:</label>
        <textarea id="notes" name="notes" required></textarea><br>

        <button type="submit">Tambah Data</button>
    </form>
    <br>
    <a href="formCO_read.php">Kembali ke Daftar Data</a>
</body>
</html>
