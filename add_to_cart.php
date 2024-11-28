<?php
session_start();

// Periksa apakah data produk dikirim melalui POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $quantity = 1;

    // Periksa apakah session keranjang sudah ada
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Cek apakah produk sudah ada di keranjang
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['name'] === $product_name) {
            $item['quantity'] += 1;  // Tambahkan jumlah jika sudah ada
            $found = true;
            break;
        }
    }

    // Jika produk belum ada di keranjang, tambahkan sebagai item baru
    if (!$found) {
        $_SESSION['cart'][] = [
            'name' => $product_name,
            'price' => $product_price,
            'quantity' => $quantity,
        ];
    }

    // Redirect kembali ke halaman shop
    header('Location: shop2.html');
    exit();
}
?>
