// Ambil produk dari localStorage
let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

// Fungsi untuk menampilkan item ke dalam tabel keranjang
function displayCartItems() {
    const cartTableBody = document.getElementById('cart-items');
    const cartTotalElement = document.getElementById('cart-total');
    let cartTotal = 0;

    // Bersihkan tabel sebelum menambahkan elemen baru
    cartTableBody.innerHTML = '';

    // Loop melalui item dalam cartItems dan tambahkan ke tabel
    cartItems.forEach((item, index) => {
        const row = document.createElement('tr');

        // Format harga menggunakan fungsi formatRupiah
        const formattedPrice = formatRupiah(item.price);
        const formattedTotal = formatRupiah(item.price * item.quantity);

        row.innerHTML = `
            <td>${item.name}</td>
            <td>${formattedPrice}</td>
            <td>
                <button class="btn btn-secondary btn-sm" data-index="${index}" onclick="changeQuantity(${index}, 1)">+</button>
                <span>${item.quantity}</span>
                <button class="btn btn-secondary btn-sm" data-index="${index}" onclick="changeQuantity(${index}, -1)">-</button>
            </td>
            <td><button class="remove-btn btn btn-danger btn-sm" data-index="${index}">Remove</button></td>
        `;

        cartTableBody.appendChild(row);
        cartTotal += item.price * item.quantity;
    });

    // Update total keranjang
    cartTotalElement.textContent = formatRupiah(cartTotal);

    // Tambahkan event listener untuk tombol remove
    const removeButtons = document.querySelectorAll('.remove-btn');
    removeButtons.forEach((button, index) => {
        button.addEventListener('click', (event) => removeItem(event));
    });

    // Update ikon keranjang setelah menampilkan item
    updateCartIcon();
}

// Fungsi untuk mengubah jumlah produk
function changeQuantity(index, change) {
    const item = cartItems[index];
    item.quantity += change;

    // Jika jumlah menjadi nol, hapus item dari keranjang
    if (item.quantity <= 0) {
        cartItems.splice(index, 1);
    }

    // Simpan kembali ke localStorage
    localStorage.setItem('cartItems', JSON.stringify(cartItems));

    // Tampilkan ulang item di tabel
    displayCartItems();
}

// Fungsi untuk menghapus item dari keranjang
function removeItem(event) {
    const index = event.target.getAttribute('data-index');
    //untuk menghapus item atau produk
    cartItems.splice(index, 1);

    // Simpan perubahan ke localStorage
    localStorage.setItem('cartItems', JSON.stringify(cartItems));

    // Tampilkan ulang item di tabel
    displayCartItems();
}

// Fungsi untuk memformat angka menjadi Rupiah
function formatRupiah(number) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(number);
}

// Fungsi untuk memperbarui jumlah item di ikon keranjang
function updateCartIcon() {
    let totalItems = cartItems.reduce((total, item) => total + item.quantity, 0);
    document.getElementById('cart-icon-count').textContent = totalItems;
}

// Event listener untuk tombol Checkout
document.getElementById('checkout-btn').addEventListener('click', () => {
    // Kosongkan keranjang setelah checkout
    cartItems = [];
    localStorage.setItem('cartItems', JSON.stringify(cartItems));
    displayCartItems();
});

// Tampilkan item di keranjang saat halaman dimuat
window.onload = () => {
    displayCartItems();
    updateCartIcon();
};

// Event listener untuk form Checkout
document.getElementById('checkout-btn-form').addEventListener('click', (e) => {
    e.preventDefault();

    // Ambil data dari form checkout
    const name = document.getElementById('name').value.trim();
    const address = document.getElementById('address').value.trim();
    const city = document.getElementById('city').value.trim();
    const number = document.getElementById('number').value.trim();
    const notes = document.getElementById('notes').value.trim();

    // Log data untuk memeriksa apakah sudah benar
    console.log({
        name,
        address,
        city,
        number,
        notes,
        cartItems: cartItems
    });

    // Validasi form
    if (!name || !address || !city || !number) {
        alert('Semua field wajib diisi!');
        return;
    }

    if (cartItems.length === 0) {
        alert('Keranjang Anda kosong!');
        return;
    }

    // Kirim data ke PHP melalui fetch
    fetch('http://localhost:8080/proses_checkout.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `name=${encodeURIComponent(name)}&address=${encodeURIComponent(address)}&city=${encodeURIComponent(city)}&number=${encodeURIComponent(number)}&cartItems=${encodeURIComponent(JSON.stringify(cartItems))}&notes=${encodeURIComponent(notes)}`
    })
    .then(response => response.text())
    .then(data => {
        alert('Checkout berhasil!');
        cartItems = [];
        localStorage.setItem('cartItems', JSON.stringify(cartItems));
        displayCartItems();
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Checkout gagal! Periksa koneksi atau coba lagi.');
    });
});