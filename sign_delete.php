<?php
include 'db.php'; 

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (filter_var($id, FILTER_VALIDATE_INT)) {
        $query = "DELETE FROM sign_up WHERE id = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                header("Location: read.php");
                exit;
            } else {
                echo "Gagal menghapus data: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Gagal mempersiapkan statement: " . $conn->error;
        }
    } else {
        echo "ID tidak valid.";
    }
} else {
    echo "Parameter ID tidak ditemukan.";
}

$conn->close();
?>
