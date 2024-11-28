<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'converse_database';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_POST['name'], $_POST['address'], $_POST['city'], $_POST['number'], $_POST['notes'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $number = $_POST['number'];
    $notes = $_POST['notes'];

    $stmt = $conn->prepare("INSERT INTO form_co (name, address, city, number, notes) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $address, $city, $number, $notes);

    if ($stmt->execute()) {
        echo "Checkout berhasil!";
    } else {
        echo "Terjadi kesalahan: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Data tidak lengkap!";
}

$conn->close();
?>
