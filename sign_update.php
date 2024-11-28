<?php
include 'db.php';   

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID tidak valid.");
}

$id = $_GET['id'];

$query = "SELECT * FROM sign_up WHERE id = ?";
$stmt = $conn->prepare($query); // Gunakan $conn, bukan $db
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if ($data === null) {
    die("Data tidak ditemukan.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $update_query = "UPDATE sign_up SET email = ?, password = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_query); // Gunakan $conn untuk koneksi
    $update_stmt->bind_param("ssi", $email, $hashed_password, $id);

    if ($update_stmt->execute()) {
        header("Location: read.php");  
        exit;
    } else {
        echo "Gagal mengupdate data: " . $conn->error;  
    }
}

$stmt->close();
$conn->close();  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
</head>
<body>
    <h2>Edit Data</h2>
    <form action="sign_update.php?id=<?= $id ?>" method="POST">
        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($data['email'] ?? ''); ?>" required>
        <br>
        <label>Password:</label>
        <input type="password" name="password" placeholder="Masukkan password baru" required>
        <br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
