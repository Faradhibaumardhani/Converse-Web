<?php
include 'koneksi.php';  

$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM sign_up WHERE email = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);

    if (password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        echo "Login berhasil!";
        echo '<br><a href="../home.html">Kembali ke Beranda</a>'; 
    } else {
        echo "Password salah.";
        echo '<br><a href="../sign_in.html">Kembali ke Beranda</a>'; 
    }
} else {
    echo "Email tidak ditemukan.";
    echo '<br><a href="../sign_up.html">Kembali ke Beranda</a>'; 
}
?>


