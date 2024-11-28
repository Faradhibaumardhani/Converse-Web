<?php
require 'db.php';

// Validasi ID dari parameter GET
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Persiapan query untuk menghapus data
    $stmt = $conn->prepare("DELETE FROM form_co WHERE id = ?");
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        // Redirect ke halaman daftar setelah berhasil
        header('Location: formCO_read.php');
        exit;
    } else {
        // Menampilkan pesan error jika gagal
        echo "Gagal menghapus data: " . $stmt->error;
    }

    // Tutup statement
    $stmt->close();
} else {
    // Pesan jika ID tidak valid
    echo "ID tidak valid atau tidak ditemukan.";
}

// Tutup koneksi
$conn->close();
?>
