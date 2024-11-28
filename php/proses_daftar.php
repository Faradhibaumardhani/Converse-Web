<?php
include 'koneksi.php';  

$email = $_POST['email'];
$password = $_POST['password'];

$hashed_password = password_hash($password, PASSWORD_DEFAULT);


$query = "SELECT * FROM sign_up WHERE email = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    echo "Email sudah digunakan.";
    echo '<br><a href="../sign_in.html">Login</a>';
} else {
    $insert_query = "INSERT INTO sign_up (email, password) VALUES (?, ?)";
    $insert_stmt = mysqli_prepare($koneksi, $insert_query);
    mysqli_stmt_bind_param($insert_stmt, "ss", $email, $hashed_password);

    if (mysqli_stmt_execute($insert_stmt)) {
        echo "Registrasi berhasil!";
        echo '<br><a href="../sign_in.html">Kembali ke Beranda</a>';
    } else {
        echo "Terjadi kesalahan: " . mysqli_error($koneksi);
    }
}
?>
