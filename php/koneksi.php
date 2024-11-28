<?php
$host = 'localhost'; // Pastikan ini benar, bisa juga 127.0.0.1
$user = 'root'; // Default untuk XAMPP adalah 'root'
$password = ''; // Default password XAMPP adalah kosong
$database = 'converse_database'; // Pastikan ini sesuai dengan nama database Anda

$koneksi = mysqli_connect($host, $user, $password, $database);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
