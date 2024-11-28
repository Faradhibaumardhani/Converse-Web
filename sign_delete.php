<?php
include 'db.php'; // Pastikan path file ini benar

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Validasi bahwa 'id' adalah angka
    if (filter_var($id, FILTER_VALIDATE_INT)) {
        // Query untuk menghapus data
        $query = "DELETE FROM sign_up WHERE id = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                // Redirect ke halaman read.php jika berhasil
                header("Location: read.php");
                exit;
            } else {
                // Tampilkan pesan error jika query gagal dijalankan
                echo "Gagal menghapus data: " . $stmt->error;
            }

            $stmt->close();
        } else {
            // Tampilkan pesan error jika statement gagal dipersiapkan
            echo "Gagal mempersiapkan statement: " . $conn->error;
        }
    } else {
        echo "ID tidak valid.";
    }
} else {
    echo "Parameter ID tidak ditemukan.";
}

// Tutup koneksi database
$conn->close();
?>
