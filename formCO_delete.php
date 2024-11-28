<?php
require 'db.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM form_co WHERE id = ?");
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        header('Location: formCO_read.php');
        exit;
    } else {
        echo "Gagal menghapus data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID tidak valid atau tidak ditemukan.";
}

$conn->close();
?>
